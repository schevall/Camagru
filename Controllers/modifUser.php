<?php
session_start();
require '../Classes/Connection.php';
header('Location: ../index.php?page=user_profile');

$login = $_SESSION['user'];
$oldpasswd = hash('whirlpool', $_POST['oldpasswd']);
$link = new Connection();
$query = $link->db->prepare("SELECT * FROM t_users WHERE login = :login");
$query->execute(array('login' => $login));
$data = $query->fetch(PDO::FETCH_ASSOC);
if ($oldpasswd == $data['passwd']) {
  if ($_POST['passwd1'] === $_POST['passwd2']) {
    $query = $link->db->prepare("UPDATE t_users SET passwd=:passwd WHERE login =:login");
    $passwd = hash('whirlpool', $_POST['passwd1']);
    $query->execute(array('login' => $login, 'passwd' => $passwd));
    $_SESSION['message'] = 'changesuccess';
  }
  else
    $_SESSION['error'] = 'passdif';
}
else
  $_SESSION['error'] = 'oldpassWrong';
 ?>
