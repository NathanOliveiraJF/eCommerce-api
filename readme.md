## Databases
- table: products
    - id: uuid primary
    - sku: string unique
    - name: string
    - price: int
    - description: string
    - quantity: int
- table: categories
    - id: uuid primary
    - code: string
    - name: string
- table: products_categories
    - id: uuid primary
    - product_id: uui references products
    - category_id: uui references categories

## Packages Utils

- Injection Dependency: https://symfony.com/doc/current/components/dependency_injection.html#basic-usage
- Routes: https://symfony.com/doc/current/routing.html
- Requests: https://packagist.org/packages/symfony/http-foundation
- Validations: https://packagist.org/packages/symfony/validator
- Migrations / Orm: https://www.doctrine-project.org/projects/doctrine-migrations/en/3.7/reference/introduction.html

## Migrations

**generate tables for database**

./vendor/bin/doctrine-migrations migrate

**run down and up migration**

**Delete tables**
./vendor/bin/doctrine-migrations migrations:execute --down 'database\migrations\Version20240331165337'

**Create tables**
./vendor/bin/doctrine-migrations migrations:execute --up 'database\migrations\Version20240331165337'