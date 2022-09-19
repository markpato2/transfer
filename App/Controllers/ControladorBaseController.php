<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

abstract class ControladorBaseController
{
    /**
     * Classe abstracta para implementação de métodos get, insert, update, delete nos Controlladores
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    abstract protected function  get(Request $request, Response $response, array $args): Response;
    abstract protected function  insert(Request $request, Response $response, array $args): Response;
    abstract protected function  update(Request $request, Response $response, array $args): Response;
    abstract protected function delete(Request $request, Response $response, array $args): Response;
}
