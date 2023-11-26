<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Inc.</title>
    <link rel="icon" href="public/favicon.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <div class="content">
        <div class="left">
            <form action="">
                <label class="heading">Room</label>
                <label class='input'>Email</label>
                <input type="email" placeholder="Enter your email">
                <label class='input'>Password</label>
                <input type="password" placeholder="Enter your password">
                <label class="forgotPassword">Forgot your Password?</label>
               <!--  <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div> -->
                <button>LOG IN</button>
                <p>OR</p>
                <a href="signup.php" class="redirect">SignUp?</a>
            </form>
        </div>
        <div class="right">
            <img src="public/loginImg.png" alt="">
            <h3 class="text"><span>Fast & Secure</span> meetings at your fingertips</h3>
        </div>
    </div>
</body>
</html>