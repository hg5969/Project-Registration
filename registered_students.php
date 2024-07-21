<?php
include 'connection2024.php';

$sql = "SELECT student_id, first_name, last_name, project_title, email, phone, time_slot FROM students";
$result = $conn->query($sql);

echo "<h1>Registered Students</h1>";
echo "<table border='1'>
<tr>
<th>Student ID</th>
<th>First Name</th>
<th>Last Name</th>
<th>Project Title</th>
<th>Email</th>
<th>Phone</th>
<th>Time Slot</th>
</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
    <td>{$row['student_id']}</td>
    <td>{$row['first_name']}</td>
    <td>{$row['last_name']}</td>
    <td>{$row['project_title']}</td>
    <td>{$row['email']}</td>
    <td>{$row['phone']}</td>
    <td>{$row['time_slot']}</td>
    </tr>";
}

echo "</table>";

$conn->close();

