<?php
include_once 'autoload.php';

$db = new models\Db;

echo $db->dbConnect();
