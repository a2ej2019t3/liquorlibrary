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
(4, 1, 'Pale Ale'),
(5, NULL, 'Cider'),
(6, NULL, 'Wine'),
(7, 6, 'Red'),
(8, 6, 'White'),
(9, 6, 'Sparkling'),
(10, 6, 'Champagne'),
(11, NULL, 'Spirits'),
(12, 11, 'Gin'),
(13, 11, 'Vodka'),
(14, 11, 'Rum'),
(15, 11, 'Tequila'),
(16, 11, 'Bourbon'),
(17, 11, 'Brandy'),
(18, 11, 'Others'),
(19, NULL, 'Others');

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
(10003, 'Sawmill Signiture', 9.5, 12.5, 'coolslight.png', 3, 2),
(10004, 'Asahi light', 7.5, 8.5, 'asahi.png', 2, 1),
(10005, 'Asahi can', 6.5, 8, 'asahican.png', 3, 2),
(10006, 'Blanche Classic', 9.5, 13, 'blanche.png', 1, 3),
(10007, 'Tranditional Blond', 10.5, 13, 'traditionalblond.png', 1, 3),
(10009, 'Sawmill Signiture', 9.5, 12.5, 'coolslight.png', 2, 2),
(10010, 'Asahi light', 7.5, 8.5, 'asahi.png', 1, 1),
(10011, 'Asahi can', 6.5, 8, 'asahican.png', 1, 2),
(10012, 'Blanche Classic', 9.5, 13, 'blanche.png', 3, 3),
(10013, 'Tranditional Blond', 10.5, 13, 'traditionalblond.png', 1, 3),
(10014, 'IPA Ca,den Classic', 8.5, 9, 'camden.png', 3, 3),
(10015, 'punky brew Classic', 6.5, 7, 'punk.png', 1, 2),
(10016, 'punky brew Classic', 6.5, 7, 'punk.png', 3, 2),
(10017, 'Mollys Cradle', 18, 25, 'MollysCradle.png', 7, 1),
(10018, 'Mollys shiraz', 19.5, 25, 'CradleShiraz.png', 7, 1),
(10019, 'Mollys Cradle', 18, 25, 'MathieClaudine.png', 7, 1),
(10020, 'Mollys Merlot', 22, 27, 'MollysMerlot.png', 7, 1),
(10021, 'Mollys bundle', 85, 95, 'ChineseNewyearbundle.png', 7, 2);

INSERT INTO `usertype` (`typeName`) VALUES 
('Branch warehouse'),
('Business partner'), 
('Individual');


