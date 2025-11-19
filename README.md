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

