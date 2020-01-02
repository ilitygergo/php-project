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

INSERT INTO users (first_name, last_name, email, address, gender, birthday, hashed_password) VALUES ('Admin', 'Admin', 'admin@example.com', '', 'male', '1977-11-29', '$2y$10$te5meb.j9zZH9YAYzYzdgurUrFI9glnVetNX6gTMuVm1.YlodDKGG');
INSERT INTO users (first_name, last_name, email, address, gender, birthday, hashed_password) VALUES ('Nagy', 'Elek', 'nagyelek@example.com', 'Szeged, Szilléri sgt. 32', 'male', '1985-07-12', '$2y$10$R5g/6fT8PaYLWDUxtrw9QeA.2/Rq.treWad6j5c600H9IvIBVyylO');
INSERT INTO users (first_name, last_name, email, address, gender, birthday, hashed_password) VALUES ('Kis', 'Jenő', 'kisjeno@example.com', 'Szeged, Kossuth u. 3B', 'male', '1980-09-01', '$2y$10$R5g/6fT8PaYLWDUxtrw9QeA.2/Rq.treWad6j5c600H9IvIBVyylO');
INSERT INTO users (first_name, last_name, email, address, gender, birthday, hashed_password) VALUES ('Lapos', 'Ödön', 'laposodon@example.com', 'Békéscsaba, Tata u. 12', 'male', '1996-10-10', '$2y$10$R5g/6fT8PaYLWDUxtrw9QeA.2/Rq.treWad6j5c600H9IvIBVyylO');
INSERT INTO users (first_name, last_name, email, address, gender, birthday, hashed_password) VALUES ('Csonka', 'Károly', 'csonkakaroly@example.com', 'Budapest, Deák tér 7', 'male', '1992-04-22', '$2y$10$R5g/6fT8PaYLWDUxtrw9QeA.2/Rq.treWad6j5c600H9IvIBVyylO');
INSERT INTO users (first_name, last_name, email, address, gender, birthday, hashed_password) VALUES ('test', 'test', 'test@example.com', 'Orosháza, Petőfi u. 2', 'male', '1985-01-19', '$2y$10$R5g/6fT8PaYLWDUxtrw9QeA.2/Rq.treWad6j5c600H9IvIBVyylO');
INSERT INTO users (first_name, last_name, email, address, gender, birthday, hashed_password) VALUES ('test1', 'test1', 'test1@example.com', 'Orosháza, Petőfi u. 2', 'male', '1985-01-19', '$2y$10$R5g/6fT8PaYLWDUxtrw9QeA.2/Rq.treWad6j5c600H9IvIBVyylO');
INSERT INTO users (first_name, last_name, email, address, gender, birthday, hashed_password) VALUES ('test2', 'test2', 'test2@example.com', 'Orosháza, Petőfi u. 2', 'male', '1985-01-19', '$2y$10$R5g/6fT8PaYLWDUxtrw9QeA.2/Rq.treWad6j5c600H9IvIBVyylO');
INSERT INTO users (first_name, last_name, email, address, gender, birthday, hashed_password) VALUES ('test3', 'test3', 'test3@example.com', 'Orosháza, Petőfi u. 2', 'male', '1985-01-19', '$2y$10$R5g/6fT8PaYLWDUxtrw9QeA.2/Rq.treWad6j5c600H9IvIBVyylO');
INSERT INTO users (first_name, last_name, email, address, gender, birthday, hashed_password) VALUES ('test4', 'test4', 'test4@example.com', 'Orosháza, Petőfi u. 2', 'male', '1985-01-19', '$2y$10$R5g/6fT8PaYLWDUxtrw9QeA.2/Rq.treWad6j5c600H9IvIBVyylO');
INSERT INTO users (first_name, last_name, email, address, gender, birthday, hashed_password) VALUES ('test5', 'test5', 'test5@example.com', 'Orosháza, Petőfi u. 2', 'male', '1985-01-19', '$2y$10$R5g/6fT8PaYLWDUxtrw9QeA.2/Rq.treWad6j5c600H9IvIBVyylO');
INSERT INTO users (first_name, last_name, email, address, gender, birthday, hashed_password) VALUES ('test6', 'test6', 'test6@example.com', 'Orosháza, Petőfi u. 2', 'male', '1985-01-19', '$2y$10$R5g/6fT8PaYLWDUxtrw9QeA.2/Rq.treWad6j5c600H9IvIBVyylO');
INSERT INTO users (first_name, last_name, email, address, gender, birthday, hashed_password) VALUES ('test7', 'test7', 'test7@example.com', 'Orosháza, Petőfi u. 2', 'male', '1985-01-19', '$2y$10$R5g/6fT8PaYLWDUxtrw9QeA.2/Rq.treWad6j5c600H9IvIBVyylO');
INSERT INTO users (first_name, last_name, email, address, gender, birthday, hashed_password) VALUES ('test8', 'test8', 'test8@example.com', 'Orosháza, Petőfi u. 2', 'male', '1985-01-19', '$2y$10$R5g/6fT8PaYLWDUxtrw9QeA.2/Rq.treWad6j5c600H9IvIBVyylO');
INSERT INTO users (first_name, last_name, email, address, gender, birthday, hashed_password) VALUES ('test9', 'test9', 'test9@example.com', 'Orosháza, Petőfi u. 2', 'male', '1985-01-19', '$2y$10$R5g/6fT8PaYLWDUxtrw9QeA.2/Rq.treWad6j5c600H9IvIBVyylO');
INSERT INTO users (first_name, last_name, email, address, gender, birthday, hashed_password) VALUES ('test10', 'test10', 'test10@example.com', 'Orosháza, Petőfi u. 2', 'male', '1985-01-19', '$2y$10$R5g/6fT8PaYLWDUxtrw9QeA.2/Rq.treWad6j5c600H9IvIBVyylO');
INSERT INTO users (first_name, last_name, email, address, gender, birthday, hashed_password) VALUES ('test11', 'test11', 'test11@example.com', 'Orosháza, Petőfi u. 2', 'male', '1985-01-19', '$2y$10$R5g/6fT8PaYLWDUxtrw9QeA.2/Rq.treWad6j5c600H9IvIBVyylO');
INSERT INTO users (first_name, last_name, email, address, gender, birthday, hashed_password) VALUES ('test12', 'test12', 'test12@example.com', 'Orosháza, Petőfi u. 2', 'male', '1985-01-19', '$2y$10$R5g/6fT8PaYLWDUxtrw9QeA.2/Rq.treWad6j5c600H9IvIBVyylO');

