<?php
require("Classes/User.php");
function GiveSessionUserInfo($login) {
  $User = new User();
  $user_info = $User->getUserinfo($login);
  return($user_info);
}
?>
