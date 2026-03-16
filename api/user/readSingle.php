<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

include_once("../../includes/initialize.php");

// creat a new instance of the User class
// This allows us to use its structure and function
$user = new User($db);

//call new function parameter
$user->user_id =  isset($_GET["user_id"]) ? $_GET["user_id"]: die();

$result = $user->readSingle();
$num = $result->rowCount();

if($num > 0){
   $user_info = array(
    'user_id'      =>$user->user_id ,
    'user_name'    =>$user->user_name ,
    'first_name'   =>$user->first_name ,
    'last_name'    =>$user->last_name ,
    'age'          =>$user->age ,
   );
   print_r(json_encode($user_info));
}
else{
    echo json_encode(array("message"=>"No users found."));
}

?>