#!/usr/bin/env python3
"""Download the public Dive 365 REST snapshot and media into a staging directory."""

from concurrent.futures import ThreadPoolExecutor
from html import unescape
import json
from urllib.error import HTTPError
from pathlib import Path
import re
import sys
from time import sleep
from urllib.parse import quote, unquote, urlencode, urlsplit
from urllib.request import urlopen

SITE = "https://dive.c365.jp"
UPLOADS = "/wp-content/uploads/"
TYPES = ("pages", "posts", "diving_blog", "news", "media")


def read(url):
    for delay in (0, 1, 3):
        sleep(delay)
        try:
            return urlopen(url, timeout=30)
        except OSError:
            if delay == 3:
                raise


def records(kind):
    items = []
    page = 1
    while True:
        query = urlencode({"rest_route": f"/wp/v2/{kind}", "per_page": 100, "page": page})
        with read(f"{SITE}/index.php?{query}") as response:
            items.extend(json.load(response))
            if page >= int(response.headers["X-WP-TotalPages"]):
                if len(items) != int(response.headers["X-WP-Total"]):
                    raise RuntimeError(f"Source collection changed while reading: {kind}")
                return items
        page += 1


def media_path(url):
    parts = urlsplit(unescape(url))
    path = Path(unquote(parts.path.removeprefix(UPLOADS)))
    if (parts.scheme == "https" and parts.netloc == "dive.c365.jp"
            and parts.path.startswith(UPLOADS) and path.parts and not path.is_absolute() and ".." not in path.parts):
        return path
    return None


def download(root, path):
    target = root / "uploads" / path
    if target.is_file() and target.stat().st_size:
        return
    try:
        with read(SITE + UPLOADS + quote(path.as_posix())) as response:
            target.parent.mkdir(parents=True, exist_ok=True)
            partial = target.with_name(target.name + ".partial")
            with partial.open("wb") as output:
                while block := response.read(1024 * 1024):
                    output.write(block)
            size = response.headers.get("Content-Length")
            if size and partial.stat().st_size != int(size):
                raise OSError("Incomplete download")
            partial.replace(target)
    except OSError as error:
        return path, error
    return None


def main(root):
    root.mkdir(parents=True, exist_ok=True)
    with ThreadPoolExecutor(max_workers=6) as pool:
        payload = dict(zip(TYPES, pool.map(records, TYPES)))
    required = set()
    for attachment in payload["media"]:
        path = media_path(attachment["source_url"])
        if path is None:
            raise RuntimeError(f"Unexpected media URL for attachment #{attachment['id']}")
        required.add(path)
        original = attachment["media_details"].get("original_image")
        if original:
            required.add(path.with_name(original))
    for page in payload["pages"]:
        if page["id"] in (14, 47) and not page["content"]["rendered"]:
            with read(f"{SITE}/?page_id={page['id']}") as response:
                html = response.read().decode()
            page["content"]["rendered"] = re.search(r"<main\b[^>]*>(.*?)</main\s*>", html, re.I | re.S)[1]
    for kind in TYPES[:-1]:
        for post in payload[kind]:
            for url in re.findall(r'https://dive\.c365\.jp/wp-content/uploads/[^\s"\'<>?,()]+', post["content"]["rendered"]):
                path = media_path(url)
                if path is not None:
                    required.add(path)
    with ThreadPoolExecutor(max_workers=10) as pool:
        errors = [err for err in pool.map(lambda path: download(root, path), sorted(required)) if err]
    unresolved = []
    for missing, error in errors:
        stem = re.sub(r"-[0-9]+x[0-9]+$", "", missing.stem)
        alternatives = [
            path for path in required if path.parent == missing.parent and path.suffix == missing.suffix
            and re.fullmatch(re.escape(stem) + r"(?:-scaled)?(?:-[0-9]+)?", path.stem)
            and (root / "uploads" / path).is_file()
        ]
        if not isinstance(error, HTTPError) or error.code != 404 or stem == missing.stem or len(alternatives) != 1:
            unresolved.append(f"{missing}: {error}")
            continue
        print(f"Missing source thumbnail {missing}, using {alternatives[0]}")
        for kind in TYPES[:-1]:
            for post in payload[kind]:
                html = post["content"]["rendered"]
                replacement = alternatives[0].as_posix()
                post["content"]["rendered"] = html.replace(UPLOADS + missing.as_posix(), UPLOADS + replacement)
    if unresolved:
        raise SystemExit("\n".join(unresolved))
    (root / "snapshot.json").write_text(json.dumps(payload, ensure_ascii=False), encoding="utf-8")
    print(f"{len(payload['media'])} attachments, {len(required) - len(errors)} media files, "
          f"{sum(len(payload[kind]) for kind in TYPES[:-1])} public content records")


if __name__ == "__main__":
    main(Path(sys.argv[1]))
