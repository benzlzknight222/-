-- โครงสร้างฐานข้อมูลเบื้องต้นสำหรับระบบบริหารคาเฟ่สัตว์
CREATE TABLE animals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    status VARCHAR(20) NOT NULL
);

CREATE TABLE cafe_tables (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    animal_id INT NULL,
    table_id INT NOT NULL,
    datetime DATETIME NOT NULL,
    fee DECIMAL(10,2) NOT NULL
);

CREATE TABLE menu_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    table_id INT NOT NULL,
    start_time DATETIME NOT NULL,
    end_time DATETIME NULL
);

CREATE TABLE order_items (
    order_id INT NOT NULL,
    menu_id INT NOT NULL,
    quantity INT NOT NULL
);
