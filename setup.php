<?php
// authors: Alex Chan, Nathaniel Gonzalez, Cory Ooten

spl_autoload_register(function($classname) {
    include "classes/$classname.php";
});

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$db = new mysqli(Config::$db["host"], Config::$db["user"], 
                 Config::$db["pass"], Config::$db["database"]);

# create tops table                 
$db->query("drop table if exists tops;");
$db->query("CREATE TABLE tops (
                productID VARCHAR(255),
                name VARCHAR(255),
                imageID VARCHAR(255),
                primaryColor VARCHAR(255),
                gender VARCHAR(255),
                price DOUBLE(64, 2),
                brand VARCHAR(255),
                sleeveLength VARCHAR(255),
                hasZipper BOOL,
                hasHood BOOL,
                PRIMARY KEY(productID));
            ");

# create bottoms table
$db->query("drop table if exists bottoms;");
$db->query("CREATE TABLE bottoms (
                productID VARCHAR(255),
                name VARCHAR(255),
                imageID VARCHAR(255),
                primaryColor VARCHAR(255),
                gender VARCHAR(255),
                price DOUBLE(64, 2),
                brand VARCHAR(255),
                pantLength VARCHAR(255),
                PRIMARY KEY(productID));
            ");

# create accessories table
$db->query("drop table if exists accessories;");
$db->query("CREATE TABLE accessories (
                productID VARCHAR(255),
                name VARCHAR(255),
                imageID VARCHAR(255),
                primaryColor VARCHAR(255),
                gender VARCHAR(255),
                price DOUBLE(64, 2),
                brand VARCHAR(255),
                type VARCHAR(255),
                PRIMARY KEY(productID));
            ");

# create users table
$db->query("drop table if exists users;");
$db->query("CREATE TABLE users (
                userID INT NOT NULL AUTO_INCREMENT,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                PRIMARY KEY(userID));
            ");

# create wishlists table
$db->query("drop table if exists wishlists;");
$db->query("CREATE TABLE wishlists (
                userID INT, 
                productID VARCHAR(255),
                priority INT, 
                PRIMARY KEY(userID, productID));  
            ");

# create wishForTops table
$db->query("drop table if exists wishForTops;");
$db->query("CREATE TABLE wishForTops (
                productID VARCHAR(255),
                userID INT NOT NULL,
                priority INT,
                PRIMARY KEY(userID, productID));
            ");

# create wishForBottoms table
$db->query("drop table if exists wishForBottoms;");
$db->query("CREATE TABLE wishForBottoms(
                productID VARCHAR(255),
                userID INT NOT NULL,
                priority INT,
                PRIMARY KEY(userID, productID));
            ");

# create wishForAccessories table
$db->query("drop table if exists wishForAccessories;");
$db->query("CREATE TABLE wishForAccessories (
                productID VARCHAR(255),
                userID INT NOT NULL,
                priority INT,
                PRIMARY KEY(userID, productID));
            ");

