-- ============================
-- 25 FILMÓW
-- ============================
INSERT INTO Item (name, year, director, actors, type, duration, season) VALUES
    ('The Shawshank Redemption', 1994, 'Frank Darabont', 'Tim Robbins, Morgan Freeman', 1, 142, NULL),
    ('The Godfather', 1972, 'Francis Ford Coppola', 'Marlon Brando, Al Pacino', 1, 175, NULL),
    ('The Dark Knight', 2008, 'Christopher Nolan', 'Christian Bale, Heath Ledger', 1, 152, NULL),
    ('Pulp Fiction', 1994, 'Quentin Tarantino', 'John Travolta, Samuel L. Jackson', 1, 154, NULL),
    ('Inception', 2010, 'Christopher Nolan', 'Leonardo DiCaprio, Tom Hardy', 1, 148, NULL),
    ('Fight Club', 1999, 'David Fincher', 'Brad Pitt, Edward Norton', 1, 139, NULL),
    ('Forrest Gump', 1994, 'Robert Zemeckis', 'Tom Hanks, Robin Wright', 1, 142, NULL),
    ('The Matrix', 1999, 'Lana Wachowski, Lilly Wachowski', 'Keanu Reeves, Laurence Fishburne', 1, 136, NULL),
    ('Interstellar', 2014, 'Christopher Nolan', 'Matthew McConaughey, Anne Hathaway', 1, 169, NULL),
    ('The Lord of the Rings: The Fellowship of the Ring', 2001, 'Peter Jackson', 'Elijah Wood, Ian McKellen', 1, 178, NULL),
    ('The Lord of the Rings: The Two Towers', 2002, 'Peter Jackson', 'Elijah Wood, Viggo Mortensen', 1, 179, NULL),
    ('The Lord of the Rings: The Return of the King', 2003, 'Peter Jackson', 'Elijah Wood, Sean Astin', 1, 201, NULL),
    ('Gladiator', 2000, 'Ridley Scott', 'Russell Crowe, Joaquin Phoenix', 1, 155, NULL),
    ('Braveheart', 1995, 'Mel Gibson', 'Mel Gibson, Sophie Marceau', 1, 178, NULL),
    ('Whiplash', 2014, 'Damien Chazelle', 'Miles Teller, J.K. Simmons', 1, 107, NULL),
    ('The Departed', 2006, 'Martin Scorsese', 'Leonardo DiCaprio, Matt Damon', 1, 151, NULL),
    ('Se7en', 1995, 'David Fincher', 'Brad Pitt, Morgan Freeman', 1, 127, NULL),
    ('Parasite', 2019, 'Bong Joon-ho', 'Song Kang-ho, Lee Sun-kyun', 1, 132, NULL),
    ('Joker', 2019, 'Todd Phillips', 'Joaquin Phoenix, Robert De Niro', 1, 122, NULL),
    ('Avatar', 2009, 'James Cameron', 'Sam Worthington, Zoe Saldana', 1, 162, NULL),
    ('The Prestige', 2006, 'Christopher Nolan', 'Hugh Jackman, Christian Bale', 1, 130, NULL),
    ('Titanic', 1997, 'James Cameron', 'Leonardo DiCaprio, Kate Winslet', 1, 195, NULL),
    ('The Social Network', 2010, 'David Fincher', 'Jesse Eisenberg, Andrew Garfield', 1, 120, NULL),
    ('Django Unchained', 2012, 'Quentin Tarantino', 'Jamie Foxx, Christoph Waltz', 1, 165, NULL),
    ('Mad Max: Fury Road', 2015, 'George Miller', 'Tom Hardy, Charlize Theron', 1, 120, NULL);

