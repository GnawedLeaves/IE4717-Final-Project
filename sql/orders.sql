CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id VARCHAR(40) NOT NULL,
    item_id INT NOT NULL,
    quantity INT NOT NULL,
    topping1 INT, 
    topping2 INT, 
    topping3 INT, 
    addon1 INT, 
    addon2 INT, 
    addon3 INT, 
    sub_total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (item_id) REFERENCES menu(itemid),
    FOREIGN KEY (order_id) REFERENCES ordersummary(order_id)
);