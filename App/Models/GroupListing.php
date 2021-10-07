<?php

namespace App\Models;
use \App\Database\Database;
use \PDO;
    class GroupListing {
        private $conn;
        private $table = 'groups';

        public $id;
        public $name;


        public function __construct($db){
            $this->conn = $db;
        }

        public function group_listing(){
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

    }