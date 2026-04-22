<?php
require 'vendor/autoload.php';
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);
$app = require 'system/Test/bootstrap.php';

$db = \Config\Database::connect();
$users = $db->table('users')->get()->getResultArray();
$roles = $db->table('roles')->get()->getResultArray();

echo "ROLES:\n";
print_r($roles);
echo "\nUSERS:\n";
print_r($users);
