FROM php:8.3-fpm

# システムパッケージのインストール
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    libonig-dev \
    libicu-dev \
    nginx \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# PHP拡張機能のインストールと構成
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) \
    gd \
    pdo_mysql \
    mbstring \
    zip \
    exif \
    bcmath \
    opcache \
    intl

# Composerのインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 作業ディレクトリの設定
WORKDIR /var/www

# ソースコードをコピー
COPY ./src /var/www

# Composerのキャッシュを利用するため、composer.jsonとcomposer.lockを先にコピー
COPY ./src/composer.json ./src/composer.lock /var/www/

# Composerで依存関係をインストール
RUN composer install --no-dev --optimize-autoloader

# NginxとPHP-FPMの設定ファイルをコピー
COPY ./gcp/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY ./gcp/php.ini /usr/local/etc/php/
COPY ./gcp/start.sh /start.sh

# 権限の設定
RUN mkdir -p /var/www/storage /var/www/bootstrap/cache

# 権限の設定
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage \
    && chmod -R 775 /var/www/bootstrap/cache

RUN chmod +x /start.sh

# ポート8080を公開
EXPOSE 8080

# スタートアップスクリプトを実行
CMD ["sh", "/start.sh"]
