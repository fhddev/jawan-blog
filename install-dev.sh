#!/bin/bash

# install-dev.sh
# Run Composer install with local overrides (development)

set -e

echo "Validating composer.local.json..."
COMPOSER=composer.local.json composer validate --no-interaction || { echo "Validation failed"; exit 1; }

echo "Running Composer install with local overrides (development)..."
COMPOSER=composer.local.json composer install --no-scripts --no-progress -vvv -d . -n