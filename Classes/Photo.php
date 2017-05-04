<?php

require_once 'Connection.php';
Class Photo extends Connection{

    private $login;
    private $id_photo;

    public function AddPhoto($login) {
      date_default_timezone_set('Europe/Paris');
      $date = date("Y-m-d H:i:s");
      $user_info = $this->getUserinfobyLogin($login);
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

    public function GetAllPhoto($id_user=null) {
      if ($id_user == null) {
        $query = $this->db->prepare("SELECT * FROM t_photos ORDER BY date_photo DESC");
      } else {
        $query = $this->db->prepare("SELECT * FROM t_photos WHERE id_user =:id_user ORDER BY date_photo DESC");
      }
      $query->execute(array('id_user' => $id_user));
      return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function GetImgData($id_photo, $login) {
      $path = "database/".$login."/".$id_photo.".png";
      if(!file_exists($path))
        return -1;
      $data = file_get_contents($path);
      $encodedData = base64_encode($data);
      return $encodedData;
    }

    public function Display($info, $login) {
      $data = $this->GetImgData($info['id_photo'], $login);
      if ($data == -1)
        return -1;
      $img = '<div class="img_container">';
      $img .= '<img id='.$info['id_photo'].' class="gallery_photo" alt="photo"';
      $img .= 'src="data:image/png;base64,'.$data.'">';
      $img .= '<img class="delete_button" alt="delete" src="config/icons/delete_icon.png"/>';
      return $img;
    }

    public function DisplayMain($info, $login) {
      $data = $this->GetImgData($info['id_photo'], $login);
      if ($data == -1)
        return -1;
      $img = '<div class="img_container">';
      $img .= '<img id='.$info['id_photo'].' class="gallery_photo" alt="photo"';
      $img .= 'src="data:image/png;base64,'.$data.'">';
      return $img;
    }

}

 ?>
