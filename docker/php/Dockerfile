# ベースイメージとして PHP 8.3-FPM を使用
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
    nodejs \
    npm \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# composer.lock と vendor ディレクトリを削除
RUN rm -rf vendor composer.lock

# PHPの拡張モジュールをインストール
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) \
    gd \
    pdo_mysql \
    mbstring \
    zip \
    exif \
    pcntl \
    bcmath \
    opcache

# Composerのインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ワーキングディレクトリを設定
WORKDIR /var/www

# アプリケーションコードをコンテナ内にコピー
COPY . /var/www

# PHPの設定ファイルをコピー
COPY ./php.ini /usr/local/etc/php/

# ポート9000を公開
EXPOSE 9000

# コンテナ起動時に実行されるコマンド
CMD ["php-fpm"]
