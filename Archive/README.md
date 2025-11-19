# Archive

These are old scripts that I no longer use, but kept here for reference of
one day, I might need to look up something.


These are scripts that makes my life easier

## enable-ssh
A script that creates an ssh key if a one is not there, then scp that key to
the server.

## rm2mp3
a script that I use to convert rm files to mp3 or ogg, actually it can be used
to convert any format readable by mplayer, it uses lame for mp3, and
vorbis-tools for ogg.

## rmvb2avi
a script that I use to convert rmvb files to avi.

## checkIPV6
A script to make sure that my IPv6 Tunnel is always on.
[more](https://blog.alaa-ibrahim.com/ipv6-tunnel-is-always-on/)

## checkGW
A script to change my default gateway, when the current one fails.

## checkPTS
A script to check if someone logged into the machine and removed his entry from
`/var/run/utmp`

## IMAP/appendMessage
a script that I use to append a message to an IMAP mailbox.

## IMAP/countInbox
A Python script to count the number of messages in an IMAP mailbox.

### Requirements
 * Python 3
 * `imaplib` (standard library)

### Usage
```bash
countInbox -u username -s server [-p password] [-m mailbox] [-n]
```

### Options
 * `-u username` - Mail username (required)
 * `-s server` - Mail server to connect to (required)
 * `-p password` - Mail password (optional, will prompt securely if not provided)
 * `-m mailbox` - Mailbox to read the count of messages (default: INBOX)
 * `-n` - Disable SSL/TLS (default: SSL/TLS enabled)

### Features
 * Secure password prompting if not provided via command line
 * Uses SSL/TLS connection by default (IMAP4_SSL)
 * Optional non-SSL connection with `-n` flag
 * Proper error handling and resource cleanup
 * Decodes binary IMAP responses to UTF-8

### Example
```bash
# Prompt for password securely
countInbox -u user@example.com -s imap.example.com

# Specify password on command line (less secure)
countInbox -u user@example.com -s imap.example.com -p mypassword

# Check a specific mailbox
countInbox -u user@example.com -s imap.example.com -m "Sent Items"
```

