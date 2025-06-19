<?php
session_start();
include 'db_config.php';

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_SESSION['selected_role'] ?? 'intern';

$_SESSION['messages'] = [];

if (!$role || ($role !== 'admin' && $role !== 'intern')) {
    $_SESSION['messages'][] = "Invalid or missing role. Please choose a role first.";
    header("Location: index.php");
    exit();
}

if($email === '' || $name === '' || $password === '' || $phone === '') {
    $_SESSION['messages'][] = 'Please Input your details!';
    header("Location: signup.php");
    exit();
}

elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['messages'][] = "Invalid email format";
    header("Location: signup.php");
    exit();
}
 else {
    // Check if email already exists
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();
    if ($check->num_rows > 0) {
        $_SESSION['messages'][] = "Email is already registered.";
        header("Location: signup.php");
        exit();
    }
}

if (!empty($_SESSION['messages'])) {
    header("Location: register.php");
    exit();
}

$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $hashedPwd, $role);
if ($stmt->execute()) {
    $_SESSION['user_id'] = $stmt->insert_id;
    $_SESSION['role'] = $role;
    $_SESSION['name'] = $name;

    if ($role == 'admin') {
        header("Location: admin_dashboard.php");
        $_SESSION['messages'][] = 'Signup Successful';
    } else {
        header("Location: intern_dashboard.php");
        $_SESSION['messages'][] = 'Signup Successful';
    }
    exit();
} else {
    $_SESSION['messages'][] = 'Registration Failed!';
    header("Location: signup.php");
    exit();
}
?>
