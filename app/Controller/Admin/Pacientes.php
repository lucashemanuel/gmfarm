<?php

namespace App\Controller\Admin;

use \App\Utils\View;

class Pacientes extends Page
{

  /**
   * Método responsável por renderizar a view de Materias
   * @return string
   */
  public static function getPaciente($request)
  {

    /* CONTEÚDO DA HOME */
    $content = View::render('admin/modules/pacientes/index', []);

    /* RETORNA A PÁGINA COMPLETA */
    return parent::getPanel('Pacientes > GMFARM', $content, 'pacientes');
  }
}
