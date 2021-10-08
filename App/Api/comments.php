<?php
namespace App\Api;
use \App\Database\Database;
use \App\Models\Comment;
use \PDO;
require_once("../../vendor/autoload.php");
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



$database = new Database();
$db = $database->connect();

$comment = new Comment($db);

$result = $comment->read();
$num = $result->rowCount();

if($num > 0 ){
    $comment_arr = array();
    $comment_arr['data']=array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $comment_item = array(
            'id' => $id,
            'mentor_id' => $mentor_id,
            'intern_id' => $intern_id,
            'Comment' => $Comment,
            'createdAt' => $createdAt
        );
        array_push($comment_arr['data'], $comment_item);
    }
echo json_encode($comment_arr);


}
else {
echo json_encode(
    array('message' => 'no interns found')
);
}