<?php

class Database
{
    private $host = "localhost";
    private $db_name = "robust";
    private $username = "root";
    private $password = "";

    public $conn;

    public function  connection()
    {
        $this->conn = null;
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

            if ($this->conn->connect_error) {
                die("Connection Error" . $this->conn->connect_error);
            }

            return $this->conn;
        } catch (Exception $e) {
            echo "Connection Error: " . $e->getMessage();
        }
    }
}
