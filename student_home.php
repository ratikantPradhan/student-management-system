

<?php
session_start();

if (!isset($_SESSION['student_loggedin']) || !$_SESSION['student_loggedin']) {
    header("Location: student_login.php");
    exit();
}

$roll_no = $_SESSION['roll_no'];

$mysqli = new mysqli("localhost:3306", "root", "", "LITDB");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = $_POST['student_name'];
    $password = $_POST['password']; // Existing password or new one if changed
    $parent_name = $_POST['parent_name'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];

    $stmt = $mysqli->prepare("UPDATE Student SET StudentName=?, ParentName=?, ContactNumber=?, Email=?, Gender=?, DOB=?, Password=? WHERE RollNo=?");
    $stmt->bind_param("sssssssi", $student_name, $parent_name, $contact_number, $email, $gender, $dob, $password, $roll_no);
    $stmt->execute();
    $stmt->close();

    echo "<div class='alert alert-success' role='alert'>Details updated successfully!</div>";
}

// Fetch student details
$stmt = $mysqli->prepare("SELECT * FROM Student WHERE RollNo=?");
$stmt->bind_param("i", $roll_no);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();
$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Home</title>
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background-color: lime;">
<div class="container mt-5" style="background-color: aquamarine;">
    <h3>Student Home</h3>
    <form method="post">
        <div class="form-group">
            <label for="roll_no">Roll Number:</label>
            <input type="text" class="form-control" name="roll_no" value="<?php echo htmlspecialchars($student['RollNo']); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="student_name">Student Name:</label>
            <input type="text" class="form-control" name="student_name" value="<?php echo htmlspecialchars($student['StudentName']); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="parent_name">Parent Name:</label>
            <input type="text" class="form-control" name="parent_name" value="<?php echo htmlspecialchars($student['ParentName']); ?>">
        </div>
        <div class="form-group">
            <label for="contact_number">Contact Number:</label>
            <input type="text" class="form-control" name="contact_number" value="<?php echo htmlspecialchars($student['ContactNumber']); ?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($student['Email']); ?>">
        </div>
        <div class="form-group  form-check-inline">
            <label for="gender">Gender:</label>
                &nbsp; &nbsp;&nbsp;
                <div>
                     <input type="radio" id="male" name="gender" value="Male" <?php echo ($student['Gender'] == 'Male') ? 'checked' : ''; ?>>
                    <label for="male">Male</label>
                </div>
                &nbsp; &nbsp;&nbsp;
                <div>
                    <input type="radio" id="female" name="gender" value="Female" <?php echo ($student['Gender'] == 'Female') ? 'checked' : ''; ?>>
                    <label for="female">Female</label>
                </div>
                &nbsp; &nbsp;&nbsp;
                <div>
                    <input type="radio" id="other" name="gender" value="Other" <?php echo ($student['Gender'] == 'Other') ? 'checked' : ''; ?>>
                    <label for="other">Other</label>
                </div>
        </div>

        <div class="form-group">
            <label for="dob">Date of Birth:</label>
            <input type="date" class="form-control" name="dob" value="<?php echo htmlspecialchars($student['DOB']); ?>">
        </div>
        <div class="form-group">
            <label for="academic_year">Academic Year:</label>
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($student['AcademicYear']); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="department_name">Department Name:</label>
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($student['DepartmentName']); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="text" class="form-control" name="password" value="<?php echo htmlspecialchars($student['Password']); ?>" readonly>
        </div>
        <input type="hidden" name="password" value="<?php echo htmlspecialchars($student['Password']); ?>">
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
        <a href="student_login.php" class="btn btn-danger">Exit</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
