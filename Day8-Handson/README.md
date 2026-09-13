# MediBook Managed Services Demo

A responsive PHP + SQLite demonstration application for the MediBook L1 Managed Services capstone. It includes patient registration/login, doctor listing, appointment booking, consultation lobby, reports metadata, chatbot, service-status dashboard and L1 support-ticket creation.

## Safety and scope
- Training/demo use only. It is not a production healthcare system.
- Do not enter real patient, payment, credential, consultation or medical-report data.
- Payments, video consultation, Twilio and AI are simulated.
- Before any real use, add approved identity, encryption, audit, consent, retention, backup, monitoring, accessibility and privacy controls.

## Local requirements
- PHP 8+
- PDO SQLite extension
- Write access to the `data` directory

## First run
1. Place the project in your web root.
2. Open `/setup.php` once in a browser.
3. Sign in with `patient@medibook.demo` and `Demo@123`.
4. Delete or restrict `setup.php` after initialization in any shared environment.

## Ubuntu EC2 deployment with Apache
Security group: allow SSH 22 only from your IP, HTTP 80 publicly, and HTTPS 443 when TLS is configured.

```bash
sudo apt update
sudo apt install -y apache2 php libapache2-mod-php php-sqlite3 unzip git
sudo systemctl enable --now apache2
cd /var/www
sudo git clone YOUR_GITHUB_REPOSITORY_URL medibook
sudo chown -R www-data:www-data /var/www/medibook
sudo find /var/www/medibook -type d -exec chmod 755 {} \;
sudo find /var/www/medibook -type f -exec chmod 644 {} \;
sudo mkdir -p /var/www/medibook/data
sudo chown -R www-data:www-data /var/www/medibook/data
```

Create the Apache site:

```bash
sudo tee /etc/apache2/sites-available/medibook.conf > /dev/null <<'EOF'
<VirtualHost *:80>
    ServerName YOUR_DOMAIN_OR_PUBLIC_IP
    DocumentRoot /var/www/medibook
    <Directory /var/www/medibook>
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    ErrorLog ${APACHE_LOG_DIR}/medibook-error.log
    CustomLog ${APACHE_LOG_DIR}/medibook-access.log combined
</VirtualHost>
EOF
sudo a2dissite 000-default.conf
sudo a2ensite medibook.conf
sudo apachectl configtest
sudo systemctl reload apache2
```

Open `http://YOUR_PUBLIC_IP/setup.php`, initialize the demo, then sign in. After setup:

```bash
sudo mv /var/www/medibook/setup.php /var/www/medibook/setup.php.disabled
```

## GitHub push
```bash
cd medibook-managed-services
git init
git add .
git commit -m "Initial MediBook managed services demo"
git branch -M main
git remote add origin YOUR_GITHUB_REPOSITORY_URL
git push -u origin main
```

## Capstone mapping
- Architecture/service journey: `docs/ARCHITECTURE.md`
- L1 operational guide: `docs/L1-RUNBOOK.md`
- Ticket scenarios A-E: `docs/TICKET-BACKLOG.md`
- Website operational status: `status.php`
- SaaS account flows: `login.php`, `register.php`
- Evidence-friendly ticket logging: `support.php`
