# 1. Clone repository
git clone <your-repo-url>
cd biblios

# 2. Install PHP dependencies
composer install

# 3. Configure database (.env.local)

# DATABASE_URL="mysql://root:password@127.0.0.1:3306/biblios?serverVersion=8.0.31"

# 4. Create database & run migrations
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

# 5. Load fixtures
php bin/console doctrine:fixtures:load

# 6. Run all tests
php bin/phpunit

# 7. Run specific tests
php bin/phpunit tests/Entity/BookTest.php
php bin/phpunit tests/Controller/AdminAccessTest.php


# 8 .Admin User Credentials (from fixtures)

Email: admin@example.com

Password: admin123

Role: ROLE_ADMIN

