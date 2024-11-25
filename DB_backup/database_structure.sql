// Database structure
/*
CREATE DATABASE hospital_queue;

CREATE TABLE departments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE queue_tickets (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ticket_number VARCHAR(10) NOT NULL,
    department_id INT,
    patient_name VARCHAR(100) NOT NULL,
    status ENUM('waiting', 'called', 'completed') DEFAULT 'waiting',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (department_id) REFERENCES departments(id)
);
*/