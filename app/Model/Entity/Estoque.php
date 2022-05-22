<?php

namespace App\Model\Entity;
use \WilliamCosta\DatabaseManager\Database;

class Estoque
{

  public $id_material;

  public $reagente;

  public $lote;

  public $fabricante;

  public $fabricacao;

  public $validade;

  public $quantidade;

  public $embalagem_original;

  public $cas;

  public function cadastrar()
  {
    /* INSERE NO BANCO DE DADOS */
    $this->id_material = (new Database('estoque'))->insert([
      'reagente' => $this->reagente,
      'lote' => $this->lote,
      'fabricante' => $this->fabricante,
      'fabricacao' => $this->fabricacao,
      'validade' => $this->validade,
      'quantidade' => $this->quantidade,
      'embalagem_original' => $this->embalagem_original,
      'cas' => $this->cas
    ]);

    /* Sucesso */
    return true;
  }

  /**
   * Método responsável por retornar (itens do estoque)
   * @param string $where
   * @param string $order
   * @param string $limit
   * @param string $fields
   * @return PDOStatement 
   */ 
  public static function getItems($where = null, $order = null, $limit = null, $fields = '*'){

    return (new Database('estoque'))->select($where, $order, $limit, $fields);
  }
}
