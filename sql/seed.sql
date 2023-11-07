-- Seed data for the "customers" table with Singaporean customers

-- Insert seed data for customer information
INSERT INTO customers (name, password, email, address, contact, type) VALUES
    ('Ahmad Bin Abdullah', 'sghotpot', 'ahmad.abdullah@example.sg', '123 Orchard Road', '+65 9123 4567','member'),
    ('Linda Tan', 'noodlelover', 'linda.tan@example.sg', '456 Serangoon Ave', '+65 9876 5432','guest'),
    ('Siti Lim', 'singaporefood', 'siti.lim@example.sg', '789 Tampines St', '+65 8234 5678','member');

-- Seed data for the "orders" table

-- Insert seed data for orders
INSERT INTO orders (order_id, customer_id, item_id, quantity, sub_total, status) VALUES
    (2001, 1, 8, 2, 25.98, 'Pending')


-- You can add more Singaporean customer and order data as needed
