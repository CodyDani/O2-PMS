<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>02PMS</title>
    <link rel="stylesheet" href="../style/form.css">
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
    <div class="admin-dashboard">
        <div class="admin-content">
            <div class="history">
                <h1>Dashboard</h1>
                <table>
                    <tr>
                        <th>S/N</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>start_date</th>
                        <th>end_date</th>
                        <th>Request's Reason</th>
                        <th>Status</th>
                    </tr><br>


                    <?php
                        include 'db_config.php';

                        $sql = "SELECT * FROM permissions WHERE user_id = ?";

                        $sql = "SELECT users.name, users.email, permissions.* 
                        FROM permissions 
                        JOIN users ON users.id = permissions.user_id";

                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->get_result();


                    $sn = 1; // Start serial number at 1
                    while ($row = $result->fetch_assoc()):
                    ?>
                        <tr>
                            <td><?= $sn++; ?></td> <!-- Serial number increments with each row -->
                            <td><?= date('d M Y h:i A', strtotime($row['submitted_at'])) ?></td>
                            <td><?= htmlspecialchars($row['name']); ?></td>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                            <td><?= htmlspecialchars($row['start_date']); ?></td>
                            <td><?= htmlspecialchars($row['end_date']); ?></td>
                            <td><?= htmlspecialchars($row['reason']); ?></td>
                            <td>
                                <!-- <i class="fa-solid fa-check"></i>
                                <i class="fa-solid fa-x"></i>
                                <i class="fas fa-ellipsis-h"></i> -->
                                <ul>
                                    <li><a href="#" class="accept">Accept</a></li>
                                    <li><a href="#" class="decline">Decline</a></li>
                                    <li><a href="#" class="ellipse">&hellip;</a></li>
                                </ul>
                            </td>
                        </tr>
                    <?php endwhile; ?>

                </table>
            </div>
        </div>
        <div class="dashboard">
            <ul class="oill">
                <li class="oil"><a href="admin_dashboard.php">Dashboard</a></li>
                <li class="oil"><a href="history.php">History</a></li>
                <li class="oil">Settings</li>
            </ul>
        </div>
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