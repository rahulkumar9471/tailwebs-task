<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ./login.php");
}

require_once 'controllers/StudentController.php';
require_once 'helpers/alert.php';


$studentController = new StudentController();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $studentinfo = $studentController->getStudentById($id);
} else {
    $students = $studentController->getstudents();
}

?>
<?php include './inc/navbar.php'; ?>

<?php if (!empty($studentinfo)) : ?>


    <div class="card">
        <div class="table-container" style="width: 24rem;">
            <div class="table-body">
                <div class="table-wrapper">
                    <div style="padding: 4px;">
                        <div id="message"></div>
                        <form id="studentForm">
                            <input type="hidden" name="id" id="id" value="<?php echo htmlspecialchars($studentinfo['id']); ?>">
                            <div class="form-group">
                                <div class="input-container">
                                    <label class="input-label">Name</label>
                                    <input name="name" type="text" id="name" class="input-field" value="<?php echo htmlspecialchars($studentinfo['name']); ?>" />
                                    <div class="icon"><i class="fa-solid fa-user"></i></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-container">
                                    <label class="input-label">Subject</label>
                                    <input name="subject" id="subject" type="text" class="input-field" value="<?php echo htmlspecialchars($studentinfo['subject']); ?>" />
                                    <div class="icon"><i class="fa-solid fa-message"></i></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-container">
                                    <label class="input-label">Mark</label>
                                    <input name="name" id="marks" name="marks" type="text" class="input-field" value="<?php echo htmlspecialchars($studentinfo['mark']); ?>" />
                                    <div class="icon"><i class="fa-solid fa-marker"></i></div>
                                </div>
                            </div>
                            <div class="modal-button-div">
                                <button type="submit" class="button">Update</button>
                                <a href="./" class="cancel-button">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php else : ?>

    <div class="card">
        <div class="table-container">
            <div class="table-body">
                <div class="table-wrapper">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>subject</th>
                                <th>Mark</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($students)) :
                                foreach ($students as $index => $student) : ?>
                                    <tr>
                                        <td><?php echo ++$index; ?></td>
                                        <td><?php echo htmlspecialchars($student['name']); ?></td>
                                        <td><?php echo htmlspecialchars($student['subject']); ?></td>
                                        <td><?php echo htmlspecialchars($student['mark']); ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <div class="dropbtn">
                                                    <i class="fa-solid fa-caret-down"></i>
                                                </div>
                                                <div class="dropdown-content">
                                                    <a href="index.php?id=<?php echo $student['id']; ?>">Edit</a>
                                                    <a href="delete.php?id=<?php echo $student['id']; ?>" onclick="event.preventDefault(); 
                                                        if(confirm('Are you sure you want to delete this student?')) {
                                                            document.getElementById('delete-form-<?php echo $student['id']; ?>').submit();
                                                        }">Delete</a>
                                                </div>
                                            </div>

                                            <form id="delete-form-<?php echo $student['id']; ?>" action="./action/delete.php" method="POST" style="display: none;">
                                                <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                                            </form>

                                        </td>
                                    </tr>
                                <?php endforeach;
                            else :
                                ?>
                                <tr>
                                    <td colspan="5" style="text-align: center;">No users found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="bdiv">
        <button type="button" class="button" id="openModalBtn">Add</button>
    </div>

    <div id="addStudentModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="message"></div>
            <form id="studentForm">
                <div class="form-group">
                    <div class="input-container">
                        <label class="input-label">Name</label>
                        <input name="name" type="text" id="name" class="input-field" />
                        <div class="icon"><i class="fa-solid fa-user"></i></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-container">
                        <label class="input-label">Subject</label>
                        <input name="subject" id="subject" type="text" class="input-field" />
                        <div class="icon"><i class="fa-solid fa-message"></i></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-container">
                        <label class="input-label">Mark</label>
                        <input name="name" id="marks" name="marks" type="text" class="input-field" />
                        <div class="icon"><i class="fa-solid fa-marker"></i></div>
                    </div>
                </div>
                <div class="modal-button-div">
                    <button type="submit" class="button">Add</button>
                </div>
            </form>
        </div>
    </div>

<?php endif; ?>

<script src="./assets/script.js"></script>

</body>

</html>