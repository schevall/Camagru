<?php
session_start();

if (!isset($_SESSION['error']) && !isset($_SESSION['message']) && $_SESSION['user'] != '')
  echo "<p style='font-family: impact'>Salut ".$_SESSION['user']."</p>";

echo "<p style='color: red'>".$_SESSION['error']."</p>";
$_SESSION['error'] = null;

echo "<p style='color: red'>".$_SESSION['message']."</p>";
$_SESSION['message'] = null;


?>
