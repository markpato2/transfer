<?php

namespace src;

use Tuupola\Middleware\HttpBasicAuthentication;

/**
 * Função para implementar autenticação básica
 * @return HttpBasicAuthentication
 */
function basicAuth(): HttpBasicAuthentication
{
    $user = getenv('BASIC_USER');
    $password = getenv('BASIC_PASSWORD');
    return new HttpBasicAuthentication([
        "users" => [
            $user => $password
        ]
    ]);
}
