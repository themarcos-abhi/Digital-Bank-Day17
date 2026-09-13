# AWS Cloud and EC2 Instances: Complete Guide

## 1. Introduction to AWS Cloud

Amazon Web Services (AWS) is a cloud computing platform that provides on-demand computing power, storage, networking, and other IT resources over the internet, on a pay-as-you-go basis.

**Key benefits of AWS:**

* No upfront hardware investment
* Scalability (scale resources up or down as needed)
* Global availability through data centers called Regions and Availability Zones
* Pay-as-you-go pricing model
* Wide range of services (compute, storage, databases, networking, security, etc.)

**Core AWS concepts:**

* **Region:** A geographic area containing multiple, isolated data centers (e.g., us-east-1, ap-south-1).
* **Availability Zone (AZ):** An isolated data center within a Region, used for fault tolerance.
* **IAM (Identity and Access Management):** Service for managing users, permissions, and access control.
* **VPC (Virtual Private Cloud):** An isolated virtual network within AWS where resources are launched.

## 2. What is EC2

**EC2 (Elastic Compute Cloud)** is AWS's core service for renting virtual servers, called **instances**, in the cloud. It allows you to run applications without owning physical hardware.

**Key EC2 concepts:**

* **AMI (Amazon Machine Image):** A template containing the OS and software used to launch an instance.
* **Instance Type:** Defines the hardware configuration (CPU, memory, network) — e.g., `t2.micro`, `t3.medium`.
* **Key Pair:** A public/private key combination used for secure SSH access to an instance.
* **Security Group:** A virtual firewall controlling inbound and outbound traffic to an instance.
* **Elastic IP:** A static public IP address that can be attached to an instance.
* **EBS (Elastic Block Store):** Persistent block storage volumes attached to instances.

## 3. Creating an EC2 Instance

### Step-by-step process (via AWS Management Console)

1. **Sign in** to the AWS Management Console and navigate to the **EC2 Dashboard**.
2. Click **Launch Instance**.
3. **Name your instance** (e.g., `my-first-server`).
4. **Choose an AMI** — select an operating system image, such as:
   * Amazon Linux
   * Ubuntu Server
   * Windows Server
5. **Choose an Instance Type** — for testing and learning, `t2.micro` or `t3.micro` (Free Tier eligible) is common.
6. **Create or select a Key Pair:**
   * Click **Create new key pair**.
   * Choose a key pair type: **RSA** (works with both OpenSSH and PuTTY).
   * Choose the private key file format:
     * **.pem** — for OpenSSH (Linux/macOS terminal, or WSL)
     * **.ppk** — for PuTTY (Windows)
   * Download and **securely store** the key file — it cannot be downloaded again.
7. **Configure Network Settings:**
   * Select or create a VPC and subnet.
   * Enable **Auto-assign Public IP** so the instance is reachable from the internet.
   * Configure the **Security Group** to allow required inbound traffic, for example:
     * SSH (port 22) — for Linux instances
     * RDP (port 3389) — for Windows instances
     * HTTP (port 80) / HTTPS (port 443) — if hosting a website
8. **Configure Storage** — set the size and type of the root EBS volume (default is usually sufficient for testing).
9. Review the configuration and click **Launch Instance**.
10. Once the instance state shows **Running** and status checks pass, note down its **Public IPv4 address** or **Public DNS name**.

## 4. Connecting to an EC2 Instance

There are two common methods depending on your operating system: using a terminal with a `.pem` file, or using PuTTY with a `.ppk` file on Windows.

### Method A: Connecting via Terminal (Linux/macOS or Windows with OpenSSH)

1. Move the downloaded `.pem` file to a known location.
2. Restrict its permissions (required on Linux/macOS):
   ```
   chmod 400 my-key.pem
   ```
3. Connect via SSH:
   ```
   ssh -i "my-key.pem" ec2-user@<public-ip-or-dns>
   ```
   * Use the correct default username for the OS:
     * `ec2-user` — Amazon Linux
     * `ubuntu` — Ubuntu
     * `admin` — Debian
     * `centos` — CentOS

### Method B: Connecting via PuTTY (Windows)

PuTTY requires the private key in `.ppk` format. If you downloaded a `.pem` file, you must first convert it using **PuTTYgen**.

#### Step 1: Convert .pem to .ppk using PuTTYgen

1. Download and open **PuTTYgen** (comes with the PuTTY installer).
2. Click **Load**, then change the file filter to **All Files (*.*)** so `.pem` files are visible.
3. Select your `.pem` file and open it.
4. Click **Save private key** (you can ignore the passphrase warning if not using one).
5. Save the file with a `.ppk` extension (e.g., `my-key.ppk`).

#### Step 2: Connect using PuTTY

1. Open **PuTTY**.
2. In the **Host Name (or IP address)** field, enter:
   ```
   ec2-user@<public-ip-or-dns>
   ```
   (replace `ec2-user` with the correct username for your instance's OS)
3. Ensure **Port** is set to `22` and **Connection type** is **SSH**.
4. In the left-hand category tree, navigate to:
   ```
   Connection > SSH > Auth > Credentials
   ```
5. Under **Private key file for authentication**, click **Browse** and select your `.ppk` file.
6. (Optional) Go back to **Session**, enter a name under **Saved Sessions**, and click **Save** so you don't have to reconfigure this each time.
7. Click **Open** to start the connection.
8. If prompted with a security alert about the host's key, click **Accept** (only for the first connection).
9. You should now be connected to your EC2 instance's command line.

## 5. Post-Connection Basics

Once connected (via terminal or PuTTY), you can manage the instance like any Linux server:

```
sudo yum update -y        # Amazon Linux/CentOS - update packages
sudo apt update && sudo apt upgrade -y   # Ubuntu/Debian - update packages
sudo systemctl status <service>          # Check status of a service
```

## 6. Managing the Instance

* **Stop:** Shuts down the instance (billing for compute stops; storage billing continues). Public IP is released unless using an Elastic IP.
* **Start:** Restarts a stopped instance.
* **Reboot:** Restarts the OS without stopping the instance.
* **Terminate:** Permanently deletes the instance and, by default, its root EBS volume.

## 7. Common Troubleshooting

| Issue | Likely Cause | Fix |
|---|---|---|
| Connection timed out | Security group does not allow port 22/3389 | Edit inbound rules to allow SSH/RDP from your IP |
| Permission denied (publickey) | Wrong username or wrong key file | Verify correct default username and matching key pair |
| Unprotected private key file (Linux/macOS) | `.pem` file permissions too open | Run `chmod 400 my-key.pem` |
| PuTTY "server refused our key" | Wrong `.ppk` file or key mismatch | Ensure the `.ppk` was converted from the correct `.pem` used at launch |
| Instance unreachable after stop/start | Public IP changed | Use the new IP, or attach an Elastic IP for a static address |

## 8. Summary

* **AWS** provides on-demand cloud infrastructure, with **EC2** as its core virtual server service.
* Creating an EC2 instance involves selecting an AMI, instance type, key pair, and security group, then launching it.
* Connection to Linux instances is done via **SSH**, using a `.pem` key from a terminal or a `.ppk` key from **PuTTY** (converted using **PuTTYgen**) on Windows.
* Proper security group configuration and key management are essential for successful and secure connections.
