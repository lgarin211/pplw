# Gunakan image PHP resmi dengan versi terbaru yang kompatibel dengan Laravel
FROM php:8.2-cli

# Install dependensi untuk PHP, MySQL/MariaDB client, dan Composer
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    libmysqlclient-dev \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install MySQL/MariaDB client
RUN apt-get update && apt-get install -y mysql-client

# Install PHP extensions untuk Laravel (jika diperlukan)
RUN docker-php-ext-configure zip
RUN docker-php-ext-install gd zip

# Set direktori kerja di dalam container
WORKDIR /workspace

# Expose port untuk PHP built-in server (opsional)
EXPOSE 8000

# Perintah untuk menjalankan PHP Built-in server saat container dijalankan (opsional)
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
