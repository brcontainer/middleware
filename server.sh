#!/bin/bash

# Setup PHP and PORT
PHP_BIN="/usr/bin/php"
PHP_INI="/etc/php5/cli/php.ini"
HOST_HOST="localhost"
HOST_PORT=9000

# public folder
ROOT_FOLDER=$(dirname "$0")
cd "$ROOT_FOLDER/public"

# Start built in server
$PHP_BIN -S $HOST_HOST:$HOST_PORT
