<?php
require_once('App/app.php');
$db = new Database();
$db->query(file_get_contents('database.sql'));
header('location: index.php');