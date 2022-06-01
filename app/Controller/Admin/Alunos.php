<?php

namespace App\Controller\Admin;

use \App\Utils\View;

class Alunos extends Page
{

  /**
   * Método responsável por renderizar a view de Materias
   * @return string
   */
  public static function getAluno($request)
  {

    /* CONTEÚDO DA HOME */
    $content = View::render('admin/modules/alunos/index', []);

    /* RETORNA A PÁGINA COMPLETA */
    return parent::getPanel('Alunos > GMFARM', $content, 'alunos');
  }
}
