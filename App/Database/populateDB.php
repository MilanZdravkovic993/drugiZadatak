<?php
namespace App\Database;
use \App\Database\Database;
use App\Models\Group;
use \App\Models\Intern;
use \App\Models\Mentor;
require_once("../../vendor/autoload.php");

        /**
    
        * Create random combinations of names and last names and populate db with them
     
        */
$names=array("Joe","Marcus","Ivan","Jovan","Marco","Darko","Peter","Joshua","Lisa","Bart");
$lastNames=array("Smith","Rangu","Paul","Anderson","Cartman","Ann","Zidane","Ronaldo","O'neil","Brayant");
$groups = array("BackEnd1","BackEnd2","FrontEnd1","FrontEnd2");

$database = new Database();
$db = $database->connect();

$intern = new Intern($db);


for($i=0;$i<10;$i++)
{
    $first=rand(0,9);
    $second=rand(0,9);

    $intern->firstName = $names[$first];
    $intern->lastName = $names[$second];
    $intern->groupId = rand(1,4);
    
    $intern->create();
}

$mentor = new Mentor($db);
for($i=0;$i<5;$i++)
{
    $first=rand(0,9);
    $second=rand(0,9);

    $mentor->firstName = $names[$first];
    $mentor->lastName = $names[$second];
    $mentor->groupId = rand(1,4);
    
    $mentor->create();
}

$group = new Group($db);
for($i=0;$i<4;$i++)
{
    $group->name = $groups[$i];
    $group->create();
}

?>