<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the comment class
// This allows us to use its structure and function
$comment = new Comment($db);

$data = json_decode(file_get_contents("php://input"));

// fill in user instance properties with decoded values from request
$comment->comment_id = $data->comment_id;
$comment->comment = $data->comment;
$comment->user_id = $data->user_id;
$comment->post_id = $data->post_id;


if($comment->update()){
    echo json_encode(array("message" => "Comment updated."));
}
else{
echo json_encode(array("message" => "Comment not updated."));
    }

?>