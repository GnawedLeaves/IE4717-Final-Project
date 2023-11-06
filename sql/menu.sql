
CREATE TABLE menu (
    itemid INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    itemprice FLOAT NOT NULL,
    PRIMARY KEY (itemid)
);


-- Seed data for the "menu" table
INSERT INTO menu (name, itemprice) VALUES ('Hawaiian', 12.99);
INSERT INTO menu (name, itemprice) VALUES ('Chicken Galore', 11.49);
INSERT INTO menu (name, itemprice) VALUES ('Chris''s Special', 13.99);
INSERT INTO menu (name, itemprice) VALUES ('Chicken Curry', 10.99);
INSERT INTO menu (name, itemprice) VALUES ('Meat Lovers', 14.99);
INSERT INTO menu (name, itemprice) VALUES ('Pepperoni', 11.99);
INSERT INTO menu (name, itemprice) VALUES ('Veggie Pizza', 11.49);
INSERT INTO menu (name, itemprice) VALUES ('BBQ Chicken', 12.49);
INSERT INTO menu (name, itemprice) VALUES ('Chocolate Waffle', 6.99);
INSERT INTO menu (name, itemprice) VALUES ('10pc Drumlets', 9.99);
INSERT INTO menu (name, itemprice) VALUES ('Snack Platter', 15.99);