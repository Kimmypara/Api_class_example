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

    // read a single user record by Id
    public function readSingle(){
        $query = "SELECT *
        FROM {$this->table} AS {$this->alias}
        WHERE {$this->alias}.user_id = ?
        LIMIT 1;";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->user_id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row > 0){
            $this->user_name = $row["user_name"];
            $this->first_name = $row["first_name"];
            $this->last_name = $row["last_name"];
            $this->age = $row["age"];
        }

        return $stmt;
    }

    // create a new user record
public function create(){
    $query = "INSERT INTO {$this->table}
    (user_name, first_name, last_name, age)
    VALUES (:user_name,:first_name, :last_name, :age);";

    $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->user_name = htmlspecialchars(strip_tags($this->user_name));
    $this->first_name = htmlspecialchars(strip_tags($this->first_name));
    $this->last_name = htmlspecialchars(strip_tags($this->last_name));
    $this->age = htmlspecialchars(strip_tags($this->age));

    // bind parameters to sql statement
    $stmt->bindParam(":user_name", $this->user_name);
    $stmt->bindParam(":first_name", $this->first_name);
    $stmt->bindParam(":last_name", $this->last_name);
    $stmt->bindParam(":age", $this->age);

    
    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}

//update a user record
public function update(){
    $query = "UPDATE {$this->table}
            SET user_name =:user_name,
                first_name = :first_name,
                last_name = :last_name,
                age = :age
                WHERE user_id = :user_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->user_id = htmlspecialchars(strip_tags($this->user_id));
    $this->user_name = htmlspecialchars(strip_tags($this->user_name));
    $this->first_name = htmlspecialchars(strip_tags($this->first_name));
    $this->last_name = htmlspecialchars(strip_tags($this->last_name));
    $this->age = htmlspecialchars(strip_tags($this->age));

    // bind parameters to sql statement
    $stmt->bindParam(":user_id", $this->user_id);
    $stmt->bindParam(":user_name", $this->user_name);
    $stmt->bindParam(":first_name", $this->first_name);
    $stmt->bindParam(":last_name", $this->last_name);
    $stmt->bindParam(":age", $this->age);

    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}

//update age of a user record
public function updateAge(){
    $query = "UPDATE {$this->table}
            SET age = :age
                WHERE user_id = :user_id;";

                $stmt = $this->conn->prepare($query);

    // clean up data sent by user
    $this->user_id = htmlspecialchars(strip_tags($this->user_id));
    $this->age = htmlspecialchars(strip_tags($this->age));

    // bind parameters to sql statement
    $stmt->bindParam(":user_id", $this->user_id);
    $stmt->bindParam(":age", $this->age);

    if($stmt->execute()){
        return true;
    }
   
    printf("Error %s. \n", $stmt->error);
    
    return false;
}

}

?>