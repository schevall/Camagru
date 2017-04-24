<?php
session_start();
if(isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'home';
}

if ($_SESSION['user'] != '')
  $page = 'mainpage';

ob_start();
include ('views/template/template.php');
if ($page === 'home') {
  include 'views/view_login.php';
  include 'views/view_createaccount.php';
} else if ($page === 'mainpage'){
  include 'views/view_mainpage.php';
}
$content = ob_get_contents();

ob_end_flush();

?>
