<?php

namespace App\Controller\Admin;

use \App\Utils\View;
use \App\Model\Entity\User;
use \App\Session\Admin\Login as SessionAdminLogin;

class Login extends Page
{

  /**
   * Método responsável por retornar a renderização da página de login
   * @param Request $request
   * @param string $errorMsg
   * @return string 
   */
  public static function getLogin($request, $errorMsg = null)
  {
    /* STATUS */
    $status = !is_null($errorMsg) ? Alert::getError($errorMsg) : '';

    $content = View::render('admin/login', [
      'status' => $status
    ]);

    /* Retorna a página completa */
    return parent::getPage('Login > GMFARM', $content);
  }

  /**
   * Método responsável por definir o login do usuário
   * @param Request $request
   */
  public static function setLogin($request)
  {

    /* POST VARS */
    $postVars = $request->getPostVars();
    $email = $postVars['email'] ?? '';
    $senha = $postVars['senha'] ?? '';

    /* BUSCA USUARIO PELO EMAIL */
    $obUser = User::getUserByEmail($email);
    if (!$obUser instanceof User) {
      return self::getLogin($request, 'E-mail inválido');
    }

    /* VERIFICA A SENHA DO USUÁRIO */
    if (!password_verify($senha, $obUser->senha)) {
      return self::getLogin($request, 'Senha inválida');
    }

    /* CRIA SESSÃO DE LOGIN */
    SessionAdminLogin::login($obUser);

    /* REDIRECIONA O USUARIO PARA HOME ADMIN */
    $request->getRouter()->redirect('/admin');
  }

  /**
   * Método responsável por deslogar o usuário
   * @param Request $request
   */
  public static function setLogout($request)
  {

    /* DESTROI SESSÃO DE LOGIN */
    SessionAdminLogin::logout();

    /* REDIRECIONA O USUARIO PARA TELA DE LOGIN */
    $request->getRouter()->redirect('/admin/login');
  }
}