-- ============================
-- 25 SERIALI
-- ============================
INSERT INTO Item (name, year, director, actors, type, duration, season) VALUES
    ('Breaking Bad', 2008, 'Vince Gilligan', 'Bryan Cranston, Aaron Paul', 2, NULL, 5),
    ('Game of Thrones', 2011, 'Various', 'Emilia Clarke, Kit Harington', 2, NULL, 8),
    ('The Sopranos', 1999, 'David Chase', 'James Gandolfini, Edie Falco', 2, NULL, 6),
    ('The Office', 2005, 'Greg Daniels', 'Steve Carell, John Krasinski', 2, NULL, 9),
    ('Stranger Things', 2016, 'Duffer Brothers', 'Millie Bobby Brown, David Harbour', 2, NULL, 5),
    ('Sherlock', 2010, 'Various', 'Benedict Cumberbatch, Martin Freeman', 2, NULL, 4),
    ('Friends', 1994, 'Various', 'Jennifer Aniston, Courteney Cox', 2, NULL, 10),
    ('Better Call Saul', 2015, 'Vince Gilligan, Peter Gould', 'Bob Odenkirk, Rhea Seehorn', 2, NULL, 6),
    ('Peaky Blinders', 2013, 'Various', 'Cillian Murphy, Paul Anderson', 2, NULL, 6),
    ('The Witcher', 2019, 'Various', 'Henry Cavill, Anya Chalotra', 2, NULL, 3),
    ('Westworld', 2016, 'Jonathan Nolan, Lisa Joy', 'Evan Rachel Wood, Jeffrey Wright', 2, NULL, 4),
    ('Dark', 2017, 'Baran bo Odar', 'Louis Hofmann, Lisa Vicari', 2, NULL, 3),
    ('The Mandalorian', 2019, 'Various', 'Pedro Pascal, Carl Weathers', 2, NULL, 3),
    ('House of Cards', 2013, 'Beau Willimon', 'Kevin Spacey, Robin Wright', 2, NULL, 6),
    ('True Detective', 2014, 'Various', 'Matthew McConaughey, Woody Harrelson', 2, NULL, 4),
    ('The Crown', 2016, 'Various', 'Olivia Colman, Claire Foy', 2, NULL, 6),
    ('Black Mirror', 2011, 'Charlie Brooker', 'Various', 2, NULL, 6),
    ('Narcos', 2015, 'Various', 'Wagner Moura, Pedro Pascal', 2, NULL, 3),
    ('The Boys', 2019, 'Eric Kripke', 'Karl Urban, Jack Quaid', 2, NULL, 4),
    ('How I Met Your Mother', 2005, 'Various', 'Josh Radnor, Neil Patrick Harris', 2, NULL, 9),
    ('Lost', 2004, 'J.J. Abrams', 'Matthew Fox, Evangeline Lilly', 2, NULL, 6),
    ('The Walking Dead', 2010, 'Frank Darabont', 'Andrew Lincoln, Norman Reedus', 2, NULL, 11),
    ('Rick and Morty', 2013, 'Dan Harmon, Justin Roiland', 'Justin Roiland, Chris Parnell', 2, NULL, 6),
    ('Vikings', 2013, 'Michael Hirst', 'Travis Fimmel, Katheryn Winnick', 2, NULL, 6),
    ('The Last of Us', 2023, 'Craig Mazin, Neil Druckmann', 'Pedro Pascal, Bella Ramsey', 2, NULL, 1);

-- ============================
-- Dodanie platform
-- ============================
INSERT INTO streaming (platform_name) VALUES
    ('Netflix'),
    ('HBO Max'),
    ('Disney+'),
    ('Amazon Prime Video'),
    ('Apple TV+'),
    ('Hulu');

-- ============================
-- Dodanie platform dla filmów
-- ============================
INSERT INTO item_streaming VALUES
    (1, 1), (1, 4),
    (2, 1), (3, 2),
    (4, 1), (4, 3),
    (5, 4), (6, 1), 
    (6, 2), (7, 3),
    (8, 1), (8, 4),
    (9, 2), (10, 1), 
    (10, 3), (11, 4),
    (12, 2), (12, 3),
    (13, 1), (14, 1),
    (14, 4), (15, 3),
    (16, 2), (16, 4),
    (17, 5), (18, 1),
    (19, 3), (19, 4),
    (20, 1), (20, 2),
    (21, 4), (22, 3),
    (23, 1), (23, 4),
    (24, 2), (25, 1), 
    (25, 5);

