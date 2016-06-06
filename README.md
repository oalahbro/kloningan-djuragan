# Baca Ya..#

Web Order Juragan yang baru dengan angularJS dan sistem Codeigniter 3. Lebih cepat dan lebih powerful dengan peningkatan berbagai sisi.

### Cara Installasi? ###

* Upload semua data kedalam web hosting
* Bikin database baru atau import yang sudah ada (`crows_juragan.sql`)
* Pengaturan koneksi database ada pada folder `config`
* Login menggunakan username `adminweb`. password `tetapsemangat`

### Ugrade dari versi sebelumnya ###
Sebelum menggantikan versi yang sebelumnya, jalankan syntax berikut untuk upgrade database;
````sql
ALTER TABLE `order` ADD `unik` VARCHAR(40) NOT NULL AFTER `data`;
UPDATE `order` SET `order`.`unik` = `order`.`id`;
````