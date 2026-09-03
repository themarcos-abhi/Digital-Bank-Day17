# Sentinel Gear Full-Stack Demo

A safe defence-themed e-commerce training project for **non-weapon** protective, outdoor, first-aid and utility gear. It intentionally excludes firearms, ammunition, explosives and weapon sales.

## Stack
- Frontend: HTML + CSS rendered by PHP
- Backend: PHP 8+
- Database: SQLite via PDO
- Server: Apache on Ubuntu/AWS EC2
- Features: signup, login/logout, sessions, four navigation tabs, product catalog, cart, checkout, order history, stock updates, prepared SQL, password hashing and CSRF tokens

## Repository structure
```
assets/style.css
includes/auth.php
includes/db.php
includes/header.php
includes/footer.php
data/
config.php
install.php
index.php
shop.php
cart.php
checkout.php
orders.php
account.php
login.php
signup.php
logout.php
deploy.sh
```

## Deploy after cloning on Ubuntu EC2
Your EC2 security group must allow inbound HTTP on port 80. Then run:
```bash
cd /home/ubuntu
git clone YOUR_GITHUB_REPOSITORY_URL secure-defence-gear-store
cd secure-defence-gear-store
chmod +x deploy.sh
./deploy.sh
```
Open:
```
http://YOUR_EC2_PUBLIC_IP/secure-gear/
```

The script installs Apache, PHP and SQLite support, copies the project into Apache's document root, creates the SQLite database, seeds the catalog, sets database-directory permissions and restarts Apache.

## GitHub push from your computer
```bash
git init
git add .
git commit -m "Initial full-stack gear store"
git branch -M main
git remote add origin YOUR_GITHUB_REPOSITORY_URL
git push -u origin main
```

## Validation commands on EC2
```bash
sudo systemctl status apache2 --no-pager
php -m | grep -i sqlite
ls -la /var/www/html/secure-gear
sudo lsof -i :80
```

## Security and production notes
- This is a learning/demo application. Add HTTPS, backups, logging, rate limiting and secure secret management before production use.
- Keep `data/store.sqlite` out of Git. The supplied `.gitignore` handles this.
- The checkout records an order but does not process payments.
- Do not adapt this project to sell regulated weapons or ammunition. Any real commerce site must comply with applicable laws, licensing, age controls, payment-provider rules and platform policies.
