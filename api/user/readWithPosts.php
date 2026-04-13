<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// instance of the User class
$user = new User($db);
$post = new Post($db);

// call the necessary function(s)
    // read function from User
$result = $user->read();
$num = $result->rowCount();

if($num > 0){
    $users_list = array();
    $users_list['data'] = array();


    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $post-> user_id = $user_id;
        $postsResult = $post-> readByUserId();

        $postsNum = $postsResult->rowCount();
        if($postsNum >0){
            $postsList = array();
            $postsList["data"] = array();

            while($postRow = $postsResult->fetch(PDO::FETCH_ASSOC)){
                extract($postRow);

                $post_item = array(
                    "post_id"    => $post_id ,
                    "title"       => $title,
                    "content"     => $content,
                    "user_id"    => $user_id ,
                );
                array_push($postsList['data'], $post_item);
        }
        }

        $user_item = array(
            "user_id"    => $user_id,
            "user_name"  => $user_name,
            "first_name" => $first_name,
            "last_name"  => $last_name,
            "age"        => $age,
            "posts"      => $postsList
        );

        array_push($users_list['data'], $user_item);

    }

    echo json_encode($users_list);
}
else{
    echo json_encode(array("message"=>"No users found."));
}

    // readByUserId from Post



// structure result
// return results 

?>