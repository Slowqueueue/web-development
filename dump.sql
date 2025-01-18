CREATE TABLE `cap_address` (
    `id` int (11) NOT NULL AUTO_INCREMENT,
	`address` char(30) DEFAULT NULL,
	PRIMARY KEY (`id`)
	) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
	INSERT INTO `cap_address` VALUES (1,'Zabalueva'),(2,'Lenina'),(3,'Ostrovskogo'),(4,'Galickogo');
CREATE TABLE `captains` (
    `id` int (11) NOT NULL AUTO_INCREMENT,
	`name` char (30) DEFAULT NULL,
	`team` char (30) DEFAULT NULL,
	`address_id` int (11) NOT NULL,
	PRIMARY KEY (`id`),
	FOREIGN KEY (`address_id`).
	REFERENCES `cap_address` (`id`)
	) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
	INSERT  INTO `captains` VALUES (1,'Ivanov','Lupa',2),(2,'Percevoy','Bars',4),(3,'Koronov','Heiner',1),(4,'Tarapenchuk','Chkalov',3);
