<?php

namespace App\Controller\Pages;

use \App\Utils\View;

/* O Controlador vai ser responsável por receber uma ação, executar o Model para obter os dados necessários e depois passar os dados para a View */

/**
 * Método responsável por retornar o conteudo da nossa página genérica.
 * @return string
 */
class Page
{
  /**
   * Método responsável por renderizar o topo da página
   * @return string
   */
  private static function getHeader()
  {
    return View::render('pages/header');
  }

  /**
   * Método responsável por renderizar o rodapé da página
   * @return string
   */
  private static function getFooter()
  {
    return View::render('pages/footer');
  }

  public static function getPage($title, $content)
  {
    return View::render('pages/page', [
      'title' => $title,
      'header' => self::getHeader(),
      'content' => $content,
      'footer' => self::getFooter()
    ]);
  }
}
