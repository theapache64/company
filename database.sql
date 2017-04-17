DROP DATABASE IF EXISTS `company`;
CREATE DATABASE IF NOT EXISTS `company`;

CREATE TABLE employees (
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(50) NOT NULL,
	mobile VARCHAR(10) NOT NULL,
	is_active TINYINT(4) NOT NULL DEFAULT 1,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
	PRIMARY KEY (id)
);
