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
            ORDER BY {$this->alias}.comment ASC;";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
    }




    // read a single post record by Id
    public function readSingle(){
        $query = "SELECT *
        FROM {$this->table} AS {$this->alias}
        WHERE {$this->alias}.comment_id = ?
        LIMIT 1;";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->comment_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row > 0){
            $this->comment = $row["comment"];
            $this->user_id = $row["user_id"];
            $this->post_id  = $row["post_id"];
            
        }

        return $stmt;
    }

     // create a new comment record
public function create(){
    $query = "INSERT INTO {$this->table}
    (comment, user_id , post_id)
    VALUES (:comment,:user_id, :post_id);";

    $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->comment = htmlspecialchars(strip_tags($this->comment));
    $this->user_id = htmlspecialchars(strip_tags($this->user_id));
    $this->post_id = htmlspecialchars(strip_tags($this->post_id));

    // bind parameters to sql statement
    $stmt->bindParam(":comment", $this->comment);
    $stmt->bindParam(":user_id", $this->user_id);
    $stmt->bindParam(":post_id", $this->post_id);

    
    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}

//update
public function update(){
   $query = "UPDATE {$this->table}
            SET comment =:comment,
                user_id = :user_id,
                post_id = :post_id
                WHERE comment_id = :comment_id;";
    $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->comment_id = htmlspecialchars(strip_tags($this->comment_id));
    $this->comment = htmlspecialchars(strip_tags($this->comment));
    $this->user_id = htmlspecialchars(strip_tags($this->user_id));
    $this->post_id = htmlspecialchars(strip_tags($this->post_id));

    // bind parameters to sql statement
    $stmt->bindParam(":comment_id", $this->comment_id);
    $stmt->bindParam(":comment", $this->comment);
    $stmt->bindParam(":user_id", $this->user_id);
    $stmt->bindParam(":post_id", $this->post_id);

    
    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}

//update comment
public function updateComment(){
   $query = "UPDATE {$this->table}
            SET comment =:comment
                WHERE comment_id = :comment_id;";
    $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->comment_id = htmlspecialchars(strip_tags($this->comment_id));
    $this->comment = htmlspecialchars(strip_tags($this->comment));

    // bind parameters to sql statement
    $stmt->bindParam(":comment_id", $this->comment_id);
    $stmt->bindParam(":comment", $this->comment);

    
    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}

    // Read all comments records created by a single post
    Public function readByPostId(){
$query = "SELECT *
        FROM {$this->table} AS {$this->alias}
        WHERE {$this->alias}.post_id = ?;";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->post_id);
        $stmt->execute();

        return $stmt;
    }

}

?>