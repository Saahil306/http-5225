-- Create the database
CREATE DATABASE IF NOT EXISTS travel_db;
USE travel_db;

-- Create countries table
CREATE TABLE countries (
    code VARCHAR(5) PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- Insert sample countries
INSERT INTO countries (code, name) VALUES
('ID', 'Indonesia'),
('FR', 'France'),
('JP', 'Japan'),
('CA', 'Canada'),
('ZA', 'South Africa');

-- Create destinations table
CREATE TABLE destinations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    country_code VARCHAR(5),
    best_season VARCHAR(50),
    avg_cost_usd INT,
    rating FLOAT,
    last_visited DATE,
    FOREIGN KEY (country_code) REFERENCES countries(code)
);

-- Insert sample destinations
INSERT INTO destinations (name, country_code, best_season, avg_cost_usd, rating, last_visited) VALUES
('Bali', 'ID', 'Summer', 1200, 4.7, '2023-08-15'),
('Paris', 'FR', 'Spring', 2000, 4.9, '2022-05-01'),
('Kyoto', 'JP', 'Autumn', 1500, 4.6, '2023-11-10'),
('Banff', 'CA', 'Winter', 1800, 4.5, '2024-01-05'),
('Cape Town', 'ZA', 'Spring', 1600, 4.4, '2023-09-20');
