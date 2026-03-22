<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the comment class
// This allows us to use its structure and function
$comment = new Comment($db);

$comment->comment_id =  isset($_GET["comment_id"]) ? $_GET["comment_id"]: die();

$result = $comment->readSingle();
$num = $result->rowCount();


   if($num > 0){
   $comment_info = array(
    'comment'      =>$comment->comment,
    'user_id'      =>$comment->user_id,
    'post_id'      =>$comment->post_id,
    
   );
   print_r(json_encode($comment_info));
} 
   

else{
    echo json_encode(array("message"=>"No comment found."));
}

?>