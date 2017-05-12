<?php
session_start();
 ?>
<div class="main_screen">
    <div class="photo_booth_container">
      <video id="video"></video><br/>
      <button id="take_pic" type='submit' value='submit' name='photo'>Prendre une photo</button>
    </div>
    <div class="filter_container">
      <p>Selectioner un Filtre</p>
      <select name="filter-selector" id="filter-selector">
       <option value="filter0">Choisir...</option>
			 <option value="filter1">Pikachu</option>
			 <option value="filter2">Sword</option>
			 <option value="filter3">Beer</option>
       <option value="filter4">Wave</option>
       <option value="filter5">Forest</option>
     </select>
      <br/><label>Télécharger une photo (en png ou jpeg):</label><br/>
      <input type="file" id="file_Upload"><br/>
      <button id="upload_button">Upload a picture</button>
        <br/><? echo $_SESSION['error']; $_SESSION['error'] = ''?>
    </div>
    <div class="photo_booth_container">
      <canvas id="canvas"></canvas><br/>
      <button id="save_pic" >Sauver</button><br/><br/>

    </div>
  <div id="gallery">
  </div>
</div>

<script type="text/javascript" src="views/scripts/photo_booth.js"></script>
