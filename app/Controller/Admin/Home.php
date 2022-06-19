<?php

namespace App\Controller\Admin;

use \App\Utils\View;
use \App\Model\Entity\User as EntityUser;

class Home extends Page
{

  /**
   * Método responsável por renderizar a view de Home
   * @return string
   */
  public static function getHome($request)
  {
    $id = $_SESSION['admin']['usuario']['id'];
    $obUser = EntityUser::getAlunoById($id);

    /* CONTEÚDO DA HOME */
    $content = View::render('admin/modules/home/index', [
      'nome' => $obUser->nome,
      'email' => $obUser->email,
      'matricula' => $obUser->matricula,
      'senha' => $obUser->senha
    ]);

    /* RETORNA A PÁGINA COMPLETA */
    return parent::getPanel('Home > GMFARM', $content, 'home');
  }
}
