<?php
// database.php
// This file is used to connect to the database

// Create a new connection to the database
    class database {
        public $conn;
        public function __construct() {
            $conn = new mysqli("localhost", "root", "", "electrogadgets");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }else{
                $this->conn = $conn;
            }
        }
        public function getConnection() {
            return $this->conn;
        }
    }

    ?>

