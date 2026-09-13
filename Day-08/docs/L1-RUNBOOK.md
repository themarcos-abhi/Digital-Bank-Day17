# L1 Operations Runbook

## Standard flow
Listen → Clarify → Investigate → Resolve or Escalate.

Ask 5W1H and “What changed?” Capture user impact, scope, timestamps/timezone, exact errors, reproduction steps, screenshots, correlation IDs, recent releases and dependency status.

## Login issue
1. Verify the approved identity attributes without asking for a password or OTP.
2. Confirm exact error, URL, time, browser and scope.
3. Check service status and whether the account exists/is active.
4. Reproduce safely with a demo/test account.
5. Guide approved reset or escalate with sanitized evidence.

## Feature issue
1. Identify the affected journey and users.
2. Check status and recent change records.
3. Reproduce using non-production data.
4. Check browser console, Apache/PHP logs and database availability.
5. Resolve known error or escalate with evidence.

## Useful EC2 checks
```bash
sudo systemctl status apache2
sudo apachectl configtest
sudo tail -n 100 /var/log/apache2/medibook-error.log
sudo journalctl -u apache2 --since "30 minutes ago"
df -h
free -m
top
php -m | grep -i sqlite
```
