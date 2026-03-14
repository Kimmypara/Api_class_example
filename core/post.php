<?php

class Post{
    // db related properties
private $conn;
private $table ="posts";
private $alias = "p";

    // table fields
public $post_id ;
public $title;
public $content;
public $user_id ;


    //constructor with db connection
    // a function that is triggered automatically when an instance of the class is created
    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        $query = "SELECT * 
            FROM {$this->table} AS {$this->alias}
            ORDER BY {$this->alias}.title ASC;";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
    }

}

?>