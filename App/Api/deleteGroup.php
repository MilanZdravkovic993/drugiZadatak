<?php
namespace App\Api;
use \App\Database\Database;
use \App\Models\Group;
require_once("../../vendor/autoload.php");
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


$database = new Database();
$db = $database->connect();

$group = new Group($db);

$data = json_decode(file_get_contents("php://input"));
$group->id = $data->id;
if($group->delete()){
    echo json_encode(
        array('message' => 'group deleted',
              'response' => '200')
    );
}
else {
    echo json_encode(
        array('message' => 'group not deleted',
              'response' => '404')
    );
}
