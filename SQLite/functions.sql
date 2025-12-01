-- ##### INFO #####
-- Tutaj znajdują się wszystkie niezbędne funkcje pomocne w realizacji całego projektu.
-- Na samym dole są funkcje przykładowe i eksperymentalne. 
-- Jak ktoś doda nową funkcję, niech najpierw opisze co ona robi. 


-- ###### ENCJA CATEGORIES ######

-- ============================
-- Pobierz wszystkie kategorie
-- > panel administratora
-- ============================
-- SELECT * FROM Categories;

-- ============================
-- Dodawanie nowej kategorii
-- > panel administratora
-- ============================
-- INSERT INTO Categories (genre) 
-- VALUES ('example');

-- ============================
-- Edycja kategorii
-- > panel administratora
-- ============================
-- UPDATE Categories
-- SET genre = 'EXAMPLE'
-- WHERE cat_ID == 16;

-- ============================
-- Usunięcie kategorii
-- > panel administratora
-- ============================
-- DELETE FROM Categories
-- WHERE cat_ID == 16;


-- ###### ENCJA TAGS ######

-- ============================
-- Pobierz wszystkie tagi
-- > panel administratora
-- ============================
-- SELECT * FROM Tags;

-- ============================
-- Dodawanie nowego tagu
-- > panel administratora
-- ============================
-- INSERT INTO Tags (name)
-- VALUES ('example');

-- ============================
-- Edycja tagu
-- > panel administratora
-- ============================
-- UPDATE Tags
-- SET name = 'EXAMPLE'
-- WHERE tag_ID == 21;

-- ============================
-- Usunięcie tagu
-- > panel administratora
-- ============================
-- DELETE FROM Tags
-- WHERE tag_ID == 21;


-- ###### ENCJA STREAMINGS ######

-- ============================
-- Pobierz wszystkie platformy
-- > panel administratora
-- ============================
-- SELECT * FROM Streamings;

-- ============================
-- Dodawanie nowej platformy
-- > panel administratora
-- ============================
-- INSERT INTO Streamings (platform_name)
-- VALUES ('example');

-- ============================
-- Edycja platformy
-- > panel administratora
-- ============================
-- UPDATE Streamings
-- SET platform_name = 'EXAMPLE'
-- WHERE streaming_ID == 7;

-- ============================
-- Usunięcie tagu
-- > panel administratora
-- ============================
-- DELETE FROM Streamings
-- WHERE streaming_ID == 7;


-- ###### ENCJA ITEM ######

-- ============================
-- Pobranie wszystkich dzieł
-- ============================
-- SELECT * FROM Item;

-- ============================
-- Pobranie wszystkich FILMÓW
-- > typ ustalony jako '1'
-- ============================
-- SELECT * FROM Item
-- WHERE type == 1;

-- ============================
-- Pobranie wszystkich SERIALI
-- > typ ustalony jako '2'
-- ============================
-- SELECT * FROM Item
-- WHERE type == 2;

-- ============================
-- Wyszukanie informacji dla
-- konkretnego filmu
-- > typ ustalony jako '1'
-- ============================
-- SELECT
--     name,
--     year,
--     director,
--     actors,
--     duration
-- FROM Item
-- WHERE type == 1 AND item_ID == 13;


-- Gets all films
-- SELECT * FROM Item;

-- Gets all platforms
-- SELECT * FROM Streamings;

-- Gets items from Netflix
-- SELECT name, platform_name 
-- FROM Item
-- INNER JOIN Item_Streamings
-- ON Item.item_ID = Item_Streamings.item_ID
-- INNER JOIN Streamings
-- ON Item_Streamings.streaming_ID = Streamings.streaming_ID
-- WHERE Streamings.platform_name == 'Netflix';

-- Gets all Sci-Fi
-- SELECT name, genre 
-- FROM Item
-- INNER JOIN Item_Categories
-- ON Item.item_ID = Item_Categories.item_ID
-- INNER JOIN Categories
-- ON Item_Categories.cat_ID = Categories.cat_ID
-- WHERE Categories.genre == 'Sci-Fi';

-- Gets all 'klasyk'
-- SELECT Item.name, Tags.name 
-- FROM Item 
-- INNER JOIN Item_Tags
-- ON Item.item_ID = Item_Tags.item_ID
-- INNER JOIN Tags
-- ON Item_Tags.tag_ID = Tags.tag_ID
-- WHERE Tags.name == 'klasyk';

-- Rating example
-- SELECT Item.name, Ratings.rating, Streamings.platform_name
-- FROM Item
-- INNER JOIN Item_Ratings
-- ON Item.item_ID = Item_Ratings.item_ID
-- INNER JOIN Ratings
-- ON Item_Ratings.rating_ID= Ratings.rating_ID
-- INNER JOIN Item_Streamings
-- ON Item.item_ID = Item_Streamings.item_ID
-- INNER JOIN Streamings
-- ON Item_Streamings.streaming_ID = Streamings.streaming_ID
-- WHERE Item.name = 'Dark';



