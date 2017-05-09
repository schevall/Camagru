<?php

require_once 'Connection.php';
Class Photo extends Connection{


    private $login;
    private $id_photo;

    public function AddPhoto($login) {
      date_default_timezone_set('Europe/Paris');
      $date = date("Y-m-d H:i:s");
      try {
        $user_info = $this->getUserinfobyLogin($login);
        $query = $this->db->prepare("INSERT INTO t_photos (id_user, date_photo) VALUES (:id_user, :date_photo)");
        $query->execute(array('id_user' => $user_info['id_user'], 'date_photo' => $date));
        $this->login = $login;
        $this->id_photo = $this->db->lastInsertId();
        return $this->id_photo;
      } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
      }

    }

    public function getEncodedData($path) {
      if (!file_exists($path))
        return -1;
      $data = file_get_contents($path);
      $encodedData = base64_encode($data);
      return $encodedData;
    }

    public function DeletePhoto($id_user, $id_photo) {
      try {
        $query = $this->db->prepare('DELETE FROM t_photos WHERE id_user=:id_user AND id_photo=:id_photo');
        $query->execute(array('id_user' => $id_user, 'id_photo' => $id_photo));
      } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
      }

    }

    public function GetAllPhoto($id_user=null) {
      if ($id_user == null) {
        $query = $this->db->prepare("SELECT * FROM t_photos ORDER BY date_photo DESC");
      } else {
        $query = $this->db->prepare("SELECT * FROM t_photos WHERE id_user =:id_user ORDER BY date_photo DESC");
      }
      try {
        $query->execute(array('id_user' => $id_user));
        return $query->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
      }

    }

    public function CountAllPhoto($id_user=null) {
      try {
        if ($id_user == null) {
          $query = $this->db->prepare("SELECT COUNT(id_photo) AS 'count' FROM t_photos");
          $query->execute();
        } else {
            $query = $this->db->prepare("SELECT COUNT(id_photo) AS 'count' FROM t_photos WHERE id_user =:id_user");
            $query->execute(array('id_user' => $id_user));
        }
        return $query->fetch();
      } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
      }

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
      $img .= '<div class="img_content"><img id='.$info['id_photo'].' class="gallery_photo" alt="photo"';
      $img .= 'src="data:image/png;base64,'.$data.'">';
      $img .= '<img class="delete_button" alt="delete" src="config/icons/delete_icon.png"/></div>';
      return $img;
    }

    public function DisplayMain($info, $login) {
      $data = $this->GetImgData($info['id_photo'], $login);
      if ($data == -1)
        return -1;
      $img = '<div class="img_container_main">';
      $img .= '<img id='.$info['id_photo'].' class="gallery_photo" alt="photo"';
      $img .= 'src="data:image/png;base64,'.$data.'">';
      return $img;
    }

    public function paginatePhoto($AllPhoto, $p) {
      if (!$AllPhoto)
        return ;
      foreach ($AllPhoto as $key => $value) {
        if ((($key + 1)) <= ($p * 10) && $key >= ($p - 1) * 10) {
          $Output[] = $value;
        }
      }
      return $Output;
    }

}

 ?>
