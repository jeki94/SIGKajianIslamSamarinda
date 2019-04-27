	    <script src="https://www.gstatic.com/firebasejs/4.6.2/firebase.js"></script>
    	<script>
        MsgElem = document.getElementById("msg")
        TokenElem = document.getElementById("token")
        NotisElem = document.getElementById("notis")
        ErrElem = document.getElementById("err")
        // Initialize Firebase
        // TODO: Replace with your project's customized code snippet
        var config = {
        apiKey: "AIzaSyBwAbG9p0NQCZH3UKw6_AcwDd4t-9T6XT4",
        authDomain: "pushnotif-16bcf.firebaseapp.com",
        databaseURL: "https://pushnotif-16bcf.firebaseio.com",
        projectId: "pushnotif-16bcf",
        storageBucket: "pushnotif-16bcf.appspot.com",
        messagingSenderId: "1006858667856"
        };
        firebase.initializeApp(config);

        const messaging = firebase.messaging();
        messaging
            .requestPermission()
            .then(function () {
                // MsgElem.innerHTML = "Notification permission granted." 
                console.log("Notification permission granted.");
                
                // get the token in the form of promise
                return messaging.getToken()
            })
            .then(function(token) {
                // TokenElem.innerHTML = "token is : " + token
              document.getElementById('token').value = token;
              console.log("token nya = "+token);
            })
            .catch(function (err) {
                // ErrElem.innerHTML =  ErrElem.innerHTML + "; " + err
                console.log("Unable to get permission to notify.", err);
            });

messaging.onMessage(function(payload) {
	  console.log("Message received. ", payload);
	  notificationTitle = payload.data.title;
	  notificationOptions = {
	  	body: payload.data.body,
	  	icon: payload.data.icon,
	  	image:  payload.data.image
	  };
	  var notification = new Notification(notificationTitle,notificationOptions);
	});
    </script>