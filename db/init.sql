
CREATE DATABASE IF NOT EXISTS products;
USE products;

-- create table products
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL
);

-- insert sample data
INSERT INTO products (name, description, price) VALUES
('Product 1', 'Description of Product 1', 10.99),
('Product 2', 'Description of Product 2', 20.50),
('Product 3', 'Description of Product 3', 15.75),
('Product 4', 'Description of Product 4', 30.25),
('Product 5', 'Description of Product 5', 5.99);

GRANT SELECT, INSERT, UPDATE, DELETE ON products TO superuser;