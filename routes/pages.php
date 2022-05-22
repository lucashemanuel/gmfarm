<?php

use \App\Http\Response;
use \App\Controller\Pages;

/* Rota HOME */

$obRouter->get('/', [
  function () {
    return new Response(200, Pages\Home::getHome());
  }
]);

/* Rota ESTOQUE */
$obRouter->get('/estoque', [
  function ($request) {
    return new Response(200, Pages\Estoque::getEstoque($request));
  }
]);

/* Rota ESTOQUE (INSERT)*/
$obRouter->post('/estoque', [
  function ($request) {
    return new Response(200, Pages\Estoque::insertMaterial($request));
  }
]);

/* Rotas DINAMICAS */
$obRouter->get('/pagina/{idPagina}/{acao}', [
  function ($idPagina, $acao) {
    return new Response(200, 'Página ' . $idPagina . ' - ' . $acao);
  }
]);
