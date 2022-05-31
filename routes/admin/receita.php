<?php

use \App\Http\Response;
use \App\Controller\Admin;

/* Rota de CRUD de Receitas */

$obRouter->get('/admin/receitas', [
  'middlewares' => [
    'required-admin-login'
  ],
  function ($request) {
    return new Response(200, Admin\Receita::getReceita($request));
  }
]);
