<?php
session_start();
require('Controllers/GetPic.php');
 ?>
<div class="main_screen">
  <div class="photo_booth">
    <div class="wrapper">
      <video autoplay></video><br/>
      <button id="take_pic" type='submit' value='submit' name='photo'>Prendre une photo</button>
    </div>
    <div class="wrapper">
      <canvas></canvas><br/>
      <button id="save_pic" type='submit' value='submit' name='photo' method="post" onclick="Request_SavePic" >Sauver</button>
    </div>
  </div>
  <div class="sider">
    <?
    $format = GetPic($_SESSION['user']);
    foreach ($format as $value) {
        echo $value;
    }
    ?>
  </div>
</div>

<script type="text/javascript" src="views/scripts/photo.js"></script>
