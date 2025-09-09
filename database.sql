-- Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS test_crud;

-- Use the database
USE test_crud;

-- Create the test_info table
CREATE TABLE IF NOT EXISTS test_info (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    comments TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Add some sample data (optional)
INSERT INTO test_info (name, comments) VALUES
('John Doe', 'This is a test comment from John.'),
('Jane Smith', 'Another test comment from Jane.'),
('Test User', 'Testing the CRUD application.');
