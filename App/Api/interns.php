<?php
namespace App\Api;
use \App\Database\Database;
use \App\Models\Intern;
use \PDO;
require_once("../../vendor/autoload.php");
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



$database = new Database();
$db = $database->connect();

$intern = new Intern($db);

$result = $intern->read();
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
            'group_id' => $group_id,
            'groupName' => $groupName,
        );
        array_push($intern_arr['data'], $intern_item);
    }
echo json_encode($intern_arr);


}
else {
echo json_encode(
    array('message' => 'no interns found')
);
}