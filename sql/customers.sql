
CREATE TABLE customers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(40) NOT NULL,
    password VARCHAR(40),
    email VARCHAR(40) NOT NULL,
    address VARCHAR(40) NOT NULL,
    contact VARCHAR(40),
    type VARCHAR(40) NOT NULL
);

INSERT INTO customers (name, password) VALUES ('adminuser', SHA1('abc123'));