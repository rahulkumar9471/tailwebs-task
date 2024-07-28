<?php
require_once __DIR__ . '/../controllers/StudentController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Basic input validation
    if (isset($_POST['id'], $_POST['name'], $_POST['subject'], $_POST['marks']) && is_numeric($_POST['id'])) {
        $id = (int) $_POST['id'];
        $name = trim($_POST['name']);
        $subject = trim($_POST['subject']);
        $marks = trim($_POST['marks']);

        // Further validation can be done here (e.g., validate the format of 'name', 'subject', and 'marks')

        $studentController = new StudentController();
        $result = $studentController->updateStudent($id, $name, $subject, $marks);

        // Set response headers and output the result
        header('Content-Type: application/json');
        echo $result;
    } else {
        // Invalid or missing inputs
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'error', 'message' => 'Invalid or missing inputs.'));
    }
} else {
    // Method not allowed
    header('HTTP/1.1 405 Method Not Allowed');
    header('Content-Type: application/json');
    echo json_encode(array('status' => 'error', 'message' => 'Method not allowed.'));
}
