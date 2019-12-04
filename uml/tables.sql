# Initial data
CREATE TABLE users (
	id int NOT NULL AUTO_INCREMENT,
    first_name varchar(255),
    last_name varchar(255),
    email varchar(255),
    address varchar(255),
    gender varchar(255),
    birthday timestamp,
    hashed_password varchar(255),
  	created_at TIMESTAMP NOT NULL DEFAULT NOW(),
	updated_at TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
    PRIMARY KEY (id)
)
CHARACTER SET 'latin2' 
COLLATE 'latin2_hungarian_ci';

INSERT INTO users (first_name, last_name, email, address, gender, birthday, hashed_password) VALUES ('Admin', 'Admin', 'admin@example.com', '', 'male', '1977-11-29', '$2y$10$R5g/6fT8PaYLWDUxtrw9QeA.2/Rq.treWad6j5c600H9IvIBVyylO');
INSERT INTO users (first_name, last_name, email, address, gender, birthday, hashed_password) VALUES ('Nagy', 'Elek', 'nagyelek@example.com', 'Szeged, Szilléri sgt. 32', 'male', '1985-07-12', '$2y$10$R5g/6fT8PaYLWDUxtrw9QeA.2/Rq.treWad6j5c600H9IvIBVyylO');
INSERT INTO users (first_name, last_name, email, address, gender, birthday, hashed_password) VALUES ('Kis', 'Jenő', 'kisjeno@example.com', 'Szeged, Kossuth u. 3B', 'male', '1980-09-01', '$2y$10$R5g/6fT8PaYLWDUxtrw9QeA.2/Rq.treWad6j5c600H9IvIBVyylO');
INSERT INTO users (first_name, last_name, email, address, gender, birthday, hashed_password) VALUES ('Lapos', 'Ödön', 'laposodon@example.com', 'Békéscsaba, Tata u. 12', 'male', '1996-10-10', '$2y$10$R5g/6fT8PaYLWDUxtrw9QeA.2/Rq.treWad6j5c600H9IvIBVyylO');
INSERT INTO users (first_name, last_name, email, address, gender, birthday, hashed_password) VALUES ('Csonka', 'Károly', 'csonkakaroly@example.com', 'Budapest, Deák tér 7', 'male', '1992-04-22', '$2y$10$R5g/6fT8PaYLWDUxtrw9QeA.2/Rq.treWad6j5c600H9IvIBVyylO');
INSERT INTO users (first_name, last_name, email, address, gender, birthday, hashed_password) VALUES ('Szarvas', 'Edina', 'szarvasedina@example.com', 'Orosháza, Petőfi u. 2', 'female', '1985-01-19', '$2y$10$R5g/6fT8PaYLWDUxtrw9QeA.2/Rq.treWad6j5c600H9IvIBVyylO');
# hashed_password = 'Password1'

CREATE TABLE products (
	id int NOT NULL AUTO_INCREMENT,
	name varchar(255),
    brand varchar(255),
    cost int,
    category varchar(255),
    subcategory varchar(255),
	image varchar(255),
  	created_at TIMESTAMP NOT NULL DEFAULT NOW(),
	updated_at TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
    PRIMARY KEY (id)
)
CHARACTER SET 'latin2' 
COLLATE 'latin2_hungarian_ci';

INSERT INTO products (name, brand, cost, category, subcategory, image) VALUES ('YEEZY Static', 'Adidas', 76, 'Shoes', 'Sneakers', '');
INSERT INTO products (name, brand, cost, category, subcategory, image) VALUES ('Air Max 200', 'Nike', 89, 'Shoes', 'Sneakers', '');
INSERT INTO products (name, brand, cost, category, subcategory, image) VALUES ('Ace 2018', 'Lacoste', 129, 'Shoes', 'Sneakers', '');
INSERT INTO products (name, brand, cost, category, subcategory, image) VALUES ('547', 'NewBalance', 99, 'Shoes', 'Sneakers', '');
INSERT INTO products (name, brand, cost, category, subcategory, image) VALUES ('Alphaedge 4', 'Adidas', 85, 'Shoes', 'Sneakers', '');

