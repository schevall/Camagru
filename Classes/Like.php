<?php
require_once 'Connection.php';
Class Like extends Connection {

  public function AddLike($id_photo_to, $login_user_from, $Like_Date) {
    try {
      $user_from = $this->getUserinfobyLogin($login_user_from);
      $query = $this->db->prepare("INSERT INTO t_likes (id_photo_to, id_user_from, date_like) VALUES (:id_photo, :id_user_from, :date_like)");
      $query->execute(array('id_photo' => $id_photo_to, 'id_user_from' => $user_from['id_user'], 'date_like' => $Like_Date));
    } catch (PDOException $e) {
      die('Erreur : ' . $e->getMessage());
    }

  }

  public function RemoveLike($id_photo_to, $login_user_from) {
    try {
      $user_from = $this->getUserinfobyLogin($login_user_from);
      $query = $this->db->prepare("DELETE FROM t_likes WHERE id_photo_to=:id_photo_to AND id_user_from=:id_user_from");
      $query->execute(array('id_photo_to' => $id_photo_to, 'id_user_from' => $user_from['id_user']));
    } catch (PDOException $e) {
      die('Erreur : ' . $e->getMessage());
    }


  }

  public function Is_allready_Liked($id_photo_to, $login_user_from) {
    try {
      $user_from = $this->getUserinfobyLogin($login_user_from);
      $query = $this->db->prepare('SELECT id_photo_to FROM t_likes WHERE id_photo_to=:id_photo_to AND id_user_from=:id_user_from');
      $query->execute(array('id_photo_to' => $id_photo_to, 'id_user_from' => $user_from['id_user']));
      if ($query->fetch()) {
        return True;
      } else {
        return False;
      }
  } catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
  }

  }

  public function NbLike($id_photo) {
    try {
      $query = $this->db->prepare("SELECT COUNT(id_photo_to) FROM t_likes WHERE id_photo_to = :id_photo_to");
      $query->execute(array('id_photo_to' => $id_photo));
      $res = $query->fetch();
      return ($res);
    } catch (PDOException $e) {
      die('Erreur : ' . $e->getMessage());
    }

  }
}


?>
