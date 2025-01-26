CREATE DATABASE IF NOT EXISTS apo;

USE apo;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    type ENUM('customer', 'pharmacist') NOT NULL
);

INSERT INTO users (name, type)
SELECT * FROM (SELECT 'John Doe', 'customer') AS tmp
WHERE NOT EXISTS (SELECT 1 FROM users WHERE name = 'John Doe')
LIMIT 1;

INSERT INTO users (name, type)
SELECT * FROM (SELECT 'Jane Smith', 'customer') AS tmp
WHERE NOT EXISTS (SELECT 1 FROM users WHERE name = 'Jane Smith')
LIMIT 1;

INSERT INTO users (name, type)
SELECT * FROM (SELECT 'Dr. Richard Miles', 'pharmacist') AS tmp
WHERE NOT EXISTS (SELECT 1 FROM users WHERE name = 'Dr. Richard Miles')
LIMIT 1;

INSERT INTO users (name, type)
SELECT * FROM (SELECT 'Dr. Sarah Williams', 'pharmacist') AS tmp
WHERE NOT EXISTS (SELECT 1 FROM users WHERE name = 'Dr. Sarah Williams')
LIMIT 1;

CREATE TABLE IF NOT EXISTS medications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    started_at DATETIME NOT NULL,
    dosage INT NOT NULL,
    note VARCHAR(500),
    image LONGBLOB,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO medications (user_id, name, started_at, dosage, note)
SELECT * FROM (SELECT 1, 'Aspirin', '2023-01-15 08:00:00', 100, 'Take one tablet after breakfast') AS tmp
WHERE NOT EXISTS (SELECT 1 FROM medications WHERE user_id = 1 AND name = 'Aspirin')
LIMIT 1;

INSERT INTO medications (user_id, name, started_at, dosage, note)
SELECT * FROM (SELECT 1, 'Lisinopril', '2023-02-20 08:30:00', 10, 'Take one tablet in the morning') AS tmp
WHERE NOT EXISTS (SELECT 1 FROM medications WHERE user_id = 1 AND name = 'Lisinopril')
LIMIT 1;

INSERT INTO medications (user_id, name, started_at, dosage, note)
SELECT * FROM (SELECT 2, 'Metformin', '2023-03-01 07:30:00', 500, 'Take with food') AS tmp
WHERE NOT EXISTS (SELECT 1 FROM medications WHERE user_id = 2 AND name = 'Metformin')
LIMIT 1;

INSERT INTO medications (user_id, name, started_at, dosage, note)
SELECT * FROM (SELECT 3, 'Fluoxetine', '2022-12-10 09:00:00', 20, 'Take one tablet in the morning') AS tmp
WHERE NOT EXISTS (SELECT 1 FROM medications WHERE user_id = 3 AND name = 'Fluoxetine')
LIMIT 1;

