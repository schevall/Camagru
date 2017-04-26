<?php
function authenticate($login, $passwd) {
  include('../Classes/Connection.php');
  $link = new Connection();
  $passwd = hash('whirlpool', $passwd);
  $query = $link->db->prepare('SELECT login, passwd, actif FROM t_users WHERE login = :login');
  $query->execute(array('login' => $login));
  if (($array = $query->fetch(PDO::FETCH_ASSOC)) !== False) {
    if ($array['passwd'] === $passwd) {
      if ($array['actif'] == 1)
        return 3;
      else
        return 2;
    }
    else
      return 1;
  }
  return 0;
}