# Insert data into tops table
$db->query('INSERT INTO tops (productID, name, imageID, primaryColor, gender, price, brand, sleeveLength, hasZipper, hasHood) values ("tops1", "Waffle Crew Neck Long-Sleeve T-Shirt", "https://image.uniqlo.com/UQ/ST3/us/imagesgoods/440522/item/usgoods_58_440522.jpg?width=320", "olive", "M", 29.90, "uniqlo", "long", FALSE, FALSE);');
$db->query('INSERT INTO tops (productID, name, imageID, primaryColor, gender, price, brand, sleeveLength, hasZipper, hasHood) values ("tops2", "Quilted Jacket", "https://static.zara.net/photos///2022/I/0/1/p/4341/709/710/2/w/298/4341709710_15_10_1.jpg?ts=1665740845294", "beige", "F", 119.00, "zara", "long", TRUE, TRUE);');
$db->query('INSERT INTO tops (productID, name, imageID, primaryColor, gender, price, brand, sleeveLength, hasZipper, hasHood) values ("tops3", "Poplin Shirt", "https://static.zara.net/photos///2022/I/0/1/p/9270/396/250/2/w/614/9270396250_15_10_1.jpg?ts=1665742395020", "white", "F", 35.90, "zara", "long", FALSE, FALSE);');
$db->query('INSERT INTO tops (productID, name, imageID, primaryColor, gender, price, brand, sleeveLength, hasZipper, hasHood) values ("tops4", "Regular Fit Oxford Shirt", "https://lp2.hm.com/hmgoepprod?set=quality%5B79%5D%2Csource%5B%2F34%2F4c%2F344ca513d57fb19c85a8454486d662aae35eb629.jpg%5D%2Corigin%5Bdam%5D%2Ccategory%5B%5D%2Ctype%5BLOOKBOOK%5D%2Cres%5Bm%5D%2Chmver%5B1%5D&call=url[file:/product/main]", "navy", "M", 24.99, "h&m", "long", FALSE, FALSE);');
$db->query('INSERT INTO tops (productID, name, imageID, primaryColor, gender, price, brand, sleeveLength, hasZipper, hasHood) values ("tops5", "Long-Sleeve T-Shirt", "https://oldnavy.gap.com/webcontent/0050/714/142/cn50714142.jpg", "blue", "K", 12.99, "oldnavy", "long", FALSE, FALSE);');
$db->query('INSERT INTO tops (productID, name, imageID, primaryColor, gender, price, brand, sleeveLength, hasZipper, hasHood) values ("tops6", "Slub-Knit Long-Sleeved T-Shirt", "https://oldnavy.gap.com/webcontent/0050/569/037/cn50569037.jpg", "black", "F", 14.99, "oldnavy", "long", FALSE, FALSE);');
$db->query('INSERT INTO tops (productID, name, imageID, primaryColor, gender, price, brand, sleeveLength, hasZipper, hasHood) values ("tops7", "Extra Soft 100% Wool Top", "https://static.zara.net/photos///2022/I/0/1/p/9598/193/717/2/w/850/9598193717_6_1_1.jpg?ts=1664957665912", "chocolate", "F", 59.90, "zara", "short", FALSE, FALSE);');
$db->query('INSERT INTO tops (productID, name, imageID, primaryColor, gender, price, brand, sleeveLength, hasZipper, hasHood) values ("tops8","Thermal-Knit Pullover T-Shirt Hoodie", "https://oldnavy.gap.com/webcontent/0050/767/329/cn50767329.jpg", "gray", "M", 36.99, "oldnavy", "long", FALSE, TRUE);');
$db->query('INSERT INTO tops (productID, name, imageID, primaryColor, gender, price, brand, sleeveLength, hasZipper, hasHood) values ("tops9", "Denim Shirt", "https://static.zara.net/photos///2022/I/0/2/p/6987/320/427/2/w/850/6987320427_6_1_1.jpg?ts=1657541676323", "mid-blue", "M",39.90, "zara", "long", FALSE, FALSE);');
$db->query('INSERT INTO tops (productID, name, imageID, primaryColor, gender, price, brand, sleeveLength, hasZipper, hasHood) values ("tops10", "Fluffy Yarn Fleece Vest", "https://image.uniqlo.com/UQ/ST3/us/imagesgoods/453611/item/usgoods_32_453611.jpg?width=320", "brown", "K", 24.90, "uniqlo", "short", TRUE, FALSE);');
$db->query('INSERT INTO tops (productID, name, imageID, primaryColor, gender, price, brand, sleeveLength, hasZipper, hasHood) values ("tops11", "Ribbed Cotton-Cashmere Relaxed Turtleneck Sweater", "https://www.jcrew.com/s7-img-facade/BB427_SU8750_m?fmt=jpeg&qlt=90,0&resMode=sharp&op_usm=.1,0,0,0&crop=0,0,0,0&wid=540&hei=540", "pink", "F", 138.00, "jcrew", "long", FALSE, FALSE);');
$db->query('INSERT INTO tops (productID, name, imageID, primaryColor, gender, price, brand, sleeveLength, hasZipper, hasHood) values ("tops12", "Photo Print T-Shirt","https://static.zara.net/photos///2022/I/0/3/p/4772/780/251/2/w/850/4772780251_6_1_1.jpg?ts=1664865996375", "oyster-white","K",10.90, "zara", "long", FALSE, FALSE);');
$db->query('INSERT INTO tops (productID, name, imageID, primaryColor, gender, price, brand, sleeveLength, hasZipper, hasHood) values ("tops13", "Kids’ Puffer Jacket", "https://www.jcrew.com/s7-img-facade/BJ193_BK0001?fmt=jpeg&qlt=90,0&resMode=sharp&op_usm=.1,0,0,0&crop=0,0,0,0&wid=540&hei=540 ", "black", "K", 158.00, "jcrew", "long", TRUE, TRUE);');
$db->query('INSERT INTO tops (productID, name, imageID, primaryColor, gender, price, brand, sleeveLength, hasZipper, hasHood) values ("tops14",  "Premium Plain T-Shirt", "https://static.zara.net/photos///2022/I/0/3/p/1887/796/400/2/w/850/1887796400_6_1_1.jpg?ts=1664187497941", "blue","K",12.90, "zara", "long", FALSE, FALSE);');
$db->query('INSERT INTO tops (productID, name, imageID, primaryColor, gender, price, brand, sleeveLength, hasZipper, hasHood) values ("tops15", "Hybrid Down Parka", "https://image.uniqlo.com/UQ/ST3/WesternCommon/imagesgoods/451706/item/goods_35_451706.jpg?width=320", "brown","M",159.90, "uniqlo", "long", TRUE, TRUE);');
            
