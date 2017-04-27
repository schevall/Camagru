<?php
require('Classes/Photo.php');

function FormatOut($user_photo) {
    $format = array();
    foreach ($user_photo as $value) {
      $format[] = '<div class="side_photo">';
      $format[] = '<img id='.$value['id_photo'].' class="side_photo" src=data:image/jpeg;base64,' . base64_encode($value['data_photo']) . '>';
      $format[] = '<img class="delete_button" src="config/icons/delete_icon.png">';
      $format[] = '</div>';
    }
    return($format);
}

function GetPic($login) {
  $photo = new Photo();
  $user = $photo->getUserinfo($login);
  $user_photo = $photo->getPhoto($user['id_user']);
  $format = FormatOut($user_photo);
  return($format);
}

 ?>
