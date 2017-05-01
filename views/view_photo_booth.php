<?php
session_start();
require('Controllers/GetPic.php');
 ?>
<div class="main_screen">
    <div class="wrapper">
      <video id="video"></video><br/>
      <button id="take_pic" type='submit' value='submit' name='photo'>Prendre une photo</button>
    </div>
    <div class="container">
      <p>Selectioner un Filtre</p>
      <select name="filter-selector" id="filter-selector">
			 <option value="filter1">Rhino</option>
			 <option value="filter2">Pikachu</option>
			 <option value="filter3">Joli cadre</option>
		  </select>
    </div>
    <div class="wrapper">
      <canvas id="canvas"></canvas><br/>
      <button id="save_pic" type='submit' value='submit' name='submit' method="post" >Sauver</button>
    </div>
  <div id="gallery">
  </div>
</div>

<script type="text/javascript" src="views/scripts/photo.js"></script>
