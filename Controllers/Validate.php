<?php
require '../Classes/User.php';
$User = new User();
$res = $User->ValidateUser($_GET['login'], $_GET['key']);
echo "<div><p style='color: red'>".$res."</p>";
echo '</br><a href="../index.php?page=home">Retour à l\'accueuil</a></div>';

?>
