<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="public/favicon.png" />
    <title>Room Inc.</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-9aIT0tGrWpb5zAzVYiVxRdMyRSUa2b72VBpIVSsi4VBSMfrXeP5Aq66rKI1yaPlDS8n4+CGJkA4Sm3MStLzU4g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <header>
        <div class="header">
            <div class="logo">
            <h1><a href="/">Room Inc.</a></h1>
                
            </div>
            <div class="links">
                <a href="" class="signup">Join</a>
                <a href="" class="signup">Host</a>
                <a href="" class="contactus">Contact Us</a>
            </div>
        </div>
    </header>

    <section class="intro">
        <h2>Welcome to Room Inc</h2>
        <p id="line1">Your Virtual Meeting Solution</p>
        <p id="line2" style="display: none;">Connect and collaborate seamlessly with Room Inc.</p>
        <div class="links">
            <a href="signup.php">SIGN UP</a>
            <a href="login.php">LOG IN</a>
        </div>
    </section>

    <section class="features-section">
        <ul class="feature">
            <li>
                <h3><i class="fas fa-video"></i> High-Quality Video</h3>
                <p>Experience crystal-clear video quality during your meetings.</p>
            </li>

            <li>
                <h3><i class="fas fa-calendar-alt"></i> Easy Scheduling</h3>
                <p>Schedule and manage your meetings effortlessly.</p>
            </li>

            <li>
                <h3><i class="fas fa-lock"></i> Secure Communication</h3>
                <p>Ensure the privacy and security of your virtual conversations.</p>
            </li>
        </ul>


        <div class="img">
            <img src="https://campusb.org/wp-content/uploads/2020/08/features.png" alt="features img" width="650px" height="450px">
        </div>
    </section>

    <footer>
        <p>&copy; 2023 Room Inc. All rights reserved.</p>
    </footer>

</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    var interval;
    var line1 = document.getElementById('line1');
    var line2 = document.getElementById('line2');

    function toggleLines() {
        if (line1.style.display === 'block') {
            line1.style.display = 'none';
            line2.style.display = 'block';
        } else {
            line1.style.display = 'block';
            line2.style.display = 'none';
        }
    }

    interval = setInterval(toggleLines, 4000);

    
    setTimeout(function () {
        clearInterval(interval);
    }, 160000); 
    });


</script>
</html>
