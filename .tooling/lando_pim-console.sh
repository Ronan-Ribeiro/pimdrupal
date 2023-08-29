#!/bin/bash
for COMMAND in "$@"
do
  php /app/pimcore/bin/console $COMMAND
done
