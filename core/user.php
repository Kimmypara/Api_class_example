<?php

class User{
    // db related properties
private $conn;
private $table ="users";
private $alias = "u";

    // table fields
public $user_id;
public $user_name;
public $first_name;
public $last_name;
public $age;

    //constructor with db connection
    // a function that is triggered automatically when an instance of the class is created
    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        $query = "SELECT * 
            FROM {$this->table} AS {$this->alias}
            ORDER BY {$this->alias}.user_name ASC;";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
    }

}

?>