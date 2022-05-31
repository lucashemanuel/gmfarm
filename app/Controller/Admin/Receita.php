<?php

namespace App\Controller\Admin;

use \App\Utils\View;

class Receita extends Page
{

  /**
   * Método responsável por renderizar a view de Relatório
   * @return string
   */
  public static function getReceita($request)
  {
    /* CONTEÚDO DA HOME */
    $content = View::render('admin/modules/receitas/index', []);

    /* RETORNA A PÁGINA COMPLETA */
    return parent::getPanel('Receitas > GMFARM', $content, 'receitas');
  }
}
