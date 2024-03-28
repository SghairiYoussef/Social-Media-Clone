-- Run this script in phpmyadmin SQL section to create the database and test --

CREATE DATABASE IF NOT EXISTS login;

USE login;

CREATE TABLE IF NOT EXISTS users (
    userName VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    fullName VARCHAR(255) NOT NULL,
    birthDay DATE NOT NULL,
    PRIMARY KEY (userName, email)
    );