#!/bin/bash
set -e

composer -V -vvv || rm -rf vendor;

composer self-update --2.2 || composer self-update --2 || composer self-update;
composer install
