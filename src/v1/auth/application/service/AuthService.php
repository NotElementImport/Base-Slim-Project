<?php

namespace App\v1\auth\application\service;

use App\v1\auth\domain\interface\IAuthStrategy;
use Psr\Http\Message\RequestInterface;

class AuthService
{
    public function __construct(
        private IAuthStrategy $strategy
    ) {}

    public function isValid(RequestInterface $request): bool
    {
        return $this->strategy->isValid(request: $request);
    }
}
