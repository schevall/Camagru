<?php
session_start();
?>
<html>
<?php include('header.php'); ?>
  <body>
    <div class="title_bar">
      <?
        if ($_SESSION['user'] != '') {
          ?>
            <a class="nav_icon" href="index.php?page=user_profile" title="Vers votre Profil"><img src="config/icons/Profil_icon.png"/></a>
            <a class="nav_icon" href="index.php?page=photo_booth" title="Vers le Photo Booth"><img src="config/icons/Photo_icon.png"/></a>
            <a class="nav_icon" href="index.php?page=gallery" title="Vers votre galerie"><img src="config/icons/Gallery_icon.png"/></a>
          <?
        }
      ?>
      <span class="main_title">Camagru</span>
      <a class="nav_icon" href="index.php?page=mainpage" title="Vers la Main page"><img src="config/icons/Main_icon.png"/></a>
      <a class="nav_icon" href="index.php?page=logout" title="Déconnection"><img src="config/icons/Logout_icon.png"/></a>
    </div>
    <div class="message_bar">
        <?
          require ('views/message.php');
        ?>
    </div>
    <div>
      <?=$content ?>
    </div>
    <div>
      <?php include('footer.php'); ?>
    </div>
  </body>
</html>
