CREATE DATABASE IF NOT EXISTS dapoer_omom CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE dapoer_omom;
CREATE TABLE users(
 id INT AUTO_INCREMENT PRIMARY KEY,nama VARCHAR(100) NOT NULL,email VARCHAR(120) NOT NULL UNIQUE,
 password VARCHAR(255) NOT NULL,role ENUM('admin','user') NOT NULL DEFAULT 'user',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE menu(
 id INT AUTO_INCREMENT PRIMARY KEY,nama VARCHAR(160) NOT NULL,harga INT NOT NULL,
 kategori VARCHAR(80) DEFAULT 'MENU FAVORIT',gambar VARCHAR(255) DEFAULT 'assets/poster.jpg',
 status TINYINT(1) DEFAULT 1,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE transaksi(
 id INT AUTO_INCREMENT PRIMARY KEY,kode VARCHAR(50) UNIQUE NOT NULL,user_id INT NULL,
 pelanggan VARCHAR(100) DEFAULT 'Umum',metode VARCHAR(40) NOT NULL,total INT NOT NULL,
 dibayar INT NOT NULL DEFAULT 0,kembalian INT NOT NULL DEFAULT 0,catatan TEXT,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE SET NULL
);
CREATE TABLE transaksi_detail(
 id INT AUTO_INCREMENT PRIMARY KEY,transaksi_id INT NOT NULL,menu_id INT NULL,
 nama_menu VARCHAR(160) NOT NULL,harga INT NOT NULL,qty INT NOT NULL,subtotal INT NOT NULL,
 FOREIGN KEY(transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE,
 FOREIGN KEY(menu_id) REFERENCES menu(id) ON DELETE SET NULL
);
INSERT INTO users(nama,email,password,role) VALUES
('Administrator','admin@dapoeromom.local','$2y$12$2px4KFZRfeX07Ievp36kfu90diRigUwD/7tA4gf3CrkzpsqfkMVK6','admin'),
('User Demo','user@dapoeromom.local','$2y$12$aPMSfvPoOKaFxbb8OOypFODw2YHFW22cmMXUdb7yMvhUNa1c95/2u','user');
INSERT INTO menu(nama,harga,kategori,gambar) VALUES
('Ricebowl Chicken Pop Ukuran Besar',20000,'BEST SELLER','assets/chicken_pop.jpeg'),
('Nasi Ayam Teriyaki Mix Vegetables',20000,'NASI FAVORIT','assets/ayam_teriyaki.jpeg'),
('Nasi Daun Jeruk Ayam Cabe Garam',13000,'NASI FAVORIT','assets/daun_jeruk.jpeg'),
('Spaghetti Bolognese Cheese',15000,'RUMAHAN','assets/spaghetti.jpeg'),
('Nasi Ayam Serundeng Mix',20000,'NASI FAVORIT','assets/serundeng_mix.jpeg'),
('Ricebowl Chicken Pop Asam Manis',15000,'BEST SELLER','assets/asam_manis.jpeg');
