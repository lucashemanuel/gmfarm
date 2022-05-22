<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Estoque as EntityEstoque;

/* O Controlador vai ser responsável por receber uma ação, executar o Model para obter os dados necessários e depois passar os dados para a View */

/**
 * Método responsável por retornar o conteudo da nossa página de estoque.
 * @return string
 */
class Estoque extends Page
{

  /**
   * Método responsável por obter a renderização dos itens de estoque 
   * @return string
   */
  private static function getEstoqueItems(){
    /* MATERIAIS */
    $itens = '';

    /* Resultados da página */
    $results = EntityEstoque::getItems(null, 'id_material DESC');

    /* Renderiza o item */
    while($obEstoque = $results->fetchObject(EntityEstoque::class)){
      $itens .= View::render('pages/estoque/item', [
        'id_material' => $obEstoque->id_material,
        'reagente' => $obEstoque->reagente,
        'lote' => $obEstoque->lote,
        'fabricante' => $obEstoque->fabricante,
        'fabricacao' => date('m/Y', strtotime($obEstoque->fabricacao)),
        'validade' => date('m/Y', strtotime($obEstoque->validade)),
        'quantidade' => $obEstoque->quantidade,
        'embalagem_original' => $obEstoque->embalagem_original,
        'cas' => $obEstoque->cas,
      ]);
    }

    /* RETORNA OS ITENS */
    return $itens;
  }

  public static function getEstoque()
  {

    /* View do Estoque */
    $content = View::render('pages/estoque', [
      'itens' => self:: getEstoqueItems()
    ]);

    /* Retorna a View da Página */
    return parent::getPage('ESTOQUE > GMFARM', $content);
  }

  public static function insertMaterial($request)
  {

    /* DADOS DO POST */
    $postVars = $request->getPostVars();

    /* NOVA INSTANCIA DE ESTOQUE */
    $obEstoque = new EntityEstoque;
    $obEstoque->reagente = $postVars['reagente'];
    $obEstoque->lote = $postVars['lote'];
    $obEstoque->fabricante = $postVars['fabricante'];
    $obEstoque->fabricacao = $postVars['fabricacao'];
    $obEstoque->validade = $postVars['validade'];
    $obEstoque->quantidade = $postVars['quantidade'];
    $obEstoque->embalagem_original = $postVars['embalagem_original'];
    $obEstoque->cas = $postVars['cas'];
    $obEstoque->cadastrar();

    return self::getEstoque();
  }
}
