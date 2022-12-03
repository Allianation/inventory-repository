CREATE DATABASE INVENTORY;

--PostgreSQL
CREATE TABLE CATEGORY (
    ID_CATEGORY SERIAL, 
    NAME_CATEGORY VARCHAR(100) NOT NULL,
    PRIMARY KEY (ID_CATEGORY)
);

CREATE TABLE PRODUCT (
    ID_PRODUCT SERIAL,
    NAME_PRODUCT VARCHAR(100) NOT NULL,
    IMAGE_PRODUCT BYTEA NOT NULL,
    DESCRIPTION_PRODUCT VARCHAR(100) NOT NULL,
    ID_CATEGORY INT NOT NULL,
    PRIMARY KEY (ID_PRODUCT),
    FOREIGN KEY (ID_CATEGORY) REFERENCES CATEGORY(ID_CATEGORY)
);


--MySQL
CREATE TABLE CATEGORY (
    ID_CATEGORY INT AUTO_INCREMENT, 
    NAME_CATEGORY VARCHAR(100) NOT NULL,
    PRIMARY KEY (ID_CATEGORY)
);

CREATE TABLE PRODUCT (
    ID_PRODUCT INT NOT NULL AUTO_INCREMENT,
    NAME_PRODUCT VARCHAR(100) NOT NULL,
    IMAGE_PRODUCT VARCHAR(100) NOT NULL,
    DESCRIPTION_PRODUCT VARCHAR(100) NOT NULL,
    ID_CATEGORY INT NOT NULL,
    PRIMARY KEY (ID_PRODUCT),
    FOREIGN KEY (ID_CATEGORY) REFERENCES CATEGORY(ID_CATEGORY)
);