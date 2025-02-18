FROM php:8.3-fpm

ARG user
ARG uid

# Install system dependencies
RUN apt-get update

RUN apt-get install -y \
    sudo \
    git \
    wget \
    curl \
    libpq-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libwebp-dev \
    libzip-dev \
    libjpeg62-turbo-dev \
    zip \
    unzip \
    zsh

SHELL ["/bin/zsh", "-c"]

# Default powerline10k theme, no plugins installed
RUN sh -c "$(wget -O- https://github.com/deluan/zsh-in-docker/releases/download/v1.1.5/zsh-in-docker.sh)"

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-webp --with-jpeg

# Install PHP extensions
RUN docker-php-ext-install pdo pgsql pdo_pgsql soap mbstring exif pcntl bcmath gd intl zip

RUN pecl install redis && docker-php-ext-enable redis

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && chown -R $user:$user /home/$user


# Set working directory
WORKDIR /var/www

USER $user
