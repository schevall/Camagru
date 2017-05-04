<?php
session_start();
require_once '../Classes/Comment.php';
header('Location: ../index.php?page=mainpage');
if ($_POST['comment_content'] == "")
  return;
$comment = $_POST['comment_content'];
$id_photo = $_POST['id_photo'];
$Comment = new Comment();
$user_info_sender = $Comment->getUserinfobyLogin($_SESSION['user']);
$Comment->AddComment($id_photo, $comment, $user_info_sender['id_user']);
chdir("../");
$Comment->CommentMail();
 ?>
