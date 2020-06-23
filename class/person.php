<?php

class Person {

    private $conn;
    private $db_table = "person";

    //columns
    public $id;
    public $name;
    public $email;
    public $created;

    public function __construct($db){
        $this->conn = $db;
    }

    //get all
    public function getPeople() {
        try {
            $sql = "SELECT id, name, email, created FROM ".$this->db_table.";";
            $stmt = $this->con->stmt_init();
            if(!$stmt->prepare($sql)) {
                throw new \Exception( 'Prepare failed' );
            } else {
                $stmt->execute();
            }

            $result = $stmt->get_result();
            if($row = $result->fetch_array(MYSQLI_ASSOC)) {
                return $result;
            } else {
                return null;
            }
        } catch (Exception $e) {
            die("There is an error.");
        }
    }

    //create
    public function createPerson() {
        try {
            $sql = "INSERT INTO ".$this->db_table." (name, email, created) VALUES (?, ?, ?);";
            $stmt = $this->con->stmt_init();
            if(!$stmt->prepare($sql)) {
                throw new \Exception( 'Prepare failed' );
            } else {
                //sanitize
                $this->name = htmlspecialchars(strip_tags($this->name));
                $this->email = htmlspecialchars(strip_tags($this->email));
                $this->created = htmlspecialchars(strip_tags($this->created));

                $stmt->bind_param("sss", $this->name, $this->email, $this->created);
                $stmt->execute();
            }

            $result = $stmt->get_result();
            if($row = $result->fetch_array(MYSQLI_ASSOC)) {
                return $result;
            } else {
                return null;
            }
        } catch (Exception $e) {
            die("There is an error.");
        }
    }

    //read
    public function readPerson() {
        try {
            $sql = "SELECT id, name, email, created FROM ".$this->db_table." WHERE id = ? LIMIT 0,1;";
            $stmt = $this->con->stmt_init();
            if(!$stmt->prepare($sql)) {
                throw new \Exception( 'Prepare failed' );
            } else {
                $stmt->bind_param("s", $this->_id);
                $stmt->execute();
            }

            $result = $stmt->get_result();
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $this->name = $row['name'];
            $this->email = $row['email'];
            $this->created = $row['created'];
        } catch (Exception $e) {
            die("There is an error.");
        }
    }

    //update
    public function updatePerson() {
        try {
            $sql = "UPDATE ".$this->db_table." SET name = ?, email = ?, created = ?  WHERE id = ?;";
            $stmt = $this->con->stmt_init();
            if(!$stmt->prepare($sql)) {
                throw new \Exception( 'Prepare failed' );
            } else {
                //sanitize
                $this->name = htmlspecialchars(strip_tags($this->name));
                $this->email = htmlspecialchars(strip_tags($this->email));
                $this->created = htmlspecialchars(strip_tags($this->created));

                $stmt->bind_param("ssss", $this->name, $this->email, $this->created, $this->id);
                $stmt->execute();
            }

            $result = $stmt->get_result();
            if($row = $result->fetch_array(MYSQLI_ASSOC)) {
                return $result;
            } else {
                return null;
            }
        } catch (Exception $e) {
            die("There is an error.");
        }
    }

    //delete
    public function deletePerson() {
        try {
            $sql = "DELETE FROM ".$this->db_table." WHERE id = ?;";
            $stmt = $this->con->stmt_init();
            if(!$stmt->prepare($sql)) {
                throw new \Exception( 'Prepare failed' );
            } else {
                $stmt->bind_param("s", $this->_id);
                $stmt->execute();
            }

            $result = $stmt->get_result();
            if($row = $result->fetch_array(MYSQLI_ASSOC)) {
                return $result;
            } else {
                return null;
            }
        } catch (Exception $e) {
            die("There is an error.");
        }
    }

}