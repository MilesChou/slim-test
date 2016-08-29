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
    $acceptHeader = $request->getHeader('Accept');
    $response->getBody()->write('');

    return $response->withStatus(200)->withHeader('Content-type', $acceptHeader);
});

$app->any('/data/null', function (Request $request, Response $response) {
    $acceptHeader = $request->getHeader('Accept');
    $data = null;

    switch (true) {
        case in_array('application/json', $acceptHeader):
            $newResponse = $response->withStatus(200)
                ->withHeader('Content-type', $acceptHeader);
            $newResponse->getBody()->write(json_encode($data));
            break;
        case in_array('application/xml', $acceptHeader):
            $xml = new SimpleXMLElement('<root/>');
            $newResponse = $response->withStatus(200)
                ->withHeader('Content-type', $acceptHeader);
            $newResponse->getBody()->write($xml->asXml());
            break;
        default:
            $newResponse = $response->withStatus(500);
    }

    return $newResponse;
});

return $app;