# hashed_password = 'Password1'

CREATE TABLE products (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255),
    brand varchar(255),
    cost int,
    category varchar(255),
    subcategory varchar(255),
    image varchar(255),
    target_group varchar(255),
    created_at TIMESTAMP NOT NULL DEFAULT NOW(),
    updated_at TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
    PRIMARY KEY (id)
)
    CHARACTER SET 'latin2'
    COLLATE 'latin2_hungarian_ci';

INSERT INTO products (name, brand, cost, category, subcategory, image, target_group) VALUES ('YEEZY Static', 'Adidas', 76, 'Footwear', 'Sneakers', 'CNyuiZTP33eHVxkY9r2q.jpg', 'male');
INSERT INTO products (name, brand, cost, category, subcategory, image, target_group) VALUES ('Air Max 200', 'Nike', 89, 'Footwear', 'Sneakers', 'GdRjBhQpVWp66awRCGIb.jpg', 'male');
INSERT INTO products (name, brand, cost, category, subcategory, image, target_group) VALUES ('Ace 2018', 'Lacoste', 129, 'Footwear', 'Sneakers', 'HPgjwcaW3GTLjqvYG6B0.jpg', 'male');
INSERT INTO products (name, brand, cost, category, subcategory, image, target_group) VALUES ('547', 'NewBalance', 99, 'Footwear', 'Sneakers', 'oeP3rU0v6jGxQNGK0eAO.jpg', 'male');
INSERT INTO products (name, brand, cost, category, subcategory, image, target_group) VALUES ('Alphaedge 4', 'Adidas', 85, 'Footwear', 'Sneakers', 'Ot5gSWGxFrTiMnvszB98.jpg', 'male');
INSERT INTO products (name, brand, cost, category, subcategory, image, target_group) VALUES ('Nike Blue Sneaker', 'Nike', 100, 'Footwear', 'Sneakers', 'Ot5gSWGxFrTiMnvszB98.jpg', 'male');
INSERT INTO products (name, brand, cost, category, subcategory, image, target_group) VALUES ('Old Skool', 'Vans', 100, 'Footwear', 'Sneakers', 'dn036jYfGZa9NwNUA7tQ.jpg', 'male');
INSERT INTO products (name, brand, cost, category, subcategory, image, target_group) VALUES ('Reebok Sport', 'Reebok', 100, 'Footwear', 'Sneakers', 'AvxRZ2tMJLXrSrAqkUmj.jpg', 'male');
INSERT INTO products (name, brand, cost, category, subcategory, image, target_group) VALUES ('SandPaper 2', 'EasyFit', 134, 'Footwear', 'Sneakers', 'A5AejmzM5vojeCkIcjxu.jpg', 'male');
INSERT INTO products (name, brand, cost, category, subcategory, image, target_group) VALUES ('White Sneaker', 'EasyFit', 89, 'Footwear', 'Sneakers', 'S2JVvjA8yzKkoMQd13im.jpg', 'male');
INSERT INTO products (name, brand, cost, category, subcategory, image, target_group) VALUES ('Plain White', 'Vans', 65, 'Footwear', 'Sneakers', 'S2JVvjA8yzKkoMQd13im.jpg', 'male');
INSERT INTO products (name, brand, cost, category, subcategory, image, target_group) VALUES ('Reebok Classic 85', 'Reebok', 135, 'Footwear', 'Sneakers', 'edwyM6j63bFwADTHxc52.jpg', 'male');

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
    id int NOT NULL AUTO_INCREMENT,
	user_id int NOT NULL,
	product_id int NOT NULL,
	content varchar(255),
	stars int,
  	created_at TIMESTAMP NOT NULL DEFAULT NOW(),
	updated_at TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
	FOREIGN KEY (user_id) REFERENCES users(id),
	FOREIGN KEY (product_id) REFERENCES products(id),
    PRIMARY KEY (id)
)
CHARACTER SET 'latin2' 
COLLATE 'latin2_hungarian_ci';

INSERT INTO reviews (id, user_id, product_id, content, stars) VALUES (1, 1, 1, 'Comfortable and doesnt get dirty easily. I love it!', 4);
INSERT INTO reviews (id, user_id, product_id, content, stars) VALUES (2, 2, 1, 'It looked different in the picture', 3);

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
# DROP TABLE reviews;
# DROP TABLE availabilities;
# DROP TABLE website;
# DROP TABLE users;
# DROP TABLE products;
