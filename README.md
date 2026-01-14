
## Prérequis

- PHP >= 8.1
- Composer
- Symfony CLI
- MySQL ou MariaDB

---

### 1. Cloner le dépôt

- git clone https://github.com/AocholAyoul9/Biblios.git
- cd biblios
 ----

## 2. Install PHP dependencies
composer install

## 3. Configure database (.env.local)

- DATABASE_URL="mysql://root:password@127.0.0.1:3306/biblios?serverVersion=8.0.31"
***  DATABASE POUR LE TEST (.env.test)**

-DATABASE_URL="mysql://root:@127.0.0.1:3306/biblios-test?serverVersion=8.0.31"


## 4. Create database & run migrations
- php bin/console doctrine:database:create
- php bin/console doctrine:migrations:migrate

## 5. Load fixtures
- php bin/console doctrine:fixtures:load

## 6.Lancer le serveur Symfony

- symfony server:start

## 7. Run all tests
- php bin/phpunit

# 8. Run specific tests
- php bin/phpunit tests/Entity/BookTest.php
- php bin/phpunit tests/Controller/AdminAccessTest.php

