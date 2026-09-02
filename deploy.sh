#!/usr/bin/env bash
set -euo pipefail
APP_NAME="secure-gear"
SRC_DIR="$(cd "$(dirname "$0")" && pwd)"
DEST="/var/www/html/$APP_NAME"
sudo apt-get update -y
sudo apt-get install -y apache2 php libapache2-mod-php php-sqlite3 git
sudo mkdir -p "$DEST"
sudo rsync -a --delete --exclude '.git' --exclude 'data/store.sqlite*' "$SRC_DIR/" "$DEST/"
sudo mkdir -p "$DEST/data"
sudo chown -R www-data:www-data "$DEST/data"
sudo chmod 775 "$DEST/data"
sudo -u www-data php "$DEST/install.php" >/dev/null
sudo systemctl enable apache2
sudo systemctl restart apache2
echo "Deployed to: http://YOUR_EC2_PUBLIC_IP/$APP_NAME/"
