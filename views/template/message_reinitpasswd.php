<?php
$subject = "Reinitialiser votre mot de passe" ;
$heading .= 'MIME-Version: 1.0' . "\r\n";
$heading .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$heading .= "From: \"Camagru\"<Camagru@mail.fr>". "\r\n";
$heading .= "Reply-to: \"Camagru\" <Camagru@mail.fr>"."\r\n";

$message = '
<html>
<head>
<title></title>
</head>
<body>
<p>Vous avez oublié votre mot de passe,</p></br>
<p>Pour le réinitialiser, veuillez cliquer sur le lien ci dessous</p>
<a href="http://localhost:8080/camagru/Controllers/ReinitPasswd.php?login='.urlencode($login).'&keyrinit='.urlencode($key).'">Regen Password</a>
<p>---------------</p>
<p>Ceci est un mail automatique, Merci de ne pas y répondre.</p>
</body>
</html>';
?>
