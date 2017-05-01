<?php
session_start();

echo "<p style='color: red'>".$_SESSION['error']."</p>";
$_SESSION['error'] = null;

echo "<p style='color: red'>".$_SESSION['message']."</p>";
$_SESSION['message'] = null;


?>
