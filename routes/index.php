<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use function src\{slimConfiguration, basicAuth, jwtAuth};

use App\Controllers\{ProdutoController, LojaController, AuthController, ExceptionController,UsuarioController,TransferenciaController};

$app = new \Slim\App(slimConfiguration());

// =========================================
//Rota Inicial do Projeto
$app->get('/', function (Request $request, Response $response, array $args) {
    $response = $response->withJson([
        'message' => 'Api para Pagamentos entre Pessoas!'
    ]);
    return $response;
});


$app->post('/login', AuthController::class . ':login');
$app->post('/refresh-token', AuthController::class . ':refreshToken');

$app->group('/v1', function () use ($app) {
   // $app->get('/loja', LojaController::class . ':getLojas');
    $app->post('/user', UsuarioController::class . ':insert');
    $app->post('/transfer', TransferenciaController::class . ':transfer');
   // $app->post('/transfer',TransferenciaController::class . ':transferir');
   // $app->put('/loja', LojaController::class . ':updateLoja');
   // $app->delete('/loja', LojaController::class . ':deleteLoja');

   // $app->get('/produto', ProdutoController::class . ':getProdutos');
   // $app->post('/produto', ProdutoController::class . ':insertProduto');
   // $app->put('/produto', ProdutoController::class . ':updateProduto');
  //  $app->delete('/produto', ProdutoController::class . ':deleteProduto');
});


/*
$app->group('v1', function () use ($app) {
    $app->get('/loja', LojaController::class . ':getLojas');
    $app->post('/loja', LojaController::class . ':insertLoja');
    $app->put('/loja', LojaController::class . ':updateLoja');
    $app->delete('/loja', LojaController::class . ':deleteLoja');

    $app->get('/produto', ProdutoController::class . ':getProdutos');
    $app->post('/produto', ProdutoController::class . ':insertProduto');
    $app->put('/produto', ProdutoController::class . ':updateProduto');
    $app->delete('/produto', ProdutoController::class . ':deleteProduto');
})->add(basicAuth());
*/
/*
$app->group('/v1', function () use ($app) {
    $app->get('/test-with-versions', function () {
        return "oi v1";
    });
});

$app->group('/v2', function () use ($app) {
    $app->get('/test-with-versions', function () {
        return "oi v2";
    });
});

$app->get('/exception-test', ExceptionController::class . ':test');

$app->get('/teste', function () {
    echo "oi";
})->add(jwtAuth());
*/

// =========================================

$app->run();
