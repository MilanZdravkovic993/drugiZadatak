<?php
namespace App\Api;
use \App\Database\Database;
use \App\Models\Intern;
require_once("../../vendor/autoload.php");
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


$database = new Database();
$db = $database->connect();

$intern = new Intern($db);

$input = file_get_contents('php://input');
$data = json_decode($input);

$intern->firstName = $data->firstName;
$intern->lastName = $data->lastName;
$intern->groupId = $data->groupId;
if($intern->create()){
    echo json_encode(
        array('message' => 'intern added')
    );
}
else {
    echo json_encode(
        array('message' => 'intern not added')
    );
}
