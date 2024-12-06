<?php
    class Connection {
        private PDO $connection;

        public function __construct() {
            $this->connection = new PDO('mysql:host=localhost;dbname=lojacliente', 'root', '');
        }
        
        public function getConnection(): PDO {
            return $this->connection; 
        }
    }
?>