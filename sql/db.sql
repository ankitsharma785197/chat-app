-- Create a database if it doesn't exist
CREATE DATABASE IF NOT EXISTS chat_app_db;

-- Use the created database
USE chat_app_db;

-- Table structure for table `users`
CREATE TABLE `users` (
  user_id int(11) NOT NULL AUTO_INCREMENT,
  unique_id int(200) NOT NULL,
  fname varchar(255) NOT NULL,
  lname varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  img varchar(400) NOT NULL,
  status varchar(255) NOT NULL,
  last_seen timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create a table to store chat messages
CREATE TABLE `messages` (
  msg_id int(11) NOT NULL AUTO_INCREMENT,
  incoming_msg_id int(255) NOT NULL,
  outgoing_msg_id int(255) NOT NULL,
  msg varchar(1000) NOT NULL,
  img1 varchar(255) NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
