<?php

use \App\Http\Response;
use \App\Controller\Admin;

/* Rota de CRUD de Alunos */

$obRouter->get('/admin/pacientes', [
  'middlewares' => [
    'required-admin-login'
  ],
  function ($request) {
    return new Response(200, Admin\Pacientes::getPaciente($request));
  }
]);