CREATE TABLE availabilities (
    id int NOT NULL AUTO_INCREMENT,
	product_id int NOT NULL,
	size varchar(255),
	color varchar(255),
	amount int,
	sale float,
  	created_at TIMESTAMP NOT NULL DEFAULT NOW(),
	updated_at TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
	FOREIGN KEY (product_id) REFERENCES products(id),
	PRIMARY KEY (id)
)
CHARACTER SET 'latin2' 
COLLATE 'latin2_hungarian_ci';

INSERT INTO availabilities (product_id, size, color, amount, sale) VALUES (1, '42', 'black', 1, 0.75);
INSERT INTO availabilities (product_id, size, color, amount, sale) VALUES (1, '43', 'black', 16, 0);
INSERT INTO availabilities (product_id, size, color, amount, sale) VALUES (1, '44', 'black', 20, 0);
INSERT INTO availabilities (product_id, size, color, amount, sale) VALUES (1, '45', 'black', 18, 0);
INSERT INTO availabilities (product_id, size, color, amount, sale) VALUES (1, '46', 'black', 20, 0);
INSERT INTO availabilities (product_id, size, color, amount, sale) VALUES (1, '42', 'white', 18, 0);
INSERT INTO availabilities (product_id, size, color, amount, sale) VALUES (1, '43', 'white', 20, 0);
INSERT INTO availabilities (product_id, size, color, amount, sale) VALUES (1, '44', 'white', 20, 0);
INSERT INTO availabilities (product_id, size, color, amount, sale) VALUES (1, '45', 'white', 19, 0);
INSERT INTO availabilities (product_id, size, color, amount, sale) VALUES (1, '46', 'white', 20, 0);

CREATE TABLE reviews (
	user_id int NOT NULL,
	product_id int NOT NULL,
	content varchar(255),
	stars int,
  	created_at TIMESTAMP NOT NULL DEFAULT NOW(),
	updated_at TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
	FOREIGN KEY (user_id) REFERENCES users(id),
	FOREIGN KEY (product_id) REFERENCES products(id)
)
CHARACTER SET 'latin2' 
COLLATE 'latin2_hungarian_ci';

INSERT INTO reviews (user_id, product_id, content, stars) VALUES (1, 1, 'Comfortable and doesn\'t get dirty easily. I love it!', 4);
INSERT INTO reviews (user_id, product_id, content, stars) VALUES (2, 1, 'It looked different in the picture', 3);

CREATE TABLE baskets (
     id int NOT NULL AUTO_INCREMENT,
     user_id int NOT NULL,
     availability_id int NOT NULL,
     amount int,
     status varchar(255),
     created_at TIMESTAMP NOT NULL DEFAULT NOW(),
     updated_at TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
     FOREIGN KEY (availability_id) REFERENCES availabilities(id),
     PRIMARY KEY (id)
)
CHARACTER SET 'latin2' 
COLLATE 'latin2_hungarian_ci';

INSERT INTO baskets (user_id, availability_id, amount, status) VALUES (1, 1, 1, 'done');
INSERT INTO baskets (user_id, availability_id, amount, status) VALUES (1, 2, 1, 'done');

CREATE TABLE orders(
    id int NOT NULL AUTO_INCREMENT,
    basket_id int,
    status varchar(255),
    created_at TIMESTAMP NOT NULL DEFAULT NOW(),
    updated_at TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
    PRIMARY KEY (id),
    FOREIGN KEY (basket_id) REFERENCES baskets(id)
)
CHARACTER SET 'latin2' 
COLLATE 'latin2_hungarian_ci';

INSERT INTO orders (basket_id, status) VALUES (1, 'fulfilled');
INSERT INTO orders (basket_id, status) VALUES (2, 'fulfilled');

CREATE TABLE website (
     id int NOT NULL AUTO_INCREMENT,
     internal_id int,
     currency varchar(255),
     created_at TIMESTAMP NOT NULL DEFAULT NOW(),
     updated_at TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
     PRIMARY KEY (id),
     FOREIGN KEY (internal_id) REFERENCES users(id)
)
CHARACTER SET 'latin2' 
COLLATE 'latin2_hungarian_ci';

INSERT INTO website (internal_id, currency) VALUES (1, 'EUR');

# Deleting everything
DROP TABLE reviews;
DROP TABLE orders;
DROP TABLE baskets;
DROP TABLE availabilities;
DROP TABLE website;
DROP TABLE users;
DROP TABLE products;
