<?php
namespace App\Api;
use \App\Database\Database;
use \App\Models\Intern;
require_once("../../vendor/autoload.php");
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$database = new Database();
$db = $database->connect();

$intern = new Intern($db);

$intern->id = isset($_GET['id']) ? $_GET['id'] : die();

$intern->read_single();

$intern_arr = array(
    'id' => $intern->id,
    'firstName' => $intern->firstName,
    'lastName' => $intern->lastName,
    'group_id' => $intern->groupId,
    'groupName' => $intern->groupName
);

print_r(json_encode($intern_arr));