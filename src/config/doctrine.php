<?php
namespace App\config;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

$mapping = [];

return function (\Slim\App &$app) use (&$mapping) {
    $config = ORMSetup::createAttributeMetadataConfiguration(
        paths: $mapping,
        isDevMode: ($_ENV['APP_ENV'] ?? 'dev') === 'dev' ? true : false,
        cache: new \Symfony\Component\Cache\Adapter\FilesystemAdapter(
            'doctrine', 0, __DIR__ . '/../../runtime/cache/doctrine'
        )
    );

    $app->getContainer()->set(
        EntityManager::class,
        new EntityManager(
            conn: DriverManager::getConnection([
                'driver' => 'pdo_mysql',
                'host' => $_ENV['DB_HOST'],
                'port' => $_ENV['DB_PORT'],
                'dbname' => $_ENV['DB_NAME'],
                'user' => $_ENV['DB_USER'],
                'password' => $_ENV['DB_PASS'],
                'charset' => 'utf8mb4',
            ]),
            config: $config
        )
    );
};
