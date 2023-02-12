
## 概要
書籍「[プロフェッショナル Web プログラミング for Laravel 9](https://books.mdn.co.jp/books/3221303041/)」を実践

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
    
