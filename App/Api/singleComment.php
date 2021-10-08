<?php
namespace App\Api;
use \App\Database\Database;
use \App\Models\Comment;
require_once("../../vendor/autoload.php");
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$database = new Database();
$db = $database->connect();

$comment = new Comment($db);

$comment->id = isset($_GET['id']) ? $_GET['id'] : die();

$comment->read_single();

$comment_arr = array(
    'id' => $comment->id,
    'mentor_id' => $comment->mentorId,
    'intern_id' => $comment->internId,
    'Comment' => $comment->comment,
    'createdAt' => $comment->createdAt
);

print_r(json_encode($comment_arr));