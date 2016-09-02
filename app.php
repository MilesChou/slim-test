<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$container = new Slim\Container();

$app = new Slim\App($container);

$app->any('/will/return/ok', function (Request $request, Response $response) {
    $body = $request->getParsedBody();
    $method = $request->getMethod();
    if ($method == 'GET') {
        $query = $request->getUri()->getQuery();
        $body = [];
        parse_str($query, $body);
    }
    $response->getBody()->write($method . ' OK ' . json_encode($body));

    return $response->withStatus(200);
});

$app->any('/will/return/cookies', function (Request $request, Response $response) {
    $cookies = $request->getCookieParams();
    $method = $request->getMethod();
    $response->getBody()->write($method . ' COOKIES ' . json_encode($cookies));

    return $response->withStatus(500);
});

$app->any('/will/return/error', function (Request $request, Response $response) {
    $body = $request->getParsedBody();
    $method = $request->getMethod();
    if ($method == 'GET') {
        $query = $request->getUri()->getQuery();
        $body = [];
        parse_str($query, $body);
    }
    $response->getBody()->write($method . ' ERROR ' . json_encode($body));

    return $response->withStatus(500);
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

$app->any('/title/return/sample', function (Request $request, Response $response) {
    $body = $request->getParsedBody();
    $response->getBody()->write('<html><title>sample</title></html>');

    return $response->withStatus(200);
});

return $app;
