# Dive 365

横浜の Diving Shop C365 向けWordPressサイトです。日本語・英語のホーム、体験ダイビング、PADI講習・スキルアップ、ファンダイブツアー、予約カレンダーを提供します。日本語の既存記事はWordPressから表示します。

## ローカルで起動

Docker Compose、curl、Python 3を使用します。初回のみ任意のローカル管理者パスワードを環境変数で指定します。

```bash
read -rs DIVE365_ADMIN_PASSWORD
export DIVE365_ADMIN_PASSWORD
./scripts/start-local.sh
unset DIVE365_ADMIN_PASSWORD
```

初期ポートは8080、管理者名は `dive365_local` です。ポートを変える場合は初回起動前に `DIVE365_PORT` を設定してください。英語の入口は `/en/` です。ローカル版は検索インデックスを無効に設定します。DockerのボリュームにWordPress・DB・アップロードを保存します。`docker compose stop` で停止し、`docker compose up -d` で再開できます。

## 公開コンテンツを開発用サイトに取り込む

既存サイトの公開REST APIを利用します。新規の開発用DBに対して実行してください。本番データの復元は、後述のDBバックアップを使います。アップロードの取得には約600 MBの保存領域を使い、Docker内にもコピーします。

```bash
stage=$(mktemp -d)
python3 scripts/fetch-public.py "$stage"
chmod -R a+rX "$stage"
docker compose exec -T wordpress mkdir -p /tmp/dive365-public-stage
tar -C "$stage" -cf - . | docker compose exec -T wordpress tar -C /tmp/dive365-public-stage -xf -
docker compose cp scripts/import-public.php wordpress:/tmp/d365-import.php
docker compose exec -T wordpress chmod a+r /tmp/d365-import.php
docker compose exec -T --user www-data wordpress php /tmp/wp-cli.phar --path=/var/www/html \
  eval-file /tmp/d365-import.php /tmp/dive365-public-stage
```

公開されている固定ページ5件、通常投稿1件、ダイビングブログ24件、お知らせ2件、メディア登録274件を取り込めることを確認しました。取得対象のメディアはサイズ違いなどを含め635ファイルでした。移行元ですでに404だった画像の縮小版7点は、同じ写真の取得可能なファイルに置き換えます。公開RESTで取得できる記事本文と公開ファイルが対象です。下書き、コメント、ユーザー、プラグイン設定などの完全移行には本番バックアップが必要です。

## 日程・予約の運用

1. 管理画面の「ダイビング日程」からタイトル、開催日（日本時間）、英語のイベント名、コースを登録し、予約受付を「受付中」にして公開します。
2. 申請は「ダイビング予約」に「未対応」で保存されます。公開日程のない場合も希望日の相談を受け付けます。管理者が詳細を確認し、顧客にメール等で連絡してから対応状況を更新します。申請者の情報は管理者向けの予約詳細に表示されます。
3. 受付終了時は日程の受付状態を変更します。同じ日程への複数の問い合わせを受ける方式で、空席数の自動確保や自動メール送信は未実装です。

## 継続開発と本番切替

- `wp-content/themes/dive365/` にデザイン、日英コピー、コース案内、店舗SEO情報があります。平丸さんをメイン、益田さんと水越さんを非常勤として掲載しています。ヒーロー写真は既存の大瀬崎ブログから、再生可能な映像は既存トップ動画から使用しています。
- `wp-content/plugins/dive365-shop/` に日程、予約、英語URL、および現行の投稿タイプ `diving_blog`・`news` の登録があります。テーマ差し替え時も投稿を参照できるよう、既存サイトのコピーでプラグインを先に有効化します。英語ページを追加した際はパーマリンクのリライトルールを更新してください。
- PADI講習ページの開催・料金は既存の個別案内を反映しています。トップに掲載されていた金額と異なるため、公開前に店舗で料金を再確認してください。EFR、レスキュー、スペシャルティ、ダイブマスターは公式カリキュラムを掲載し、店舗での開催可否は相談として案内します。
- 本番は既存のDBと `wp-content/uploads` のバックアップからステージングを作り、元の記事ID、パーマリンク、メディア、プラグインのショートコードを確認します。既存ブログとお知らせは元の投稿URLで確認し、URLを変更する場合は301転送を設定します。予約公開前に本番で受付・管理とプライバシーポリシーを確認します。
- 公開先ではサイトのインデックス設定を見直し、`/wp-sitemap.xml` をSearch Consoleに送信します。店舗名、住所、電話番号、営業時間をGoogleビジネスプロフィールの表記と揃えます。テーマはページタイトル、説明文、canonical、日英hreflang、店舗構造化データ、英語ページのサイトマップを出力します。既存のSEOプラグインを使用する場合はメタデータの出力重複を確認してください。
