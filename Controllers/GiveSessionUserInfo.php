<?php
require("Classes/User.php");
function GiveSessionUserInfo($login) {
  $User = new User();
  $user_info = $User->getUserAllInfo($login);
  return($user_info);
}
?>
