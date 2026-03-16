<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the comment class
// This allows us to use its structure and function
$comment = new Comment($db);

$result = $comment->read();
$num = $result->rowCount();

if($num > 0){
    $comments_list = array();
    $comments_list['data'] = array();


    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $comment_item = array(
            "comment_id  "    => $comment_id,
            "comment"       => $comment,
            "user_id "     => $user_id,
            "post_id  "    => $post_id,
            
        );

        array_push($comments_list['data'], $comment_item);
    }

    echo json_encode($comments_list);
}
else{
    echo json_encode(array("message"=>"No comments found."));
}

?>