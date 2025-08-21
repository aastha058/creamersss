# PHP 8.2 CLI बेस इमेज
FROM php:8.2-cli

# सिस्टम डिपेंडेंसीज़ (Laravel + Vite build के लिए)
RUN apt-get update && apt-get install -y \
    unzip git curl libpng-dev libonig-dev libxml2-dev zip libzip-dev \
    nodejs npm \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Composer जोड़ें
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# वर्किंग डायरेक्टरी
WORKDIR /var/www/html

# कोड कॉपी
COPY . .

# PHP डिपेंडेंसीज़
RUN composer install --no-dev --optimize-autoloader

# फ्रंटएंड (Vite) build
RUN npm install && npm run build

# परमिशन
RUN chmod -R 777 storage bootstrap/cache

# कंटेनर पोर्ट
EXPOSE 8080

# ऐप स्टार्ट (माइग्रेशन के साथ)
CMD php artisan migrate --force && php artisan serve --host 0.0.0.0 --port 8080
