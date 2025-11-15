<?php

define("DB_NAME","fasks");
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');

class Database {

  private $db;
  function __construct() {
    $this->db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($this->db->connect_error) {
      die(''. $this->db->connect_error);
    }
  }

  public function getConnection () {
    return $this->db;
  }

}

?>