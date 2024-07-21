CREATE DATABASE IF NOT EXISTS student-demo-registration-db;
USE student-demo-registration-db;

CREATE TABLE IF NOT EXISTS students (
    student_id VARCHAR(50) PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    project_title VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    time_slot VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS time_slots (
    slot VARCHAR(50) PRIMARY KEY,
    available_seats INT NOT NULL
);

INSERT INTO time_slots (slot, available_seats) VALUES
('09:00 AM - 10:00 AM', 10),
('10:00 AM - 11:00 AM', 10),
('11:00 AM - 12:00 PM', 10),
('01:00 PM - 02:00 PM', 10),
('02:00 PM - 03:00 PM', 10),
('03:00 PM - 04:00 PM', 10);