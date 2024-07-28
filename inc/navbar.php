<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/custom.css" />
    <title>tailwebs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <header class="header">
        <nav class="navbar">
            <div class="logo">
                <a href="./">
                    <h1>tailwebs.</h1>
                </a>
            </div>
            <div>
                <ul class="nav-menu">
                    <li class="login-button">
                        <a href="./" class="btn-login">Home</a>
                    </li>
                    <?php
                    if (!isset($_SESSION['username'])) { ?>
                        <li class="login-button">
                            <a href="./login.php" class="btn-login">Login</a>
                        </li>
                    <?php } else { ?>
                        <li class="login-button">
                            <a href="./action/logout.php" class="btn-login">Logout</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </header>