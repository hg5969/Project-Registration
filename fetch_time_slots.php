<?php
include 'connection2024.php';

$sql = "SELECT slot, available_seats FROM time_slots";
$result = $conn->query($sql);

$slots = [];
while ($row = $result->fetch_assoc()) {
    $slots[] = $row;
}

echo json_encode($slots);

$conn->close();