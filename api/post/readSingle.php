<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the post class
// This allows us to use its structure and function
$post = new Post($db);

$post->post_id =  isset($_GET["post_id"]) ? $_GET["post_id"]: die();

$result = $post->readSingle();
$num = $result->rowCount();


   if($num > 0){
   $post_info = array(
    'title'      =>$post->title ,
    'content'      =>$post->content ,
    'user_id'      =>$post->user_id ,
    
   );
   print_r(json_encode($post_info));
} 
   

else{
    echo json_encode(array("message"=>"No posts found."));
}

?>