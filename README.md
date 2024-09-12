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
similar to mg (or at least have the same goal), to only have one nvim server per
project/tmux session, and switch using tmux to the pane containing the nvim
server


## eix-fzf
A script to use eix with fzf.

### Requirements
 * [eix](https://wiki.gentoo.org/wiki/Eix)
 * [fzf](https://github.com/junegunn/fzf)
 * [Equery](https://wiki.gentoo.org/wiki/Equery)

### Options
 * `-i`: Only query installed packages (Default).
 * `-a`: Query all packages.
 * `-f`: refresh cache.

