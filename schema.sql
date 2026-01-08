-- Create Database
CREATE DATABASE IF NOT EXISTS cj_mart;
USE cj_mart;

-- Users Table (Simplified: Username/Password only)
DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Products Table
DROP TABLE IF EXISTS products;
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(50) NOT NULL,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    image VARCHAR(500) NOT NULL,
    description TEXT,
    rating FLOAT DEFAULT 4.5
);

-- Cart Table
DROP TABLE IF EXISTS cart;
CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT DEFAULT 1,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Orders Table
DROP TABLE IF EXISTS orders;
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    address TEXT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50) DEFAULT 'Pending',
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Insert 50 Specific Products (Real Stock Photos from LoremFlickr)
-- URL Format: https://loremflickr.com/400/400/{keywords}?lock={id}

-- 1. DRESSES
INSERT INTO products (category, name, price, description, image, rating) VALUES
('Dresses', 'Floral Summer Dress', 1299.00, 'Light and breezy.', 'https://loremflickr.com/400/400/dress,floral?lock=1', 4.5),
('Dresses', 'Party Wear Gown', 2999.00, 'Elegant gown.', 'https://loremflickr.com/400/400/gown,fashion?lock=2', 4.8),
('Dresses', 'Casual Cotton Dress', 799.00, 'Comfortable cotton.', 'https://loremflickr.com/400/400/dress,casual?lock=3', 4.2),
('Dresses', 'Ethnic Kurti', 599.00, 'Traditional kurti.', 'https://loremflickr.com/400/400/kurti,ethnic?lock=4', 4.4),
('Dresses', 'Maxi Dress', 1499.00, 'Long flowing dress.', 'https://loremflickr.com/400/400/dress,maxi?lock=5', 4.6),
('Dresses', 'Designer Gown', 4999.00, 'Exclusive gown.', 'https://loremflickr.com/400/400/gown,designer?lock=6', 4.9),
('Dresses', 'Western Short Dress', 999.00, 'Stylish short dress.', 'https://loremflickr.com/400/400/dress,short?lock=7', 4.3),
('Dresses', 'Printed Daily Wear', 699.00, 'Simple printed dress.', 'https://loremflickr.com/400/400/dress,print?lock=8', 4.1),
('Dresses', 'Office Wear Dress', 1299.00, 'Formal office dress.', 'https://loremflickr.com/400/400/dress,office?lock=9', 4.5),
('Dresses', 'Evening Wear Dress', 1899.00, 'Sophisticated evening.', 'https://loremflickr.com/400/400/dress,evening?lock=10', 4.7);

-- 2. MOBILES
INSERT INTO products (category, name, price, description, image, rating) VALUES
('Mobiles', 'Android 5G Phone', 15999.00, 'High speed 5G.', 'https://loremflickr.com/400/400/smartphone,android?lock=11', 4.6),
('Mobiles', 'Flagship Smartphone', 45999.00, 'Top specs.', 'https://loremflickr.com/400/400/smartphone,tech?lock=12', 4.9),
('Mobiles', 'Camera Focus Mobile', 22999.00, 'Best camera.', 'https://loremflickr.com/400/400/camera,phone?lock=13', 4.7),
('Mobiles', 'Gaming Smartphone', 35999.00, 'For gaming.', 'https://loremflickr.com/400/400/gaming,phone?lock=14', 4.8),
('Mobiles', 'Budget Android Phone', 7999.00, 'Affordable.', 'https://loremflickr.com/400/400/mobile,phone?lock=15', 4.2),
('Mobiles', 'Premium Glass Phone', 29999.00, 'Glass design.', 'https://loremflickr.com/400/400/smartphone,glass?lock=16', 4.5),
('Mobiles', 'Dual Camera Phone', 12999.00, 'Dual cameras.', 'https://loremflickr.com/400/400/phone,camera?lock=17', 4.3),
('Mobiles', 'Battery Long-life Phone', 10999.00, '6000mAh battery.', 'https://loremflickr.com/400/400/battery,phone?lock=18', 4.4),
('Mobiles', 'Compact Smartphone', 18999.00, 'Small size.', 'https://loremflickr.com/400/400/small,phone?lock=19', 4.5),
('Mobiles', 'AI Feature Phone', 25999.00, 'AI powered.', 'https://loremflickr.com/400/400/ai,technology?lock=20', 4.6);

