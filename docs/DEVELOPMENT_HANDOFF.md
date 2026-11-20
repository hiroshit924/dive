# Diving Shop C365 開発引き継ぎ

2026年11月20日（日本時間）

## GitHubと作業ブランチ

- リポジトリは `hiroshit924/dive`。次回は `handoff/2026-11-20` を使用する。
- 本日の最終ソースコミットは `da0e044423f53744cf0e22d2475bb5b487d86044`。終了時の確認で GitHub の `main` もこのコミットを指していた。
- このファイルを保存したコミットは `git log -1 --format=%H -- docs/DEVELOPMENT_HANDOFF.md` で確認できる。リモートの先端は `git ls-remote origin refs/heads/handoff/2026-11-20` で確認する。
- 配布用の `downloads` は `00e4eb977045efa7ac149113efc1b2300b3c986c`。テーマ1.8.2とプラグイン1.9.0のZIPは、展開した全ファイルが最終ソースと一致した。
- 11月19日までの変更と検証は前日の記録を参照。 [11月19日の引き継ぎ](https://github.com/hiroshit924/dive/blob/handoff/2026-11-19/docs/DEVELOPMENT_HANDOFF.md)

## 本日完了した実装

| コミット | 変更内容 |
| --- | --- |
| `a7e1199` | 日英の初島・熱海ページを追加。スポット情報、定期船・地図、店舗集合と無料送迎の案内を整備。サイト共通の予約導線と日英プライバシーページを追加し、予約フォームに「その他のご相談」を用意。その他の相談は人数を省略でき、確認画面と受付・店舗向け通知は問い合わせ用の文言を使う。税込レンタル価格とキャンセル料表も更新。 |
| `e6ab29a` | 国内を「逗子・葉山・城ヶ島」「伊豆」「初島・熱海」の3地域に整理。既存の地域URLを維持し、葉山のビーチ・ボート案内、開始料金（29,000円、36,000円、33,000円）、日英コピーとSEOを更新。 |
| `da0e044` | 国内ツアーの料金欄に3地域すべての相談リンクを設置。日英の予約フォームに希望エリアを引き継ぐ。 |

開始時点で上記3件はコミット済みで、ステージ済み・未ステージ・未追跡のファイルはなかった。差分レビューは前日の最終ソース `9c4a804` から本日の最終ソースまでの22ファイルを対象とした。

## 現在のシステム構成

| 場所 | 役割 |
| --- | --- |
| `wp-content/themes/dive365/` | 日英のページ・ナビゲーション・SEO・ブログ・静的素材。国内ツアーの地域・スポットは `tour-destinations.php`、料金・相談リンクは `tour.php`、レンタルとキャンセル料は `template-parts/`。 |
| `wp-content/plugins/dive365-shop/` | 日英のURL、旧投稿タイプ `diving_blog`・`news`、日程 `d365_session`、非公開の予約・問い合わせ `d365_booking`、メール。 |
| `compose.yaml`・`scripts/start-local.sh` | WordPress（PHP 8.3 / Apache）とMariaDB 11.4。WP-CLIで初期化、テーマ・プラグインの有効化、リライトルール更新を実行。テーマ・プラグインはチェックアウトから読み込む。 |
| Dockerの名前付きボリューム | WordPress本体、DB、アップロード。新しいボリュームでは空の開発用サイトが起動する。 |
| `scripts/fetch-public.py`・`scripts/import-public.php` | 旧サイトの公開REST APIと公開メディアから開発用データを取り込む。手順は [README](../README.md#公開コンテンツを開発用サイトに取り込む) を参照。 |

検証時は WordPress 7.1.5、PHP 8.3.37、MariaDB 11.4.13、Docker Compose v2.40.3、Python 3.12.14、Node.js 24.22.1。Composeのイメージタグが更新されるとパッチバージョンは変わる。

## 検証結果と発見事項

- 空の別Composeプロジェクトで初回起動と初期化スクリプトの再実行に成功。PHP 34ファイル、JavaScript 2ファイル、BashとPythonの構文、Compose設定、Git差分の空白チェックが通った。
- 26件のHTTP GETで200と目的の内容を確認。日英トップ、国内一覧と3地域、海外ツアー、プライバシー、OW講習、3地域の希望場所の自動入力、月をまたぐ日程の両月表示、日程の事前選択を確認した。
- HTTP POSTを6ケース確認。日英の「その他のご相談」は人数なしで受付。既存の日程予約は人数2・希望場所・終了日付きで受付。通常のツアー相談の人数未入力、不正なnonce、存在しない日程は拒否された。3レコードは非公開・未対応で保存され、メール6通をローカルで捕捉。問い合わせに対して予約確定メールが送られないことも確認した。
- 旧サイトの固定ページがないDBでは、日本語の `/dive-trips/` を直接開くと404。サイト内リンクが使う `/?d365_experience=tour` と各地域の直接URLは200だった。この経路の実装は前日の時点から存在する。ステージングでは旧DBの固定ページID 14と実際のパーマリンクを照合する。
- ブラウザ上でのスマホ表示、メニュー、JavaScriptによるフォーム項目の切り替えと送信後のフォーカス、ステージングでのSMTP実配信・既存データ移行・キャッシュ・サイトマップは未検証。公開前に店舗側で料金、キャンセル条件、プライバシー文面を確認する。

## 新しいCodex環境で再開する

GitHubを読み込むときに `handoff/2026-11-20` を選ぶ。既存のチェックアウトが `main` の場合は、作業ツリーがクリーンなことを確認してから切り替える。

```bash
cd /workspace/dive
git status --short --branch
git remote set-branches --add origin handoff/2026-11-20
git fetch origin refs/heads/handoff/2026-11-20:refs/remotes/origin/handoff/2026-11-20
git switch --track origin/handoff/2026-11-20
git log -1 --oneline
```

同名のローカルブランチがある場合は `git switch handoff/2026-11-20` で切り替える。

Dockerデーモン、Compose v2、Bash、curl、Python 3、ripgrepが必要。JavaScriptの構文確認はNode.jsを使用する。初回はローカル管理者用のパスワードを環境変数で渡す。次の例は一時的に生成する。管理画面にログインする場合は、初回起動前に自分で管理できる値を `DIVE365_ADMIN_PASSWORD` に指定する。

```bash
cd /workspace/dive
DIVE365_ADMIN_PASSWORD="${DIVE365_ADMIN_PASSWORD:-$(python3 -c 'import secrets; print(secrets.token_urlsafe(32))')}" \
    bash scripts/start-local.sh
docker compose ps
page=$(curl --noproxy '*' -fsS --retry 12 --retry-connrefused --retry-delay 1 --max-time 10 \
    "http://127.0.0.1:${DIVE365_PORT:-8080}/en/")
rg -Fq 'Dive calendar' <<< "$page"
```

- 既定のバインドは `127.0.0.1:8080`、管理者は `dive365_local`。ポートを変える場合は初回起動前に `DIVE365_PORT` を設定する。停止は `docker compose stop`。初期化済みの環境は `docker compose up -d --wait --wait-timeout 90` で再開できる。
- ComposeはDocker Hubのイメージ、起動スクリプトは `raw.githubusercontent.com` のWP-CLIを使用する。公開記事の取り込みには別途 `dive.c365.jp` へのHTTPSアクセス、tar、および取得データとコンテナ内のコピー用容量が必要。
- 今回の元の開発DBには公開記事・メディア・日程・予約が登録されていなかった。検証用の日程・予約は別のDBに作成した。現行サイトの運用データが必要な場合は、承認済みの保管先からDBと `wp-content/uploads` のバックアップをステージングに復元する。公開記事だけを確認する場合はREADMEの再取得手順を使用する。
- ローカル管理者パスワード、SMTP認証情報、APIキー、アクセストークン、`.env`、SQLダンプ、予約の個人情報はGitに入れない。SMTPなどの秘密情報は承認済みの環境設定で管理する。Compose内の固定DB文字列はローカル開発用。

## 次回最初にやること

1. 作業ブランチで起動し、スマートフォン幅で各地域の相談リンクからフォームまでを日英で確認する。「その他のご相談」への切り替え、日程付き申請、送信結果へのフォーカスを確認する。
2. 旧DBとアップロードを復元したステージングで、既存の日本語ツアーURL、記事・メディア、ショートコード、プライバシーURLを照合する。バックアップを待つ間は公開データで表示を確認する。
3. 店舗と料金・規約を確認し、ステージングでSMTP実配信と管理者による予約状態変更、キャッシュとサイトマップを検証する。
