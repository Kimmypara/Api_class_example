<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the User class
// This allows us to use its structure and function
$user = new User($db);
//read submitted json data from request body
$data = json_decode(file_get_contents("php://input"));


$user->user_id = isset($_GET["user_id"]) ? $_GET["user_id"] :die();

if($user->delete()){
    echo json_encode(array("message" => "User deleted."));
}
else{
echo json_encode(array("message" => "User not deleted."));
    }

?>