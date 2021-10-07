<?php
namespace App\Api;
use \App\Database\Database;
use \App\Models\Mentor;
require_once("../../vendor/autoload.php");
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


$database = new Database();
$db = $database->connect();

$mentor = new Mentor($db);

$input = file_get_contents('php://input');
$data = json_decode($input);

$mentor->id = $data->id;
$mentor->firstName = $data->firstName;
$mentor->lastName = $data->lastName;
$mentor->groupId = $data->groupId;

if($mentor->update()){
    echo json_encode(
        array('message' => 'mentor updated')
    );
}
else {
    echo json_encode(
        array('message' => 'mentor not updated')
    );
}
