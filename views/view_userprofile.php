<?php
session_start();
require($_SERVER["DOCUMENT_ROOT"].'/camagru/Controllers/getUserinfo.php');
?>
<div style="margin: 0 3vw">
  <h2>Votre compte</h2><br/>
      <form class="modif_user" method="post" action="Controllers/modifUser.php" onSubmit="return verif_modif_user(this)">
        <p>
          <label>Login : </label>
          <var><?=$_SESSION['userinfo']['login']?><br/>
        </p>
        <p>
          <label>Prenom : </label>
          <var><?=$_SESSION['userinfo']['prenom']?></var<br/>
        </p>
        <p>
          <label>Nom : </label>
          <var><?=$_SESSION['userinfo']['nom']?></var<br/>
        </p>
        <p>
          <label>Email : </label>
          <var><?=$_SESSION['userinfo']['mail']?></var><br/>
        </p>
        <br/>
        <p>Pour changer votre mot de passe</p><br/>
        <p>
          <label style="width: 180px">Ancien mot de passe</label>
          <input type="password" size="80" name="oldpasswd" value=""/><br/>
        </p><br/>
        <p>
          <label style="width: 180px">Nouveau mot de passe</label>
          <input type="password" size="80" name="passwd1" value=""/><br/>
        </p><br/>
        <p>
          <label style="width: 180px">Confirmer le mot de passe</label>
          <input type="password" size="80" name="passwd2" value=""/><br/>
        </p><br/>
        <input style="margin-left: 400px; width: 40px; height: 25px" type="submit" size="80" name="submit" value="OK">
      </form>
</div>
<div>
  <?
    require('message.php');

  ?>
</div>
