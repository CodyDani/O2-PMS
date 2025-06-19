<?php
session_start();
include 'db_config.php';

$_SESSION['messages'] = [];


    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id = $_SESSION['user_id'] ?? null;
        $matric_no = $_POST['matric_no'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $reason = $_POST['reason'];

    // Validate inputs first
    if (!$user_id || trim($matric_no) === '' || trim($start_date) === '' || trim($end_date) === '' || trim($reason) === '') {
        $_SESSION['messages'][] = 'Please fill in all required fields!';
        header("Location: intern_dashboard.php");
        exit();
    }

    if (!$user_id) {
        $_SESSION['messages'][] = "You're not logged in!";
        header("Location: login.php");
        exit();
    }

        // Prepare and execute SQL only if inputs are valid
        $sql = "INSERT INTO permissions (user_id, matric_no, start_date, end_date, reason) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);


        if ($stmt) {
            $stmt->bind_param("issss", $user_id, $matric_no, $start_date, $end_date, $reason);
            if ($stmt->execute()) {
                $_SESSION['messages'][] = 'Request submitted successfully!';
            } else {
                $_SESSION['messages'][] = 'Error submitting request. Try again.';
            }
            $stmt->close();
        } else {
            $_SESSION['messages'][] = 'Database error. Please contact admin.';
        }
    
        header("Location: intern_dashboard.php");
        exit();
    
    } else {
        header("Location: intern_dashboard.php");
        exit();
    }
    ?>







