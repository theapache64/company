DROP DATABASE IF EXISTS `company`;
CREATE DATABASE IF NOT EXISTS `company`;
USE `company`;

CREATE TABLE companies (
	id INT NOT NULL AUTO_INCREMENT,
	username VARCHAR(50) NOT NULL,
	password VARCHAR(10) NOT NULL,
	is_active TINYINT(4) NOT NULL DEFAULT 1,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);

CREATE TABLE employees (
	id INT NOT NULL AUTO_INCREMENT,
	company_id INT NOT NULL,
	name VARCHAR(50) NOT NULL,
	mobile VARCHAR(10) NOT NULL,
	is_active TINYINT(4) NOT NULL DEFAULT 1,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (company_id) REFERENCES companies(id) ON UPDATE CASCADE ON DELETE CASCADE,
	PRIMARY KEY (id)
);
