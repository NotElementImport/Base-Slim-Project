<?php
namespace App\v1\auth\domain\interface;

use Psr\Http\Message\RequestInterface;

interface IAuthStrategy
{
    function isValid(RequestInterface $request): bool;
};
