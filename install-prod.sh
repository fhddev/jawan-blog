#!/bin/bash

# install-prod.sh
# Run Composer install optimized for production

set -e

echo "Validating composer.json..."
composer validate --no-interaction || { echo "Validation failed"; exit 1; }

echo "Running Composer install optimized for production..."
composer install --no-scripts --no-progress -vvv -d . -n -o