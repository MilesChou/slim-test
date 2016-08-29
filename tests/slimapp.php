<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$container = new Slim\Container();

$app = new Slim\App();

$app->get('/will/return/ok', function (Request $request, Response $response) {
    $response->getBody()->write('200');
    $newReponse = $response->withStatus(200);

    return $newReponse;
});

$app->get('/will/return/500', function (Request $request, Response $response) {
    $response->getBody()->write('500');
    $newReponse = $response->withStatus(500);

    return $newReponse;
});

return $app;
