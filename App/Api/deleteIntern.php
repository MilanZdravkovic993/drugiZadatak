<?php
namespace App\Api;
use \App\Database\Database;
use \App\Models\Intern;
require_once("../../vendor/autoload.php");
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


$database = new Database();
$db = $database->connect();

$intern = new Intern($db);

$data = json_decode(file_get_contents("php://input"));
$intern->id = $data->id;
if($intern->delete()){
    echo json_encode(
        array('message' => 'intern deleted')
    );
}
else {
    echo json_encode(
        array('message' => 'intern not deleted')
    );
}
