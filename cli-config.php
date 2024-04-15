<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Commerce\Shared\Doctrine\EntityManagerFactory;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\DependencyFactory;


$config = new PhpFile('migrations.php');
//$params = [
//    'host'     => $_ENV['DB_HOST'],
//    'user'     => $_ENV['DB_USER'],
//    'password' => $_ENV['DB_PASS'],
//    'dbname'   => $_ENV['DB_DATABASE'],
//    'driver'   => $_ENV['DB_DRIVER'] ?? 'pdo_mysql',
//];
//$paths = [__DIR__.'/modules/**/**/Entity'];
//$ORMConfig = ORMSetup::createAttributeMetadataConfiguration($paths, true);
//$connection = DriverManager::getConnection($params);
//$entityManager = new EntityManager($connection, $ORMConfig);
return DependencyFactory::fromEntityManager($config, new ExistingEntityManager(EntityManagerFactory::create()->getEntityManager()));