<?php
namespace App\Api;
use \App\Database\Database;
use \App\Models\Group;
require_once("../../vendor/autoload.php");
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


$database = new Database();
$db = $database->connect();

$group = new Group($db);

$input = file_get_contents('php://input');
$data = json_decode($input);

$group->name = $data->name;

if($group->create()){
    echo json_encode(
        array('message' => 'group added')
    );
}
else {
    echo json_encode(
        array('message' => 'group not added')
    );
}
