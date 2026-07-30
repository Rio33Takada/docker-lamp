CREATE USER IF NOT EXISTS 'data_user'@'%' IDENTIFIED BY 'data';
GRANT ALL PRIVILEGES ON * . * TO 'data_user'@'%';

DROP DATABASE IF EXISTS test_db;
CREATE DATABASE IF NOT EXISTS test_db;

use test_db;

DROP TABLE IF EXISTS test_table;
CREATE TABLE IF NOT EXISTS test_table (
    id INT PRIMARY KEY,
    name VARCHAR(255),
    example_number INT,
    example_message VARCHAR(255)
);

insert into test_table (id, name, example_number, example_message) values (1, 'test1', 10, 'message1');
insert into test_table (id, name, example_number, example_message) values (2, 'test2', 20, 'message2');
insert into test_table (id, name, example_number, example_message) values (3, 'test3', 30, 'message3');

DROP DATABASE IF EXISTS data_master;
CREATE DATABASE IF NOT EXISTS data_master;

use data_master;

DROP TABLE IF EXISTS students;
CREATE TABLE IF NOT EXISTS students (
    student_id INT PRIMARY KEY,
    student_name VARCHAR(255),
    class_id INT
);

DROP TABLE IF EXISTS classes;
CREATE TABLE IF NOT EXISTS classes (
    class_id INT PRIMARY KEY,
    class_name VARCHAR(255)
);

insert into students (student_id, student_name, class_id) values (1, 'Tanaka', 1);
insert into students (student_id, student_name, class_id) values (2, 'Sato', 1);
insert into students (student_id, student_name, class_id) values (3, 'Suzuki', 2);
insert into students (student_id, student_name, class_id) values (4, 'Kimura', 2);

insert into classes (class_id, class_name) values (1, 'Programmer Class');
insert into classes (class_id, class_name) values (2, 'Designer Class');

insert into students (student_id, student_name, class_id) values (5, 'Takagi', 3);

DROP TABLE IF EXISTS jobs;
CREATE TABLE IF NOT EXISTS jobs(
    id INT PRIMARY KEY,
    name VARCHAR(255)
);

INSERT INTO jobs(id, name) VALUES
(1, 'knight'),
(2, 'wizard'),
(3, 'thief');

DROP TABLE IF EXISTS users;
CREATE TABLE IF NOT EXISTS users(
    id INT PRIMARY KEY,
    name VARCHAR(255),
    level INT,
    job_id INT
);

INSERT INTO users(id, name, level, job_id) VALUES
(1, 'abc', 45, 3),
(2, 'def', 21, 1),
(3, 'ghi', 37, 2),
(4, 'jkl', 26, 2),
(5, 'mno', 31, 3),
(6, 'pqr', 19, 1),
(7, 'stu', 42, 1),
(8, 'vwx', 29, 2),
(9, 'yz', 40, 3);

DROP TABLE IF EXISTS battle_log;
CREATE TABLE IF NOT EXISTS battle_log(
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    result_win BOOL,
    create_date DATE
);

INSERT INTO battle_log (user_id, result_win, create_date) VALUES
(8, TRUE, '2025-01-05'),
(9, TRUE, '2025-01-05'),
(6, TRUE, '2025-01-05'),
(5, TRUE, '2025-01-05'),
(8, TRUE, '2025-01-05'),
(3, FALSE, '2025-01-05'),
(2, FALSE, '2025-01-05'),
(9, FALSE, '2025-01-05'),
(1, FALSE, '2025-01-05'),
(8, TRUE, '2025-01-05'),
(9, TRUE, '2025-01-05'),
(6, FALSE, '2025-01-05'),
(1, FALSE, '2025-01-06'),
(4, TRUE, '2025-01-06'),
(2, TRUE, '2025-01-06'),
(3, TRUE, '2025-01-06'),
(5, TRUE, '2025-01-06'),
(7, FALSE, '2025-01-06'),
(7, TRUE, '2025-01-06'),
(5, FALSE, '2025-01-06'),
(2, TRUE, '2025-01-06'),
(1, TRUE, '2025-01-06'),
(4, FALSE, '2025-01-06'),
(6, TRUE, '2025-01-06'),
(3, TRUE, '2025-01-06'),
(8, FALSE, '2025-01-06'),
(7, FALSE, '2025-01-06'),
(6, FALSE, '2025-01-06'),
(6, TRUE, '2025-01-06'),
(1, FALSE, '2025-01-06'),
(3, TRUE, '2025-01-06'),
(6, FALSE, '2025-01-06'),
(7, TRUE, '2025-01-06'),
(7, TRUE, '2025-01-06'),
(4, TRUE, '2025-01-06'),
(2, TRUE, '2025-01-06'),
(8, TRUE, '2025-01-06'),
(4, TRUE, '2025-01-06'),
(8, FALSE, '2025-01-07'),
(1, TRUE, '2025-01-07'),
(3, TRUE, '2025-01-07'),
(3, FALSE, '2025-01-07'),
(9, FALSE, '2025-01-07'),
(9, TRUE, '2025-01-07'),
(5, TRUE, '2025-01-07'),
(1, FALSE, '2025-01-07'),
(7, TRUE, '2025-01-07'),
(3, TRUE, '2025-01-07'),
(8, TRUE, '2025-01-07'),
(4, TRUE, '2025-01-07'),
(2, FALSE, '2025-01-07'),
(2, TRUE, '2025-01-07'),
(5, FALSE, '2025-01-07'),
(9, FALSE, '2025-01-07'),
(5, TRUE, '2025-01-08'),
(4, TRUE, '2025-01-08'),
(6, TRUE, '2025-01-08'),
(1, TRUE, '2025-01-08'),
(2, TRUE, '2025-01-08'),
(7, TRUE, '2025-01-08'),
(5, TRUE, '2025-01-08'),
(6, FALSE, '2025-01-08'),
(5, TRUE, '2025-01-08'),
(7, TRUE, '2025-01-08'),
(4, TRUE, '2025-01-08'),
(2, TRUE, '2025-01-08'),
(8, TRUE, '2025-01-08'),
(3, TRUE, '2025-01-08'),
(9, FALSE, '2025-01-08'),
(4, TRUE, '2025-01-08'),
(1, FALSE, '2025-01-08'),
(9, TRUE, '2025-01-08');