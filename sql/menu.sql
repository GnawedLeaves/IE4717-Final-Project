
CREATE TABLE menu (
    itemid INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    itemprice FLOAT NOT NULL,
    size VARCHAR(40),
    PRIMARY KEY (itemid)
);


-- Seed data for the "menu" table
INSERT INTO menu (name, itemprice, size) VALUES ('Hawaiian', 12.99, 'regular');
INSERT INTO menu (name, itemprice, size) VALUES ('Hawaiian', 15.99, 'large');
INSERT INTO menu (name, itemprice, size) VALUES ('Chicken Galore', 11.49, 'regular');
INSERT INTO menu (name, itemprice, size) VALUES ('Chicken Galore', 14.49, 'large');
INSERT INTO menu (name, itemprice, size) VALUES ('Chris Special', 13.99, 'regular');
INSERT INTO menu (name, itemprice, size) VALUES ('Chris Special', 16.99, 'large');
INSERT INTO menu (name, itemprice, size) VALUES ('Chicken Curry', 10.99, 'regular');
INSERT INTO menu (name, itemprice, size) VALUES ('Chicken Curry', 13.49, 'large');
INSERT INTO menu (name, itemprice, size) VALUES ('Meat Lovers', 14.99, 'regular');
INSERT INTO menu (name, itemprice, size) VALUES ('Meat Lovers', 17.99, 'large');
INSERT INTO menu (name, itemprice, size) VALUES ('Pepperoni', 11.99, 'regular');
INSERT INTO menu (name, itemprice, size) VALUES ('Pepperoni', 14.99, 'large');
INSERT INTO menu (name, itemprice, size) VALUES ('Veggie Pizza', 11.49, 'regular');
INSERT INTO menu (name, itemprice, size) VALUES ('Veggie Pizza', 14.49, 'large');
INSERT INTO menu (name, itemprice, size) VALUES ('BBQ Chicken', 12.49, 'regular');
INSERT INTO menu (name, itemprice, size) VALUES ('BBQ Chicken', 15.49, 'large');
INSERT INTO menu (name, itemprice) VALUES ('Chocolate Waffle', 6.99);
INSERT INTO menu (name, itemprice) VALUES ('10pc Drumlets', 9.99);
INSERT INTO menu (name, itemprice) VALUES ('Snack Platter', 15.99);