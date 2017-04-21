<?php
//creation de la db

require('database.php');
require('../Classes/Connection.php');

$pdo = new PDO('mysql:host=localhost', $DB_USER, $DB_PASSWORD);

$req = 'CREATE DATABASE IF NOT EXISTS db_camagru';
$pdo->prepare($req)->execute();
$req = 'USE DATABASE db_camagru';

$link = new Connection($DB_DSN, $DB_USER, $DB_PASSWORD);

$config = file_get_contents("native_db.sql");
$query = explode (";", $config);
$query = array_filter($query);
foreach ($query as $key => $value) {
	if (strlen($value) < 2) {
		unset($query[$key]);
	}
}
foreach ($query as $elem) {
		$link->db->query($elem);
};

?>
