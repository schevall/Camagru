<?php
session_start();
require '../Classes/Connection.php';

$sample = 'data:image/png;base64,';
$data = substr($_POST['data'], strlen($sample));
$data64 = base64_decode($data);
$link = new Connection();
$link->AddPhoto($data64, $_SESSION['user']);
?>
