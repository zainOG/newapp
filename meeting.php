<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meeting Room - Zoom Clone</title>
    <link rel="stylesheet" href="css/styles.css">
    <!-- WebRTC and Socket.IO libraries -->
     <!-- Alternative source for then.min.js -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.min.js"></script>
    <!-- Alternative source for rtcpeerconnection.bundle.js -->
    <script src="https://cdn.jsdelivr.net/gh/otalk/rtcpeerconnection@master/rtcpeerconnection.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.2.0/socket.io.js"></script>
</head>
<body>

    <header>
        <h1>Zoom Clone</h1>
        <p>Your Virtual Meeting Solution</p>
    </header>

    <section class="meeting-room">
        <div class="video-feeds">
            <!-- Video feeds for participants - WebRTC implementation -->
            <video id="local-video" autoplay></video> <!-- Local video -->
            <video id="remote-video" autoplay></video> <!-- Remote video -->
        </div>

        <div class="chatbox">
            <h2>Chat</h2>
            <!-- Chatbox for text communication - Additional chat implementation -->
            <div id="chat-messages"></div>
            <!-- Input field for sending messages -->
            <input type="text" id="message-input" placeholder="Type your message">
            <button onclick="sendMessage()">Send</button>
        </div>

        <div class="controls">
            <h2>Controls</h2>
            <!-- Controls for microphone, camera, and screen sharing - WebRTC implementation -->
            <button onclick="toggleMute()">Toggle Mute</button>
            <button onclick="toggleVideo()">Toggle Video</button>
            <button onclick="shareScreen()">Share Screen</button>
        </div>

        <div class="meeting-details">
            <h2>Meeting Details</h2>
            <!-- Display meeting details and options -->
            <p>Meeting ID: 123456789</p>
            <p>Start Time: 12:00 PM</p>
            <p>End Time: 1:00 PM</p>
            <!-- Additional meeting options as needed -->
        </div>
    </section>

    <footer>
        <p>&copy; 2023 Zoom Clone. All rights reserved.</p>
    </footer>

    <script>
        // WebRTC and Socket.IO integration
        const socket = io('http://localhost/zoomApp/zoom/meeting.php'); // Replace with your server URL
        const rtcConfig = { iceServers: [{ urls: 'stun:stun.l.google.com:19302' }] };
        const peerConnection = new rtcpeerconnection(rtcConfig);

        // Set up local video stream
        navigator.mediaDevices.getUserMedia({ video: true, audio: true })
            .then((stream) => {
                const localVideo = document.getElementById('local-video');
                localVideo.srcObject = stream;
                stream.getTracks().forEach((track) => {
                    peerConnection.addTrack(track, stream);
                });
            })
            .catch((error) => {
                console.error('Error accessing camera:', error);
            });

        // Set up event handlers for the WebRTC connection
        peerConnection.onicecandidate = (event) => {
            if (event.candidate) {
                // Send the ICE candidate to the remote peer via Socket.IO
                socket.emit('ice-candidate', event.candidate);
            }
        };

        // Handle incoming ICE candidates from the remote peer
        socket.on('ice-candidate', (candidate) => {
            peerConnection.addIceCandidate(candidate);
            console.log(candidate)
        });

        // Create offer
        peerConnection.createOffer()
            .then((offer) => peerConnection.setLocalDescription(offer))
            .then(() => {
                // Send the offer to the remote peer via Socket.IO
                socket.emit('offer', peerConnection.localDescription);
            });

        // Handle incoming offer from the remote peer
        socket.on('offer', (offer) => {
            peerConnection.setRemoteDescription(offer);

            // Create answer
            peerConnection.createAnswer()
                .then((answer) => peerConnection.setLocalDescription(answer))
                .then(() => {
                    // Send the answer to the remote peer via Socket.IO
                    socket.emit('answer', peerConnection.localDescription);
                });
        });

        // Handle incoming answer from the remote peer
        socket.on('answer', (answer) => {
            peerConnection.setRemoteDescription(answer);
        });

        // Additional functions for controls and messaging
        function toggleMute() {
        const localStream = document.getElementById('local-video').srcObject;
        const audioTrack = localStream.getAudioTracks()[0];

        // Toggle mute/unmute
        if (audioTrack.enabled) {
            audioTrack.enabled = false;
            console.log('Microphone muted');
        } else {
            audioTrack.enabled = true;
            console.log('Microphone unmuted');
        }
    }

    function toggleVideo() {
        const localStream = document.getElementById('local-video').srcObject;
        const videoTrack = localStream.getVideoTracks()[0];

        // Toggle video on/off
        if (videoTrack.enabled) {
            videoTrack.enabled = false;
            console.log('Video turned off');
        } else {
            videoTrack.enabled = true;
            console.log('Video turned on');
        }
    }

    function shareScreen() {
        navigator.mediaDevices.getDisplayMedia({ video: true })
            .then((stream) => {
                const localVideo = document.getElementById('local-video');
                localVideo.srcObject = stream;

                // Replace the video track in the peer connection with the screen-sharing track
                const videoTrack = stream.getVideoTracks()[0];
                const sender = peerConnection.getSenders().find((s) => s.track.kind === 'video');
                sender.replaceTrack(videoTrack);

                console.log('Screen sharing started');
            })
            .catch((error) => {
                console.error('Error sharing screen:', error);
            });
    }

        function sendMessage() {
            const messageInput = document.getElementById('message-input');
            const message = messageInput.value;
            // Send the message to the server or handle it as needed
            socket.emit('message', message);
            // Display the sent message in the chatbox
            const chatMessages = document.getElementById('chat-messages');
            chatMessages.innerHTML += `<p>You: ${message}</p>`;
            // Clear the input field
            messageInput.value = '';
        }

        // Handle incoming messages
        socket.on('message', (data) => {
            // Process the incoming message as needed
            const chatMessages = document.getElementById('chat-messages');
            chatMessages.innerHTML += `<p>Participant: ${data}</p>`;
        });
    </script>

</body>
</html>
