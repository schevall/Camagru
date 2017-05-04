<?php
session_start();
require('Classes/Photo.php');
require('Classes/Like.php');
$Photo = new Photo();
$AllPhoto = $Photo->GetAllPhoto();
$Like = new Like();
?>
<div class="main_page">
  <?
  foreach ($AllPhoto as $key => $entry) {
    $user_info = $Photo->getUserinfobyId($entry['id_user']);
    $img = $Photo->DisplayMain($entry, $user_info['login']);
    echo $img;
    ?>
    <p>Auteur: <? if ($_SESSION['user'] == $user_info['login']) { echo 'Vous même !';} else { echo $user_info['login'];}?></p>
    <? if ($_SESSION['user'] != $user_info['login']) {?>
    <form method="post" action="Controllers/AddComment.php" onSubmit="return verifComm(this)">
      <input style="display: none" name="id_photo" value="<?=$entry['id_photo']?>"/>
      <input class="comment_form" name="comment_content" type="text" value=""/>
      <input class="submit_comment" name="submit_comment" type="submit" value="Envoyer"/></form>
      <button class="undeflike_button" >Like</button><span> Photo Liké: <?=$Like->NbLike($entry['id_photo'])[0]?> fois</span>
      <? } ?>
      </div>
  <? } ?>
</div>

<script type="text/javascript" src="views/scripts/main_page.js"></script>
