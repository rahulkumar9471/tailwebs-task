<?php
require_once __DIR__ . '/../controllers/StudentController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = (int) $_POST['id'];

        $studentController = new StudentController();
        $result = $studentController->deleteStudent($id);

        if ($result) {
            echo "<script>window.location.href='../?msg=success'</script>";
        } else {
            echo "<script>window.location.href='../?msg=error'</script>";
        }
    } else {
        echo "<script>window.location.href='../?msg=error'</script>";
    }
} else {
    echo "<script>window.location.href='../?msg=error'</script>";
}
