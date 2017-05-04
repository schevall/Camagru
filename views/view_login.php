<div style="display: inline-flex">
</br><div style="margin: 15px 3vw">
    <h2>Connectez vous</h2>
    <form method='post' action='Controllers/login.php' onSubmit="return verif_login(this)">
      <div style="width: 150px">*Login :<input style="width: 200px; height: 25px" type="text" size="80" name="login" value=""/></div>
      <div style="width: 150px">*Mot de passe :<input style="width: 200px; height: 25px" type="password" size="80" name="passwd" value=""/></div></br>
      <div><input style="width: 200px; height: 25px" type="submit" size="80" name="submit" value="OK"></div></br>
    </form>
  </div>
</br><div style="margin: 15px 0">
    <h2>Oublie de mot de passe</h2>
    <form method='post' action='Controllers/SendReinitMail.php'>
      <div style="width: 150px">*Login :<input style="width: 200px; height: 25px" type="text" size="80" name="login" value=""/></div>
      <div style="width: 150px">*email :<input style="width: 200px; height: 25px" type="email" size="80" name="email" value=""/></div></br>
      <div><input style="width: 200px; height: 25px" type="submit" size="80" name="submit" value="OK"></div></br></form>
  </div>
</div>
