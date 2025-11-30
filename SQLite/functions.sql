
-- Gets all films
-- SELECT * FROM Item;

-- Gets all platforms
-- SELECT * FROM Streamings;

-- Gets all categories
-- SELECT * FROM Categories;

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
