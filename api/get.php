<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__.'/../config/database.php';
require_once __DIR__.'/../class/person.php';

$database = new Database();
$db = $database->getConnection();
$items = new Person($db);

$stmt = $items->getPeople();
$itemCount = $stmt->rowCount();
echo json_encode($itemCount);

if($itemCount > 0) {

    $peopleArr = array();
    $peopleArr["body"] = array();
    $peopleArr["itemCount"] = $itemCount;

    while($row = $stmt->fetch_array(MYSQLI_ASSOC)) {
        extract($row);
        $e = array(
            "id" => $id,
            "name" => $name,
            "email" => $email,
            "creation" => $creation
        );
        array_push($peopleArr["body"], $e);
    }

} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}