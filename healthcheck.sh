#!/bin/bash

# Check if Apache is running
if ! service apache2 status >/dev/null; then
  exit 1
fi

# Check if PHP is working
if ! php -r "echo 'PHP is working';" >/dev/null; then
  exit 1
fi

# Check if Redis is running
if ! redis-cli ping >/dev/null; then
  exit 1
fi

exit 0
