#!/usr/bin/env bash

SRC_DIR="$1_ru"
TO_LANG="$2"
DESC_DIR="$1_$TO_LANG"
TRANS_PATH="/var/www/trans"
CURRENT_PATH="$3"

mkdir -p "$DESC_DIR"
cp -r $SRC_DIR/* $DESC_DIR/

find "$SRC_DIR/" -name '*.md' -type f -printf '%P\0' |
while IFS= read -r -d '' file; do
    `"$TRANS_PATH" -no-autocorrect -no-ansi -no-warn "ru:$2" "file://$CURRENT_PATH/$SRC_DIR/$file" | sed -f translate.sed > "$CURRENT_PATH/$DESC_DIR/$file"`
done

UPPER_LANG=`echo "$TO_LANG" | awk '{print toupper($0)}'`

if [[ "$TO_LANG" = "en" ]]; then
    DESC_FILE="$CURRENT_PATH/README.md"
else
    DESC_FILE="$CURRENT_PATH/README.$TO_LANG-$UPPER_LANG.md"
fi

`"$TRANS_PATH" -e yandex -no-autocorrect -no-ansi -no-warn "ru:$2" "file://$CURRENT_PATH/README.ru-RU.md" | sed -f translate.sed > "$DESC_FILE"`