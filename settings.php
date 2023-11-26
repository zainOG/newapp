<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Zoom Clone</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <header>
        <h1>Zoom Clone</h1>
        <p>Your Virtual Meeting Solution</p>
    </header>

    <section class="settings">
        <div class="audio-settings">
            <h2>Audio Settings</h2>
            <!-- Display and configure audio settings -->
            <label for="audio-input">Select Audio Input</label>
            <select id="audio-input" name="audio-input">
                <!-- Add options for available audio inputs -->
                <option value="microphone">Microphone</option>
                <option value="headphones">Headphones</option>
            </select>
        </div>

        <div class="video-settings">
            <h2>Video Settings</h2>
            <!-- Display and configure video settings -->
            <label for="video-input">Select Video Input</label>
            <select id="video-input" name="video-input">
                <!-- Add options for available video inputs -->
                <option value="webcam">Webcam</option>
                <option value="screen">Screen Share</option>
            </select>
        </div>

        <div class="notification-preferences">
            <h2>Notification Preferences</h2>
            <!-- Configure notification preferences -->
            <label for="notification-sound">Notification Sound</label>
            <select id="notification-sound" name="notification-sound">
                <!-- Add options for notification sounds -->
                <option value="default">Default Sound</option>
                <option value="custom">Custom Sound</option>
            </select>
        </div>

        <div class="security-privacy-settings">
            <h2>Security and Privacy Settings</h2>
            <!-- Configure security and privacy settings -->
            <label for="password-protection">Password Protection</label>
            <input type="password" id="password-protection" name="password-protection">

            <label for="privacy-mode">Privacy Mode</label>
            <select id="privacy-mode" name="privacy-mode">
                <!-- Add options for privacy mode settings -->
                <option value="public">Public</option>
                <option value="private">Private</option>
            </select>
        </div>
    </section>

    <footer>
        <p>&copy; 2023 Zoom Clone. All rights reserved.</p>
    </footer>

</body>
</html>
