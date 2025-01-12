<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .admin-home-container {
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
        }
        .admin-home-container h1 {
            margin-bottom: 30px;
        }
        .admin-home-container .btn {
            margin: 10px;
        }
    </style>
</head>
<body>
    <div class="admin-home-container">
        <h1>Admin Home</h1>
        <a href="add_student.php" class="btn btn-primary">Add New Student</a>
        <a href="download_students.php" class="btn btn-success">Download Student Details</a>
        <a href="thankyou.php" class="btn btn-secondary">Exit</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
