<?php

use \App\Http\Response;
use \App\Controller\Admin;

/* Rota de CRUD de Alunos */

$obRouter->get('/admin/alunos', [
  'middlewares' => [
    'required-admin-login'
  ],
  function ($request) {
    return new Response(200, Admin\Alunos::getAluno($request));
  }
]);
