CREATE TABLE Item (
    item_ID INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    year INTEGER NOT NULL,
    director TEXT NOT NULL,
    actors TEXT NOT NULL,
    type INTEGER NOT NULL,
    duration INTEGER,
    season INTEGER
);

CREATE TABLE Ratings (
    rating_ID INTEGER PRIMARY KEY AUTOINCREMENT,
    rating REAL NOT NULL,
    comment TEXT
);

CREATE TABLE Streamings (
    streaming_ID INTEGER PRIMARY KEY AUTOINCREMENT,
    platform_name TEXT NOT NULL
);

CREATE TABLE Tags (
    tag_ID INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL
);

CREATE TABLE Categories (
    cat_ID INTEGER PRIMARY KEY AUTOINCREMENT,
    genre TEXT
);


-- Tabele pośrednie --

CREATE TABLE Item_Streamings (
    item_ID INT NOT NULL,
    streaming_ID INT NOT NULL,
    FOREIGN KEY (item_ID) REFERENCES Item(item_ID),
    FOREIGN KEY (streaming_ID) REFERENCES Streamings(streaming_ID),
    PRIMARY KEY (item_ID, streaming_ID)
);

CREATE TABLE Item_Tags (
    item_ID INT NOT NULL,
    tag_ID INT NOT NULL,
    FOREIGN KEY (item_ID) REFERENCES Item(item_ID),
    FOREIGN KEY (tag_ID) REFERENCES Tags(tag_ID),
    PRIMARY KEY (item_ID, tag_ID)
);

CREATE TABLE Item_Categories (
    item_ID INT NOT NULL,
    cat_ID INT NOT NULL,
    FOREIGN KEY (item_ID) REFERENCES Item(item_ID),
    FOREIGN KEY (cat_ID) REFERENCES Categories(cat_ID),
    PRIMARY KEY (item_ID, cat_ID)
);

CREATE TABLE Item_Ratings (
    item_ID INT NOT NULL,
    rating_ID INT NOT NULL,
    FOREIGN KEY (item_ID) REFERENCES Item(item_ID),
    FOREIGN KEY (rating_ID) REFERENCES Ratings(rating_ID),
    PRIMARY KEY (item_ID, rating_ID)
);

