<?php
//    include('login.php');
session_start();
$db = mysqli_connect('localhost', 'root', '', 'lsd');
    $a = $_SESSION['uid'];
//    echo $a;
?>
<html>
<head><script type="text/javascript" src="mqtt.js"></script>
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
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Allerta+Stencil" rel="stylesheet">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Welcome</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <style>
      *{
            background-color: #fff;
        }
        .nav ul{
            position: absolute;
            top: -50px;
            left: 25%;
            list-style-type: none;
        }
        .nav li{
            float: left;
            border: solid;
            border-color: black;
            border-width: 3px;
            border-radius: 3px;
            margin:3px;
            padding:8px;
            padding-right: 30px;
            text-align: center;
            margin: 50px;
        }
        .nav li a {
            text-decoration: none;
            font-size: 20px;
            display: block;
            color: #3498db;
            width: 60px;
        }            
       
        #search input[type=text] {
                left:31%;
                color: #3498db;
                position: absolute;
                border-color: black !important;
                border-width: 2px;
                border-radius: 4px;
                top: 16%;
                padding: 6px;
                border: solid;
                width:45%;
                font-size: 28px;
        }
        #search input[type=submit] {
                left:71.2%;
                color: #3498db;
                position: absolute;
                border-color: black !important;
                border-width: 2px;
                border-radius: 4px;
                top: 16%;
                padding: 6px;
                border: solid;
                width:110px;
                font-size: 28px;
        }
        #result{
            left:28.5%;
            position: absolute;
            top: 180px;
            width: 800px;
            height: 450px;
            font-size: 20px;
            border: solid;
            border-width: black;
            border-width: 3px;
            border-radius: 6px;
        }
        h1{
            font-family: 'Allerta Stencil', sans-serif;
            font-size: 45px;
            margin-left:10%;
        }
        #result2{
            left:0%;
            position: absolute;
            top: 100px;
            width: 800px;
            height: auto;
            font-size: 20px;
            border: solid;
            border-width: black;
            border-width: 3px;
            border-radius: 6px;
        }
        
    </style>
    <script src="main.js"></script>
</head>
<body>
        
<?php
   
//    if(isset($_SESSION['success']) == 'Successfully Posted!') {
//     echo "Successfully Posted!";
//    }

    echo "<div class='sidebar' style='max-width:18%; max-height:auto;'>";
    echo "<h1>ProjectLSD</h1>";
    echo "<label style='color:#3498db; font-size: 20px; '>Welcome,<br>" . $_SESSION["username"] . "</label><br>";
    $sql = "SELECT Dname FROM diseases";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result) > 0) {
        
        while($row = mysqli_fetch_assoc($result)) {
           echo "<a style=\"color:#3498db;display:block;margin:5px;padding:10px;border: solid;overflow: hidden;
           font-size: 20px;border-radius: 3px;border-color: black; text-align: center;\"id='".$row["Dname"]."'>" . $row["Dname"] . "</a><br>";

           echo "<script>
           $(document).ready(function(){
           $('#".$row['Dname']."').click(function(event){
            event.preventDefault();
            var formValues = $(this).text();
            console.log(formValues);
            $.post('keywordDisease.php', formValues, function(data){
                $('#result').html(data);
            });
        });
    });
           </script>";
        }
    } else {
        echo "0 results";
    }
    echo "</div>";

?>
    

    <div class="nav">
        <ul>
            <li><a href="post.php">Post</a></li>
            <li><a href="twitter.php">News</a></li>
            <li><a href="#" onclick="return hideopen()">Messages</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <form id="search">
        <input type="text" name="search" placeholder="Enter Your Symptoms/disease...">
        <input type="submit" value="submit">
    </form>    
    <div id="result"></div>
    <script>
           $(document).ready(function(){
           $('form').submit(function(event){
            event.preventDefault();
            var formValues = $(this).serialize();
            console.log(formValues);
            $.post('keywordDisease1.php', formValues, function(data){
                $('#result').html(data);
            });
        });
    });
   </script>

   <script>
    function hideopen() {
    var x = document.getElementById('chat');
    if (x.style.display === 'none') {
        x.style.display = 'block';
    } else {
        x.style.display = 'none';
    }
}
</script>
    
    <div id="chat" style="display:none;background-color:#bdc3c7;
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
