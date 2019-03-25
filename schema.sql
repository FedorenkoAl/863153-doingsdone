CREATE DATABASE Doingsdone;
 USE Doingsdone;

CREATE TABLE project (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(64),
  author INT
);

CREATE TABLE task (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date_create DATETIME,
  data_end DATETIME,
  status TINYINT DEFAULT '0',
  name VARCHAR(64),
  file VARCHAR(128),
  term DATETIME,
  author INT,
  project INT
);

CREATE TABLE user (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date_registration DATETIME,
  name VARCHAR(64),
  email VARCHAR(128) NOT NULL UNIQUE,
  password VARCHAR(128) NOT NULL UNIQUE
);
