-- SQL for security-demo
CREATE DATABASE IF NOT EXISTS security_demo_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE security_demo_db;

-- Users table for registration/login
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);
