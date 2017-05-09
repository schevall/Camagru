<?php
session_start();
require '../Classes/User.php';
header('Location: ../index.php?page=home');
if ($_POST['email'] != '') {
  $mail = $_POST['email'];
  $User = new User();
  if ($_POST['login'] === '' || $_POST['email'] === '') {
    $_SESSION['error'] = "Veuillez remplir tout les champs";
    return ;
  }
  $user_info = $User->getUserAllInfo($_POST['login']);
  if ($user_info == null) {
    $_SESSION['error'] = "Ce login n'existe pas chez nous";
  } else if ($user_info['mail'] != $mail) {
    $_SESSION['error'] = "Cet email ne correspond pas au login";
  } else {
    $User->SendReinitMail($user_info['login'], $mail);
    $_SESSION['message'] = "Un email de réinitialisation vous a été envoyé";
  }
  return ;

}
else
  $_SESSION['error'] = "Veuillez remplir tout les champs";

 ?>
