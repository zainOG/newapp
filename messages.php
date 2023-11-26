<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Call</title>
    <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
    <style>
        #messages {
            max-height: 200px;
            overflow-y: scroll;
        }
    </style>
</head>
<body>
    <div id="messages">
        <p>Messages will show here</p>
    </div>
    <div>
        <label for="message">Message: </label>
        <input type="text" id="message" />
        <button onclick="sendMessage()">Send</button>
    </div>
    <video id="localVideo" autoplay></video>
    <video id="remoteVideo" autoplay></video>
    <button onclick="startVideoCall()">Start Video Call</button>
    
    <script>
        const socket = new WebSocket('ws://localhost:8080');
        const messagesFile = 'database/messages.php';

        socket.addEventListener('open', (event) => {
            console.log('WebSocket connection opened:', event);
            updateMessages();
        });

        socket.addEventListener('message', (event) => {
            console.log("Message Found", event)
            const message = event.data;
            saveMessage('received', message);
            updateMessages();
        });

        socket.addEventListener('close', (event) => {
            console.log('WebSocket connection closed:', event);
        });

        socket.addEventListener('error', (error) => {
            console.error('WebSocket error:', error);
        });

        function sendMessage() {
            const messageInput = document.getElementById('message');
            const messageText = messageInput.value.trim();
            if (messageText !== '') {
                saveMessage('sent', messageText);
                updateMessages();
                socket.send(messageText);
                messageInput.value = '';
            }
        }

        function updateMessages() {
            const messagesDiv = document.getElementById('messages');
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        try {
                            const messages = JSON.parse(xhr.responseText);
                            messagesDiv.innerHTML = ''; 
                            messages.forEach(({ type, message }) => {
                                const messageParagraph = document.createElement('p');
                                messageParagraph.textContent = `[${type}] ${message}`;
                                messagesDiv.appendChild(messageParagraph);
                            });
                        } catch (error) {
                            console.error('Error parsing JSON:', error);
                        }
                    } else {
                        console.error('Error fetching messages:', xhr.statusText);
                    }
                }  
            };

            xhr.open('GET', `${messagesFile}?action=getMessages`, true);
            xhr.send();
        }

        function saveMessage(type, message) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', `${messagesFile}?action=saveMessage`, true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send(JSON.stringify({ type, message }));
        }

        let localStream;
        let remoteStream;
        let rtcPeerConnection;

        const localVideo = document.getElementById('localVideo');
        const remoteVideo = document.getElementById('remoteVideo');

        async function startVideoCall() {
            try {
                localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
                localVideo.srcObject = localStream;
            
                // Create an RTCPeerConnection
                rtcPeerConnection = new RTCPeerConnection();
            
                // Add the local stream to the connection
                localStream.getTracks().forEach(track => rtcPeerConnection.addTrack(track, localStream));
            
                // Set up the event handlers for the connection
                rtcPeerConnection.onicecandidate = handleIceCandidate;
                rtcPeerConnection.oniceconnectionstatechange = handleIceConnectionStateChange;
                rtcPeerConnection.ontrack = handleTrack;
            
                // Create an offer to start the communication
                const offer = await rtcPeerConnection.createOffer();
                await rtcPeerConnection.setLocalDescription(offer);
            
                // Check for and connect to the latest offer before sending the current offer
                fetchLatestOffer();
            
                // Send the offer to the server
                sendOfferToServer(offer);
            
                // Check for and connect to the latest candidate after sending the offer
                fetchLatestCandidate();
            } catch (error) {
                console.error('Error starting video call:', error);
            }
        }



        function handleIceCandidate(event) {
            if (event.candidate) {
                // Send the candidate to the other peer through your signaling server
                // For simplicity, I'm assuming a hypothetical `sendCandidateToServer` function
                sendCandidateToServer(event.candidate);
            }
        }

        function handleIceConnectionStateChange() {
            console.log('ICE connection state changed:', rtcPeerConnection.iceConnectionState);
        }

        function handleTrack(event) {
            remoteStream = event.streams[0];
            remoteVideo.srcObject = remoteStream;
        }

        // Your signaling server logic (for sending offers, candidates, etc.) goes here

        function sendOfferToServer(offer) {
            // Assuming your signaling server is running on localhost:3000
            const serverUrl = 'http://localhost/zoomApp/zoom/database/sendOffer.php';
            console.log("I sent candidate to sever")
            // Send the offer to the server
            fetch(serverUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ offer: offer }),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to send offer to the server');
                }
                // Handle the success response if needed
            })
            .catch(error => {
                console.error('Error sending offer to the server:', error);
            });
        }

        function sendCandidateToServer(candidate) {
            // Assuming your signaling server is running on localhost:3000
            const serverUrl = 'http://localhost/zoomApp/zoom/database/handleCandidate.php';
            console.log("I sent candidate to sever")
            // Send the candidate to the server
            fetch(serverUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ candidate: candidate }),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to send candidate to the server');
                }
                // Handle the success response if needed
            })
            .catch(error => {
                console.error('Error sending candidate to the server:', error);
            });
        }

        function fetchLatestOffer() {
            fetch('http://localhost/zoomApp/zoom/database/offer-storage.json') // Replace with your actual URL
                .then(response => response.text())
                .then(offer => {
                    // Handle the latest offer
                    if (offer) {
                        console.log(offer)
                        const offerObject = JSON.parse(offer);
                        handleReceivedOffer(offerObject.offer);
                    }
                })
                .catch(error => console.error('Error fetching latest offer:', error));
        }

        function fetchLatestCandidate() {
            fetch('http://localhost/zoomApp/zoom/database/candidate-storage.json') // Replace with your actual URL
                .then(response => response.text())
                .then(candidate => {
                    // Handle the latest candidate
                    if (candidate) {
                        console.log(candidate)
                        const candidateObject = JSON.parse(candidate);
                        handleReceivedCandidate(candidateObject.candidate);
                    }
                })
                .catch(error => console.error('Error fetching latest candidate:', error));
        }

        function handleReceivedOffer(receivedOffer) {
            // Set the remote description with the received offer

            rtcPeerConnection.setRemoteDescription(new RTCSessionDescription(receivedOffer))
                .then(() => {
                    // Create an answer to the offer
                    return rtcPeerConnection.createAnswer();
                })
                .then(answer => {
                    // Set the local description with the answer
                    return rtcPeerConnection.setLocalDescription(answer);
                })
                .then(() => {
                    // Send the answer to the server
                    sendAnswerToServer(rtcPeerConnection.localDescription);
                })
                .catch(error => {
                    console.error('Error handling received offer:', error);
                });
        }

        function handleReceivedCandidate(receivedCandidate) {
            // Add the received candidate to the connection
            rtcPeerConnection.addIceCandidate(new RTCIceCandidate(receivedCandidate))
                .catch(error => {
                    console.error('Error handling received candidate:', error);
                });
        }

        function sendAnswerToServer(answer) {
            // Assuming your signaling server is running on localhost:3000
            const serverUrl = 'http://localhost/zoomApp/zoom/database/handleAnswer.php';

            // Send the answer to the server
            fetch(serverUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ answer: answer }),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to send answer to the server');
                }
                // Handle the success response if needed
            })
            .catch(error => {
                console.error('Error sending answer to the server:', error);
            });
        }
    </script>
</body>
</html>
