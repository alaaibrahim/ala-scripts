#!/bin/bash
dir="$(git rev-parse --show-toplevel 2> /dev/null || pwd)"
servername="$(basename "$dir" | tr '[:lower:]' '[:upper:]')"

VIMAPP="gvim"

function switchToOSX {
    name="$1"
    {
      echo 'tell application "MacVim"'
      echo '  activate'
      echo '  set x to count of windows'
      echo '  repeat x times'
      echo '    set window_name to name of front window'
      echo "    if window_name ends with \"- $name\" then"
      echo '      return'
      echo '    end if'
      echo '    tell application "System Events" to keystroke "`" using command down'
      echo '  end repeat'
      echo 'end tell'
    } | osascript
}

function switchToLinux {
  local servername="$1"
  if type "wmctrl" > /dev/null 2>&1; then
    wmctrl -a "- $servername"
  fi
}

switchTo=switchToLinux

if [[ "$OSTYPE" == "darwin"* ]]; then
  switchTo=switchToOSX
  VIMAPP=mvim
fi

if $VIMAPP --serverlist | grep -o "$servername" > /dev/null 2>&1
then
    if [ $# -gt 0 ]; then
        # shellcheck disable=SC2068
        $VIMAPP --servername "$servername" --remote-silent $@
    fi
    $switchTo "$servername"
else
    # shellcheck disable=SC2068
    $VIMAPP --servername "$servername" $@
fi
