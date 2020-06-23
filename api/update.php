<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once __DIR__.'/../config/database.php';
require_once __DIR__.'/../class/person.php';

$database = new Database();
$db = $database->getConnection();
$item = new Person($db);

$data = json_decode(file_get_contents("php://input"));
    
$item->id = $data->id;
    
//person values
$item->name = $data->name;
$item->email = $data->email;
$item->age = $data->age;
$item->designation = $data->designation;
$item->created = date('Y-m-d H:i:s');
    
if($item->updatePerson()){
    echo json_encode("Person data updated.");
} else{
    echo json_encode("Data could not be updated");
}