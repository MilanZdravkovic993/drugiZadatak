<?php
namespace App\Api;
use \App\Database\Database;
use \App\Models\GroupListing;
require_once("../../vendor/autoload.php");
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$database = new Database();
$db = $database->connect();

$group = new GroupListing($db);

$group->id = isset($_GET['id']) ? $_GET['id'] : die();

$group->group_listing();

$group_arr = array(
    'id' => $group->id,
    'groupName' => $group->name,
    'internId' => $group->internId,
    'internFirstName' => $group->internFirstName,
    'internLastName' => $group->internLastName,
    'mentorId' => $group->mentorId,
    'mentorFirstName' => $group->mentorFirstName,
    'mentorLastName' => $group->mentorLastName,

);

print_r(json_encode($group_arr));