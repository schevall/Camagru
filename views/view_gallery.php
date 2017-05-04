<?
session_start();
require 'Classes/Photo.php';
require 'Classes/Like.php';
$Photo = new Photo();
$Like = new Like();
$info_user = $Photo->getUserinfobyLogin($_SESSION['user']);
$AllPhoto = $Photo->GetAllPhoto($info_user['id_user']);
?>
<div class="gallery">
<?
foreach ($AllPhoto as $key => $entry) {
  $img = $Photo->Display($entry, $_SESSION['user']);
  echo $img;
  ?>
  <span> Photo Liké: <?=$Like->NbLike($entry['id_photo'])[0]?> fois</span></div>
  <?
}
?>
</div>
<script type="text/javascript" src="views/scripts/gallery.js"></script>
