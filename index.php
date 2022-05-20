<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Http\Router;
use \App\Utils\View;
use \WilliamCosta\DotEnv\Environment;

/* Carrega variaveis de ambiente */

Environment::load(__DIR__);

/* Define a constante de URL */
define('URL', getenv('URL'));


/* Define o valor padrão das variaveis */
View::init([
  'URL' => URL
]);

/* Inicia o Router */
$obRouter = new Router(URL);

/* Inclui as Rotas */
include __DIR__ . '/routes/pages.php';

/* Imprime o response da rota */
$obRouter->run()
  ->sendResponse();
