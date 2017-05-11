<?php

require_once 'Connection.php';

Class Comment extends Connection{

  private $comment;
  private $id_photo;
  private $id_user_sender;

  public function AddComment($id_photo, $comment, $id_user_sender) {
    date_default_timezone_set('Europe/Paris');
	  $date_c = date("Y-m-d H:i:s");
    $comment = htmlentities($comment);
    $query = $this->db->prepare("INSERT INTO t_comments
                                (id_user_from, id_photo_to, date_comment, comment_content)
                                VALUES (:user, :photo, :date_c, :comment)");
    $query->execute(array('user' => $id_user_sender, 'photo' => $id_photo, 'date_c' => $date_c, 'comment' => $comment));
    $this->comment = $comment;
    $this->id_photo = $id_photo;
    $this->id_user_sender = $id_user_sender;
    return $comment;
  }

  public function CommentMail() {
    $user_sender = $this->getUserinfobyId($this->id_user_sender);
    $id_user_receiver = $this->getUserinfobyIdPhoto($this->id_photo);
    $user_receiver = $this->getUserinfobyId($id_user_receiver['id_user']);
    $user_receiver = $this->getUserAllInfo($user_receiver['login']);

    $id_photo = $this->id_photo;
    $sender = $user_sender['login'];
    $receiver = $user_receiver['login'];
    $mail = $user_receiver['mail'];
    $comment = $this->comment;
    require 'views/template/message_comment.php';
  }

  public function GetComment($id_photo) {
    try {
      $query = $this->db->prepare("SELECT * FROM t_comments WHERE id_photo_to =:id ORDER BY id_comment DESC");
      $query->execute(array("id" => $id_photo));
      return ($query->fetchAll(PDO::FETCH_ASSOC));
      } catch (PDOException $e) {
      die('Erreur : ' . $e->getMessage());
    }
  }
}
?>
