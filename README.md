
## 概要
書籍「[プロフェッショナル Web プログラミング for Laravel 9](https://books.mdn.co.jp/books/3221303041/)」を実践。

チャプターごとにPR、ブランチを作成し、進めております。

以下のようなつぶやきアプリを作成
【機能】
- ユーザー登録、ログイン機能
- CRUD処理
- 会員登録時のイベント処理
<img width="1444" alt="スクリーンショット 2023-02-23 23 48 21" src="https://user-images.githubusercontent.com/109059339/220941471-51a2e491-ec0f-4342-a890-9c36fcc16367.png">


## 開発準備

1. `.env.example`をコピーして`.env`としてください

2. 以下のコマンドをアプリディレクトリ直下で実行します
    
    PHPパッケージをインストール
    ```bash
    composer install
    ```
    こちらはsailを使用可能にするためのコマンドです。
    ```bash
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v $(pwd):/var/www/html \
        laravelsail/php81-composer:latest \
        composer install --ignore-platform-reqs
    ```
    dockerを立ち上げる
    ```bash
    sail up -d
    ```
    アプリケーションキーの初期化
    ```bash
    sail artisan key:generate
    ```
    DBのマイグレーション＆seed実行
    ```bash
    sail artisan migrate:refresh --seed
    ```
    npm install
    ```bash
    sail npm install
    ```
    CSSを反映
    ```bash
    ail npm run development
    ```
    storageディレクトリにシンポリックリンクを作成
    ```bash
    sail artisan storage:link
    ```
    
3. こちらのパスからアプリに遷移できます。：[http://localhost/tweet](http://localhost/tweet)
