CREATE DATABASE IF NOT EXISTS fw_prod
CREATE DATABASE IF NOT EXISTS fw_test
CREATE TABLE IF NOT EXISTS post (
  id int NOT NULL primary key AUTO_INCREMENT,
  name varchar(255),
  body varchar(255),
  image varchar(255)
);
