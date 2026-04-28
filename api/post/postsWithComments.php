<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// instance of the Post class

$post = new Post($db);
$commentObj = new Comment($db);

$result = $post->read();
$num = $result->rowCount();

if ($num > 0) {
    $posts_list = array();
    $posts_list['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $commentObj->post_id = $post_id;
        $commentsResult = $commentObj->readByPostId();

        $commentsList = array();
        $commentsList["data"] = array();

        while ($commentRow = $commentsResult->fetch(PDO::FETCH_ASSOC)) {
            $comment_item = array(
                "comment_id" => $commentRow["comment_id"],
                "comment"    => $commentRow["comment"],
                "user_id"    => $commentRow["user_id"],
                "post_id"    => $commentRow["post_id"]
            );

            array_push($commentsList['data'], $comment_item);
        }

        $post_item = array(
            "post_id"  => $post_id,
            "title"    => $title,
            "content"  => $content,
            "user_id"  => $user_id,
            "comments" => $commentsList
        );

        array_push($posts_list['data'], $post_item);
    }

    echo json_encode($posts_list);
} else {
    echo json_encode(array("message" => "No posts found."));
}
    // readByUserId from Post



// structure result
// return results 

?>