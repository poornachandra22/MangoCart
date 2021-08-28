CREATE DATABASE `mangocart` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */;

CREATE TABLE `user` (
  `UserId` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(30) NOT NULL,
  `UserMailId` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `UserPhoneNo` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `UserCity` varchar(15) DEFAULT NULL,
  `UserPeramanentAddress` varchar(200) DEFAULT NULL,
  `UserShippingAddress` varchar(200) DEFAULT NULL,
  `UserPassword` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`UserId`),
  UNIQUE KEY `UserMailId_UNIQUE` (`UserMailId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `mangoproduct` (
  `mangoproductid` int(11) NOT NULL AUTO_INCREMENT,
  `mangoproductname` varchar(45) NOT NULL,
  `mangoproductstock` int(11) DEFAULT NULL,
  `mangoproductprice` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`mangoproductid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `productorder` (
  `orderid` int(11) NOT NULL AUTO_INCREMENT,
  `orderuserid` int(11) NOT NULL,
  `orderproductid` int(11) NOT NULL,
  `orderquantity` int(11) NOT NULL,
  `orderamount` decimal(10,2) NOT NULL,
  `orderdate` datetime DEFAULT NULL,
  PRIMARY KEY (`orderid`),
  KEY `orderproductid_idx` (`orderproductid`),
  KEY `orderuserid_idx` (`orderuserid`),
  CONSTRAINT `orderproductid` FOREIGN KEY (`orderproductid`) REFERENCES `mangoproduct` (`mangoproductid`),
  CONSTRAINT `orderuserid` FOREIGN KEY (`orderuserid`) REFERENCES `user` (`UserId`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
