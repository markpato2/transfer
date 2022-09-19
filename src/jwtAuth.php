<?php

namespace src;

use Tuupola\Middleware\JwtAuthentication;

/**
 * Função para implementar Autenticação JWT
 * @return JwtAuthentication
 */
function jwtAuth(): JwtAuthentication
{
    return new JwtAuthentication([
        'secret' => getenv('JWT_SECRET_KEY'),
        'attribute' => 'jwt'
    ]);
}