# Insert data into bottoms table
$db->query('INSERT INTO bottoms (productID, name, imageID, primaryColor, gender, price, brand, pantLength) values ("bottoms1", "Cargo Jogger Sweatpants", "https://oldnavy.gap.com/webcontent/0050/739/643/cn50739643.jpg", "acacia", "K", 29.99, "oldnavy", "long");');
$db->query('INSERT INTO bottoms (productID, name, imageID, primaryColor, gender, price, brand, pantLength) values ("bottoms2", "Jogger Pants", "https://static.zara.net/photos///2022/I/0/2/p/0761/367/800/2/w/36/0761367800_6_1_1.jpg?ts=1666105896768", "black", "M", 59.90, "zara", "long");');
$db->query('INSERT INTO bottoms (productID, name, imageID, primaryColor, gender, price, brand, pantLength) values ("bottoms3", "Girls’ Patch-Pocket Corduroy Skirt", "https://www.jcrew.com/s7-img-facade/BJ242_BL8133?fmt=jpeg&qlt=90,0&resMode=sharp&op_usm=.1,0,0,0&crop=0,0,0,0&wid=540&hei=540", "navy", "K", 49.50, "jcrew", "short");');
$db->query('INSERT INTO bottoms (productID, name, imageID, primaryColor, gender, price, brand, pantLength) values ("bottoms4", "Slim Fit Cotton Twill Pants", "https://lp2.hm.com/hmgoepprod?set=quality%5B79%5D%2Csource%5B%2Ff7%2Fa8%2Ff7a8da2029dd8018763ef53bdaf23299bd083a02.jpg%5D%2Corigin%5Bdam%5D%2Ccategory%5B%5D%2Ctype%5BLOOKBOOK%5D%2Cres%5Bm%5D%2Chmver%5B1%5D&call=url[file:/product/main]", "beige", "M", 29.99, "h&m", "long");');
$db->query('INSERT INTO bottoms (productID, name, imageID, primaryColor, gender, price, brand, pantLength) values ("bottoms5", "Skinny Chino Pants", "https://static.zara.net/photos///2022/I/0/2/p/6786/310/733/2/w/850/6786310733_6_1_1.jpg?ts=1657540462611", "cream", "M", 39.90, "zara", "long");');
$db->query('INSERT INTO bottoms (productID, name, imageID, primaryColor, gender, price, brand, pantLength) values ("bottoms6", "High Waist Joggers", "https://lp2.hm.com/hmgoepprod?set=quality%5B79%5D%2Csource%5B%2F2c%2F34%2F2c34c08195185a902d0b633dfa2ea0529013751c.jpg%5D%2Corigin%5Bdam%5D%2Ccategory%5B%5D%2Ctype%5BLOOKBOOK%5D%2Cres%5Bm%5D%2Chmver%5B1%5D&call=url[file:/product/main]", "black", "F", 24.99, "h&m", "long");');
$db->query('INSERT INTO bottoms (productID, name, imageID, primaryColor, gender, price, brand, pantLength) values ("bottoms7", "High-Waisted Rib-Knit Leggings", "https://oldnavy.gap.com/webcontent/0050/500/655/cn50500655.jpg", "gray", "F", 19.99, "oldnavy", "long");');
$db->query('INSERT INTO bottoms (productID, name, imageID, primaryColor, gender, price, brand, pantLength) values ("bottoms8", "Textured Weave Plaid Shorts", "https://static.zara.net/photos///2022/I/0/1/p/3046/261/064/2/w/850/3046261064_6_1_1.jpg?ts=1661788363512", "black/white", "F", 45.90, "zara", "short");');
$db->query('INSERT INTO bottoms (productID, name, imageID, primaryColor, gender, price, brand, pantLength) values ("bottoms9", "Ultra Stretch Dry Sweatpants", "https://image.uniqlo.com/UQ/ST3/us/imagesgoods/450698/sub/usgoods_450698_sub7.jpg?width=750", "black", "K", 24.90, "uniqlo", "long");');
$db->query('INSERT INTO bottoms (productID, name, imageID, primaryColor, gender, price, brand, pantLength) values ("bottoms10", "Slim-fit Stretch Jeans", "https://www.jcrew.com/s7-img-facade/AW290_DM4913_d1?fmt=jpeg&qlt=90,0&resMode=sharp&op_usm=.1,0,0,0&crop=0,0,0,0&wid=540&hei=540", "denim", "M", 128.00, "jcrew", "long");');
$db->query('INSERT INTO bottoms (productID, name, imageID, primaryColor, gender, price, brand, pantLength) values ("bottoms11", "Buttoned Faux Leather Shorts", "https://static.zara.net/photos///2022/I/0/1/p/3046/258/800/2/w/850/3046258800_6_1_1.jpg?ts=1662480488282", "black", "F", 39.90, "zara", "short");');
$db->query('INSERT INTO bottoms (productID, name, imageID, primaryColor, gender, price, brand, pantLength) values ("bottoms12", "Smart Ankle Pants", "https://image.uniqlo.com/UQ/ST3/WesternCommon/imagesgoods/455492/item/goods_06_455492.jpg?width=320", "gray", "M", 49.90, "uniqlo", "long");');
$db->query('INSERT INTO bottoms (productID, name, imageID, primaryColor, gender, price, brand, pantLength) values ("bottoms13", "Plaid Pants", "https://static.zara.net/photos///2022/V/0/3/p/1656/663/811/2/w/850/1656663811_6_1_1.jpg?ts=1644497356680", "Light-Gray", "K", 32.90, "zara", "long");');
$db->query('INSERT INTO bottoms (productID, name, imageID, primaryColor, gender, price, brand, pantLength) values ("bottoms14", "Baggy Jeans", "https://image.uniqlo.com/UQ/ST3/us/imagesgoods/451193/item/usgoods_69_451193.jpg?width=320", "navy", "F", 49.90, "uniqlo", "long");');
$db->query('INSERT INTO bottoms (productID, name, imageID, primaryColor, gender, price, brand, pantLength) values ("bottoms15", "Mesh Basketball Shorts", "https://oldnavy.gap.com/webcontent/0050/240/947/cn50240947.jpg", "white", "K", 19.99, "oldnavy", "short");');

