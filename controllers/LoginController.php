<?php

require_once __DIR__ . '/../config/Database.php';

class LoginController
{
    private $db;
    private $conn;

    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->connection();
    }

    public function login($username, $password)
    {
        if (empty($username)) {
            return json_encode(['status' => 'error', 'message' => 'Username is required.']);
        }
        if (empty($password)) {
            return json_encode(['status' => 'error', 'message' => 'Password is required.']);
        }

        try {

            $username = $this->conn->real_escape_string($username);
            $password = $this->conn->real_escape_string($password);

            $stmt = $this->conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                session_start();
                $_SESSION['username'] = $username;
                return json_encode(["status" => "success", "message" => "Login successful"]);
            } else {
                return json_encode(['status' => 'error', 'message' => 'Invalid credentials.']);
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return ['status' => 'error', 'message' => 'Error occurred while logging in.'];
        }
    }
}
