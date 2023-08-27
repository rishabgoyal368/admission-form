<?php
include_once('db.php');
include_once('views/models/courseinfo.php');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Form</title>
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container mt-5">
        <h2>Admission Form</h2>
        <div id="message">
            <?php
            if (isset($_SESSION['success_message'])) {
                echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
                unset($_SESSION['success_message']);
            }

            ?>
        </div>

        <form action="process.php" method="POST">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Mother's Name:</label>
                        <input type="text" class="form-control" id="mother_name" name="mother_name" required>
                    </div>
                    <div class="form-group">
                        <label for="state">State:</label>
                        <select class="form-control" id="state" name="state" required>
                            <option value="">Select State</option>
                            <?php
                            $result = $conn->query("SELECT * FROM states");
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='{$row['id']}'>{$row['name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                    <div class="form-group">
                        <label>Gender:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="male" required>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="female" required>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                    </div>

                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="name">Mobile:</label>
                        <input type="number" class="form-control" id="mobile" name="mobile" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Father's Name:</label>
                        <input type="text" class="form-control" id="father_name" name="father_name" required>
                    </div>

                    <div class="form-group">
                        <label for="name">Address:</label>
                        <textarea name="address" id="" cols="30" rows="4" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <select class="form-control" id="city" name="city" required>
                            <option value="">Select City</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="age">Age:</label>
                        <input type="text" class="form-control" id="age" name="age" readonly>
                    </div>
                    <div class="form-group">
                        <label for="course">Course:</label>
                        <select class="form-control" id="course" name="course" required>
                            <option value="" selected disabled>Select Course</option>
                            <?php
                            $course_info = $conn->query("SELECT * FROM course_info");
                            while ($row = $course_info->fetch_assoc()) {
                                echo "<option value='{$row['id']}'>{$row['course_name']}</option>";
                            }
                            $conn->close();
                            ?>
                        </select>
                    </div>

                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <div class="modal fade" id="courseModal" tabindex="-1" role="dialog" aria-labelledby="courseModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="courseModalLabel">Course Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table" id="courseDetails">

                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="selectCourse">Done</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include('views/list.php');
        ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="public/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="scripts/form.js"></script>
    <script src="scripts/course.js"></script>
</body>

</html>