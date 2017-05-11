<?php
session_start();
require('Classes/Photo.php');
require('Classes/Comment.php');

$Comment = new Comment();


$Photo = new Photo();
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
      if ($img != -1) {
        echo $img;
      ?>
      <div class="auteur" value="<?=$_SESSION['user']?>"><p >Auteur: <? if ($_SESSION['user'] == $user_info['login']) { echo 'Vous même !';} else { echo $user_info['login'];}?></p><br/></div>
      <? if ($_SESSION['user'] != null && $_SESSION['user'] != $user_info['login']) {?>
        <form>
          <input class="comment_content" name="comment_content" type="text" value="" placeholder="Commenter..."/>&nbsp;&nbsp;&nbsp;&nbsp;
          <input  style="display:none" class="submit_comment" name="submit_comment" type="submit" value="Envoyer"/>&nbsp;&nbsp;&nbsp;&nbsp;
          <input class="user_form" style="display:none" value="<?=$_SESSION['user']?>"/>
          <button class="undeflike_button" >UndefLike</button>
        </form>
      <? } ?>
      <div class="nb_like"><span >likes: fois</span></div>
      <? $allcomms = $Comment->GetComment($entry['id_photo']);
      if ($allcomms != null) {
        ?> <ul class="comm_list"> <?
        foreach ($allcomms as $com) {
          $user = $Comment->getUserinfobyId($com['id_user_from']);
          ?>
            <li class="comment_display"><?=$user['login']?> : <?=$com['comment_content']?></li>
        <? } ?>
      </ul>
      <? } ?>
      </div>
    <? }}} ?>
</div>

<script type="text/javascript" src="views/scripts/main_page.js"></script>
