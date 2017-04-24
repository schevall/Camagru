<?php
require '../Classes/Connection.php';
if ($_POST['login'] && $_POST['passwd1'] && $_POST['submit'] == "OK" && $_POST['nom'] && $_POST['prenom'] && $_POST['mail']) {
    $link = new Connection();
    $login = $_POST['login'];
    $query = $link->db->prepare("SELECT * FROM t_users WHERE login = :login");
    $query->execute(array('login' => $_POST['login']));
    if ($query->fetch()) {
        echo "<div><p style='color: red'>Ce login est déja utilisé</p>";
    }
    else {
      $passwd = hash('whirlpool', $_POST['passwd1']);
      $query = $link->db->prepare("INSERT INTO t_users (login, nom, prenom, mail, passwd, date_user) VALUES (:login, :nom, :prenom, :mail, :passwd, :date_user)");
      $query->execute(array('login' => $_POST['login'], 'nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'mail' => $_POST['mail'], 'passwd' => $passwd, 'date_user' => date('Y-m-d')));
      $login = $_POST['login'];
      $key = md5(microtime(TRUE)*100000);
      $query = $link->db->prepare("UPDATE t_users SET user_key=:key WHERE login =:login");
      $query->execute(array('login' => $login, 'key' => $key));
      require '../views/template/message_validation.php';
      mail($_POST['mail'], $subject, $message, $heading);
      echo "mail = " . $_POST['mail'] . '</br>';
      echo "key = " .$key . '</br>';
      echo "message = " . $message ."</br>";
      echo "subject = " . $subject . "</br>";
      echo "heading = " . $heading . "</br>";
      echo "<div><p style='color: red'>Votre compte a bien été créé</p></br>";
      echo "<p>Un email de confirmation vous à été envoyé<p>";
    }
    echo '<a href="../index.php?page=home">Retour à l\'accueuil</a></div>';
}
?>
