<?php

namespace App\Model\Entity;

class Estoque
{

  public $id_material;

  public $reagente;

  public $fabricante;

  public $fabricacao;

  public $validade;

  public $qtd;

  public $embalagem_original;

  public $cas;

  public function cadastrar()
  {
    echo "<pre>";
    print_r($this);
    echo "</pre>";
    exit;
  }
}
