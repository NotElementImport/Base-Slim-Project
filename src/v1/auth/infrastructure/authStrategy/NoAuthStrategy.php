<?php
namespace App\v1\auth\infrastructure\authStrategy;

use App\v1\auth\domain\interface\IAuthStrategy;
use Psr\Http\Message\RequestInterface;

class NoAuthStrategy implements IAuthStrategy
{
    public function isValid(RequestInterface $request): bool
    {
        return true;
    }
};
