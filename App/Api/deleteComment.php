<?php
namespace App\Api;
use \App\Database\Database;
use \App\Models\Comment;
require_once("../../vendor/autoload.php");
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


$database = new Database();
$db = $database->connect();

$comment = new Comment($db);

$data = json_decode(file_get_contents("php://input"));
$comment->id = $data->id;
if($comment->delete()){
    echo json_encode(
        array('message' => 'comment deleted',
              'response' => '200')
    );
}
else {
    echo json_encode(
        array('message' => 'comment not deleted',
              'response' => '404')
    );
}
