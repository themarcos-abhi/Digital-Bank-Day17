<?php
require __DIR__.'/includes/db.php';
$pdo=db();
$pdo->exec("CREATE TABLE IF NOT EXISTS users(id INTEGER PRIMARY KEY AUTOINCREMENT,name TEXT NOT NULL,email TEXT UNIQUE NOT NULL,password_hash TEXT NOT NULL,created_at TEXT DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE IF NOT EXISTS products(id INTEGER PRIMARY KEY AUTOINCREMENT,name TEXT NOT NULL,category TEXT NOT NULL,description TEXT NOT NULL,price REAL NOT NULL,stock INTEGER NOT NULL DEFAULT 0);
CREATE TABLE IF NOT EXISTS orders(id INTEGER PRIMARY KEY AUTOINCREMENT,user_id INTEGER NOT NULL,total REAL NOT NULL,status TEXT NOT NULL DEFAULT 'Placed',shipping_address TEXT NOT NULL,created_at TEXT DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(user_id) REFERENCES users(id));
CREATE TABLE IF NOT EXISTS order_items(id INTEGER PRIMARY KEY AUTOINCREMENT,order_id INTEGER NOT NULL,product_id INTEGER NOT NULL,quantity INTEGER NOT NULL,price REAL NOT NULL,FOREIGN KEY(order_id) REFERENCES orders(id),FOREIGN KEY(product_id) REFERENCES products(id));");
$count=(int)$pdo->query('SELECT COUNT(*) FROM products')->fetchColumn();
if(!$count){$items=[
['Ballistic-Style Training Helmet','Training','Non-ballistic helmet for drills, display and outdoor training.',2499,20],
['Industrial Safety Vest','Protective Gear','High-visibility vest for site and emergency response use.',899,35],
['Tactical Utility Backpack','Bags','Durable multi-compartment outdoor utility backpack.',3199,18],
['Rechargeable LED Flashlight','Lighting','Water-resistant emergency flashlight with rechargeable battery.',1299,40],
['Trauma First-Aid Kit','Medical','General emergency first-aid supplies for trained responders.',1899,25],
['Protective Safety Goggles','Protective Gear','Impact-resistant eye protection for workshop and field use.',649,50],
['All-Weather Combat-Style Boots','Footwear','Rugged outdoor boots for hiking and training.',3999,15],
['Two-Way Radio Pouch','Accessories','Universal utility pouch for compatible handheld radios.',499,30]
];$s=$pdo->prepare('INSERT INTO products(name,category,description,price,stock) VALUES(?,?,?,?,?)');foreach($items as $i)$s->execute($i);} echo 'Installation complete. <a href="index.php">Open website</a>';