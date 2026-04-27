<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, "http://localhost/API_class_example/api/user/read.php");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Accept"=> "application/json",
        "Content-Type"=> "application/json"

    ]);

    $result = curl_exec($curl);

    curl_close($curl);
   //echo $result;
    $result = json_decode($result, true);
    $data = $result["data"];
   
    foreach($data as $user){
        echo "<div style='border:1px solid black';>";
        echo "<h2>{$user['user_name']}</h2>";
        echo "<p>{$user['first_name']} {$user['last_name']}</p>";
        echo "</div";
        

    }

    





?>
  
<?php

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, "http://localhost/API_class_example/api/post/read.php");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Accept"=> "application/json",
        "Content-Type"=> "application/json"

    ]);

    $result = curl_exec($curl);

    curl_close($curl);
   //echo $result;
    $result = json_decode($result, true);
    $data = $result["data"];
   
    foreach($data as $post){
        echo "<div style='border:1px solid black';>";
        echo "<h2>{$post['title']}</h2>";
        echo "<p>{$post['content']}</p>";
        echo "</div";
        

    }

    





?>
</body>
</html>