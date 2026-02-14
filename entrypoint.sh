#!/bin/sh
set -e

echo "DATABASE_URL: $DATABASE_URL"
echo "Waiting for database..."

max_attempts=30
attempt=0

until php bin/console dbal:run-sql "SELECT 1" 2>/dev/null || [ $attempt -eq $max_attempts ]; do
  attempt=$((attempt+1))
  echo "Attempt $attempt/$max_attempts - Database not ready, retrying..."
  sleep 2
done

if [ $attempt -eq $max_attempts ]; then
  echo "Failed to connect to database after $max_attempts attempts"
  exit 1
fi

echo "Database connected successfully!"
echo "Creating database schema..."
php bin/console doctrine:schema:create --no-interaction || echo "Schema already exists"

echo "Running GrumPHP..."
exec vendor/bin/grumphp run
