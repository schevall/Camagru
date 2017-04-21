<?php

class Connection {

public $db;

  public function __construct() {
    require('../config/database.php');
    try {
      $this->db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die('Erreur : ' . $e->getMessage());
    }
  }

}

 ?>
