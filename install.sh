#!/usr/bin/env bash

APP_VERSION="4.*"

GITIGNORE=` cat <<EOF

#docker data
/docker/data/*
/.env

#Migration
/config/Migrations/schema-dump-default.lock
EOF
`

MARKDOWN_EDITORCONFIG=` cat <<EOF

[*.md]
trim_trailing_whitespace = false
EOF
`

if [ -z "${IS_DOCKER}" ];then
  echo "Run it on a Docker container."
  exit 1;
fi

while getopts i: OPT
do
  case $OPT in
    "i" ) APP_VERSION="$OPTARG";;
     * ) echo "Usage: $CMDNAME [-p VALUE]" 1>&2
     exit 1 ;;
  esac
done

REQUIRED_CMDS="cp rsync rm"
for i in $REQUIRED_CMDS
do
  type -P $i &>/dev/null  && continue  || { echo "$i command not found."; exit 1; }
done

cp ./config/.env.docker ./config/.env && \
  composer create-project cakephp/app:${APP_VERSION} --no-progress --profile --prefer-dist .tmp_app && \
  rsync -ahv --exclude='README.md' .tmp_app/ ./ && \
  rm -rf .tmp_app && \
  echo "$GITIGNORE" >> .gitignore && \
  echo "$MARKDOWN_EDITORCONFIG" >> .editorconfig
