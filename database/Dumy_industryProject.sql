INSERT INTO `admin` (`ID`, `password`, `whID`) VALUES
(1, '1234', 1);

INSERT INTO `brand` (`brandID`, `brandName`) VALUES
(1, 'ASAHI'),
(2, 'Sawmill'),
(3, 'Heineken');

INSERT INTO `category` (`categoryID`, `parentCategoryID`, `categoryName`) VALUES
(1, NULL, 'beer'),
(2, 1, 'IPA'),
(3, 1, 'APA'),
(4, 1, 'Pale Ale');

INSERT INTO `warehousetype` (`typeID`, `typeName`) VALUES
(1, 'branch');

INSERT INTO `warehouse` (`whID`, `typeID`, `whName`, `address`, `phone`, `email`) VALUES
(1, 1, 'CBD', '6hobson', 0, 'hamfd@gmail.com'),
(2, 1, '4575abd', '1234567', 252144, 'abd@gmail.com'),
(3, 1, 'Newmarket', '7symonds', 252144, 'abd@gmail.com'),
(4, 1, 'Takapuna', 'bowman456', 252144, 'abd@gmail.com'),
(5, 1, 'Albany', '185 archers', 252144, 'abd@gmail.com'),
(6, 1, '6666', '2 asdf', 12341234, 'asdf@asdf.com'),
(7, 1, '7777', '45 Asdsdf', 1234567234, '23sdff@asdf.com'),
(8, 1, '8888', '75 wert', 12456734, '2435asdf@asdf.com'),
(9, 1, '9999', '67 zxcv', 12345234, '34534@asdf.com'),
(10, 1, '1010', '23 asdf', 15878834, '234sdf@asdf.com'),
(11, 1, '1010', '23 fdfddf', 2108216229, 'ham@asdf.com');

INSERT INTO `product` (`productID`, `productName`, `discountprice`, `price`, `img`, `categoryID`, `brandID`) VALUES
(10003, 'Sawmill Signiture', 9.5, 12.5, 'coolslight.png', 1, 2),
(10004, 'Asahi light', 7.5, 8.5, 'asahi.png', 1, 1),
(10005, 'Asahi can', 6.5, 8, 'asahican.png', 1, 2),
(10006, 'Blanche Classic', 9.5, 13, 'blanche.png', 1, 3),
(10007, 'Tranditional Blond', 10.5, 13, 'traditionalblond.png', 1, 3),
(10009, 'Sawmill Signiture', 9.5, 12.5, 'coolslight.png', 1, 2),
(10010, 'Asahi light', 7.5, 8.5, 'asahi.png', 1, 1),
(10011, 'Asahi can', 6.5, 8, 'asahican.png', 1, 2),
(10012, 'Blanche Classic', 9.5, 13, 'blanche.png', 1, 3),
(10013, 'Tranditional Blond', 10.5, 13, 'traditionalblond.png', 1, 3),
(10014, 'IPA Ca,den Classic', 8.5, 9, 'camden.png', 1, 3),
(10015, 'punky brew Classic', 6.5, 7, 'punk.png', 1, 2);

INSERT INTO `usertype` (`typeName`) VALUES 
('Branch warehouse'),
('Business partner'), 
('Individual');


