<?php
require '../Classes/Connection.php';
if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'] == "OK" && $_POST['nom'] && $_POST['prenom'] && $_POST['mail']) {
    $link = new Connection();
    $login = $_POST['login'];
    $query = $link->db->prepare("SELECT * FROM t_users WHERE login = :login");
    $query->execute(array('login' => $_POST['login']));
    if ($query->fetch()) {
        echo "<div><p style='color: red'>Ce login est déja utilisé</p></div>";
    }
    else {
      $passwd = hash('whirlpool', $_POST['passwd']);
      $query = $link->db->prepare("INSERT INTO t_users (login, nom, prenom, mail, passwd, date_user) VALUES (:login, :nom, :prenom, :mail, :passwd, :date_user)");
      $query->execute(array('login' => $_POST['login'], 'nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'mail' => $_POST['mail'], 'passwd' => $passwd, 'date_user' => date('Y-m-d')));
      echo "<div><p style='color: red'>Votre compte a bien été créé</p></div>";
    }
}
?>
