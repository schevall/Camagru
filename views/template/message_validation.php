<?php
$subject = "Activer votre compte" ;
$heading  = 'MIME-Version: 1.0' . "\r\n";
$heading .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$heading .= 'From: "Camagru" <subcribe@camagru.com>' . "\r\n";

$message = '
<html>
<head>
<title></title>
</head>
<body>
<p>Bienvenue sur Camagrrrrrruuuu,</p></br>
<p>Pour activer votre compte, veuillez cliquer sur le lien ci dessous</p>
localhost:8080/camagru/Controllers/Validate.php?login='.urlencode($login).'&key='.urlencode($key).'
<p>---------------</p>
<p>Ceci est un mail automatique, Merci de ne pas y répondre.</p>
</body>
</html>';
?>
