<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the post class
// This allows us to use its structure and function
$post = new Post($db);

$result = $post->read();
$num = $result->rowCount();

if($num > 0){
    $posts_list = array();
    $posts_list['data'] = array();


    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $post_item = array(
            "post_id "    => $post_id ,
            "title"       => $title,
            "content"     => $content,
            "user_id "    => $user_id ,
            
        );

        array_push($posts_list['data'], $post_item);
    }

    echo json_encode($posts_list);
}
else{
    echo json_encode(array("message"=>"No posts found."));
}

?>