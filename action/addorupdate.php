<?php
require_once __DIR__ . '/../controllers/StudentController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['name'], $_POST['subject'], $_POST['marks'])) {
        $name = trim($_POST['name']);
        $subject = trim($_POST['subject']);
        $marks = trim($_POST['marks']);

        $studentController = new StudentController();
        $response = $studentController->newStudent($name, $subject, $marks);

        header('Content-Type: application/json');
        echo $response;
    } else {

        echo "<script>window.location.href='../?msg=error'</script>";
    }
} else {

    echo "<script>window.location.href='../?msg=error'</script>";
}
