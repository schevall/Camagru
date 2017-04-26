<?php
session_start();
define('ROOT', $_SERVER['DOCUMENT_ROOT']."/Camagru");
if(isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'home';
}

if ($page === 'logout') {
  require 'Controllers/logout.php';
  $page = 'home';
}

ob_start();
include ('views/template/template.php');
if ($page === 'home') {
  include 'views/view_login.php';
  include 'views/view_createaccount.php';
} else if ($page === 'mainpage'){
  include 'views/view_mainpage.php';
} else if ($page === 'user_profile'){
  include 'views/view_userprofile.php';
} else if ($page === 'photo_booth'){
  include 'views/view_photo_booth.php';
}
$content = ob_get_contents();
ob_end_flush();

?>
