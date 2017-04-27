CREATE TABLE t_users (
id_user INT PRIMARY KEY AUTO_INCREMENT,
login varchar(255) NOT NULL,
nom varchar(255) NOT NULL,
prenom varchar(255) NOT NULL,
mail varchar(255) NOT NULL,
passwd varchar(255) NOT NULL,
actif BOOLEAN DEFAULT 0,
user_key varchar(32) DEFAULT NULL,
date_user DATE NOT NULL);

CREATE TABLE t_admin (
  id_admin INT PRIMARY KEY AUTO_INCREMENT,
  login varchar(255) NOT NULL,
  nom varchar(255) NOT NULL,
  prenom varchar(255) NOT NULL,
  mail varchar(255) NOT NULL,
  passwd varchar(255) NOT NULL,
  date_admin DATE NOT NULL);

CREATE TABLE t_comments (
  id_comment INT PRIMARY KEY AUTO_INCREMENT,
  id_user INT NOT NULL,
  date_comments DATE NOT NULL,
  comment_content varchar(255) NOT NULL);

CREATE TABLE t_photos (
  id_photo INT PRIMARY KEY AUTO_INCREMENT,
  id_user INT NOT NULL,
  data_photo LONGBLOB NOT NULL,
  date_photo DATETIME NOT NULL);

CREATE TABLE t_likes (
  id_like INT PRIMARY KEY AUTO_INCREMENT,
  id_user_from INT NOT NULL,
  id_user_to INT NOT NULL,
  date_like DATE NOT NULL);
