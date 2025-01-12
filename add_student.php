<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Student</title>
</head>
<body>
    <form action="add_student_process.php" method="post">
        <label for="roll_no">Student Roll Number:</label>
        <input type="text" id="roll_no" name="roll_no" required><br><br>
        <label for="student_name">Student Name:</label>
        <input type="text" id="student_name" name="student_name" required><br><br>
        <label for="academic_year">Acc Year:</label>
        <input type="text" id="academic_year" name="academic_year" required><br><br>
        <label for="department_name">Dept Name:</label>
        <input type="text" id="department_name" name="department_name" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Add Student</button>
        <button type="reset">Reset</button>
        <button type="button" onclick="location.href='admin_home.php'">Exit</button>
    </form>
</body>
</html>
