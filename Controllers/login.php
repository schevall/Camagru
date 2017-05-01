<?php
session_start();
require('Authenticate.php');
if ($_POST['submit'] && $_POST['submit'] == 'OK' && $_POST['login'] && $_POST['passwd']) {
    $res = authenticate($_POST['login'], $_POST['passwd']);
    if (count($res) == 0) {
      $_SESSION['user'] = $_POST['login'];
      header('Location: ../index.php?page=mainpage');
    } else {
      $_SESSION['error'] = $res;
      header('Location: ../index.php?page=home');
    }
}
?>
