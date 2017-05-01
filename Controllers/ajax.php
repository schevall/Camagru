<?php
session_start();
require('../Classes/Photo.php');

if (!isset($_POST['action']))
  exit('Aucune action');
if ($_POST['action'] == 'save') {
  	header("Content-Type: application/json");
  	$encodedData = $_POST['data'];
  	// $filterSelected = $_REQUEST['filter'];
    $encodedData = str_replace(' ','+',$encodedData);
    $decodedData = base64_decode($encodedData);
  	$login = $_SESSION['user'];
  	$imgFolder = "../database/" . $login . "/";
    date_default_timezone_set('Europe/Paris');
	  $creationDate = date("Y-m-d H:i:s");
  	$Photo = new Photo();
    $id_photo = $Photo->AddPhoto($login, $creationDate);
  	$imgPath = $imgFolder . $id_photo . ".png";
  	if (!file_exists($imgFolder))
  		mkdir($imgFolder, 0777, true);
  	file_put_contents($imgPath, $decodedData);
  	// require "image.php";
  	// applyFilter($imgPath, $filterSelected);
  	$encodedData = $Photo->getEncodedData();
  	echo '{ "id":' . $id_photo . ', "src":"' . 'data:image/png;base64,' . $encodedData . '"}';
}

if ($_POST['action'] == 'delete') {
  $id = $_POST['id'];
	$login = $_SESSION['user'];
	$imgFolder = "../database/" . $login . "/";
	$imgPath = $imgFolder . $id . ".png";
  $Photo = new Photo();
  $user_info = $Photo->getUserinfo($login);
  $Photo->DeletePhoto($user_info['id_user'], $id);
	echo "photo supprimée";
	unlink($imgPath);
}

 ?>
