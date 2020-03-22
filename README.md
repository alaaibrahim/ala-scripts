# Scripts That I use

**Note**: I moved old files to [Archive](Archive/README.md) Directory, these are scripts that I no
longer use.

## mg
A script to handle gvim server to only load one server per project, and it would
switch to the already loaded one and open the file.

### Requirements
 * gvim (or macvim) compiled with `+clientserver` `:h clientserver`
 * [wmctrl](http://sweb.cz/tripie/utils/wmctrl) for Linux (Optional).

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

### Environment Variables
 * `REPO_PATHS`: Paths for all installed package repos to search through (If not
   supplied will try to get it from `/etc/portage/repos.conf`)
   
   Example:
   
   ```shell
   export REPO_PATHS="/var/db/repos/gentoo /var/lib/layman/lisp"
   ```


