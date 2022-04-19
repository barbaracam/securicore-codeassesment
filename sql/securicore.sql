-- SQL code for securicore database table
-- Database Name: securicore

CREATE TABLE `userInfo` (
  `userInfo_id` int PRIMARY KEY AUTO_INCREMENT,
  `uname` varchar(255) NOT NULL,  
  `email` varchar(255) NOT NULL,
  `user_id` int NOT NULL 
);
ALTER TABLE `userInfo` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

CREATE TABLE `users` (
  `user_id` int PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
);

-- Insert data with a hashed password
INSERT INTO users(username, password) values ("pepe", MD5("1234"));