-- ============================
-- Dodanie platform dla seriali
-- ============================
INSERT INTO item_streaming VALUES
    (26, 1), (27, 2),
    (28, 1), (28, 3),
    (29, 4), (30, 1), 
    (30, 2), (31, 3),
    (32, 1), (32, 4),
    (33, 5), (34, 1),
    (35, 2), (35, 3),
    (36, 4), (37, 1), 
    (37, 2), (38, 3),
    (39, 1), (39, 4),
    (40, 2), (41, 3), 
    (41, 4), (42, 1),
    (43, 5), (44, 2), 
    (44, 3), (45, 1),
    (46, 4), (47, 2),
    (48, 1), (48, 5),
    (49, 3), (50, 1), 
    (50, 4);

-- ============================
-- Dodanie kategorii
-- ============================
INSERT INTO category (genre) VALUES
    ('Akcja'),
    ('Przygodowy'),
    ('Dramat'),
    ('Komedia'),
    ('Sci-Fi'),
    ('Fantasy'),
    ('Horror'),
    ('Thriller'),
    ('Kryminał'),
    ('Romans'),
    ('Animacja'),
    ('Dokumentalny'),
    ('Familijny'),
    ('Historyczny'),
    ('Wojenny');

-- ============================
-- Przypianie kategorii
-- ============================
INSERT INTO item_category VALUES
    (1, 3), (1, 10), (2, 1), (2, 5), (3, 8),
    (4, 3), (4, 12), (5, 5), (5, 1), (6, 4),
    (7, 11), (7, 13), (8, 6), (9, 7), (10, 3),
    (10, 15), (11, 8), (12, 5), (13, 4), (14, 6),
    (15, 1), (16, 2), (17, 9), (18, 12), (19, 3), 
    (20, 14), (21, 4), (22, 3), (23, 1), (24, 9),
    (25, 10), (26, 5), (26, 1), (27, 9), (28, 1),
    (29, 6), (30, 8), (31, 12), (32, 3), (33, 7),
    (34, 11), (35, 5), (36, 13), (37, 6), (38, 3),
    (39, 1), (40, 2), (41, 3), (42, 8), (43, 5),
    (44, 3), (45, 9), (46, 11), (47, 4), (48, 3),
    (49, 12), (50, 8);


-- ============================
-- Dodanie tagów
-- ============================
INSERT INTO tag (tag_name) VALUES
    ('Hanks'),
    ('DiCaprio'),
    ('Keanu'),
    ('Johansson'),
    ('Jackson'),
    ('Portman'),
    ('Johnson'),
    ('mroczny'),
    ('straszny'),
    ('śmieszny'),
    ('klasyk'),
    ('wysoka_ocena'),
    ('nowość'),
    ('kosmos'),
    ('superbohater'),
    ('gangsterzy'),
    ('postapokaliptyczny'),
    ('epicki'),
    ('true_story'),
    ('dla_dzieci');


-- ============================
-- Uzupełnianie tagów
-- ============================
INSERT INTO item_tag (item_id, tag_ID) VALUES
    (1, 1), (1, 11),(2, 3), (2, 14),(3, 8),
    (4, 2), (4, 19),(5, 3),(6, 10),(7, 20),
    (8, 6),(9, 9),(10, 12),(11, 8),(12, 14),
    (13, 4),(14, 7),(15, 3),(16, 13),(17, 16),
    (18, 12),(19, 3),(20, 18),(21, 1),(22, 4),
    (23, 3),(24, 17),(25, 10),(26, 3), (26, 14),
    (27, 9),(28, 3),(29, 6),(30, 8),(31, 19),
    (32, 3),(33, 7),(34, 20),(35, 5),(36, 11),
    (37, 7),(38, 3),(39, 14),(40, 10),(41, 3),
    (42, 8),(43, 14),(44, 3),(45, 16),(46, 12),
    (47, 10),(48, 18),(49, 19),(50, 7);