# Insert data into accessories table
$db->query('INSERT INTO accessories (productID, name, imageID, primaryColor, gender, price, brand, type) values ("accessory1", "Cotton Beanie", "https://www.jcrew.com/s7-img-facade/BJ318_BL8133?fmt=jpeg&qlt=90,0&resMode=sharp&op_usm=.1,0,0,0&crop=0,0,0,0&wid=540&hei=540", "navy", "M", 49.50, "jcrew", "hat");');
$db->query('INSERT INTO accessories (productID, name, imageID, primaryColor, gender, price, brand, type) values ("accessory2", "Compass Pendant", "https://cdn.shopify.com/s/files/1/2219/3483/products/CRAFTDECOMMarch8921.jpg?v=1618055372&width=533", "Gold", "F", 84.99, "CRAFTD LONDON", "jewelry");');
$db->query('INSERT INTO accessories (productID, name, imageID, primaryColor, gender, price, brand, type) values ("accessory3", "Kids’ Leather Belt", "https://www.jcrew.com/s7-img-facade/AW434_SP4160?fmt=jpeg&qlt=90,0&resMode=sharp&op_usm=.1,0,0,0&crop=0,0,0,0&wid=540&hei=540", "caramel", "K", 29.50, "jcrew", "belt");');
$db->query('INSERT INTO accessories (productID, name, imageID, primaryColor, gender, price, brand, type) values ("accessory4", "Blue Tennis Chain (Silver) 3mm", "https://cdn.shopify.com/s/files/1/2219/3483/products/Angle1_a1147db0-dd75-4dfd-8efd-ad03f6d95ec9.png?v=1665053607&width=533", "blue", "F", 124.99, "CRAFTD LONDON", "jewelry");');
$db->query('INSERT INTO accessories (productID, name, imageID, primaryColor, gender, price, brand, type) values ("accessory5", "Maxi Resin Earrings", "https://static.zara.net/photos///2022/I/0/1/p/4548/267/807/2/w/850/4548267807_6_1_1.jpg?ts=1666094430767", "Anthracite-Grey", "F", 22.90, "zara", "jewelry");');
$db->query('INSERT INTO accessories (productID, name, imageID, primaryColor, gender, price, brand, type) values ("accessory6", "Retro Thick-Frame Sunglasses", "https://oldnavy.gap.com/webcontent/0050/836/564/cn50836564.jpg", "gray-smoke", "F", 22.99, "oldnavy", "sunglasses");');
$db->query('INSERT INTO accessories (productID, name, imageID, primaryColor, gender, price, brand, type) values ("accessory7", "Tone Ring", "https://cdn.shopify.com/s/files/1/0161/1184/products/Tone-Vitaly-QRTZ-1_533x.jpg?v=1653494882", "silver", "M", 80.00, "VITALY", "jewelry");');
$db->query('INSERT INTO accessories (productID, name, imageID, primaryColor, gender, price, brand, type) values ("accessory8", "Basic Fringed Scarf", "https://static.zara.net/photos///2022/I/0/2/p/3920/307/800/2/w/850/3920307800_6_1_1.jpg?ts=1662108362835", "black", "M",35.90, "zara", "scarf");');
$db->query('INSERT INTO accessories (productID, name, imageID, primaryColor, gender, price, brand, type) values ("accessory9", "Canvas Baseball Cap", "https://oldnavy.gap.com/webcontent/0050/246/495/cn50246495.jpg", "yellow", "K",14.99, "oldnavy", "hat");');
$db->query('INSERT INTO accessories (productID, name, imageID, primaryColor, gender, price, brand, type) values ("accessory10", "Corduroy Bucket Hat", "https://lp2.hm.com/hmgoepprod?set=quality%5B79%5D%2Csource%5B%2F02%2F77%2F027792fb0be8347f1fcd37dfaac7f301c762e5e9.jpg%5D%2Corigin%5Bdam%5D%2Ccategory%5B%5D%2Ctype%5BLOOKBOOK%5D%2Cres%5Bm%5D%2Chmver%5B1%5D&call=url[file:/product/main]", "black", "M", 12.99, "h&m", "hat");');
$db->query('INSERT INTO accessories (productID, name, imageID, primaryColor, gender, price, brand, type) values ("accessory11", "Solid Knit Beanie", "https://oldnavy.gap.com/webcontent/0050/724/305/cn50724305.jpg", "harvest gold", "K", 14.99, "oldnavy", "hat");');
$db->query('INSERT INTO accessories (productID, name, imageID, primaryColor, gender, price, brand, type) values ("accessory12", "Sonic The Hedgehog Interactive Watch", "https://target.scene7.com/is/image/Target/GUEST_00456e7b-f34d-466f-a85f-5318058165e9?qlt=85&fmt=webp&hei=199&wid=199", "blue", "K", 35.00, "target", "watch");');

