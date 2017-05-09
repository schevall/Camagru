<?
session_start();
require 'Classes/Photo.php';
require 'Classes/Like.php';
$Photo = new Photo();
$Like = new Like();
$info_user = $Photo->getUserinfobyLogin($_SESSION['user']);
$AllPhoto = $Photo->GetAllPhoto($info_user['id_user']);
$Count_photo = $Photo->CountAllPhoto($info_user['id_user']);
$count = $Count_photo['count'];
$img_per_page = 10;
$nb_of_page = ceil($count / $img_per_page);
for ($i = 0; $i < $nb_of_page; $i++) {
  if ($i == 0){
    ?><div class="selector"><?
  }
  if ($i <= $nb_of_page) {
    ?><a href="http://localhost:8080/camagru/index.php?page=gallery&p=<?=$i+1?>">[ page <?=$i + 1?>]</a><?
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
<div class="gallery">
<?
$AllPhoto = $Photo->paginatePhoto($AllPhoto, $p);
if ($AllPhoto !== NULL) {
  foreach ($AllPhoto as $key => $entry) {
    $img = $Photo->Display($entry, $_SESSION['user']);
    echo $img;
    ?>
    <div class="Likage"> Photo Liké: <?=$Like->NbLike($entry['id_photo'])[0]?> fois</div></div>
    <?
  }
}
?>
</div>
<script type="text/javascript" src="views/scripts/gallery.js"></script>
