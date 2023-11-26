<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Zoom Clone</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <header>
        <h1>Zoom Clone</h1>
        <p>Your Virtual Meeting Solution</p>
    </header>

    <section class="user-profile">
        <div class="view-details">
            <h2>View User Details</h2>
            <!-- Display user details - replace with actual user data -->
            <p>Name: John Doe</p>
            <p>Email: john@example.com</p>
            <p>Meeting History: 10 meetings</p>
        </div>

        <div class="edit-details">
            <h2>Edit User Details</h2>
            <form>
                <label for="edit-username">Username</label>
                <input type="text" id="edit-username" name="edit-username" required>

                <label for="edit-email">Email</label>
                <input type="email" id="edit-email" name="edit-email" required>

                <button type="submit">Save Changes</button>
            </form>
        </div>

        <div class="change-password">
            <h2>Change Password</h2>
            <form>
                <label for="current-password">Current Password</label>
                <input type="password" id="current-password" name="current-password" required>

                <label for="new-password">New Password</label>
                <input type="password" id="new-password" name="new-password" required>

                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" required>

                <button type="submit">Change Password</button>
            </form>
        </div>

        <div class="meeting-history">
            <h2>Meeting History</h2>
            <!-- Display meeting history and statistics - replace with actual data -->
            <p>Total Meetings: 20</p>
            <p>Meetings Attended: 15</p>
            <p>Meetings Hosted: 5</p>
        </div>
    </section>

    <footer>
        <p>&copy; 2023 Zoom Clone. All rights reserved.</p>
    </footer>

</body>
</html>
