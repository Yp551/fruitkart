CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    price DECIMAL(10,2),
    old_price DECIMAL(10,2),
    image VARCHAR(255),
    description TEXT
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role ENUM('user', 'admin') DEFAULT 'user'
);

-- Default Admin Account (Password: admin123)
INSERT INTO users (email, password, role) VALUES ('admin@fruit.com', 'admin123', 'admin');

-- Sample Fruits
INSERT INTO products (name, price, old_price, image) VALUES 
('Alphonso Mango', 500, 700, 'mango.jpg'),
('Fresh Apple', 180, 220, 'apple.jpg');