<?php
$var = [
    'DB_HOST' => 'db',
    'DB_USERNAME' => 'docker',
    'DB_PASSWORD' => 'docker',
    'DB_NAME' => 'docker',
    'DB_PORT' => '3306'
];

foreach ($var as $key => $value) {
    putenv("$key=$value");
}
