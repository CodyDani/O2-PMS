<?php
    session_start();

    $messages = $_SESSION['messages'] ?? [];

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


    <div class=" main-content ">
        <div class="welcome">


<?php

   foreach($messages as $msg){
      echo '
      <div class="message">   
         <span style="color:lightgreen;">'.$msg.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }

?>

            <div class="logout" id="logout">
                <i class="fa-solid fa-right-from-bracket" alt="logout"></i>
            </div>
            <h2>Hi! <?php echo $_SESSION['name'] ?></h2>
            <p>You can request for permission, check your
                permission status and view your history</p>
            <button id="openFormBtn">Submit Request</button>
        </div>
        <div class="popup-form" id="popupForm">
            <div class="close" id="closeFormBtn">
                <i class="fa-solid fa-xmark" alt="closeform"></i>    
            </div>
        <form action="request_form.php" method="POST">
            <div class="input-text">
                    <input type="text" name="matric_no" placeholder="Matric Number" required>
                </div>
                <div class="input-text">
                    <label for="">Date to be absent</label>
                    <input type="date" name="start_date" required>
                </div>
                <div class="input-text">
                    <label for="">Returning Date</label>
                    <input type="date" name="end_date" required>
                </div>
                <div class="input-text">
                    <textarea name="reason" placeholder="Reason for absence" required></textarea>
                </div>

                <button type="submit" id="closeFormBtn">Submit request</button>
            </form>
        </div>
        <div class="history">
            <table>
    <tr>
        <th>S/N</th>
        <th>Date</th>
        <th>Request's Reason</th>
        <th>Status</th>
    </tr>
    <?php
        include 'db_config.php';

        $sql = "SELECT * FROM permissions WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();


    $sn = 1; // Start serial number at 1
    while ($row = $result->fetch_assoc()):
    ?>
        <tr>
            <td><?= $sn++; ?></td> <!-- Serial number increments with each row -->
            <td><?= date('d M Y h:i A', strtotime($row['submitted_at'])) ?></td>
            <td><?= htmlspecialchars($row['reason']); ?></td>
            <td class="pend"><?= htmlspecialchars($row['status']); ?>Pending...</td>
        </tr>
    <?php endwhile; ?>
</table>



        </div>
    </div>



    <footer>
        <div class="footer">
            <div class="f-tor">
                <img src="../pix/logo-for-02-Innovations-lab-150x150.png" alt="logo" class="logo">
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
    <script>
        document.getElementById('openFormBtn').onclick = function () {
            document.getElementById('popupForm').classList.add('active');
        };
        document.getElementById('closeFormBtn').onclick = function () {
            document.getElementById('popupForm').classList.remove('active');
        };
        document.getElementById('logout').onclick = function () {
            if (confirm("Are you sure you want to logout?")) {
                window.location.href = "logout.php";
            }
        };
    </script>
    <script src="https://kit.fontawesome.com/02164bf396.js" crossorigin="anonymous"></script>
</body>

</html>