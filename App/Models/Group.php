<?php

namespace App\Models;
use \App\Database\Database;
use \PDO;
    class Group {
        private $conn;
        private $table = 'groups';

        public $id;
        public $name;


        public function __construct($db){
            $this->conn = $db;
        }

        /**
    
        * Read all from table groups
        */
      public function read() {
          $query = 'SELECT * FROM
                ' . $this->table;

                $stmt = $this->conn->prepare($query);
                $stmt->execute();
                return $stmt;
            }


        /**
    
        * Read single entry from table groups
     
        */

        public function read_single(){
            $query = 'SELECT * FROM
            ' . $this->table . ' WHERE id = ?
            LIMIT 0,1';


            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];
            $this->name = $row['name'];



        }

        /**
    
        * Create new entry in table groups
     
        */
        public function create(){


            $query = 'INSERT INTO ' . $this->table . '
            
                SET
                   Name = :Name';
            
            $stmt = $this->conn->prepare($query);

            $this->name = htmlspecialchars(strip_tags($this->name));


            $stmt->bindParam(':Name', $this->name);
            if($stmt->execute()){
                return true;
            }
            else{
                printf("Error: %s.\n", $stmt->error);
                return false;
            }
            
        }
        /**
    
        * Update single entry from table groups
     
        */
        public function update(){


            $query = 'UPDATE ' . $this->table . '
            
                SET
                  name = :Name
                WHERE
                    id = :id';
            
            $stmt = $this->conn->prepare($query);

            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(':Name', $this->name);
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
    
        * Delete single entry from table groups
     
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