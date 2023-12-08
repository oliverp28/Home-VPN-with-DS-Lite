# Home VPN with DS-Lite

In this project, I describe the setup and operation of a VPN connection to a home network via a DS-Lite connection.

## Project Goals

- Start a powerful PC using a Wake-On-LAN signal
- Establish a remote connection to the PC
- Access high computational power from anywhere in the world

## Setup

- Vodafone Standard Router with DS-Lite contract
- Raspberry Pi
- PC
- Laptop
- All connected via LAN cable
- Wireguard VPN
  - Efficient
  - User-friendly
  - Native support from MacBook to iPhone and iPad
  - High security against Wireshark, etc. (strong encryption)

## DS-Lite Challenge

- Growing devices reduce available IPv4 addresses (max 2^32)
- IPv6 solves this with 2^128 addresses
- ISPs now allocate IPv6 addresses to customers
- IPv6 must work over VPN services for remote router access
  - Wireguard doesn't natively support IPv6
- IPv6 is not directly compatible with IPv4

### Solution

- Servers on the internet still have IPv4, facilitating communication
  - Protocol translation occurs on an ISP server
- Use a personal server with a public IPv4 address for translation
- Connect to the server from a laptop to access the home network
  - Encrypted and secure
  - High speed and low latency
  - Location-independent

![Connection Setup](Verbindung.png)

## Configuration

1. Update everything (`sudo apt update && apt upgrade -y`)
2. Install Wireguard (`sudo apt install wireguard`)
3. Enable IP forwarding (uncomment `net.ipv4.ip_forward=1` in `/etc/sysctl.conf`)
4. Save the configuration (`sysctl -p`)
5. Generate public and private keys (`cd /etc/wireguard`, `umask 077; wg genkey | tee privatekey | wg pubkey > publickey`)
6. Create `wg0.conf` configuration file (`sudo nano /etc/wireguard/wg0.conf`)
7. Add Wireguard configuration to the file
8. Start the connection (`wg-quick up wg0`)
9. Check the status (`wg show`)
10. Automatically establish the Wireguard connection on startup (`systemctl enable wg-quick@wg0`)

## Workflow

1. Open the start button on the website
2. Send Wake-On-LAN signal
3. PC powers up
4. Validate startup with a ping test
5. Disconnect VPN home connection
6. Connect via remote desktop
7. Optionally, initiate a Windows reboot after startup

## Remote Desktop Apps

### Linux: RustDesk

- Efficient data transfer
- Encrypted connection
- Minimal latency

### Windows: Parsec

- Optimized for Windows
- Optimal graphics transfer
- Minimal latency (suitable for programs requiring low response times)
- Suitable for graphics-intensive games

## Additional Considerations

- Adjust all IP and MAC addresses accordingly (`ifconfig` for your IP, `arp -a` for all IP addresses in the network)
- Edit `wg0.conf` with `wg-quick down wg0` before and `wg-quick up wg0` after for changes to take effect
- Test the connection with `ping 192.168.XX.XX`
- For specific hardware, like Gigabyte motherboards and network cards with WakeOnLan, create a Bash script to activate Wake-On-LAN on startup (script not included in this repository)
- For the website:
  - Install Apache2 webserver
  - Move the website to the `/etc/www/html/` folder (Tips are in the Support-Fraud repository)
- Helpful video for problems: [DS-Lite Port Forwarding, Reverse Proxy, and VPN Server](https://youtu.be/kIK0I9dwXh8) (Channel: Apfelcast)
