<?php
namespace App\Api;
use \App\Database\Database;
use \App\Models\Mentor;
require_once("../../vendor/autoload.php");
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


$database = new Database();
$db = $database->connect();

$mentor = new Mentor($db);

$data = json_decode(file_get_contents("php://input"));
$mentor->id = $data->id;
if($mentor->delete()){
    echo json_encode(
        array('message' => 'mentor deleted')
    );
}
else {
    echo json_encode(
        array('message' => 'mentor not deleted')
    );
}
