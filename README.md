# Baca Ya..#

Web Order Juragan yang baru dengan angularJS dan sistem Codeigniter 3. Lebih cepat dan lebih powerful dengan peningkatan berbagai sisi.

### Cara Installasi? ###

* Upload semua data kedalam web hosting
* Bikin database baru atau import yang sudah ada (`crows_juragan.sql`)
* Pengaturan koneksi database ada pada folder `config`
* Login menggunakan username `adminweb`. password `tetapsemangat`

### Ugrade ###
Sebelum menggantikan versi yang sebelumnya, jalankan syntax berikut untuk upgrade database;
````sql
CREATE TABLE `juragan` (
  `id` int(11) NOT NULL,
  `nama_cs` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(120) NOT NULL,
  `level` enum('superadmin','admin','user') NOT NULL DEFAULT 'user',
  `register` datetime NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `juragan_auth` (
  `id` int(11) NOT NULL,
  `juragan_id` int(11) NOT NULL,
  `allow_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `juragan`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `juragan_auth`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `juragan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `juragan_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
````