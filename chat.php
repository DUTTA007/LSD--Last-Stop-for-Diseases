<?php
  session_start();
  $a = $_SESSION['uid'];
?>
<html>
    <head>
        <script type="text/javascript" src="mqtt.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>
            function tododo(){
                
            }
        </script>
        <script>
        
 //Using the HiveMQ public Broker, with a random client Id
 var client = new Messaging.Client("192.168.43.156", 19001, "myclientid_" + parseInt(Math.random() * 100, 10));

 //Gets  called if the websocket/mqtt connection gets disconnected for any reason
 client.onConnectionLost = function (responseObject) {
     //Depending on your scenario you could implement a reconnect logic here
     alert("connection lost: " + responseObject.errorMessage);
 };

 //Gets called whenever you receive a message for your subscriptions
 client.onMessageArrived = function (message) {
     //Do something with the push message you received
     if(message.destinationName == "test")
      $('#contents').append('<span>Topic: ' + message.destinationName + '  | ' + message.payloadString + '</span><br/>');
     else
          $('#contents').append('<span style="color:red;">Topic: ' + message.destinationName + '  | ' + message.payloadString + '</span><br/>');
//     alert(message.payloadString);
     
//     text = message.payloadString;
//     var a = text.split(",");
//     alert(a[0]);
//     alert(a[1]);
 };

 //Connect Options
 var options = {
     timeout: 3,
     //Gets Called if the connection has sucessfully been established
     onSuccess: function () {
     	client.subscribe('test', {qos: 2});
         client.subscribe('test1', {qos: 2});
//         alert("Connected");

     },
     //Gets Called if the connection could not be established
     onFailure: function (message) {
         alert("Connection failed: " + message.errorMessage);
     }
 };

 //Creates a new Messaging.Message Object and sends it to the HiveMQ MQTT Broker
 var publish = function (payload, topic, qos) {
     //Send your message (also possible to serialize it as JSON or protobuf or just use a string, no limitations)
     var message = new Messaging.Message(payload);
     message.destinationName = topic;
     message.qos = qos;
     client.send(message);

 }


 client.connect(options);
 
        </script>
    </head>
    <body>
        <div style="background-color:#bdc3c7;
height:50%;
width:35%;
border-style: solid;
border-color:#7f8c8d;
position: fixed;
top: 48%;
left:64%">
        <div style="background-color:#7f8c8d;
height:20%;
width:100%;">
            <h1 style="margin:0;padding:3%;color: floralwhite" id="name"><?php echo $a?></h1>
        </div>
            <div id="contents" style="background-color:#ecf0f1;
height:69%;
width:100%;">
                &nbsp;
            </div>
<div style="margin:0;margin-left: 1%;padding:0;">
                <input type="text" name="message" placeholder="Type here.." style="width: 88%;height:10%;padding: 0;margin: =0;border: none;border-radius: 10%;font-size:100%;"/>
                <button onclick="tododo()" style="width: 10%;padding: 0;margin: =0;background-color:#ecf0f1;border-radius: 20%;color: #7f8c8d;border: none;border-style:solid;height:10%;">></button>
            </div>
        </div>
    </body>
</html>