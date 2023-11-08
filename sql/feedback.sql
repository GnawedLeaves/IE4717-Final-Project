CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id VARCHAR(40),
    customer_id INT,
    rating INT NOT NULL,
    comments VARCHAR(255),
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id),
    FOREIGN KEY (order_id) REFERENCES ordersummary(order_id)
);