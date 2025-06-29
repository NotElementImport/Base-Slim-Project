<?php
namespace App\app\interface\controller;

use App\v1\auth\application\service\AuthService;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AuthController
{
    public function __construct(
        private AuthService $auth
    ) {}

    public function check(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write(
            string: json_encode($this->auth->isValid($request))
        );

        return $response->withHeader(
            name: 'Content-Type',
            value: 'application/json'
        );
    }
}
