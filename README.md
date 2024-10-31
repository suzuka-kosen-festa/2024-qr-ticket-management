## QR認証

## 起動方法
以下の手順に従ってプロジェクトをセットアップし、起動してください。

### 1. リポジトリをクローンします。

### 2. Dockerコンテナをビルドし、起動します。

```bash
docker-compose up -d --build
```

### 3. コンテナにアクセスして依存関係をインストールします。

まず、コンテナ内のbashにアクセスします。

```bash
docker exec -it  ticket-management bash
```

その後、コンテナ内で以下の手順を実行します。

- **データベースのマイグレーションを実行**:
    ```bash
    php artisan migrate
    ```

- **シーディングを実行して初期データを挿入**:
    ```bash
    php artisan db:seed --class=DatabaseSeeder
    ```

### 4. 開発サーバーの起動
- Tailwindを使用するとき`app.css`へビルドするために以下のコマンドをコンテナ内でする必要があります。
```bash
npm run watch
```

ブラウザで `http://localhost:8080/` にアクセスし、アプリケーションを確認してください。

### 5. コンテナの停止と削除

開発が終わったら、以下のコマンドでコンテナを停止し、削除します。

```bash
docker-compose down
```

### MySQLにアクセスしてデータを確認

MySQLコンテナに入って、データベース内のデータを確認します。

```bash
docker exec -it mysql-ticket-management bash
 mysql -u user -ppassword ticket-local # パスワードなどはテスト用
```

### その他の便利なコマンド

- **新しいシーダークラスを作成**:
    ```bash
    php artisan make:seeder <特定の>
    ```

- **autoloadファイルのリフレッシュ**:
    ```bash
    composer dump-autoload
    ```

- **キャッシュのクリア**:
    ```bash
    php artisan config:clear
    php artisan cache:clear
    php artisan route:clear
    php artisan view:clear
    ```
