<?php
session_start();
require_once('Authenticate.php');
if ($_POST['submit'] && $_POST['submit'] == 'OK' && $_POST['login'] && $_POST['passwd']) {
    $res = authenticate($_POST['login'], $_POST['passwd']);
    if ($res == 3) {
      $_SESSION['user'] = $_POST['login'];
      echo "Connection réussie";
    }
    elseif ($res == 2) {
      echo "<p>Vous n'avez pas validé le lien du mail de confirmation</p>";
    }
    elseif ($res == 1) {
      echo "<p>Mauvaise Combinaison login/mot de passe</p>";
    }
    else if($res == 0) {
      echo "<p>Cet utilisateur n'existe pas</p>";
    }
    echo '<a href="../index.php?page=home">Retour à l\'accueuil</a></div>';
}
?>
