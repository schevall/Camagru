<?php
session_start();
require('../Classes/Photo.php');
require('../Classes/Like.php');

if (!isset($_POST['action']))
  exit('Aucune action');
if ($_POST['action'] == 'save') {
  	header("Content-Type: application/json");
  	$encodedData = $_POST['data'];
    $encodedData = str_replace(' ','+',$encodedData);
    $decodedData = base64_decode($encodedData);
  	$login = $_SESSION['user'];
  	$imgFolder = "../database/" . $login . "/";
  	$Photo = new Photo();
    $id_photo = $Photo->AddPhoto($login);
  	$imgPath = $imgFolder . $id_photo . ".png";
  	if (!file_exists($imgFolder))
  		mkdir($imgFolder, 0777, true);
  	file_put_contents($imgPath, $decodedData);
    $encodedData = $Photo->getEncodedData($imgPath);
  	echo '{ "id":' . $id_photo . ', "src":"' . 'data:image/png;base64,' . $encodedData . '"}';
}

if ($_POST['action'] == 'put_filter') {
  header("Content-Type: application/json");
  $encodedData = $_POST['data'];
  $filterSelected = $_POST['filter'];
  $encodedData = str_replace(' ','+',$encodedData);
  $decodedData = base64_decode($encodedData);
  $login = $_SESSION['user'];
  $imgFolder = "../database/tmp/";
  $Photo = new Photo();
  $imgPath = $imgFolder . "tmp.png";
  if (!file_exists($imgFolder))
    mkdir($imgFolder, 0777, true);
  file_put_contents($imgPath, $decodedData);
  require "filter_image.php";
  applyFilter($imgPath, $filterSelected);
  $encodedData = $Photo->getEncodedData($imgPath);
  echo '{"src":"' . 'data:image/png;base64,' . $encodedData . '"}';
}

if ($_POST['action'] == 'delete') {
  $id = $_POST['id'];
	$login = $_SESSION['user'];
	$imgFolder = "../database/" . $login . "/";
	$imgPath = $imgFolder . $id . ".png";
  $Photo = new Photo();
  $user_info = $Photo->getUserinfobyLogin($login);
  $Photo->DeletePhoto($user_info['id_user'], $id);
	echo '{photo supprimée}';
	unlink($imgPath);
}

if ($_POST['action'] == 'newlike') {
  $Like = new Like();
  date_default_timezone_set('Europe/Paris');
  $Like_Date = date("Y-m-d H:i:s");
  if ($Like->Is_allready_Liked($_POST['id'], $_SESSION['user']) == True) {
    $Like->RemoveLike($_POST['id'], $_SESSION['user']);
    echo 'less';
  } else {
    $Like->AddLike($_POST['id'], $_SESSION['user'], $Like_Date);
    echo 'more';
  }

}

if ($_POST['action'] == 'Is_allready_Liked') {
    $Like = new Like();
    if ($Like->Is_allready_Liked($_POST['id'], $_SESSION['user']) == True) {
      echo 'allreadyliked';
    } else {
      echo 'notlikedyet';
  }
}

if ($_POST['action'] == 'Nb_of_like') {
  $Like = new Like();
  $res = $Like->NbLike($_POST['id']);
  echo ($res['COUNT(id_photo_to)']);
}
 ?>
