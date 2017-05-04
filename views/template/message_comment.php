
<?php
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.
{
	$passage_ligne = "\r\n";
}
else
{
	$passage_ligne = "\n";
}
//=====Déclaration des messages au format texte et au format HTML.
$message_txt = "Bonjour ".$receiver.", la photo ci jointe à été commentée par ".$sender.".\r\n";
$message_txt .= "Voici son commentaire:\r\n";
$message_txt .= "$comment\r\n";
// $message_html = "<html><head></head><body><b>Bonjour "."</b>, voici un e-mail envoyé par un <i>script PHP</i>.</body></html>";
//==========

//=====Lecture et mise en forme de la pièce jointe.
$filepath = "database/".$receiver."/".$id_photo.".png";
echo $filepath;
$fichier   = fopen($filepath, "r");
$attachement = fread($fichier, filesize($filepath));
$attachement = chunk_split(base64_encode($attachement));
fclose($fichier);
//==========

//=====Création de la boundary.
$boundary = "-----=".md5(rand());
$boundary_alt = "-----=".md5(rand());
//==========

//=====Définition du sujet.
$sujet = "Une de vos Photo a été commentée !";
//=========

//=====Création du header de l'e-mail.
$header = "From: \"Camagru\"<Camagru@mail.fr>".$passage_ligne;
$header.= "Reply-to: \"Camagru\"<Camagru@mail.fr>".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========

//=====Création du message.
$message = $passage_ligne."--".$boundary.$passage_ligne;
$message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
//=====Ajout du message au format texte.
$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;
//==========

// $message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
//
// //=====Ajout du message au format HTML.
// $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
// $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
// $message.= $passage_ligne.$message_html.$passage_ligne;
// //==========

// //=====On ferme la boundary alternative.
// $message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
// //==========



$message.= $passage_ligne."--".$boundary.$passage_ligne;

//=====Ajout de la pièce jointe.
$message.= "Content-Type: image/png; name=\"image.png\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: base64".$passage_ligne;
$message.= "Content-Disposition: attachment; filename=\"image.png\"".$passage_ligne;
$message.= $passage_ligne.$attachement.$passage_ligne.$passage_ligne;
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
//==========
//=====Envoi de l'e-mail.
mail($mail,$sujet,$message,$header);

//==========
?>
