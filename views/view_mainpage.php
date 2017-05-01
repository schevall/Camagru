<?php
session_start();
require('../Classes/Photo.php');
?>
<div class="main_page">This is the main page
  <?=DisplayAllPhoto()?>
</div>


<script type="text/javascript" src="views/scripts/main_page.js"></script>
