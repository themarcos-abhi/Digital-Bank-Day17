# Linux: Complete Guide with Commands and Filesystem Hierarchy

## 1. Introduction to Linux

Linux is an open-source, Unix-like operating system kernel, widely used for servers, cloud infrastructure, embedded systems, and increasingly desktops. Common distributions ("distros") include Ubuntu, CentOS, Red Hat Enterprise Linux (RHEL), Debian, Fedora, and Amazon Linux.

**Key characteristics:**

* Multi-user and multi-tasking
* Open source and highly customizable
* Case-sensitive file system
* Everything is treated as a file (devices, processes, sockets)
* Strong permission and security model

## 2. The Linux Filesystem Hierarchy (In Depth)

Linux organizes all files and directories in a single tree structure starting from the **root directory (`/`)**. Every other directory branches from it — there are no separate drive letters like in Windows.

```
/
├── bin
├── sbin
├── etc
├── home
├── root
├── opt
├── usr
│   ├── bin
│   ├── sbin
│   ├── lib
│   └── local
├── var
├── tmp
├── lib
├── dev
├── proc
├── mnt
├── media
├── boot
└── srv
```

### `/` — Root Directory
The top-level directory of the entire filesystem. Every file and directory on the system exists under `/`. It is **not** the same as the `root` user's home directory.

### `/bin` — Essential User Binaries
Contains essential command binaries needed for basic system functionality, available to all users, even in single-user/recovery mode.
* Examples: `ls`, `cp`, `mv`, `cat`, `echo`, `bash`
* On many modern distros, `/bin` is now a symbolic link to `/usr/bin`.

### `/sbin` — System Binaries
Contains essential binaries typically used for **system administration**, usually requiring root/superuser privileges.
* Examples: `reboot`, `shutdown`, `fdisk`, `iptables`, `ifconfig`
* Like `/bin`, `/sbin` is often symlinked to `/usr/sbin` on modern systems.

### `/etc` — Configuration Files
Contains system-wide configuration files (text-based) for the OS and installed applications.
* Examples: `/etc/passwd` (user accounts), `/etc/fstab` (filesystem mounts), `/etc/hosts` (hostname resolution), `/etc/ssh/sshd_config` (SSH configuration)
* No executable binaries are stored here — only configuration data.

### `/home` — User Home Directories
Contains personal directories for each non-root user on the system.
* Example: `/home/john`, `/home/alice`
* Each user typically has read/write access only to their own home directory by default.

### `/root` — Root User's Home Directory
The home directory for the **root (superuser)** account — separate from `/home` for security and availability reasons (so root has a home directory even if `/home` is on a separate, unmounted partition).

### `/opt` — Optional/Add-on Software
Used for installing **third-party or optional software packages** that are not part of the default OS installation, often self-contained with their own directory structure.
* Example: `/opt/google/chrome`, `/opt/myapp`

### `/usr` — User System Resources
Contains the majority of user-installed applications, libraries, and documentation. Despite the name, it stands for "Unix System Resources," not "user."
* `/usr/bin` — Non-essential user command binaries
* `/usr/sbin` — Non-essential system administration binaries
* `/usr/lib` — Libraries used by binaries in `/usr/bin` and `/usr/sbin`
* `/usr/local` — Software compiled/installed manually by the system administrator, separate from package-manager-installed software

### `/var` — Variable Data
Contains files whose content is expected to grow or change frequently during normal operation.
* `/var/log` — System and application log files
* `/var/spool` — Spool files (e.g., print queues, mail queues)
* `/var/www` — Common location for web server content (on many distros)

### `/tmp` — Temporary Files
Used for temporary files created by the system or applications. Contents are often cleared automatically on reboot.

### `/lib` — Essential Shared Libraries
Contains shared library files needed by binaries in `/bin` and `/sbin`. Often symlinked to `/usr/lib` on modern systems.

### `/dev` — Device Files
Contains special files representing hardware devices, treated as files for input/output.
* Examples: `/dev/sda` (first storage disk), `/dev/null` (discards written data), `/dev/tty` (terminal device)

### `/proc` — Process and Kernel Information
A virtual filesystem providing real-time information about running processes and kernel parameters. Not stored on disk — generated dynamically by the kernel.
* Example: `/proc/cpuinfo`, `/proc/meminfo`, `/proc/<PID>/status`

### `/mnt` and `/media` — Mount Points
* `/mnt` — Conventionally used for temporarily mounting filesystems manually (e.g., an external drive for admin tasks).
* `/media` — Used for automatically mounted removable media (USB drives, CDs, etc.).

### `/boot` — Boot Loader Files
Contains files required to boot the system, including the Linux kernel and bootloader configuration (e.g., GRUB).
* Examples: `vmlinuz` (kernel image), `initrd.img`, `grub/`

### `/srv` — Service Data
Contains data for services provided by the system, such as files served by a web or FTP server.

## 3. Essential Linux Commands

### File and Directory Navigation

