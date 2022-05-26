<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class User
{

  public $id;

  public $nome;

  public $email;

  public $senha;

  /**
   * Método responsável por retornar um usuári com base em seu e-mail
   * @param string $email
   * @return User
   */
  public static function getUserByEmail($email)
  {
    return (new Database('usuarios'))->select('email = "' . $email . '"')->fetchObject(self::class);
  }
}
