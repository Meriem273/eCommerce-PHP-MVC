<?php

class Database
{
  private $PDOInstance = null;

  private static $instance = null;

  private function __construct()
  {
    $string = DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME;
    $this->PDOInstance  = new PDO($string, DB_USER, DB_PASS);
  }

  //chaque appel a getInstance() renvoie toujours la meme instance unique de la classe Database pour utiliser une seule connexion a la bdd
  public static function getInstance()
  {
    if (is_null(self::$instance)) {
      self::$instance = new Database();
    }
    return self::$instance;
  }

  //lis dans la bdd
  public function read($query, $data = array())
  {
    $statement = $this->PDOInstance->prepare($query);
    $result = $statement->execute($data);

    if ($result) {
      $data = $statement->fetchAll(PDO::FETCH_OBJ);
      if (is_array($data) && count($data) > 0) {
        return $data;
      }
    }
    return false;
  }

  //ecrit dans la bdd
  public function write($query, $data = array())
  {
    $statement = $this->PDOInstance->prepare($query);
    $result = $statement->execute($data);

    if ($result) {
      return true;
    }
    return false;
  }

  //retourne le dernier id insere

  public function getLastInsertId()
  {
    return $this->PDOInstance->lastInsertId();
  }
}
