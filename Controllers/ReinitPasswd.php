<?php
require '../Classes/User.php';
$User = new User();
for($i = 0; $i < 7; $i++) {
  $num .= rand(1,9);
}
$num.= 'a';
$res = $User->ValidateUserrinit($_GET['login'], $_GET['keyrinit'], $num);
echo "<div><p style='color: red'>".$res."</p>";
echo '</br><a href="../index.php?page=home">Retour à l\'accueuil</a></div>';
 ?>
