<?php

namespace App\Controller\Admin;

use \App\Utils\View;

class Home extends Page
{

  /**
   * Método responsável por renderizar a view de Home
   * @return string
   */
  public static function getHome($request, $errorMsg = null)
  {

    /* STATUS */
    $status = !is_null($errorMsg) ? Alert::getError($errorMsg) : '';

    /* CONTEÚDO DA HOME */
    $content = View::render('admin/modules/home/index', [
      'status' => $status,
      'value1' => '',
      'value2' => '',
      'value3' => '',
      'resultado' => ''
    ]);

    /* RETORNA A PÁGINA COMPLETA */
    return parent::getPanel('Home > GMFARM', $content, 'home');
  }

  public static function setCalculo($request)
  {
    /* POST VARS */
    $postVars = $request->getPostVars();

    foreach ($postVars as $values) {

      $result = str_replace(",", ".", $values);
      if (!ctype_alpha($result)) {

        if (is_numeric($values) or is_double($result + 0)) {

          function regraDeTres($postVars)
          {
            $var = trimReplace($postVars['value1']);
            $result = trimReplace($postVars['value2']) * trimReplace($postVars['value3']) / $var;
            return number_format($result, 2, ".", "");
          }

          function trimReplace($value)
          {
            return str_replace(",", ".", trim($value));
          }

          $resultado = regraDeTres($postVars);

          $content = View::render('admin/modules/home/index', [
            'status' => null,
            'value1' => $postVars['value1'],
            'value2' => $postVars['value2'],
            'value3' => $postVars['value3'],
            'resultado' => $resultado
          ]);

          return parent::getPanel('Home > GMFARM', $content, 'home');
          exit;
        }
      }
      return self::getHome($request, 'Dados inválidos! Informe apenas números');
    }
    exit;
  }
}
