<?php

namespace src;

use App\DAO;

/**
 * Função para Display de erros do Framework Slim
 * @return \Slim\Container
 */
function slimConfiguration(): \Slim\Container
{
    $configuration = [
        'settings' => [
            'displayErrorDetails' => getenv('DISPLAY_ERRORS_DETAILS'),
        ],
    ];
    $container = new \Slim\Container($configuration);
    return $container;
}
