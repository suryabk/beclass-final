--  Make database and tables
CREATE DATABASE db_film;

USE db_film;

CREATE TABLE film(
    id INT PRIMARY KEY ,
    title VARCHAR(100) NOT NULL,
    year INT(4) NOT NULL,
    director VARCHAR(100),
    actor VARCHAR(500),
    synopsis TEXT,
    id_category INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE types(
    id INT PRIMARY KEY,
    type_name VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE poster(
    id_film INT NOT NULL,
    trailer_link VARCHAR(3000),
    thumbnail VARCHAR(3000),
    w_poster VARCHAR(3000),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE category(
    id INT PRIMARY KEY ,
    category VARCHAR(20) NOT NULL,
    age VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE genre(
    id INT PRIMARY KEY ,
    genre VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE film_genre(
    id_genre INT NOT NULL,
    id_film INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tvshows(
    id_types INT NOT NULL,
    id_genre INT NOT NULL,
    id_film INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE movies(
    id_types INT NOT NULL,
    id_genre INT NOT NULL,
    id_film INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Add foreign key for each table
ALTER TABLE movies ADD FOREIGN KEY (id_types) REFERENCES types(id);

ALTER TABLE movies ADD FOREIGN KEY (id_genre) REFERENCES genre(id);

ALTER TABLE movies ADD FOREIGN KEY (id_film) REFERENCES film(id);

ALTER TABLE tvshows ADD FOREIGN KEY (id_types) REFERENCES types(id);

ALTER TABLE tvshows ADD FOREIGN KEY (id_genre) REFERENCES genre(id);

ALTER TABLE tvshows ADD FOREIGN KEY (id_film) REFERENCES film(id);

ALTER TABLE film_genre ADD FOREIGN KEY (id_genre) REFERENCES genre(id);

ALTER TABLE film_genre ADD FOREIGN KEY (id_film) REFERENCES film(id);

ALTER TABLE poster ADD FOREIGN KEY (id_film) REFERENCES film(id);

ALTER TABLE film ADD FOREIGN KEY (id_category) REFERENCES category(id);


-- Add some data that we wont add in CRUD system
INSERT INTO category(id, category, age) VALUES 
    (1, "SU", "All Age"),
    (2, "13+", "Above 13 years old"),
    (3, "17+", "Above 17 years old"),
    (4, "21+", "Above 21 years old");

INSERT INTO types(id, type_name) VALUES 
    (1, "TV Shows"),
    (2, "Movies");

INSERT INTO genre(id, genre) VALUES 
    (1,"Action"),
    (2,"Adventure"),
    (3,"Animation"),
    (4,"Comedy"),
    (5,"Drama"),
    (6,"Fantasy"),
    (7,"Historical"),
    (8,"Horror"),
    (9,"Mystery"),
    (10,"Romance"),
    (11,"Sci-Fi"),
    (12,"Superhero"),
    (13,"Thriller"),
    (14,"Western");

-- Add some default data
INSERT INTO `film` (`id`, `title`, `year`, `director`, `actor`, `synopsis`, `id_category`) VALUES
(1, 'Venom : Let There be Carnage', 2021, 'Andy Serkis', 'Tom Hardy, Woody Harrelson, Amber Sienna, Michelle Williams', 'Eddie Brock is still struggling to coexist with the shape-shifting extraterrestrial Venom. When deranged serial killer Cletus Kasady also becomes host to an alien symbiote, Brock and Venom must put aside their differences to stop his reign of terror.', 3),
(2, 'Eternals', 2021, 'Chloé Zhao', 'Harry Styles, Angelina Jolie, Kill Harington', 'The Eternals, a race of immortal beings with superhuman powers who have secretly lived on Earth for thousands of years, reunite to battle the evil Deviants.', 2),
(3, 'Ghostbusters: Afterlife', 2021, 'Jason Reitman', 'Carrie', 'When a single mother and her two children move to a new town, they soon discover they have a connection to the original Ghostbusters and the secret legacy their grandfather left behind.', 1),
(4, 'Arcane', 2021, 'Pascal Charrue Arnaud Delord', 'Hailee Steinfeld', 'Amid the stark discord of twin cities Piltover and Zaun, two sisters fight on rival sides of a war between magic technologies and clashing convictions.', 2);

INSERT INTO `poster` (`id_film`, `trailer_link`, `thumbnail`, `w_poster`) VALUES
(1, 'https://www.youtube.com/embed/-FmWuCgJmxo', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQAYUb9zdOYDvDGG7iPi-LTlcBPetJLubT1qNKLe_fXQjTCIJkl', 'https://i2.wp.com/www.cinematik.it/wordpress/wp-content/uploads/2021/10/Venom-la-furia-di-Carnage.jpg?resize=1536%2C864&ssl=1'),
(2, 'https://www.youtube.com/embed/0WVDKZJkGlY', 'https://awsimages.detik.net.id/visual/2021/11/01/eternals.jpeg?w=650', 'https://theculturednerd.org/wp-content/uploads/2021/08/Cyborg-2.jpg'),
(3, 'https://www.youtube.com/embed/ahZFCF--uRY', 'https://m.media-amazon.com/images/M/MV5BMmZiMjdlN2UtYzdiZS00YjgxLTgyZGMtYzE4ZGU5NTlkNjhhXkEyXkFqcGdeQXVyMTEyMjM2NDc2._V1_FMjpg_UX1000_.jpg', 'https://static1.colliderimages.com/wordpress/wp-content/uploads/2021/09/ghostbusters-afterlife.jpg'),
(4, 'https://www.youtube.com/embed/3Svs_hl897c', 'https://www.themoviedb.org/t/p/original/fqldf2t8ztc9aiwn3k6mlX3tvRT.jpg', 'https://www.themoviedb.org/t/p/original/cJ0vEnEGWZDv2a5SRRRGxtRTlPm.jpg');


INSERT INTO `film_genre` (`id_genre`, `id_film`) VALUES
(1, 1),
(11, 1),
(13, 1),
(1, 2),
(12, 2),
(4, 3),
(6, 3),
(1, 4),
(2, 4),
(3, 4),
(6, 4),
(11, 4);

INSERT INTO `tvshows` (`id_types`, `id_genre`, `id_film`) VALUES
(1, 4, 3),
(1, 6, 3),
(1, 1, 4),
(1, 2, 4),
(1, 3, 4),
(1, 6, 4),
(1, 11, 4);

INSERT INTO `movies` (`id_types`, `id_genre`, `id_film`) VALUES
(2, 1, 1),
(2, 11, 1),
(2, 13, 1),
(2, 1, 2),
(2, 12, 2);


