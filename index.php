<?php
session_start();
if(isset($_GET['page']) && isset($_SESSION['user'])) {
  $page = $_GET['page'];
} else if ($_GET['page'] == 'mainpage'){
  $page = 'mainpage';
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
} else if ($page === 'gallery'){
  include 'views/view_gallery.php';
}
$content = ob_get_contents();
ob_end_flush();

?>
