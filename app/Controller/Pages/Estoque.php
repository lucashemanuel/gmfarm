<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

/* O Controlador vai ser responsável por receber uma ação, executar o Model para obter os dados necessários e depois passar os dados para a View */

/**
 * Método responsável por retornar o conteudo da nossa página de estoque.
 * @return string
 */
class Estoque extends Page
{

  public static function getEstoque()
  {
    $obOrganization = new Organization;

    /* View do Estoque */
    $content = View::render('pages/estoque', [
      /* CONTENT */]);

    /* Retorna a View da Página */
    return parent::getPage('ESTOQUE > GMFARM', $content);
  }
}
