<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoom Clone</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background-color: #0077cc;
            color: #fff;
            padding: 1em;
            text-align: center;
        }

        section {
            padding: 2em;
            text-align: center;
        }

        .signup-form, .login-form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .features-section {
            background-color: #0077cc;
            color: #fff;
            padding: 2em;
        }

        .feature {
            margin-bottom: 20px;
        }
        /* Form Styling */
form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 0.5em;
}

input {
    padding: 0.5em;
    margin-bottom: 1em;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    padding: 0.7em;
    background-color: #0077cc;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #00568d;
}

        footer {
            background-color: #333;
            color: #fff;
            padding: 1em;
            text-align: center;
        }
    </style>
</head>
<body>

    <header>
        <h1>Zoom Clone</h1>
        <p>Your Virtual Meeting Solution</p>
    </header>

    <section>
        <h2>Welcome to Zoom Clone</h2>

        <!-- Sign-up Form -->


<!-- Log-in Form -->
<div class="login-form">
    <h3>Log In</h3>
    <form>
        <label for="login-email">Email</label>
        <input type="email" id="login-email" name="login-email" required>

        <label for="login-password">Password</label>
        <input type="password" id="login-password" name="login-password" required>

        <button type="submit">Log In</button>
    </form>
</div>

    </section>

    <!-- Features Section -->
    <section class="features-section">
        <h2>Key Features</h2>

        <!-- Features List -->
        <div class="feature">
            <h3>High-Quality Video</h3>
            <p>Experience crystal-clear video quality during your meetings.</p>
        </div>

        <div class="feature">
            <h3>Easy Scheduling</h3>
            <p>Schedule and manage your meetings effortlessly.</p>
        </div>

        <div class="feature">
            <h3>Secure Communication</h3>
            <p>Ensure the privacy and security of your virtual conversations.</p>
        </div>
    </section>

    <footer>
        <p>&copy; 2023 Zoom Clone. All rights reserved.</p>
    </footer>

</body>
</html>
