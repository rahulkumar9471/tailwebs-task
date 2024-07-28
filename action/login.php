<?php
require_once __DIR__ . '/../controllers/LoginController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['username'], $_POST['password'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);


        $LoginController = new LoginController();
        $response = $LoginController->login($username, $password);

        header('Content-Type: application/json');
        echo $response;
    } else {

        echo "<script>window.location.href='../?msg=error'</script>";
    }
} else {

    echo "<script>window.location.href='../?msg=error'</script>";
}
