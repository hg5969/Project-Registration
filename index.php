<?php
include 'connection2024.php';

$studentID = $_POST['student_ID'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$projectTitle = $_POST['project_title'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$timeSlot = $_POST['time_slot'];

// Check if the student is already registered
$checkQuery = "SELECT * FROM students WHERE student_id = ?";
$stmt = $conn->prepare($checkQuery);
$stmt->bind_param("s", $studentID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Student is already registered
    echo "<script>
            if (confirm('You are already registered. Do you want to change your time slot?')) {
                window.location.href = 'update_registration.html?student_ID={$studentID}';
            } else {
                window.location.href = 'registration.html';
            }
          </script>";
} else {
    // Check time slot availability
    $slotQuery = "SELECT available_seats FROM time_slots WHERE slot = ?";
    $stmt = $conn->prepare($slotQuery);
    $stmt->bind_param("s", $timeSlot);
    $stmt->execute();
    $slotResult = $stmt->get_result();
    $slot = $slotResult->fetch_assoc();

    if ($slot['available_seats'] > 0) {
        // Register new student
        $insertQuery = "INSERT INTO students (student_id, first_name, last_name, project_title, email, phone, time_slot) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("sssssss", $studentID, $firstName, $lastName, $projectTitle, $email, $phone, $timeSlot);
        if ($stmt->execute()) {
            // Update available seats
            $updateQuery = "UPDATE time_slots SET available_seats = available_seats - 1 WHERE slot = ?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("s", $timeSlot);
            $stmt->execute();
            echo "<script>alert('Registration successful!'); window.location.href = 'registration.html';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "'); window.location.href = 'registration.html';</script>";
        }
    } else {
        echo "<script>alert('Selected time slot is fully booked.'); window.location.href = 'registration.html';</script>";
    }
}

$conn->close();