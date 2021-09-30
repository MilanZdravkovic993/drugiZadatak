<?php

namespace App\Models;
use \App\Database\Database;
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

    }