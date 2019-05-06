create table product (
	productID int(20) not null primary key auto_increment,
    productName varchar(45) not null,
    price double,
    img varchar(100),
    categoryID int(20) not null,
    brandID int(20) not null
    );
    
create table category (
	categoryID int(20) not null primary key auto_increment,
    parentCategoryID int(20),
    categoryName varchar(45) not null
    );
    
create table brand (
	brandID int(20) not null primary key auto_increment,
    brandName varchar(45) not null
    );
    
create table warehousetype (
	typeID int(20) not null primary key auto_increment,
    typeName varchar(45) not null
    );
    
create table warehouse (
	whID int(20) auto_increment primary key,
    typeID int(20) default 0,
    whName varchar(45),
    address varchar(45),
    phone bigint(20),
    email varchar(45)
    );
    
create table stocklist (
	listIndex int(20) not null primary key auto_increment,
	productID int(20) not null,
    quantity int(20),
    whID int(20) not null
    );
    
create table usertype (
	typeID int(20) not null primary key auto_increment,
    typeName varchar(45)
    );

create table users (
	userID int(20) not null primary key auto_increment,
    typeID int(20) not null,
    userName varchar(45) not null,
    password varchar(45),
    email varchar(45),
    phone bigint(20),
    address varchar(45)
    );
    
    
create table orders (
	orderID int(20) not null primary key auto_increment,
    buyerID int(20) not null,
    whID int(20) not null,
    date datetime,
    status boolean default 0
    );
    

create table orderitems (
	itemID int(20) not null primary key auto_increment,
    orderID int(20) not null,
    quantity int(20) not null,
    price double 
    );

create table backorders (
	backorderID int(20) not null primary key auto_increment,
    out_whID int(20) not null, 
    in_whID int(20) not null,
    date datetime,
    status boolean
    );
    

create table backorderitems (
	boItemID int(20) not null primary key auto_increment,
    boID int(20) not null,
    quantity int(20) default 0
    );
    

create table admin (
	ID int(20) not null primary key auto_increment,
    password varchar(20),
    whID int(20) not null
    );
    
alter table admin
add foreign key (whID) references warehouse(whID);

################################################################################3333
    alter table product 
    add foreign key (categoryID) references category(categoryID);
    
	alter table product 
    add foreign key (brandId) references brand(brandID);

	delimiter //
		create trigger after_product_inserted
			after insert on product
            for each row
		begin
			insert into stocklist (productID, whID)
            values (new.productID, 1), (new.productID, 2), (new.productID, 3), (new.productID, 4), (new.productID, 5), (new.productID, 6), (new.productID, 7), (new.productID, 8), (new.productID, 9), (new.productID, 10), (new.productID, 11);
		end;//
	delimiter ;
#####################################################################
    
alter table warehouse
add foreign key (typeID) references warehousetype(typeID);
#####################################################################
    
alter table stocklist
add foreign key (productID) references product(productID);

alter table stocklist
add foreign key (whID) references warehouse(whID);
################################################################

alter table users
add foreign key (typeID) references usertype(typeID);
###############################################################

alter table orders
add foreign key (buyerID) references users(userID);

alter table orders
add foreign key (whID) references warehouse(whID);

###################################################################

alter table orderitems
add foreign key (itemID) references product(productID);

alter table orderitems
add foreign key (orderID) references orders(orderID);
###################################################################

alter table backorders 
add foreign key (out_whID) references warehouse(whID);

alter table backorders
add foreign key (in_whID) references warehouse(whID);
################################################################

alter table backorderitems
add foreign key (boID) references backorders(backorderID);

alter table backorderitems
add foreign key (boItemID) references product(productID);

##################

