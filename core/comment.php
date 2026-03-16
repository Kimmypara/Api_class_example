<?php

class Comment{
    // db related properties
private $conn;
private $table ="comment";
private $alias = "c";

    // table fields
public $comment_id;
public $comment;
public $user_id;
public $post_id;


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




    // read a single post record by Id
    public function readSingle(){
        $query = "SELECT *
        FROM {$this->table} AS {$this->alias}
        WHERE {$this->alias}.post_id = ?
        LIMIT 1;";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->post_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row > 0){
            $this->title = $row["title"];
            $this->content = $row["content"];
            $this->user_id  = $row["user_id"];
            
        }

        return $stmt;
    }

}

?>