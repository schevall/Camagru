<?php
session_start();
if(isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'home';
}

ob_start();
require ('views/template/template.php');
if ($page === 'home') {
  require 'views/home.php';
} else {
  require 'views/home.php';
}
$content = ob_get_contents();

ob_end_flush();

?>
