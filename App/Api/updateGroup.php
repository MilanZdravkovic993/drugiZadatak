<?php
namespace App\Api;
use \App\Database\Database;
use \App\Models\Group;
require_once("../../vendor/autoload.php");
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


$database = new Database();
$db = $database->connect();

$group = new Group($db);

$input = file_get_contents('php://input');
$data = json_decode($input);

$group->id = $data->id;
$group->name = $data->name;


if($group->update()){
    echo json_encode(
        array('message' => 'group updated',
              'response' => '200')
    );
}
else {
    echo json_encode(
        array('message' => 'group not updated',
              'response' => '404')
    );
}
