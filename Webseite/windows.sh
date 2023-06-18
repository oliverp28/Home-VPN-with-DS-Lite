#!/usr/bin/expect -f

# Set the SSH login credentials
set username "User_Name"
set password "example_password"
set hostname "192.168.0.3"

# Connect to the remote host via SSH
spawn ssh $username@$hostname

# Expect the authenticity prompt and enter "yes"
expect "Are you sure you want to continue connecting (yes/no)?"
send "yes\r"

# Expect the password prompt and enter the password
expect "password:"
send "$password\r"

# Expect the command prompt and enter the sudo su command
expect "$ "
send "sudo su\r"

# Expect the password prompt again and enter the password
expect "password:"
send "$password\r"

# Run the desired command
expect "# "
send "sudo grub-reboot 2\r"
expect "# "
send "reboot\r"

# Exit the shell
expect "# "
send "exit\r"
interact
