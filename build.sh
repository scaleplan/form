#!/usr/bin/bash

BASE_PATH=`pwd`
SAMI_PATH="/var/www/sami.phar"

cd "$BASE_PATH"

php "$SAMI_PATH" update sami-config.php

./translate.sh docs en "$BASE_PATH/"

git add -A
git commit --allow-empty-message -m '' --no-edit
git push origin master

composer update --prefer-source
