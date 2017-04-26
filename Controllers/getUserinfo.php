<?
session_start();
 require 'Classes/Connection.php';
$link = new Connection();
$data = $link->getUserinfo($_SESSION['user']);
$_SESSION['userinfo']['login'] = $data['login'];
$_SESSION['userinfo']['nom'] = $data['nom'];
$_SESSION['userinfo']['prenom'] = $data['prenom'];
$_SESSION['userinfo']['mail'] = $data['mail'];
?>
