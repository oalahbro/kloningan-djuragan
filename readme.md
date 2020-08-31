# Orderan Djuragan

## Sekilas Info

Web POS ini dibangun dengan menggunakan framework [Codeigniter](http://codeigniter.com) v4.0.4

## Update System

Untuk update versi CI, cukup jalankan `composer update`.

Jangan lupa untuk perhaikan apa-apa yang perlu diperbarui untuk versi terbaru

## Setup

Jalankan  `php -r "file_exists('.env') || copy('env', '.env');"` di-root dan lakukan pengaturan baseUrl dan database atau yang lainnya.

## Upload ke server

`public/index.php` adalah halaman utama situs. Jangan lupa untuk pointing ke folder `public`.

## Server Requirements

PHP version 7.2 or higher is required, with the following extensions installed: 

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)
