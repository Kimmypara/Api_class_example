<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the User class
// This allows us to use its structure and function
$user = new User($db);
//read submitted json data from request body
$data = json_decode(file_get_contents("php://input"));

// fill in user instance properties with decoded values from request
$user->user_id = $data->user_id;
$user->user_name = $data->user_name;
$user->first_name = $data->first_name;
$user->last_name = $data->last_name;
$user->age = $data->age;

if($user->update()){
    echo json_encode(array("message" => "User updated."));
}
else{
echo json_encode(array("message" => "User not updated."));
    }

?>