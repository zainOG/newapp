<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Scheduler - Zoom Clone</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header>
        <h1>Zoom Clone</h1>
        <p>Your Virtual Meeting Solution</p>
    </header>

    <section class="meeting-scheduler">
        <h2>Schedule a New Meeting</h2>
        <form>
            <label for="meeting-title">Meeting Title</label>
            <input type="text" id="meeting-title" name="meeting-title" required>

            <label for="date-time">Date and Time</label>
            <input type="datetime-local" id="date-time" name="date-time" required>

            <label for="invite-method">Invite Participants</label>
            <select id="invite-method" name="invite-method">
                <option value="email">Email</option>
                <option value="link">Link</option>
            </select>

            <label for="password-protection">Password Protection</label>
            <input type="password" id="password-protection" name="password-protection">

            <!-- Additional settings as needed -->

            <button type="submit">Schedule Meeting</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2023 Zoom Clone. All rights reserved.</p>
    </footer>

</body>
</html>
