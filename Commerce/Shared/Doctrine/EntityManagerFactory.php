<?php
namespace Commerce\Shared\Doctrine;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;

class EntityManagerFactory implements EntityManagerFactoryInterface
{
    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager(): EntityManagerInterface
    {
        $dotenv = Dotenv::createImmutable('././');
        $dotenv->load();
        $params = [
            'host' => $_ENV['DB_HOST'],
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASS'],
            'dbname' => $_ENV['DB_DATABASE'],
            'driver' => $_ENV['DB_DRIVER'] ?? 'pdo_mysql',
        ];

        $paths = [__DIR__ . '/../../**/Src'];
        $ORMConfig = ORMSetup::createAttributeMetadataConfiguration($paths, true);
        $connection = DriverManager::getConnection($params);
        return new EntityManager($connection, $ORMConfig);
    }

    /**
     * @return self
     */
    public static function create(): self
    {
        return new self();
    }
}