<?php

namespace App\Models;
use \App\Database\Database;
use \App\Models\Intern;
use \App\Models\Mentor;
use \PDO;
    class Comment {
        private $conn;
        private $table = 'comments';

        public $id;
        public $mentorId;
        public $internId;
        public $comment;
        public $createdAt;

        public function __construct($db){
            $this->conn = $db;
        }
      public function read() {
          $query = 'SELECT * FROM
                ' . $this->table;

                $stmt = $this->conn->prepare($query);
                $stmt->execute();
                return $stmt;
            }




        public function read_single(){
            $query = 'SELECT * FROM
            ' . $this->table . ' WHERE id = ?
            LIMIT 0,1';


            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];
            $this->name = $row['Name'];



        }


        public function create(){


            $query = 'INSERT INTO ' . $this->table . '
            
                SET
                   mentor_id = :mentor_id,
                   intern_id = :intern_id,
                   Comment = :Comment';

            
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

        public function update(){


            $query = 'UPDATE ' . $this->table . '
            
                SET
                  Name = :Name, 
                WHERE
                    id = :id';
            
            $stmt = $this->conn->prepare($query);

            $this->Name = htmlspecialchars(strip_tags($this->name));
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