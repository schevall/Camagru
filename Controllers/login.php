<?php
session_start();
require('Authenticate.php');
if ($_POST['submit'] && $_POST['submit'] == 'OK' && $_POST['login'] && $_POST['passwd']) {
    $res = authenticate($_POST['login'], $_POST['passwd']);
    if ($res == 3) {
      $_SESSION['user'] = $_POST['login'];
      header('Location: ../index.php?page=mainpage');
    }
    elseif ($res == 2) {
      $_SESSION['error'] = 'notactivated';
      header('Location: ../index.php?page=home');
    }
    elseif ($res == 1) {
      $_SESSION['error'] = 'notvalid';
      header('Location: ../index.php?page=home');
    }
    else if($res == 0) {
      $_SESSION['error'] = 'notexist';
      header('Location: ../index.php?page=home');
    }
}
?>
