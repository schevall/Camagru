<?php

require 'Connection.php';

Class User extends Connection {

    public function Create($array) {
      $passwd = hash('whirlpool', $array['passwd1']);
      $query = $this->db->prepare("INSERT INTO t_users (login, nom, prenom, mail, passwd, date_user) VALUES (:login, :nom, :prenom, :mail, :passwd, :date_user)");
      $query->execute(array('login' => $array['login'], 'nom' => $array['nom'], 'prenom' => $array['prenom'], 'mail' => $array['mail'], 'passwd' => $passwd, 'date_user' => date('Y-m-d')));
    }

    public function Exists ($login) {
      $query = $this->db->prepare("SELECT * FROM t_users WHERE login = :login");
      $query->execute(array('login' => $login));
      if ($query->fetch())
        return True;
      else
        return False;
    }

    public function SendActivationMail($mail, $login) {
      $key = md5(microtime(TRUE)*100000);
      $query = $this->db->prepare("UPDATE t_users SET user_key=:key WHERE login =:login");
      $query->execute(array('login' => $login, 'key' => $key));
      require '../views/template/message_validation.php';
      mail($mail, $subject, $message, $heading);
    }

    static protected function VerifPasswd($passwd1, $passwd2) {
      $verif = Null;
      if ($passwd1 !== $passwd2)
        $verif = "Mots de passe différents";
      $len = strlen($passwd1);
      if ($len > 25 || $len < 8)
        $verif = "Taille du mot de passe invalide";

      $alpha = preg_match("/[a-zA-Z]/", $passwd1);
      $num = preg_match("/[0-9]/", $passwd1);
      if ($alpha == 0)
        $verif = "Il n'y a pas de lettre dans le mot de passe";
      if ($num == 0)
        $verif = "Il n'y a pas de chiffre dans le mot de passe";
      return $verif;
    }

    static protected function VerifLogin($login) {
      $len = strlen($login);
      if ($len < 4 || $len > 25)
        return "Login non valid";
      else
        return Null;
    }

    static protected function VerifMail($mail) {
      $regex = "/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/";
      $res = preg_match($regex, $mail);
      if ($res === 1)
        return Null;
      else
        return "Email non valid";
    }

    public function VerifInput($array) {
      $verif = self::VerifPasswd($array['passwd1'], $array['passwd2']);
      $verif = self::VerifLogin($array['login']);
      $verif = self::VerifMail($array['mail']);
      return $verif;
    }

    public function ValidateUser($login, $key) {
      $query = $this->db->prepare("SELECT user_key, actif FROM t_users WHERE login = :login");
      $query->execute(array('login' => $login));
      if ($res = $query->fetch()) {
        $keybdd = $res['user_key'];
        $actif = $res['actif'];
      }
      if($actif == '1')
        return "Votre compte est déjà actif !";
      else if ($key == $keybdd) {
        $query = $this->db->prepare("UPDATE t_users SET actif = 1 WHERE login like :login ");
        $query->execute(array('login' => $login));
        return "Votre compte a bien été activé !</br>Connectez vous pour accéder";
      }
      else
        return "Erreur ! Votre compte ne peut être activé car la cle envoyée est différente de celle présente dans la base de données";
    }

    public function Authenticate($login, $passwd) {
      $query = $this->db->prepare('SELECT login, passwd, actif FROM t_users WHERE login = :login');
      $query->execute(array('login' => $login));
      if (($array = $query->fetch(PDO::FETCH_ASSOC))) {
        $hashedpasswd = hash('whirlpool', $passwd);
        if (!strcmp($array['passwd'], $hashedpasswd)) {
          if ($array['actif'] == 1)
            return NULL;
          else
            return "votre compte n'est pas activé";
        }
        else
          return "Le mot de passe n'est pas le bon";
      }
      else
        return "Ce compte n'existe pas";
    }

    public function ModifPasswdUser($login, $array) {
      $verif = self::VerifPasswd($array['passwd1'], $array['passwd2']);
      if ($verif == Null) {
        $verif = $this->Authenticate($login, $array['oldpasswd']);
        if ($verif == Null) {
            $newpasswd = hash('whirlpool', $array['passwd1']);
            $query = $this->db->prepare("UPDATE t_users SET passwd=:passwd WHERE login =:login");
            $query->execute(array('passwd' => $newpasswd, 'login' => $login));
            return "Votre mot de passe a bien été modifié";
        }
      }
      return $verif;
    }
}
?>
