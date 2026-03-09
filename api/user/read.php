<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the User class
// This allows us to use its structure and function
$user = new User($db);

$result = $user->read();
$num = $result->rowCount();

if($num > 0){
    $users_list = array();
    $users_list['data'] = array();


    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $user_item = array(
            "user_id"    => $user_id,
            "user_name"  => $user_name,
            "first_name" => $first_name,
            "last_name"  => $last_name,
            "age"        => $age,
        );

        array_push($users_list['data'], $user_item);
    }

    echo json_encode($users_list);
}
else{
    echo json_encode(array("message"=>"No users found."));
}

?>