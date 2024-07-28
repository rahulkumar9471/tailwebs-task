<?php

require_once __DIR__ . '/../config/Database.php';

class StudentController
{
    private $db;
    private $conn;

    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->connection();
    }

    private function validateInputs($name, $subject, $mark)
    {
        if (empty($name)) {
            return ['status' => 'error', 'message' => 'Name is required.'];
        }
        if (empty($subject)) {
            return ['status' => 'error', 'message' => 'Subject is required.'];
        }
        if (!is_numeric($mark) || $mark < 0) {
            return ['status' => 'error', 'message' => 'Mark must be a numeric value and cannot be negative.'];
        }
        return null;
    }

    public function getStudents()
    {
        try {
            $query = "SELECT * FROM students";
            $result = $this->conn->query($query);

            $students = [];
            if ($result->num_rows > 0) {
                $students = $result->fetch_all(MYSQLI_ASSOC);
            }

            return $students;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function newStudent($name, $subject, $mark)
    {
        $validation = $this->validateInputs($name, $subject, $mark);
        if ($validation) {
            return json_encode($validation);
        }

        try {
            $name = $this->conn->real_escape_string($name);
            $subject = $this->conn->real_escape_string($subject);
            $mark = (int)$mark;

            $check = $this->conn->prepare("SELECT * FROM students WHERE name = ? AND subject = ?");
            $check->bind_param("ss", $name, $subject);
            $check->execute();
            $result = $check->get_result();

            if ($result->num_rows > 0) {
                $existingStudent = $result->fetch_assoc();
                $newMarks = $existingStudent['mark'] + $mark;

                $updateQuery = $this->conn->prepare("UPDATE students SET mark= ? WHERE id = ?");
                $updateQuery->bind_param("ii", $newMarks, $existingStudent['id']);
                $updateQuery->execute();

                return json_encode(['status' => 'success', 'message' => 'Student updated successfully.']);
            } else {
                $insertQuery = $this->conn->prepare("INSERT INTO students (name, subject, mark) VALUES (?, ?, ?)");
                $insertQuery->bind_param("ssi", $name, $subject, $mark);
                if ($insertQuery->execute()) {
                    return json_encode(['status' => 'success', 'message' => 'New student added successfully.']);
                } else {
                    return json_encode(['status' => 'error', 'message' => 'Failed to add student: ' . $this->conn->error]);
                }
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return json_encode(['status' => 'error', 'message' => 'Error occurred while adding/Updating student.']);
        }
    }

    public function getStudentById($id)
    {
        try {
            $id = (int)$id;

            $getInfo = $this->conn->prepare("SELECT * FROM students WHERE id = ?");
            $getInfo->bind_param("i", $id);
            $getInfo->execute();
            $result = $getInfo->get_result();

            if ($result && $result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return null;
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function updateStudent($id, $name, $subject, $mark)
    {
        $validation = $this->validateInputs($name, $subject, $mark);
        if ($validation) {
            return json_encode($validation);
        }

        try {
            $check = $this->conn->prepare("SELECT * FROM students WHERE id = ?");
            $check->bind_param("i", $id);
            $check->execute();
            $result = $check->get_result();

            if ($result->num_rows > 0) {
                $name = $this->conn->real_escape_string($name);
                $subject = $this->conn->real_escape_string($subject);
                $mark = (int)$mark;

                $updateQuery = $this->conn->prepare("UPDATE students SET name=?, subject=?, mark=? WHERE id=?");
                $updateQuery->bind_param("ssii", $name, $subject, $mark, $id);
                $updateQuery->execute();

                return json_encode(['status' => 'success', 'message' => 'Student updated successfully.']);
            } else {
                return json_encode(['status' => 'error', 'message' => 'Student not found.']);
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return json_encode(['status' => 'error', 'message' => 'Error occurred while updating student.']);
        }
    }

    public function deleteStudent($id)
    {
        try {
            $id = (int)$id;

            $deleteQuery = $this->conn->prepare("DELETE FROM students WHERE id = ?");
            $deleteQuery->bind_param("i", $id);
            $deleteQuery->execute();

            if ($deleteQuery->affected_rows > 0) {
                return json_encode(['status' => 'success', 'message' => 'One Record Deleted successfully.']);
            } else {
                return json_encode(['status' => 'error', 'message' => 'Failed to delete record.']);
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return json_encode(['status' => 'error', 'message' => 'Error occurred while deleting record.']);
        }
    }
}
