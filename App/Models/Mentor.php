<?php

namespace App\Models;
use \App\Database\Database;
    class Mentor {
        private $conn;
        private $table = 'mentors';

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

    }