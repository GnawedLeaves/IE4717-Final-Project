CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    customer_id INT NOT NULL,
    item_id INT NOT NULL,
    quantity INT NOT NULL,
    sub_total DECIMAL(10, 2) NOT NULL,
    status VARCHAR(40) NOT NULL,
    FOREIGN KEY (item_id) REFERENCES menu(itemid),
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
);