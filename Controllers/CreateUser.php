<?php
session_start();
require '../Classes/User.php';
header('Location: ../index.php?page=home');
if ($_POST['login'] && $_POST['passwd1'] && $_POST['submit'] == "OK" && $_POST['nom'] && $_POST['prenom'] && $_POST['mail']) {
    $User = new User();
    $res = $User->VerifInput($_POST);
    if ($res) {
      $_SESSION['error'] = $res;
    }
    else {
      if ($User->Exists($_POST['login']))
        $_SESSION['error'] = "<div><p style='color: red'>Ce login est déja utilisé</p>";
      else {
        $User->Create($_POST);
        $User->SendActivationMail($_POST['mail'], $_POST['login']);
        $_SESSION['message'] = "<div><p style='color: red'>Votre compte a bien été créé</p></br><p>Un email de confirmation vous a été envoyé<p></div>";
      }
    }
}
?>
