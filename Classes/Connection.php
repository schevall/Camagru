<?php

class Connection {

public $db;

  public function __construct() {
    try {
      require($_SERVER["DOCUMENT_ROOT"].'/Camagru/config/database.php');
      $this->db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die('Erreur : ' . $e->getMessage());
    }
  }

  public function getUserinfobyLogin($login) {
    try {
      $query = $this->db->prepare('SELECT login, id_user FROM t_users WHERE login =:login');
      $query->execute(array('login' => $login));
      return $query->fetch(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
    die('Erreur : ' . $e->getmessage());
    }
  }

  public function getUserinfobyId($id_user) {
    try {
      $query = $this->db->prepare('SELECT login, id_user FROM t_users WHERE id_user =:id_user');
      $query->execute(array('id_user' => $id_user));
      return $query->fetch(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
    die('Erreur : ' . $e->getmessage());
    }
  }

  public function getUserinfobymail($mail_user) {
    try {
      $query = $this->db->prepare('SELECT login, id_user FROM t_users WHERE mail =:mail_user');
      $query->execute(array('mail_user' => $mail_user));
      return $query->fetch(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
    die('Erreur : ' . $e->getmessage());
    }
  }

  public function getUserAllInfo($login) {
    try {
      $query = $this->db->prepare('SELECT * FROM t_users WHERE login =:login');
      $query->execute(array('login' => $login));
      return $query->fetch(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
    die('Erreur : ' . $e->getmessage());
    }
  }

  public function getUserinfobyIdPhoto($id_photo) {
    try {
      $query = $this->db->prepare('SELECT id_user FROM t_photos WHERE id_photo =:id_photo');
      $query->execute(array('id_photo' => $id_photo));
      return $query->fetch(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
    die('Erreur : ' . $e->getmessage());
    }
  }
}
?>
