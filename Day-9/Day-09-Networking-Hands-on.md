# Day 09 - Networking Hands-on

Run the commands appropriate for the operating system and network environment.

## Windows

```
ipconfig
ipconfig /all
ping google.com
nslookup google.com
tracert google.com
netstat -ano
curl.exe -I https://google.com
```

## Linux

```
ip addr
ip route
ping -c 4 google.com
nslookup google.com
traceroute google.com
ss -tulpn
curl -I https://google.com
```

## Checks Performed

* Confirmed the assigned IP address and default gateway.
* Verified DNS resolution for a public hostname.
* Traced the route to a public endpoint.
* Checked listening network ports.
* Confirmed an HTTP response from a web endpoint.

## Support Notes

A failed `ping` does not always mean the application is unavailable because ICMP may be blocked. Validate the service with DNS and HTTP checks before escalating.
