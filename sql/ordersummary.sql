CREATE TABLE ordersummary (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id VARCHAR(40) NOT NULL,
    customer_id INT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    date datetime  NOT NULL,
    delivery_time TIME,
    status VARCHAR(40) NOT NULL,
    INDEX (order_id),
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
);