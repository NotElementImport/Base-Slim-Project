<?php
namespace App\config;

use App\app\interface\controller\AuthController;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteCollectorProxy;

return function (\Slim\App &$app) {
    // Health check
    $app->get('/health-check', function ($_, Response $response) {
        $response->getBody()->write('"ok"');
        return $response
            ->withHeader('Content-Type', 'application/json');
    });

    // V1 Api
    $app->group('/v1', function (RouteCollectorProxy $app) {
        // Auth example
        $app->get('/auth/check', [AuthController::class, 'check']);
    });
};
