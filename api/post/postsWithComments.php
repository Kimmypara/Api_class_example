<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// instance of the Post class

$post = new Post($db);
$comment = new Comment($db);

// call the necessary function(s)
    // read function from User
$result = $post->read();
$num = $result->rowCount();

if($num > 0){
    $posts_list = array();
    $posts_list['data'] = array();


    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
       
        $comment->post_id = $post_id;
        $commentsResult = $comment-> readByPostId();

        $commentsNum = $commentsResult->rowCount();
        if($commentsNum > 0){
            $commentsList = array();
            $commentsList["data"] = array();

            while($commentRow = $commentsResult->fetch(PDO::FETCH_ASSOC)){
                extract($commentRow);
//  print_r($commentRow);
                $comment_item = array(
                    "comment_id"    => $comment_id,
                    "comment"       => $comment,
                    "user_id"    => $user_id,
                    "post_id"     => $post_id,
                    
                );
                array_push($commentsList['data'], $comment_item);
        }
        }

        $post_item = array(
            "post_id"    => $post_id,
            "title"  => $title,
            "content" => $content,
            "user_id"  => $user_id,
            "comments" => $commentsList,
        );

        array_push($posts_list['data'], $post_item);

    }

    echo json_encode($posts_list);
}
else{
    echo json_encode(array("message"=>"No posts found."));
}

    // readByUserId from Post



// structure result
// return results 

?>