# Scripts That I use

**Note**: I moved old files to [Archive](Archive/README.md) Directory, these are scripts that I no
longer use.

## mg
A script to handle gvim server to only load one server per project, and it would
switch to the already loaded one and open the file.

### Requirements
 * gvim (or macvim) compiled with `+clientserver` `:h clientserver`
 * [wmctrl](http://sweb.cz/tripie/utils/wmctrl) for Linux (Optional).

## nvt
A script to manage nvim server instances, ensuring only one nvim server per project or tmux session.

### Description
nvt creates and manages nvim server instances with automatic switching:
- In tmux: One nvim server per tmux session, automatically switches to the pane containing the server
- Outside tmux: One nvim server per git project root directory

When you run `nvt` with files, it will:
- If a server exists: Open files in the existing server and switch to that pane/window
- If no server exists: Start a new nvim server

### Requirements
 * [Neovim](https://neovim.io/) with `--remote` support (built-in)
 * [tmux](https://github.com/tmux/tmux) (optional, for session management)
 * `lsof` (for finding nvim server processes)
 * `git` (optional, for project detection)

### Usage
```zsh
nvt [files...]
```

### Examples
```zsh
# Start nvim server (or connect to existing one)
nvt

# Open files in existing server or start new one
nvt file1.txt file2.txt

# In tmux: automatically switches to the pane with nvim
nvt myfile.js
```


## eix-fzf
A script to use eix with fzf for interactive package searching.

### Requirements
 * [eix](https://wiki.gentoo.org/wiki/Eix)
 * [fzf](https://github.com/junegunn/fzf)
 * [Equery](https://wiki.gentoo.org/wiki/Equery)

### Usage
```
eix-fzf [options] [query]
```

### Options
 * `-f`, `--refresh`: Refresh cache
 * `-F`, `--refresh-silent`: Refresh cache silently (for hooks/cron)
 * `-i`, `--installed`: Query only installed packages (Default)
 * `-a`, `--all`: Query all packages
 * `-p`, `--preview`: Show preview window with package details
 * `-n`, `--no-preview`: Don't show preview window (Default)
 * `-E`, `--no-eix`: Don't run eix on selection, just print package name
 * `-h`, `--help`: Show help message

### Arguments
 * `query`: Optional prefilled search query for fzf

### Completions
Bash and Zsh completion files are included:
 * Bash: `eix-fzf-completion.bash`
 * Zsh: `_eix-fzf`

## uncrypt
A script to securely create, view, and edit encrypted GPG tar archives. It works
by creating a temporary, encrypted, in-memory filesystem (a "vault") where the
contents of the GPG tar archive are extracted. After you're done, the script
re-encrypts the contents and cleans up the temporary vault, leaving no trace on
the disk.

It uses `hdiutil` on macOS to create a sparse bundle and `gocryptfs` on
Linux/BSD to create an encrypted directory, providing a seamless and
cross-platform experience.

### Requirements
 * `gpg`
 * `gocryptfs` (for Linux/BSD systems)

### Usage
```bash
uncrypt [-r recipient]... <gpg-file>
```
 * `<gpg-file>`: The path to the GPG-encrypted tar archive.
 * `-r recipient`: Optional. Specify a GPG recipient for encryption. This flag can be used multiple times.

### Workflow
The script operates in one of two modes:
1.  **Recipient Mode**: If you provide one or more `-r` flags, the archive will
    be encrypted for those recipients and signed.
2.  **Passphrase Mode**: If no recipients are provided, the script will use
    symmetric encryption (`gpg -c`). You will be prompted for a passphrase to
    encrypt and decrypt the archive.

Once the vault is mounted, you can access the files inside the temporary
directory shown in the script's output. When you are finished, you can choose
one of the following options:
 * `(s)ave & encrypt`: Re-packages the contents of the vault, encrypts them, and
   saves them back to the original GPG file.
 * `(d)estroy & exit`: Discards all changes and tears down the temporary vault.


## wait_for_ip
A utility script to wait for a machine to become reachable via ping or a specific service port (like SSH).

### Description
`wait_for_ip` is designed for scenarios where you've just started a machine (e.g., a VM or a cloud instance) and want to connect as soon as it's ready. It can wait for a simple ICMP ping response or for a specific TCP port to open.

### Requirements
 * `ping`
 * `nc` (netcat)

### Usage
```bash
wait_for_ip [-s] <target_ip> [target_port]
```

### Options
 * `-s`: Silent mode. Suppresses all status messages, only exiting when the target is reached.

### Examples
```bash
# Wait for a machine to respond to ping
wait_for_ip 192.168.1.50

# Wait for SSH (port 22) to become available
wait_for_ip 192.168.1.50 22

# Silent mode (useful for scripts)
wait_for_ip -s 192.168.1.50 22 && ssh user@192.168.1.50
```
