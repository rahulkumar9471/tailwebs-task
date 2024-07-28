<?php

session_start();

if (isset($_SESSION['username'])) {
    header("Location: ./");
} 

require_once 'helpers/alert.php';


?>
<?php include './inc/navbar.php'; ?>

<div class="card">
    <div class="table-container" style="width: 24rem;">
        <div class="table-body">
            <div class="table-wrapper">
                <div style="padding: 4px;">
                    <div id="message"></div>
                    <form id="login">
                        <div class="form-group">
                            <div class="input-container">
                                <label class="input-label">Username</label>
                                <input name="username" type="text" id="username" class="input-field" />
                                <div class="icon"><i class="fa-solid fa-user"></i></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-container">
                                <label class="input-label">Password</label>
                                <input name="password" id="password" type="password" class="input-field" />
                                <div class="icon"><i class="fa-solid fa-lock"></i></div>
                            </div>
                        </div>
                        <div class="modal-button-div">
                            <button type="submit" class="button">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('login').addEventListener('submit', function(event) {
        event.preventDefault();

        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        var data = "username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password);

        var xhr = new XMLHttpRequest();
        xhr.open("POST", './action/login.php', true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function() {
            try {
            var jsonResponse = JSON.parse(xhr.responseText);
            displayMessage(jsonResponse.message, jsonResponse.status === "success" ? "green" : "red", jsonResponse.status === "success");
            } catch (e) {
                displayMessage("An unexpected error occurred.");
            }
        };


        xhr.send(data);
    });
</script>
</body>

</html>