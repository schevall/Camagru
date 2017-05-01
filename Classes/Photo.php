<?php

require 'Connection.php';
Class Photo extends Connection{

    private $login;
    private $id_photo;

    public function AddPhoto($login, $date) {
      $user_info = $this->getUserinfo($login);
      $query = $this->db->prepare("INSERT INTO t_photos (id_user, date_photo) VALUES (:id_user, :date_photo)");
      $query->execute(array('id_user' => $user_info['id_user'], 'date_photo' => $date));
      $this->login = $login;
      $this->id_photo = $this->db->lastInsertId();
      return $this->id_photo;
    }

    public function getEncodedData() {
      $path = '../database/'.$this->login.'/'.$this->id_photo.'.png';
      if (!file_exists($path))
        return -1;
      $data = file_get_contents($path);
      $encodedData = base64_encode($data);
      return $encodedData;
    }

    public function DeletePhoto($id_user, $id_photo) {
      $query = $this->db->prepare('DELETE FROM t_photos WHERE id_user=:id_user AND id_photo=:id_photo');
      $query->execute(array('id_user' => $id_user, 'id_photo' => $id_photo));
    }

    public function GetAllPhoto() {
      $query = $this->db->prepare("SELECT * FROM t_photos");
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}

 ?>
