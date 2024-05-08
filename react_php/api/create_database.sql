-- This SQL script will create a new database and a table for users

-- Creating a new database called `UserDatabase`
CREATE DATABASE IF NOT EXISTS UserDatabase;
USE UserDatabase;

-- Creating a table called `users`
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Unique identifier for each user
    name VARCHAR(100) NOT NULL,        -- User's name
    email VARCHAR(100) NOT NULL UNIQUE,-- User's email (must be unique)
    phone VARCHAR(20) NOT NULL         -- User's phone number
);

-- Optionally, you can insert a sample record into the users table
INSERT INTO users (name, email, phone) VALUES ('John Doe', 'john.doe@example.com', '123-456-7890');
