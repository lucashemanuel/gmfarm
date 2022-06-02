<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class User
{
  public $id;

  public $nome;

  public $email;

  public $senha;

  public function cadastrar()
  {
    /* INSERE NO BANCO DE DADOS */
    $this->id = (new Database('usuarios'))->insert([
      'nome' => $this->nome,
      'email' => $this->email,
      'senha' => $this->senha
    ]);

    /* Sucesso */
    return true;
  }

  public function atualizar()
  {
    /* ATUALIZA NO BANCO DE DADOS */
    return (new Database('usuarios'))->update('id = ' . $this->id, [
      'nome' => $this->nome,
      'email' => $this->email,
      'senha' => $this->senha,
    ]);
  }

  public function excluir()
  {
    /* EXCLUI O ALUNO NO BANCO DE DADOS */
    return (new Database('usuarios'))->delete('id = ' . $this->id);
  }


  /**
   * Método responsável por retornar um usuári com base em seu e-mail
   * @param string $email
   * @return User
   */
  public static function getUserByEmail($email)
  {
    return (new Database('usuarios'))->select('email = "' . $email . '"')->fetchObject(self::class);
  }

  /**
   * Método responsável por retornar o aluno com base no ID
   * @param integer $id_material
   * @return Estoque
   */
  public static function getAlunoById($id)
  {
    return self::getAtributos('id = ' . $id)->fetchObject(self::class);
  }

  /**
   * Método responsável por retornar (atributos do aluno)
   * @param string $where
   * @param string $order
   * @param string $limit
   * @param string $fields
   * @return PDOStatement 
   */
  public static function getAtributos($where = null, $order = null, $limit = null, $fields = '*')
  {
    return (new Database('usuarios'))->select($where, $order, $limit, $fields);
  }
}
