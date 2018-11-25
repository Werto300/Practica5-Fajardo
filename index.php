<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practica5-Fajardo</title>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <link rel="manifest" href="manifest.json">
    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase.js"></script>
    <script>
    // Initialize Firebase
    var config = {
        apiKey: "AIzaSyDnWIu5Lo85DeMgyM4JYOdFJWz1-XtEiFA",
        authDomain: "clase-mantenimiento-fajardo.firebaseapp.com",
        databaseURL: "https://clase-mantenimiento-fajardo.firebaseio.com",
        projectId: "clase-mantenimiento-fajardo",
        storageBucket: "clase-mantenimiento-fajardo.appspot.com",
        messagingSenderId: "908198576486"
    };
    firebase.initializeApp(config);
    </script>
</head>
<body>
    <h1> App con notificaciones</h1>
    <script>
        // Retrieve Firebase Messaging object.
        const messaging = firebase.messaging();
        messaging.usePublicVapidKey("BM7Hls1q35i4sEHXgKl0vx4YQN9aNJSXYWzJpDniiFVC86fF-rGxHRYjZ2iALqfxCvDTIWbM7I8BctwJ95Aa-Os");

        messaging.requestPermission().then(function() {
        console.log('Notification permission granted.');
        // TODO(developer): Retrieve an Instance ID token for use with FCM.
        // ...
        }).catch(function(err) {
        console.log('Unable to get permission to notify.', err);
        });

        function setTokenSentToServer(sent) {
            window.localStorage.setItem('sentToServer', sent ? 1 : 0);
        }

        function isTokenSentToServer() {
            return window.localStorage.getItem('sentToServer') == 1;
        }
    
        function showToken(currentToken) {
            // Show token in console and UI.
            var tokenElement = document.querySelector('#token');
            tokenElement.textContent = currentToken;
        }

        function saveToken(currentToken){
            if (isTokenSentToServer()) {
            console.log('Sending token to server...');
            $.ajax({
                type: 'POST',
                url:'guardar.php',
                data: currentToken,
                success: function(data){
                },
            });
            // TODO(developer): Send the current token to your server.
            setTokenSentToServer(true);
            } else {
                console.log('Token already sent to server so won\'t send it again ' +
                'unless it changes');
            }
        }

        function getRegToken(){
            // Get Instance ID token. Initially this makes a network call, once retrieved
            // subsequent calls to getToken will return from cache.
            messaging.getToken().then(function(currentToken) {
                if (currentToken) {
                    saveToken(currentToken);
                    console.log(currentToken);
                    setTokenSentToServer(true);
                } else {
                    // Show permission request.
                    console.log('No Instance ID token available. Request permission to generate one.');
                    // Show permission UI.
                    setTokenSentToServer(false);
                }
            }).catch(function(err) {
                console.log('An error occurred while retrieving token. ', err);
                //showToken('Error retrieving Instance ID token. ', err);
                setTokenSentToServer(false);
            });
        };
        getRegToken();

         messaging.onMessage(function(payload){
            var title = payload.data.title;
            var options = {
                body: payload.data.body,
                icon: payload.data.icon
            }
            var myNotification = new Notification(title, options);
            console.log('Mensaje recibidio', payload)
        })


    </script>

</body>
</html>