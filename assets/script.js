document.addEventListener("DOMContentLoaded", function () {
  var form = document.getElementById("studentForm");
  var modal = document.getElementById("addStudentModal");
  var btn = document.getElementById("openModalBtn");
  var span = document.getElementsByClassName("close")[0];

  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();

      var id = document.getElementById("id")?.value.trim();
      var name = document.getElementById("name").value.trim();
      var subject = document.getElementById("subject").value.trim();
      var marks = document.getElementById("marks").value.trim();

      if (!name || !subject || !marks) {
        displayMessage("All fields are required.", "red");
        return;
      }

      var data =
        "name=" +
        encodeURIComponent(name) +
        "&subject=" +
        encodeURIComponent(subject) +
        "&marks=" +
        encodeURIComponent(marks);
      if (id) {
        data = "id=" + encodeURIComponent(id) + "&" + data;
      }

      var xhr = new XMLHttpRequest();
      xhr.open(
        "POST",
        "./action/" + (id ? "updatestudent.php" : "addorupdate.php"),
        true
      );
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onload = function () {
        try {
          var jsonResponse = JSON.parse(xhr.responseText);
          displayMessage(jsonResponse.message,jsonResponse.status === "success" ? "green" : "red", jsonResponse.status === "success"
          );
        } catch (e) {
          displayMessage("An unexpected error occurred.", "red");
        }
      };

      xhr.send(data);
    });
  }

  if (btn) {
    btn.onclick = function () {
      modal.style.display = "block";
    };
  }

  if (span) {
    span.onclick = function () {
      modal.style.display = "none";
    };
  }

  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
});
