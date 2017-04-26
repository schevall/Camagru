<?php session_start();?>
    <div style="margin: 0 3vw">
      <?
        require ('message.php');
      ?>
    </div>
    <div style="margin: 0 3vw">
    </br><h2>Créer son compte</h2></br>
          <form method="post" action="Controllers/createUser.php" onSubmit="return verifForm(this)">
              <p style='width: 300px'>*Login : Entre 4 et 25 Charactères<input style="width: 500px; height: 25px" type="text" size="80" name="login" onblur="verifPseudo(this)" value=""/></p>
              <br />
              <p style='width: 300px'>*Mot de passe : Votre mot de passe doit contenir au moins 8 caractères, comporter au moins un chiffre et une lettre<input style="width: 500px; height: 25px" type="password" size="80" name="passwd1" value=""/></p>
              <br />
              <p style='width: 300px'>*Confirmer le mot de passe :<input style="width: 500px; height: 25px" type="password" size="80" name="passwd2" value=""/></p>
              <br />
              <p style='width: 300px'>*Prenom :<input style="width: 500px; height: 25px" type="text" size="80" name="prenom" value=""/></p>
              <br />
              <p style='width: 300px'>*Nom :<input style="width: 500px; height: 25px" type="text" size="80" name="nom" value=""/></p>
              <br />
              <p style='width: 300px'>*Email :<input style="width: 500px; height: 25px" type="text" size="80" name="mail" onblur="verifMail(this)"/></p>
              <br />
              <input style="width: 200px; height: 25px" type="submit" size="80" name="submit" value="OK">
          </form>
    </div>
