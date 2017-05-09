<?php
session_start();
require('Classes/Photo.php');
require('Classes/Like.php');
$Photo = new Photo();
$Like = new Like();
$AllPhoto = $Photo->GetAllPhoto();
$Count_photo = $Photo->CountAllPhoto();
$count = $Count_photo['count'];
$img_per_page = 10;
$nb_of_page = ceil($count / $img_per_page);
for ($i = 0; $i < $nb_of_page; $i++) {
  if ($i == 0){
    ?><div class="selector"><?
  }
  if ($i <= $nb_of_page) {
    ?><a href="http://localhost:8080/camagru/index.php?page=mainpage&p=<?=$i+1?>">[ page <?=$i + 1?>]</a><?
  }
  if ($i == $nb_of_page - 1) {
    ?></div><?
  }
}
if (!isset($_GET['p'])) {
    $p = 1;
}
else {
  $p = $_GET['p'];
}
  ?>
  <div class="main_page" onload="init_button">
  <?
  if ($AllPhoto != null) {
    $AllPhoto = $Photo->paginatePhoto($AllPhoto, $p);
    foreach ($AllPhoto as $key => $entry) {
      $user_info = $Photo->getUserinfobyId($entry['id_user']);
      $img = $Photo->DisplayMain($entry, $user_info['login']);
      echo $img;
      ?>
      <div class="auteur"><p >Auteur: <? if ($_SESSION['user'] == $user_info['login']) { echo 'Vous même !';} else { echo $user_info['login'];}?></p></div>
      <? if ($_SESSION['user'] != null && $_SESSION['user'] != $user_info['login']) {?>
        <form method="post" action="Controllers/AddComment.php" onSubmit="return verifComm(this)">
          <input style="display: none" name="page" value='<?=$p?>'/>
          <input style="display: none" name="id_photo" value="<?=$entry['id_photo']?>"/>
          <input class="comment_form" name="comment_content" type="text" value=""/>
          <input class="submit_comment" name="submit_comment" type="submit" value="Envoyer"/></form>
          <button class="undeflike_button" >UndefLike</button>
      <? } ?>
      <div class="nb_like"><span > Photo Liké: fois</span></div>
      </div>
  <? }} ?>
</div>

<script type="text/javascript" src="views/scripts/main_page.js"></script>
