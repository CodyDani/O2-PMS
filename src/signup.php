<?php
session_start();


if (isset($_GET['role'])) {
    $role = $_GET['role'];
    if ($role !== 'admin' && $role !== 'intern') {
        header("Location: intro.php");
        exit();
    }
    $_SESSION['selected_role'] = $role;
} elseif (!isset($_SESSION['selected_role'])) {
    // Default or redirect
    // $_SESSION['selected_role'] = 'intern';
    header("Location: index.php");
    exit();
}

$role = $_SESSION['selected_role'];
$messages = $_SESSION['messages'] ?? [];
unset($_SESSION['messages']);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - <?= ucfirst($role) ?></title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <div class="navbar">
        <div class="container">
            <nav>
                <div>
                    <img src="../pix/logo-for-02-Innovations-lab-150x150.png" alt="logo">
                </div>
                <div>
                    <h1>02PMS</h1>
                    <p>02 Permission Management System</p>
                </div>
            </nav>
        </div>
    </div>
    <div class="content">

                <?php
            foreach ($messages as $msg): ?>
            <p style="color:red;"><?= $msg ?></p>
            <?php endforeach; 
                ?>

        <form action="signup_process.php" method="post">
            <div class="input-text">
                <input type="text" name="name" placeholder="Full Name" >
            </div>
            <div class="input-text">
                <input type="email" name="email" placeholder="Email@gmail.com" >
            </div>
            <div class="input-text">
                <input type="password" name="password" placeholder="Password" >
            </div>
            <div class="input-text">
                <input type="number" name="phone" placeholder="Phone Number" >
            </div>
            <div class="remember">
                <label><input type="checkbox">
                    Remember me
                </label>
            </div>
                <button type="submit">Register as <?= htmlspecialchars($role) ?></button>
            
            <div class="register">
                <p>Already have an account? <a href="login.php">Login</a> </p>
            </div>
        </form>
    </div>


    <footer>
        <div class="footer">
            <div class="f-tor">
                <img src="/pix/logo-for-02-Innovations-lab-150x150.png" alt="logo" class="logo">
                <div>
                    <h3>02INNOVATION LAB NIG LTD</h3>
                    <p>RC1965167</p>
                </div>
            </div>
            <div class="f-tor footer-links">
                <ul class="oill">
                    <li class="oil">About Us</li>
                    <li class="oil">Our Team</li>
                    <li class="oil">Our Courses</li>
                    <li class="oil">Awards</li>
                    <li class="oil">Testimonials</li>
                    <li class="oil">Contact Us</li>
                </ul>
                <div class="foo">
                    <div class="link">
                        <a href="#"><i class="fa-brands fa-facebook"></i>
                            <span>Facebook</span>
                        </a></div>
                    <div class="link">
                        <a href="#"><i class="fa-brands fa-twitter"></i>
                            <span>Twitter</span>
                        </a></div>
                    <div class="link">
                        <a href="#"><i class="fa-brands fa-linkedin"></i>
                            <span>Linkedin</span>
                        </a></div>
                    <div class="link">
                        <a href="#">
                            <i class="fa-brands fa-instagram"></i>
                            <span>Instagram</span>
                        </a></div>
                    <div class="link">
                        <a href="#">
                            <i class="fa-brands fa-youtube"></i>
                            <span>Youtube</span>
                        </a></div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://kit.fontawesome.com/02164bf396.js" crossorigin="anonymous"></script>
</body>

</html>