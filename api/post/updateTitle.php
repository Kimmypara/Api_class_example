<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the post class
// This allows us to use its structure and function
$post = new Post($db);

$data = json_decode(file_get_contents("php://input"));

// fill in user instance properties with decoded values from request
$post->post_id = $data->post_id;
$post->title = $data->title;

if($post->updateTitle()){
    echo json_encode(array("message" => "Post title updated."));
}
else{
echo json_encode(array("message" => "Post title not updated."));
    }

?>