<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Estoque as EntityEstoque;
use \WilliamCosta\DatabaseManager\Pagination;

/* O Controlador vai ser responsável por receber uma ação, executar o Model para obter os dados necessários e depois passar os dados para a View */

/**
 * Método responsável por retornar o conteudo da nossa página de estoque.
 * @return string
 */
class Estoque extends Page
{

  /**
   * Método responsável por obter a renderização dos itens de estoque 
   * @param Request
   * @param Pagination $obPagination
   * @return string
   */
  private static function getEstoqueItems($request, &$obPagination)
  {
    /* MATERIAIS */
    $itens = '';

    /* Quantidade toral de registros */
    $quantidadeTotal = EntityEstoque::getItems(null, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;

    /* Página atual */
    $queryParams = $request->getQueryParams();
    $paginaAtual = $queryParams['page'] ?? 1;

    /* Instancia de paginação */
    $obPagination = new Pagination($quantidadeTotal, $paginaAtual, 2);

    /* Resultados da página */
    $results = EntityEstoque::getItems(null, 'id_material DESC', $obPagination->getLimit());

    /* Renderiza o item */
    while ($obEstoque = $results->fetchObject(EntityEstoque::class)) {
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

  public static function getEstoque($request)
  {

    /* View do Estoque */
    $content = View::render('pages/estoque', [
      'itens' => self::getEstoqueItems($request, $obPagination),
      'pagination' => parent::getPagination($request, $obPagination)
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

    /* RETORNA A PÁGINA DE LISTAGEM DO ESTOQUE */
    return self::getEstoque($request);
  }
}
