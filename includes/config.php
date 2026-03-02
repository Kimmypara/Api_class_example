<?php
//this file is database connection
$db_user = 'root';
$db_password = '';
$db_name = 'api_2026';

//PDO = PHP Data Objects
//Used for Objects Oriented Programming
//Creating an 'Object' makes our codemore organised
$db = new PDO(
    'mysql:host=127.0.0.1;dbname='.$db_name.';charset=ut8',
    $db_user,
    $db_password
);

//set same attributes
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>