#!/usr/bin/env python

import socket
import sys

if len(sys.argv) < 3:
    print("Usage: wakeonlan.py <ADR> <MAC> (example: 192.168.1.255 00:11:22:33:44:55)")
    sys.exit(1)

mac = sys.argv[2]
data = ''.join(['FF' * 6, mac.replace(':', '') * 16])
data = bytes.fromhex(data)
sock = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
sock.setsockopt(socket.SOL_SOCKET, socket.SO_BROADCAST, 1)
sock.sendto(data, (sys.argv[1], 9))
