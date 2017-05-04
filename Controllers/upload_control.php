<?php
session_start();
header('Location: ../index.php?page=photo_booth');

function verif_type($file) {
  $type = explode('/', $file['type']);
  if ($type[0] != 'image' || $type[1] != 'png')
    return False;
  else
    return True;
}


$max_size = $_POST['max_size'];
$file = $_FILES['uploaded_file'];
if ($file['size'] == 0)
  $_SESSION['error'] = "Vous n'avez pas uploadé de fichier";
else if ($file['error'] > 0)
  $_SESSION['error'] = "Erreur lors du transfert";
else if (verif_type($file) == false)
  $_SESSION['error'] = "Le fichier doit être un png";
else if ($file['size'] > $max_size)
  $_SESSION['error'] = "Votre fichier est trop grand, limite 1Mo";
else {
  return true
}
return false;

 ?>
