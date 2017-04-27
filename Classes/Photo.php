<?php

require 'Connection.php';
Class Photo extends Connection{

    public function getPhoto($id_user) {
      $query = $this->db->prepare('SELECT * FROM t_photos WHERE id_user=:id_user ORDER BY id_photo DESC');
      $query->execute(array('id_user' => $id_user));
      $array = $query->fetchAll(PDO::FETCH_ASSOC);
      return($array);
    }

}

 ?>
