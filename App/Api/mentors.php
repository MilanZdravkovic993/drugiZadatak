<?php
namespace App\Api;
use \App\Database\Database;
use \App\Models\Mentor;
use \PDO;
require_once("../../vendor/autoload.php");
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



$database = new Database();
$db = $database->connect();

$mentor = new Mentor($db);

$result = $mentor->read();
$num = $result->rowCount();

if($num > 0 ){
    $mentor_arr = array();
    $mentor_arr['data']=array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $mentor_item = array(
            'id' => $id,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'group_id' => $group_id,
            'groupName' => $groupName,
        );
        array_push($mentor_arr['data'], $mentor_item);
    }
echo json_encode($mentor_arr);


}
else {
echo json_encode(
    array('message' => 'no mentors found')
);
}