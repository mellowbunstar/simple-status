CREATE TABLE `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(65) NOT NULL DEFAULT '',
  PRIMARY KEY (`userId`),
  UNIQUE KEY `username` (`username`)
);

INSERT INTO `users` (`userId`, `username`) VALUES(1, 'Meowmix');

CREATE TABLE `statuses` (
  `statusId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT 0,
  `body` varchar(140) NOT NULL DEFAULT '',
  PRIMARY KEY (`statusId`)
);

INSERT INTO `statuses` (`userId`, `date`, `body`) VALUES(1, NOW(), 'Hello worldz! :D');