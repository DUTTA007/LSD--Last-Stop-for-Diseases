<html>
    <head>
     <title>titlename</title>
         <link rel="stylesheet" href="index.css">
           <style>
               
  .h1{
                 color: brown;
                 tab-size: 2p;
                 background-color: floralwhite;
      align-content: center;
                }
        </style>
    </head>
    
    <body>
        <div class="h1">
            <center><h1>LSD</h1></center></div>
       
        <div class="bg">
            <div class="d2">
            <form method="post">
            <label for="uname">Username</label>  
           <input type="text" id="uname" name="username" placeholder="Enter the id" required>
         
       <label for="pwd">Password</label>
        <input type="password" id="pwd" name="password" placeholder="Enter your password" required>
        <label for="name">Name</label>    
         <input type="text" id="name" name="Name" placeholder="Enter your name" required>
        <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
          <label for="pno">Phone Number</label>
            <input type="text" id="email" name="phone_no" placeholder="Enter your Phonenumber" required>
             <input type="submit" name="submit">         
            
        <br/>        
            </form></div></div>
                </body>
   
</html>
<?php
include 'dbconn.php';

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone_no'])){
   $user_name = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $email_id = $_POST['email'];
   $phone_no = $_POST['phone_no'];
   //echo $user_name;
   $query = "INSERT INTO users(Username, Password, Name, Email_id, Phone) VALUES ('$user_name', '$password', '$name', '$email_id', '$phone_no') ";
   mysqli_query($db,$query);
   //mysql_close($db);
 }   

?>