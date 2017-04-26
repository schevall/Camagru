function surligne(champ, erreur)
{
   if(erreur)
      champ.style.backgroundColor = "#fba";
   else
      champ.style.backgroundColor = "";
}

function verifPasswd(passwd1, passwd2) {

  if (passwd1.value == '' || passwd2.value == '') {
    alert('Remplir les champs mots de passe');
    return false;
  }
  else if (passwd1.value != passwd2.value) {
    alert('Ce ne sont pas les mêmes mots de passe!');
    return false;
  }
  var validpasswd = 3;
  var pass = passwd1.value
  var length = pass.length;
  if (length <= 25 && length >= 8) {
    validpasswd = 2;
  }
  var regex1 = new RegExp("[a-zA-Z]{1,24}");
  var regex2 = new RegExp("[0-9]{1,24}");
  var match1 = regex1.test(passwd1.value);
  var match2 = regex2.test(passwd1.value);
  if (match1 == true && match2 == true) {
    validpasswd = validpasswd - 2;
  }
  if (passwd1.value == passwd2.value && validpasswd == 0) {
    return true;
  }
  else {
    alert("Votre mot de passe n'est pas assez sécurisé");
    return false;
  }
}

  function verifPseudo(champ)
  {
     if(champ.value.length < 4 || champ.value.length > 25)
     {
       surligne(champ, true);
       return false;
     }
     else
     {
        surligne(champ, false);
        return true;
     }
  }

  function verifMail(champ)
  {
     var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
     if(!regex.test(champ.value))
     {
       surligne(champ, true);
       return false;
     }
     else
     {
       surligne(champ, false);
       return true;
     }
  }

function verifNom(nom, prenom) {
  if (nom.value == '' || prenom.value == '') {
    surligne(nom, true);
    surligne(prenom, true);
    return false;
  }
  else {
    surligne(prenom, false);
    return true;
  }
}

  function verifForm(f)
  {
     var pseudoOk = verifPseudo(f.login);
     var mailOk = verifMail(f.mail);
     var passwdOK = verifPasswd(f.passwd1, f.passwd2);
     var nomOK = verifNom(f.nom, f.prenom);

     if(pseudoOk && mailOk && passwdOK && nomOk)
        return true;
     else
     {
        alert("Veuillez remplir correctement tous les champs pour vous inscrire");
        return false;
     }
  }

function verif_modif_user(f) {
    var passwdOK = verifPasswd(f.passwd1, f.passwd2);
    if (f.oldpasswd.value === '')
      passwdOK = false;
    if(passwdOK)
      return true;
    else
      return false;
}

function verif_login(f) {
  if (f.login.value === '' || f.passwd.value === ''){
    alert("Veuillez remplir correctement tous les champs pour vour connecter")
    return false;
  }
  else {
    return true;
  }

}
