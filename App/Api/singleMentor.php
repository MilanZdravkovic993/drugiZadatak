<?php
namespace App\Api;
use \App\Database\Database;
use \App\Models\Mentor;
require_once("../../vendor/autoload.php");
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$database = new Database();
$db = $database->connect();

$mentor = new Mentor($db);

$mentor->id = isset($_GET['id']) ? $_GET['id'] : die();

$mentor->read_single();

$mentor_arr = array(
    'id' => $mentor->id,
    'firstName' => $mentor->firstName,
    'lastName' => $mentor->lastName,
    'group_id' => $mentor->groupId,
    'groupName' => $mentor->groupName
);

echo (json_encode($mentor_arr));