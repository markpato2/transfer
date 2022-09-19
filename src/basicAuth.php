<?php

namespace src;

use Tuupola\Middleware\HttpBasicAuthentication;

/**
 * Função para implementar autenticação básica
 * @return HttpBasicAuthentication
 */
function basicAuth(): HttpBasicAuthentication
{
    return new HttpBasicAuthentication([
        "users" => [
            "root" => "teste123"
        ]
    ]);
}
