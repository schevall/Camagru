<?php
function authenticate($login, $passwd) {
  include('../Classes/User.php');
  $User = new User();
  $res = $User->Authenticate($login, $passwd);
  return $res;
}
?>
