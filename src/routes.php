<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Body;

// *****************************************************************************

// Routes
// Sample route created by the "create-project" Slim script
$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

// *****************************************************************************

define('JSON_OPTIONS', JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

$app->group('/api', function () {
  $this->group('/v1', function () {
    require_once '../src/app/handler.php';

    // ***********************************************************************

    // Sample funtion to get information from the database
    $this->get('/items/player/{idPlayer}', function ($request, $response, $args) {

      $idPlayer = $request->getAttribute('idPlayer');
      $this->logger->info("Get items from the player {$idPlayer}");

      $dbh = new Handler($this);
      $items = $dbh->getPlayerItems($idPlayer);
      $respStatus = 200; // OK

      return $response->withJson($items, $respStatus, JSON_OPTIONS);
    });
  });
});

// *****************************************************************************
