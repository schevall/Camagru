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

  public function getUserinfo($login) {
    try {
      $query = $this->db->prepare('SELECT * FROM t_users WHERE login =:login');
      $query->execute(array('login' => $login));
      return $query->fetch(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
    die('Erreur : ' . $e->getmessage());
    }
  }

  public function AddPhoto($data, $user_login) {
    $user_info = $this->getUserinfo($user_login);
    $query = $this->db->prepare('INSERT INTO t_photos (id_user, data_photo, date_photo) VALUES (:id_user, :data_photo, :date_photo)');
    $query->execute(array('id_user' => $user_info['id_user'], 'data_photo' => $data, 'date_photo' => date('Y-m-d-h-i-s')));
  }
}
?>
