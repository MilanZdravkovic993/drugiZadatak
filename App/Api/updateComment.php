<?php
namespace App\Api;
use \App\Database\Database;
use \App\Models\Comment;
require_once("../../vendor/autoload.php");
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


$database = new Database();
$db = $database->connect();

$comment = new Comment($db);

$input = file_get_contents('php://input');
$data = json_decode($input);

$comment->id = $data->id;
$comment->mentorId = $data->mentor_id;
$comment->internId = $data->intern_id;
$comment->comment = $data->Comment;


if($comment->update()){
    echo json_encode(
        array('message' => 'comment updated',
              'response' => '200')
    );
}
else {
    echo json_encode(
        array('message' => 'comment not updated',
              'response' => '404')
    );
}
