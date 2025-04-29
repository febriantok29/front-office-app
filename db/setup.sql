-- Front Office Visitor Registration System Database Setup
-- This script creates the necessary tables for the visitor registration system

-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS front_office_db;

-- Use the front office database
USE front_office_db;

-- Drop existing tables if they exist (in reverse order of dependencies)
DROP TABLE IF EXISTS guest_book;
DROP TABLE IF EXISTS items;
DROP TABLE IF EXISTS visitors;
DROP TABLE IF EXISTS employees;

-- Create employees table if it doesn't exist yet
CREATE TABLE IF NOT EXISTS employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    department VARCHAR(100) NOT NULL,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create visitors table
CREATE TABLE IF NOT EXISTS visitors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    id_card_number VARCHAR(50) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    email VARCHAR(100),
    employee_id INT NOT NULL,
    visit_purpose TEXT NOT NULL,
    visit_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    checkout_timestamp TIMESTAMP NULL,
    FOREIGN KEY (employee_id) REFERENCES employees(id)
);

-- Create items table for future Item Entry/Exit feature
CREATE TABLE IF NOT EXISTS items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    visitor_id INT NOT NULL,
    item_name VARCHAR(100) NOT NULL,
    item_description TEXT,
    entry_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    exit_timestamp TIMESTAMP NULL,
    approved_by INT,
    FOREIGN KEY (visitor_id) REFERENCES visitors(id),
    FOREIGN KEY (approved_by) REFERENCES employees(id)
);

-- Create guest_book table for future Guest Book feature
CREATE TABLE IF NOT EXISTS guest_book (
    id INT AUTO_INCREMENT PRIMARY KEY,
    visitor_id INT NOT NULL,
    comment TEXT NOT NULL,
    rating TINYINT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (visitor_id) REFERENCES visitors(id)
);

-- Insert sample employees data (if table is empty)
INSERT INTO employees (name, department) 
SELECT * FROM (SELECT 'John Smith', 'Information Technology') AS tmp
WHERE NOT EXISTS (
    SELECT id FROM employees WHERE name = 'John Smith'
) LIMIT 1;

INSERT INTO employees (name, department) 
SELECT * FROM (SELECT 'Sarah Jones', 'Human Resources') AS tmp
WHERE NOT EXISTS (
    SELECT id FROM employees WHERE name = 'Sarah Jones'
) LIMIT 1;

INSERT INTO employees (name, department) 
SELECT * FROM (SELECT 'Michael Brown', 'Finance') AS tmp
WHERE NOT EXISTS (
    SELECT id FROM employees WHERE name = 'Michael Brown'
) LIMIT 1;

INSERT INTO employees (name, department) 
SELECT * FROM (SELECT 'Emily Davis', 'Marketing') AS tmp
WHERE NOT EXISTS (
    SELECT id FROM employees WHERE name = 'Emily Davis'
) LIMIT 1;