```
pwd                     # Print current working directory
ls                      # List directory contents
ls -la                  # List all files (including hidden) with details
cd <directory>          # Change directory
cd ..                   # Move up one directory
cd ~                    # Go to home directory
tree                    # Display directory structure as a tree (if installed)
```

### File Operations

```
touch file.txt          # Create an empty file
mkdir dirname           # Create a directory
mkdir -p a/b/c          # Create nested directories
cp source dest          # Copy a file
cp -r source dest       # Copy a directory recursively
mv source dest          # Move or rename a file/directory
rm file.txt             # Remove a file
rm -r dirname           # Remove a directory recursively
rm -rf dirname          # Force remove without prompts (use with caution)
```

### Viewing and Editing Files

```
cat file.txt            # Display full file content
less file.txt           # View file content page by page
head file.txt           # Show first 10 lines
tail file.txt           # Show last 10 lines
tail -f file.txt        # Continuously monitor a file (e.g., logs)
nano file.txt           # Edit file in Nano editor
vi file.txt             # Edit file in Vi/Vim editor
```

### Permissions and Ownership

```
ls -l                   # View permissions, ownership, size, etc.
chmod 755 file.sh       # Change file permissions (numeric)
chmod u+x file.sh       # Add execute permission for the owner
chown user:group file   # Change file owner and group
```

**Permission structure example:** `-rwxr-xr--`
* First character: file type (`-` file, `d` directory, `l` symlink)
* Next 3: owner permissions (rwx)
* Next 3: group permissions (r-x)
* Last 3: others' permissions (r--)

### Searching

```
find / -name "file.txt"        # Search for a file by name from root
grep "text" file.txt           # Search for text within a file
grep -r "text" /path/          # Recursively search within a directory
which command                  # Show the path of a command's binary
locate file.txt                 # Fast file search using an indexed database
```

### Process Management

```
ps aux                  # List all running processes
top                     # Real-time view of system processes and resource usage
htop                    # Enhanced interactive process viewer (if installed)
kill <PID>              # Terminate a process by its ID
kill -9 <PID>           # Force kill a process
jobs                    # List background jobs in the current shell
```

### Disk and System Info

```
df -h                   # Show disk space usage (human-readable)
du -sh <directory>      # Show size of a directory
free -h                 # Show memory usage
uname -a                # Show system/kernel information
uptime                  # Show system uptime and load average
lsblk                   # List block devices (disks/partitions)
```

### Networking

```
ip addr                 # Show network interfaces and IP addresses
ping google.com         # Test connectivity to a host
netstat -tulpn          # Show listening ports and services (or use ss)
ss -tulpn               # Modern replacement for netstat
curl -I https://site    # Fetch HTTP headers from a URL
scp file user@host:/path  # Securely copy a file to a remote host
```

### Package Management

```
# Debian/Ubuntu
sudo apt update
sudo apt install <package>
sudo apt remove <package>

# RHEL/CentOS/Amazon Linux
sudo yum update
sudo yum install <package>
sudo yum remove <package>
```

### User and Group Management

```
whoami                  # Show current logged-in user
sudo useradd username   # Create a new user
sudo passwd username    # Set/change a user's password
sudo usermod -aG group username   # Add a user to a group
sudo userdel username   # Delete a user
groups                  # Show groups the current user belongs to
```

### Archiving and Compression

```
tar -cvf archive.tar dir/       # Create a tar archive
tar -xvf archive.tar            # Extract a tar archive
tar -czvf archive.tar.gz dir/   # Create a compressed (gzip) archive
tar -xzvf archive.tar.gz        # Extract a gzip-compressed archive
zip -r archive.zip dir/         # Create a zip archive
unzip archive.zip               # Extract a zip archive
```

## 4. Redirection and Pipes

```
command > file.txt      # Redirect output to a file (overwrite)
command >> file.txt     # Redirect output to a file (append)
command < file.txt      # Use a file as input
command1 | command2     # Pipe output of one command into another
```

**Example:**
```
ps aux | grep nginx      # Find processes related to nginx
```

## 5. File Permissions Numeric Reference

| Number | Permission | Symbol |
|---|---|---|
| 0 | No permission | --- |
| 1 | Execute | --x |
| 2 | Write | -w- |
| 3 | Write + Execute | -wx |
| 4 | Read | r-- |
| 5 | Read + Execute | r-x |
| 6 | Read + Write | rw- |
| 7 | Read + Write + Execute | rwx |

**Example:** `chmod 755 file.sh` → Owner: rwx, Group: r-x, Others: r-x

## 6. Summary

Linux organizes the entire system under a single directory tree rooted at `/`, with dedicated directories for binaries (`/bin`, `/sbin`, `/usr`), configuration (`/etc`), user data (`/home`, `/root`), optional software (`/opt`), variable data (`/var`), and more. Mastering the filesystem hierarchy alongside core commands for navigation, file management, permissions, process control, networking, and package management forms the foundation for effectively administering and working within any Linux system.
