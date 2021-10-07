<?php

namespace App\Models;
use \App\Database\Database;
use \PDO;
    class Intern {
        private $conn;
        private $table = 'interns';

        public $id;
        public $firstName;
        public $lastName;
        public $groupId;
        public $groupName;

        public function __construct($db){
            $this->conn = $db;
        }
      public function read() {
          $query = 'SELECT 
                g.name as groupName,
                i.id, 
                i.firstName,
                i.lastName,
                i.group_id
            FROM
                ' . $this->table . ' i
                LEFT JOIN
                    groups g ON i.group_id = g.id
                ORDER BY 
                i.firstName ASC' ;

                $stmt = $this->conn->prepare($query);
                $stmt->execute();
                return $stmt;
            }




        public function read_single(){
            $query = 'SELECT 
            g.name as groupName,
            i.id, 
            i.firstName,
            i.lastName,
            i.group_id
        FROM
            ' . $this->table . ' i
            LEFT JOIN
                groups g ON i.group_id = g.id
            WHERE i.id = ?
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