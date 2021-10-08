<?php
namespace App\Api;
use \App\Database\Database;
use \App\Models\Group;
use \App\Models\Intern;
use \App\Models\Mentor;
use \PDO;
require_once("../../vendor/autoload.php");
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$database = new Database();
$db = $database->connect();

$group = new Group($db);
$mentor = new Mentor($db);
$intern = new Intern($db);

$group->id = isset($_GET['id']) ? $_GET['id'] : die();
$mentor->groupId = $group->id;
$intern->groupId = $group->id;

$group->read_single();

$group_arr = array(
    'id' => $group->id,
    'name' => $group->name
);
print_r (json_encode($group_arr));


$result = $intern->readInternsFromGroup();
$num = $result->rowCount();

if($num > 0 ){
    $intern_arr = array();
    $intern_arr['data']=array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $intern_item = array(
            'id' => $id,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'group_id' => $group_id
        );
        array_push($intern_arr['data'], $intern_item);
    }



}
else {
echo json_encode(
    array('message' => 'no interns found')
);
}
echo json_encode($intern_arr);