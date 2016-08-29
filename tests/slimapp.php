<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$container = new Slim\Container();

$app = new Slim\App();

$app->get('/will/return/ok', function (Request $request, Response $response) {
    return $response->withStatus(200);
});

$app->get('/will/return/500', function (Request $request, Response $response) {
    return $response->withStatus(500);
});

$app->any('/data/empty', function (Request $request, Response $response) {
    $dataType = $request->getHeader('Accept');
    $response->getBody()->write('');

    return $response->withStatus(200)->withHeader('Content-type', $dataType);
});

return $app;
