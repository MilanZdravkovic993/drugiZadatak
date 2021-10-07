<?php
namespace App\Api;
use \App\Database\Database;
use \App\Models\Group;
use \PDO;
require_once("../../vendor/autoload.php");
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



$database = new Database();
$db = $database->connect();

$group = new Group($db);

$result = $group->read();
$num = $result->rowCount();

if($num > 0 ){
    $group_arr = array();
    $group_arr['data']=array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $group_item = array(
            'id' => $id,
            'name' => $name
        );
        array_push($group_arr['data'], $group_item);
    }
echo json_encode($group_arr);


}
else {
echo json_encode(
    array('message' => 'no interns found')
);
}