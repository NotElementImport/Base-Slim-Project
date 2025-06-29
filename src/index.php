<?php
namespace App;

use DI\Container;
use Dotenv\Dotenv;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Psr7\Response as PsrResponse;

require __DIR__ . '/../vendor/autoload.php';

// Register DI
\Slim\Factory\AppFactory::setContainer(
    new Container()
);

// Register .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

/** @var \Slim\App */
$app = \Slim\Factory\AppFactory::create();

// Register configs:
(require __DIR__ . '/config/doctrine.php')($app);
(require __DIR__ . '/config/di.php')($app);
(require __DIR__ . '/config/routes.php')($app);

// Adding Public Assets
$app->get('/public/{path:.*}', function ($request, $response, $args) {
    $path = $args['path'];
    $file = __DIR__ . '/../public/' . $path;

    if (!file_exists($file)) {
        return $response->withStatus(404);
    }

    $stream = new \Slim\Psr7\Stream(fopen($file, 'rb'));
    return $response
        ->withHeader('Content-Type', mime_content_type($file))
        ->withBody($stream);
});

// Adding Not Found Json
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setErrorHandler(
    \Slim\Exception\HttpNotFoundException::class,
    function (Request $request, \Throwable $exception, bool $displayErrorDetails): Response {
        $response = new PsrResponse();
        $response->getBody()->write(json_encode([
            'error' => 'Route not found',
            'path' => (string) $request->getUri()
        ]));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(404);
    }
);

// Run the application
$app->run();