# Insert data into users table
$pass1 = password_hash('iluvPatrick&2', PASSWORD_DEFAULT);
$pass2 = password_hash('Sesame5tr1!', PASSWORD_DEFAULT);
$pass3 = password_hash('Clubhouse541!', PASSWORD_DEFAULT);
$pass4 = password_hash('G01fisC001!', PASSWORD_DEFAULT);
$pass5 = password_hash('The4ce!!!', PASSWORD_DEFAULT);
$db->query("INSERT INTO users (name, email, password) values ('Spongebob','spongebob2@yahoo.com','$pass1');");
$db->query("INSERT INTO users (name, email, password) values ('Elmo','elmo@gmail.com','$pass2');");
$db->query("INSERT INTO users (name, email, password) values ('Mickey','mickey@gmail.com','$pass3');");
$db->query("INSERT INTO users (name, email, password) values ('Clark','lawnmowerdad@gmail.com','$pass4');");
$db->query("INSERT INTO users (name, email, password) values ('Vader','darthvader@outlook.com','$pass5');");

# Insert data into wishlists table
$db->query('INSERT INTO wishlists (userID, productID, priority) values ("1","tops1", 3);');
$db->query('INSERT INTO wishlists (userID, productID, priority) values ("2","bottoms4", 4);');
$db->query('INSERT INTO wishlists (userID, productID, priority) values ("3","bottoms9", 2);');
$db->query('INSERT INTO wishlists (userID, productID, priority) values ("3","accessories2", 1);');
$db->query('INSERT INTO wishlists (userID, productID, priority) values ("3","tops12", 3);');
$db->query('INSERT INTO wishlists (userID, productID, priority) values ("5","accessories12", 5);');
$db->query('INSERT INTO wishlists (userID, productID, priority) values ("6","accessories12", 4);');
$db->query('INSERT INTO wishlists (userID, productID, priority) values ("7","accessories5", 3);');
$db->query('INSERT INTO wishlists (userID, productID, priority) values ("7","tops3", 4);');
$db->query('INSERT INTO wishlists (userID, productID, priority) values ("8","bottoms1", 2);');

# Insert data into wishForTops table
$db->query('INSERT INTO wishForTops(userID, productID, priority) values ("1","tops1", 3);');
$db->query('INSERT INTO wishForTops(userID, productID, priority) values ("3","tops12", 3);');
$db->query('INSERT INTO wishForTops(userID, productID, priority) values ("7","tops3", 4);');

# Insert data into wishForBottoms table
$db->query('INSERT INTO wishForBottoms(userID, productID, priority) values ("2","bottoms4", 4);');
$db->query('INSERT INTO wishForBottoms(userID, productID, priority) values ("3","bottoms9", 2);');
$db->query('INSERT INTO wishForBottoms(userID, productID, priority) values ("8","bottoms1", 2);');

# Insert data into wishForAccessories table
$db->query('INSERT INTO wishForAccessories(userID, productID, priority) values ("3","accessories2", 1);');
$db->query('INSERT INTO wishForAccessories(userID, productID, priority) values ("5","accessories12", 5);');
$db->query('INSERT INTO wishForAccessories(userID, productID, priority) values ("6","accessories12", 4);');
$db->query('INSERT INTO wishForAccessories(userID, productID, priority) values ("7","accessories5", 3);');

