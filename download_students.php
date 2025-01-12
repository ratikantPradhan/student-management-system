<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

$conn = new mysqli('localhost:3306', 'root', '', 'LITDB');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=student_details.csv');

$output = fopen('php://output', 'w');
fputcsv($output, array('Roll No', 'Student Name', 'Parent Name', 'Contact Number', 'Email', 'Gender', 'Department Name', 'Academic Year', 'Password'));

$result = $conn->query('SELECT * FROM Student');

while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
$conn->close();
exit;
?>
