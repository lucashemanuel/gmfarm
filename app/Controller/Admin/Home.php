<?php

namespace App\Controller\Admin;

use \App\Utils\View;
use \App\Model\Entity\User as EntityUser;
use \App\Model\Entity\Dados as EntityDados;

class Home extends Page
{

  /**
   * Método responsável por renderizar a view de Home
   * @return string
   */
  public static function getHome($request, $messageError = null, $messageSuccess = null)
  {

    /* STATUS */
    $statusError = !is_null($messageError) ? Alert::getError($messageError) : '';
    $statusSuccess = !is_null($messageSuccess) ? Alert::getSuccess($messageSuccess) : '';

    $id = $_SESSION['admin']['usuario']['id'];
    $obUser = EntityUser::getAlunoById($id);
    $results = EntityDados::getDados(null, null, null, '(select count(*) from estoque) AS estoque, (select count(*) from paciente) AS paciente, (select count(*) from usuarios) AS usuarios');

    $obDados = $results->fetchObject(EntityDados::class);

    /* CONTEÚDO DA HOME */
    $content = View::render('admin/modules/home/index', [
      'nome' => $obUser->nome,
      'email' => $obUser->email,
      'matricula' => $obUser->matricula,
      'senha' => $obUser->senha,
      'nestoque' => $obDados->estoque ?? 0,
      'nusuarios' => $obDados->usuarios ?? 0,
      'npacientes' => $obDados->paciente ?? 0,
      'statusError' => $statusError,
      'statusSuccess' => $statusSuccess
    ]);

    /* RETORNA A PÁGINA COMPLETA */
    return parent::getPanel('Home > GMFARM', $content, 'home');
  }

  /**
   * Método responsável por renderizar a view de Home
   * @return string
   */
  public static function setSenha($request)
  {
    $postVars = $request->getPostVars();

    $id = $_SESSION['admin']['usuario']['id'];
    $obUser = EntityUser::getAlunoById($id);

    /* VERIFICA A SENHA DO USUÁRIO */
    if (!password_verify($postVars['senha'], $obUser->senha)) {
      return self::getHome($request, 'A senha digitada não coincide com a senha atual!', null);
      exit;
    }

    $cripSenha = password_hash($postVars['nsenha'], PASSWORD_BCRYPT);

    /* ATUALIZA A SENHA */
    $obUser->senha = $cripSenha;
    $obUser->atualizar();

    return self::getHome($request, null, 'Senha alterada com sucesso!');
  }
}
