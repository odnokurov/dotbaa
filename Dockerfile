FROM php:8.3-fpm

# Системные пакеты и библиотеки для PHP-расширений
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    && docker-php-ext-install \
        pdo_mysql \
        mbstring \
        zip \
        intl \
    && rm -rf /var/lib/apt/lists/*

# Устанавливаем Composer из официального образа
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www