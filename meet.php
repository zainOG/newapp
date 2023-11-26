<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="public/favicon.png" />
    <title>Room Inc.</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>
        <div class="header">
            <div class="logo">
                <h1>Room Inc.</h1>
                
            </div>
            <div class="links">
                <a href="" class="signup">Welcome, Username</a>
                <a href="" class="signup">Host</a>
                <a href="" class="contactus">Contact Us</a>
            </div>
        </div>
    </header>

    <p id="notification" hidden></p>
    <section>
        <div class="entry-modal" id="entry-modal">
            <p>Create or Join Meeting</p>
            <input id="room-input" class="room-input" placeholder="Enter Room ID">
            <div>
                <button onclick="createRoom()">Create Room</button>
                <button onclick="joinRoom()">Join Room</button>
            </div>
        </div>
    </section>
    <div class="meet-area">
        <!-- Remote Video Element-->
        <video id="remote-video" ></video>

        <!-- Local Video Element-->
        <video id="local-video"></video>
        <div class="meet-controls-bar" style="display: none;" id="shareScreen">
            <button onclick="startScreenShare()">Screen Share</button>
        </div>
    </div>
</body>

<script src="https://unpkg.com/peerjs@1.3.1/dist/peerjs.min.js"></script>
<script src="script.js"></script>

</html>