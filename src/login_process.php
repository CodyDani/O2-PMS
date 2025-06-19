<?php
session_start();
include 'db_config.php';

// Check if inputs exist
if (!isset($_POST['email'], $_POST['password'])) {
    die("Email or password missing.");
}

$email = trim($_POST['email']);
$password = $_POST['password'];
$role = $_SESSION['selected_role'] ?? null;


if (!$role || ($role !== 'admin' && $role !== 'intern')) {
    $_SESSION['messages'][] = "Invalid or missing role. Please choose a role first.";
    header("Location: intro.php");
    exit();
}

if(empty($email) || empty($password)) {
    $_SESSION['messages'][] = 'Please Input your details!';
    header("Location: login.php");
    exit();
}

// Prepare the SQL
$sql = "SELECT * FROM users WHERE email = ? AND role = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Database error: " . $conn->error);
}

$stmt->bind_param("ss", $email, $role);
$stmt->execute();
$result = $stmt->get_result();


if ($user = $result->fetch_assoc()) {
    if (password_verify($password, $user['password'])) {

        $_SESSION['name'] = 'SELECT name FROM users WHERE email = $email';
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['name'] = $user['name'];

        // Redirect to the correct dashboard
        if ($user['role'] == 'admin') {
            header("Location: admin_dashboard.php");
            $_SESSION['messages'][] = 'Login Successful';
        } else {
            header("Location: intern_dashboard.php");
            $_SESSION['messages'][] = 'Login Successful';
        }
        exit();
    }
    else {
        $_SESSION['messages'][] = 'Incorrect Password!';
        header("Location: login.php");
        exit();
    }

}
else {
    $_SESSION['messages'][] = 'No user found with this email and role.';
    header("Location: login.php");
    exit();
}


?>


<?php