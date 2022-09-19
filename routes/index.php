<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use function src\{slimConfiguration, basicAuth};

use App\Controllers\{UsuarioController,TransferenciaController};

$app = new \Slim\App(slimConfiguration());

// =========================================
//Rota Inicial do Projeto
$app->get('/', function (Request $request, Response $response, array $args) {
    $response = $response->withJson([
        'message' => 'Api para Pagamentos entre Pessoas!'
    ]);
    return $response;
});

//Rotas para criação, consulta de usuarios e para executar transferencia
$app->group('/v1', function () use ($app) {

    $app->post('/user', UsuarioController::class . ':insert');
    $app->get('/user[/{id}]',UsuarioController::class . ':get');
    $app->post('/transfer', TransferenciaController::class . ':transfer');

})->add(basicAuth());

//Comando Slim para iniciar rotas
$app->run();
