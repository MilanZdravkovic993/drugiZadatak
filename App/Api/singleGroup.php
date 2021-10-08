<?php
namespace App\Api;
use \App\Database\Database;
use \App\Models\Group;
require_once("../../vendor/autoload.php");
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$database = new Database();
$db = $database->connect();

$group = new Group($db);

$group->id = isset($_GET['id']) ? $_GET['id'] : die();

$group->read_single();

$group_arr = array(
    'id' => $group->id,
    'name' => $group->name
);

print_r (json_encode($group_arr));