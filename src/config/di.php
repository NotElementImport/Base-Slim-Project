<?php
namespace App\config;

use App\v1\auth\application\service\AuthService;
use App\v1\auth\infrastructure\authStrategy\NoAuthStrategy;

return function (\Slim\App &$app) {
    /** @var \DI\Container */
    $container = $app->getContainer();

    // DI: Auth example
    $container->set(
        AuthService::class,
        new AuthService(
            strategy: new NoAuthStrategy()
        )
    );
};
