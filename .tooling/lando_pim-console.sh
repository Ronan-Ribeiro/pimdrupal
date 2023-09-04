#!/bin/bash
if [ -z "$1" ]
  then
    php /app/pimcore/bin/console
fi

for COMMAND in "$@"
do
  php /app/pimcore/bin/console $COMMAND
done
