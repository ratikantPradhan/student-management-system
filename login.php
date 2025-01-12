<?php
$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "litdb";
$port = "3306";

session_start();
$conn = new mysqli("localhost:3306", "root", "", "litdb");

if ($conn->connect_error)
{
	die("Connection failed: ". $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT * from Admin WHERE username='$username' AND password='$password'";

	$result = $conn->query($sql);

	if ($result->num_rows > 0)
	{
		$_SESSION['loggedin'] = true;
		header("Location: admin_home.php");
		exit();
	}
	else
	{
		echo "Invalid username or password";
	}
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
</head>
<body>
    <h1>Admin Login</h1>
    <form method="POST">
        <label for="username">Admin User ID:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Admin Password:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Admin Login</button>
        <button onclick="window.location.href='student_login.php'">Student Login</button>
    </form>
</body>
</html>