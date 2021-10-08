<?php
namespace App\Api;
use \App\Database\Database;
use \App\Models\Intern;
use \App\Models\Comment;
use \PDO;
require_once("../../vendor/autoload.php");
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$database = new Database();
$db = $database->connect();

$intern = new Intern($db);
$comment = new Comment($db);

$intern->id = isset($_GET['id']) ? $_GET['id'] : die();
$comment->internId = ($_GET['id']);
$intern->read_single();
$result = $comment->readInternComments();
$intern_arr = array(
    'id' => $intern->id,
    'firstName' => $intern->firstName,
    'lastName' => $intern->lastName,
    'group_id' => $intern->groupId,
    'groupName' => $intern->groupName
);


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
            'createdAt' => $createdAt,
        );
        array_push($comment_arr['data'], $comment_item);
    }



}
else {
echo json_encode(
    array('message' => 'no comments found')
);
}
print_r(json_encode($intern_arr));
echo json_encode($comment_arr);