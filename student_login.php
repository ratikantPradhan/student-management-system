<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $roll_no = $_POST['roll_no'];
    $academic_year = $_POST['academic_year'];
    $password = $_POST['password'];
    
    $conn = new mysqli('localhost:3306', 'root', '', 'LITDB');
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $stmt = $conn->prepare('SELECT * FROM Student WHERE RollNo = ? AND AcademicYear = ? AND Password = ?');
    $stmt->bind_param('sss', $roll_no, $academic_year, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $_SESSION['student_loggedin'] = true;
        $_SESSION['roll_no'] = $roll_no;
        header('Location: student_home.php');
        exit;
    } else {
        $error = "Invalid Roll Number, Academic Year, or Password";
    }
    
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="text-center">Student Login</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="roll_no">Student Roll Number:</label>
                <input type="text" class="form-control" id="roll_no" name="roll_no" required>
            </div>
            <!-- <div class="form-group">
                <label for="academic_year">Acc Year:</label>
                <input type="text" class="form-control" id="academic_year" name="academic_year" required>
            </div> -->
            <div class="form-group">
                <label for="academic_year">Academic Year:</label>
                <select class="form-control" id="academic_year" name="academic_year">
                    <option selected>Choose an option</option>
                    <option value="2021-24">2021-24</option>
                    <option value="2022-25">2022-25</option>
                    <option value="2023-26">2023-26</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Student Login</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
                <a href="thankyou.php" class="btn btn-danger">Exit</a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
