<?php
namespace App\Api;
use \App\Database\Database;
use \App\Models\Comment;
use \App\Models\Intern;
use \App\Models\Mentor;
require_once("../../vendor/autoload.php");
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


$database = new Database();
$db = $database->connect();

$comment = new Comment($db);

$input = file_get_contents('php://input');
$data = json_decode($input);

$comment->mentorId = $data->mentor_id;
$comment->internId = $data->intern_id;
$comment->comment = $data->Comment;


$intern = new Intern($db);
$intern->id = $comment->internId;
$intern->read_single();


$mentor = new Mentor($db);
$mentor->id = $comment->mentorId;
$mentor->read_single();

if($intern->groupId == $mentor->groupId){
    if($comment->create()){
        echo json_encode(
            array('message' => 'comment added',
                    'response' =>'200')
        );
    }
    else {
        echo json_encode(
            array('message' => 'comment not added',
            'response' =>'404')
        );
    }



}
else{
    echo "Intern is not in Mentors group";
}


