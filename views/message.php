<?php
session_start();
switch ($_SESSION['error']) {
  case 'notactivated':
    echo "<p style='color:red'>Vous n'avez pas validé le lien du mail de confirmation</p>";
    break;
  case 'notvalid':
    echo "<p style='color:red'>Mauvaise Combinaison login/mot de passe</p>";
    break;
  case 'notexist':
    echo "<p style='color:red'>Cet utilisateur n'existe pas</p>";
    break;
  case 'alreadyused':
    echo "<div><p style='color: red'>Ce login est déja utilisé</p>";
    break;
  case 'passdif':
    echo "<br/><p style='color: red'>Les mots de passe sont différents</p>";
    break;
  case 'oldpassWrong':
    echo "<br/><p style='color: red'>L'ancien mot de passe renseigné ne correspond avec celui présent dans notre base de données</p>";
    break;
}

switch ($_SESSION['message']) {
  case 'createdaccount':
    echo "<div><p style='color: red'>Votre compte a bien été créé</p></br>";
    echo "<p>Un email de confirmation vous a été envoyé<p></div>";
    break;
  case 'changesuccess':
    echo "<br/><p style='color: red'>Votre mot de passe a bien été changé</p>";
    break;
}

$_SESSION['error'] = '';
$_SESSION['message'] = '';
 ?>
