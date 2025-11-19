# bash completion for eix-fzf

_eix_fzf_completions() {
  local cur prev opts
  COMPREPLY=()
  cur="${COMP_WORDS[COMP_CWORD]}"
  prev="${COMP_WORDS[COMP_CWORD-1]}"
  
  # All available options
  opts="-f --refresh -F --refresh-silent -i --installed -a --all -p --preview -n --no-preview -E --no-eix -h --help"
  
  # If current word starts with -, complete with options
  if [[ ${cur} == -* ]]; then
    COMPREPLY=( $(compgen -W "${opts}" -- "${cur}") )
    return 0
  fi
  
  # Otherwise, allow any input (the query string)
  return 0
}

complete -F _eix_fzf_completions eix-fzf
