<?php

class Post{
    // db related properties
private $conn;
private $table ="post";
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

    // Read all Post records created by a single User
    Public function readByUserId(){
$query = "SELECT *
        FROM {$this->table} AS {$this->alias}
        WHERE {$this->alias}.user_id = ?
        LIMIT 1;";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->user_id);
        $stmt->execute();

        return $stmt;
    }

         // create a new post record
public function create(){
    $query = "INSERT INTO {$this->table}
    (title, content , user_id )
    VALUES (:title,:content, :user_id);";

    $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->title = htmlspecialchars(strip_tags($this->title));
    $this->content = htmlspecialchars(strip_tags($this->content));
    $this->user_id  = htmlspecialchars(strip_tags($this->user_id ));

    // bind parameters to sql statement
    $stmt->bindParam(":title", $this->title);
    $stmt->bindParam(":content", $this->content);
    $stmt->bindParam(":user_id", $this->user_id);

    
    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}

//update a user record
public function update(){
    $query = "UPDATE {$this->table}
            SET title =:title,
                content = :content,
                user_id = :user_id
                WHERE post_id = :post_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->post_id = htmlspecialchars(strip_tags($this->post_id));
    $this->title = htmlspecialchars(strip_tags($this->title));
    $this->content = htmlspecialchars(strip_tags($this->content));
    $this->user_id  = htmlspecialchars(strip_tags($this->user_id ));

    // bind parameters to sql statement
    $stmt->bindParam(":post_id", $this->post_id);
    $stmt->bindParam(":title", $this->title);
    $stmt->bindParam(":content", $this->content);
    $stmt->bindParam(":user_id", $this->user_id );

    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}

//update title of a user record
public function updateTitle(){
    $query = "UPDATE {$this->table}
            SET title = :title
                WHERE post_id = :post_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->post_id = htmlspecialchars(strip_tags($this->post_id));
    $this->title = htmlspecialchars(strip_tags($this->title));

    // bind parameters to sql statement
    $stmt->bindParam(":post_id", $this->post_id);
    $stmt->bindParam(":title", $this->title);

    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}

}

?>