-- 3. TOYS
INSERT INTO products (category, name, price, description, image, rating) VALUES
('Toys', 'Remote Control Car', 899.00, 'RC car.', 'https://loremflickr.com/400/400/toy,car?lock=21', 4.7),
('Toys', 'Teddy Bear', 599.00, 'Soft teddy.', 'https://loremflickr.com/400/400/teddy,bear?lock=22', 4.9),
('Toys', 'Doll Set', 1299.00, 'Doll + accessories.', 'https://loremflickr.com/400/400/doll,toy?lock=23', 4.5),
('Toys', 'Building Blocks', 499.00, 'Construction set.', 'https://loremflickr.com/400/400/lego,blocks?lock=24', 4.6),
('Toys', 'Puzzle Toy', 299.00, 'Brain teaser.', 'https://loremflickr.com/400/400/puzzle,game?lock=25', 4.3),
('Toys', 'Robot Toy', 999.00, 'Walking robot.', 'https://loremflickr.com/400/400/robot,toy?lock=26', 4.4),
('Toys', 'Action Figure', 399.00, 'Hero figure.', 'https://loremflickr.com/400/400/action,figure?lock=27', 4.5),
('Toys', 'Kids Kitchen Set', 1599.00, 'Kitchen play.', 'https://loremflickr.com/400/400/toy,kitchen?lock=28', 4.8),
('Toys', 'Learning Toy', 799.00, 'Educational.', 'https://loremflickr.com/400/400/educational,toy?lock=29', 4.7),
('Toys', 'Musical Toy', 450.00, 'Plays music.', 'https://loremflickr.com/400/400/toy,music?lock=30', 4.2);

-- 4. GROCERY
INSERT INTO products (category, name, price, description, image, rating) VALUES
('Grocery', 'Rice Bag', 499.00, '5kg Rice.', 'https://loremflickr.com/400/400/rice,grain?lock=31', 4.8),
('Grocery', 'Cooking Oil', 180.00, '1L Oil.', 'https://loremflickr.com/400/400/oil,bottle?lock=32', 4.5),
('Grocery', 'Snack Packets', 50.00, 'Chips.', 'https://loremflickr.com/400/400/chips,snack?lock=33', 4.3),
('Grocery', 'Fresh Vegetables', 150.00, 'Vegetables.', 'https://loremflickr.com/400/400/vegetables,fresh?lock=34', 4.7),
('Grocery', 'Fresh Fruits', 250.00, 'Fruits.', 'https://loremflickr.com/400/400/fruit,basket?lock=35', 4.9),
('Grocery', 'Milk Pack', 60.00, '1L Milk.', 'https://loremflickr.com/400/400/milk,bottle?lock=36', 4.6),
('Grocery', 'Spice Masala', 80.00, 'Spices.', 'https://loremflickr.com/400/400/spices,indian?lock=37', 4.5),
('Grocery', 'Instant Noodles', 20.00, 'Noodles.', 'https://loremflickr.com/400/400/noodles,food?lock=38', 4.4),
('Grocery', 'Breakfast Cereals', 350.00, 'Cereals.', 'https://loremflickr.com/400/400/cereal,breakfast?lock=39', 4.6),
('Grocery', 'Household Items', 199.00, 'Cleaning.', 'https://loremflickr.com/400/400/cleaning,products?lock=40', 4.2);

-- 5. SKINCARE
INSERT INTO products (category, name, price, description, image, rating) VALUES
('Skincare', 'Face Wash', 150.00, 'Face wash.', 'https://loremflickr.com/400/400/face,wash?lock=41', 4.5),
('Skincare', 'Moisturizer', 299.00, 'Cream.', 'https://loremflickr.com/400/400/cream,lotion?lock=42', 4.6),
('Skincare', 'Sunscreen', 450.00, 'SPF 50.', 'https://loremflickr.com/400/400/sunscreen,bottle?lock=43', 4.8),
('Skincare', 'Vitamin C Serum', 599.00, 'Serum.', 'https://loremflickr.com/400/400/serum,bottle?lock=44', 4.9),
('Skincare', 'Night Cream', 699.00, 'Night repair.', 'https://loremflickr.com/400/400/cream,night?lock=45', 4.7),
('Skincare', 'Face Mask', 99.00, 'Mask.', 'https://loremflickr.com/400/400/facemask,beauty?lock=46', 4.4),
('Skincare', 'Body Lotion', 350.00, 'Lotion.', 'https://loremflickr.com/400/400/lotion,body?lock=47', 4.5),
('Skincare', 'Toner', 250.00, 'Toner.', 'https://loremflickr.com/400/400/toner,skin?lock=48', 4.3),
('Skincare', 'Cleanser', 199.00, 'Cleanser.', 'https://loremflickr.com/400/400/cleanser,face?lock=49', 4.4),
('Skincare', 'Herbal Cream', 120.00, 'Herbal.', 'https://loremflickr.com/400/400/herbal,cream?lock=50', 4.2);
