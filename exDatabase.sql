CREATE DATABASE IF NOT EXISTS LaptopShop
  DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE LaptopShop;

CREATE TABLE IF NOT EXISTS laptops (
  id INT(11) NOT NULL AUTO_INCREMENT,
  brand VARCHAR(100) NOT NULL,       -- Hãng laptop (Dell, Asus, Apple…)
  model VARCHAR(100) NOT NULL,       -- Tên model
  processor VARCHAR(100) NOT NULL,   -- CPU
  ram VARCHAR(50) NOT NULL,          -- RAM (8GB, 16GB…)
  storage VARCHAR(50) NOT NULL,      -- Ổ cứng (512GB SSD…)
  price DECIMAL(10,2) NOT NULL,      -- Giá bán
  stock INT NOT NULL,                -- Số lượng còn
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO laptops (brand, model, processor, ram, storage, price, stock) VALUES
('Dell', 'XPS 13', 'Intel i7-1360P', '16GB', '512GB SSD', 1500.00, 10),
('Asus', 'ROG Strix G15', 'AMD Ryzen 7 6800H', '16GB', '1TB SSD', 1800.00, 5),
('Apple', 'MacBook Air M2', 'Apple M2', '8GB', '256GB SSD', 1200.00, 8);