-- ============================
-- Uzupełnianie encji oceny
-- ============================
INSERT INTO rating (rating, comment) VALUES
    (4.5, 'Świetny film!'),
    (3.8, 'Całkiem spoko'),
    (4.2, 'Bardzo dobry'),
    (5.0, 'Mistrzostwo!'),
    (3.5, 'Może być'),
    (4.0, 'Fajna produkcja'),
    (4.7, 'Polecam!'),
    (3.9, 'Przeciętny'),
    (4.1, 'Dobry, ale krótki'),
    (2.8, 'Nie mój klimat'),
    (4.6, 'Super aktorsko'),
    (3.7, 'Oczekiwałem więcej'),
    (4.3, 'Bardzo ciekawy'),
    (4.9, 'Wspaniały!'),
    (3.6, 'Całkiem przyjemny'),
    (4.0, 'Fajny seans'),
    (3.2, 'Średni'),
    (4.4, 'Dobre efekty specjalne'),
    (3.9, 'Może być lepszy'),
    (4.8, 'Rewelacja!'),
    (4.1, 'Dobrze zrobione'),
    (3.5, 'Taki sobie'),
    (4.2, 'Ciekawa fabuła'),
    (4.0, 'Przyjemny film'),
    (3.8, 'Nie zachwycił'),
    (4.5, 'Super!'),
    (3.9, 'Spoko'),
    (4.3, 'Bardzo dobry serial'),
    (4.6, 'Świetnie zrealizowany'),
    (3.7, 'Dobrze się ogląda'),
    (4.1, 'Polecam obejrzeć'),
    (4.4, 'Ciekawy wątek'),
    (3.6, 'Średni'),
    (4.0, 'Fajna produkcja'),
    (4.2, 'Bardzo przyjemny'),
    (4.5, 'Wciągający'),
    (3.8, 'Nie mój typ'),
    (4.3, 'Super aktorstwo'),
    (4.0, 'Dobrze zrobiony'),
    (3.9, 'Może być'),
    (4.6, 'Rewelacja!'),
    (4.1, 'Fajna historia'),
    (3.5, 'Średni'),
    (4.2, 'Ciekawy'),
    (4.0, 'Dobrze się ogląda'),
    (4.4, 'Warto zobaczyć'),
    (3.7, 'Nie do końca mój gust'),
    (4.5, 'Bardzo dobry'),
    (4.3, 'Fajne efekty'),
    (3.9, 'Całkiem spoko'),
    (4.1, 'Polecam');


-- ============================
-- Uzupełnianie ocen do itemów
-- ============================
INSERT INTO item_rating (item_ID, rating_ID) VALUES
    (1, 1),
    (2, 2),
    (3, 3),
    (4, 4),
    (5, 5),
    (6, 6),
    (7, 7),
    (8, 8),
    (9, 9),
    (10, 10),
    (11, 11),
    (12, 12),
    (13, 13),
    (14, 14),
    (15, 15),
    (16, 16),
    (17, 17),
    (18, 18),
    (19, 19),
    (20, 20),
    (21, 21),
    (22, 22),
    (23, 23),
    (24, 24),
    (25, 25),
    (26, 26),
    (27, 27),
    (28, 28),
    (29, 29),
    (30, 30),
    (31, 31),
    (32, 32),
    (33, 33),
    (34, 34),
    (35, 35),
    (36, 36),
    (37, 37),
    (38, 38),
    (39, 39),
    (40, 40),
    (41, 41),
    (42, 42),
    (43, 43),
    (44, 44),
    (45, 45),
    (46, 46),
    (47, 47),
    (48, 48),
    (49, 49),
    (50, 50);
