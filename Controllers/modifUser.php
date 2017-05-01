<?php
session_start();
require('../Classes/User.php');
header('Location: ../index.php?page=user_profile');
$User = new User();
$res = $User->ModifPasswdUser($_SESSION['user'], $_POST);
if ($res)
  $_SESSION['error'] = $res;
?>
