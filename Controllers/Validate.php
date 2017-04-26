<?php
require '../Classes/Connection.php';
$login = $_GET['login'];
$key = $_GET['key'];
$link = new Connection();
$query = $link->db->prepare("SELECT user_key, actif FROM t_users WHERE login = :login");
if ($query->execute(array('login' => $login)) && $row = $query->fetch()) {
    $keybdd = $row['user_key'];
    $actif = $row['actif'];
}

if($actif == '1')
     echo "Votre compte est déjà actif !";
else {
     if($key == $keybdd)
       {
          echo "Votre compte a bien été activé !</br>Connectez vous pour accéder";
          $query = $link->db->prepare("UPDATE t_users SET actif = 1 WHERE login like :login ");
          $query->execute(array('login' => $login));
       }
     else
        echo "Erreur ! Votre compte ne peut être activé car la cle envoyée est différente de celle présente dans la base de données";
  }
  echo '</br><a href="../index.php?page=home">Retour à l\'accueuil</a></div>';



 ?>
