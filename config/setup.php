<?php

require('database.php');
require('../Classes/Connection.php');

$pdo = new PDO('mysql:host=localhost', $DB_USER, $DB_PASSWORD);
$exist = False;
$req = $pdo->prepare('SHOW DATABASES');
$req->execute();
while($res = $req->fetch()) {
	if ($res['Database'] === 'db_camagru')
		$exist = True;
}
if ($exist === false) {

	$req = $pdo->prepare('CREATE DATABASE db_camagru');
	$req->execute();
	$pdo->query('USE DATABASE db_camgru');
	$link = new Connection($DB_DSN, $DB_USER, $DB_PASSWORD);
	$config = file_get_contents("native_db.sql");
	$query = explode (";", $config);
	unset($query[count($query) - 1]);
	foreach ($query as $elem) {
		$link->db->query($elem);
	};
	echo "db_camagru has been created";
}
else {
	echo "db_camagru allready exists";
}

?>
