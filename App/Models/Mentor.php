<?php

namespace App\Models;
use \App\Database\Database;
use \PDO;
    class Mentor {

    
        private $conn;
        private $table = 'mentors';

        public $id;
        public $firstName;
        public $lastName;
        public $groupId;
        public $groupName;
    /**
    
    * Class constructor 
     
    */
        public function __construct($db){
            $this->conn = $db;
        }
        /**
    
        * Read all from table mentors
     
        */
      public function read() {
          $query = 'SELECT 
                g.name as groupName,
                m.id, 
                m.firstName,
                m.lastName,
                m.group_id
            FROM
                ' . $this->table . ' m
                LEFT JOIN
                    groups g ON m.group_id = g.id
                ORDER BY 
                m.firstName ASC' ;

                $stmt = $this->conn->prepare($query);
                $stmt->execute();
                return $stmt;
            }
        /**
    
        * Read single entry from table mentors by id 
     
        */
        public function read_single(){
             $query = 'SELECT 
                g.name as groupName,
                m.id, 
                m.firstName,
                m.lastName,
                m.group_id
            FROM
                ' . $this->table . ' m
                LEFT JOIN
                    groups g ON m.group_id = g.id
                WHERE m.id = ?
                LIMIT 0,1';
    
    
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(1, $this->id);
                $stmt->execute();
                
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
                $this->id = $row['id'];
                $this->firstName = $row['firstName'];
                $this->lastName = $row['lastName'];
                $this->groupId = $row['group_id'];
                $this->groupName = $row['groupName'];
    
    
    
            }
        /**
    
        * Create new entry in table mentor
     
        */
            public function create(){


                $query = 'INSERT INTO ' . $this->table . '
                
                    SET
                       firstName = :firstName,
                       lastName = :lastName,
                       group_id = :group_id';
                
                $stmt = $this->conn->prepare($query);
    
                $this->firstName = htmlspecialchars(strip_tags($this->firstName));
                $this->lastName = htmlspecialchars(strip_tags($this->lastName));
                $this->groupId = htmlspecialchars(strip_tags($this->groupId));
    
                $stmt->bindParam(':firstName', $this->firstName);
                $stmt->bindParam(':lastName', $this->lastName);
                $stmt->bindParam(':group_id', $this->groupId);
    
                if($stmt->execute()){
                    return true;
                }
                else{
                    printf("Error: %s.\n", $stmt->error);
                    return false;
                }
                
            }
        /**
    
        * Update single entry from table mentors
     
        */
            public function update(){


                $query = 'UPDATE ' . $this->table . '
                
                    SET
                       firstName = :firstName,
                       lastName = :lastName,
                       group_id = :group_id
                       
                    WHERE
                        id = :id';
                
                $stmt = $this->conn->prepare($query);
    
                $this->firstName = htmlspecialchars(strip_tags($this->firstName));
                $this->lastName = htmlspecialchars(strip_tags($this->lastName));
                $this->groupId = htmlspecialchars(strip_tags($this->groupId));
                $this->id = htmlspecialchars(strip_tags($this->id));
    
                $stmt->bindParam(':firstName', $this->firstName);
                $stmt->bindParam(':lastName', $this->lastName);
                $stmt->bindParam(':group_id', $this->groupId);
                $stmt->bindParam(':id', $this->id);
    
                if($stmt->execute()){
                    return true;
                }
                else{
                    printf("Error: %s.\n", $stmt->error);
                    return false;
                }
                
            }
        /**
    
        * Delete one entry from table mentors
     
        */
            public function delete(){

                $query = 'DELETE FROM ' . $this->table . ' WHERE id=:id';
                $stmt = $this->conn->prepare($query);
                $this->id = htmlspecialchars(strip_tags($this->id));
                $stmt->bindParam(':id', $this->id);
                if($stmt->execute()){
                    return true;
                }
                else{
                    printf("Error: %s.\n", $stmt->error);
                    return false;
                }
            }

    }