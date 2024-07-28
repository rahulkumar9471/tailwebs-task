<script>
    function displayMessage(message, color, reload = false) {
        var messageElement = document.getElementById('message');
        messageElement.textContent = message;
        messageElement.style.display = "block";
        setTimeout(function() {
            messageElement.style.display = "none";
            if (reload) {
                location.reload();
            }

        }, 3000);
    }
</script>