
<?php
//include('login.php');
session_start();
$db = mysqli_connect('localhost', 'root', '', 'lsd');
    $a = $_SESSION['uid'];
if(isset($_POST['SubmitButton'])){
    $symptoms = $_POST['inputText']; 
//    echo $symptoms;
    $diseases = $_POST['disease'];
    $sql1= "SELECT DID FROM diseases where Dname = '$diseases' ";
    $did = mysqli_query($db, $sql1);
    while($row = mysqli_fetch_assoc($did)) {
        $did1 = $row["DID"];
    }
    $description = $_POST['descrip'];
    $date = date("m/d/Y h:i A");
    $final = strtotime($date);
    $time_posted = date("Y-m-d", $final);
    $uid = $a;
    $ini = 0;
    $insert = "INSERT INTO posts (Dataa,UID,DIDe,Datee)VALUES('".$symptoms."', ".$uid.", ".$did1.", '".$time_posted."')";
//    echo $insert;
    if (mysqli_query($db, $insert)) {
        header('location: profile.php');
        $_SESSION["success"] = "Successfully Posted!";
    }    
    else{
        
        echo "Error posting. Try Again";
    }
}
?>
<html>
<head>
    <style>
    label{
        font-size: 20px;
        display: block;
        margin: 20px;
    }
     *{
            background-color: #ecf0f1;
        }
        #search input[type=text] {
                left:22.2%;
                color: #3498db;
                position: absolute;
                border-color: black !important;
                border-width: 2px;
                border-radius: 4px;
                top: 14%;
                padding: 1px;
                border: solid;
                width:45%;
                font-size: 20px;
        }
        #search input[type=submit] {
                left:22.2%;
                color: #3498db;
                position: absolute;
                border-color: black !important;
                border-width: 2px;
                border-radius: 4px;
                top: 80%;
                padding: 6px;
                border: solid;
                width:110px;
                font-size: 28px;
        }
        #search textarea {
                left:22.2%;
                color: #3498db;
                position: absolute;
                border-color: black !important;
                border-width: 2px;
                border-radius: 4px;
                top: 25%;
                padding: 6px;
                border: solid;
                font-size: 28px;
        }

    </style>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Post</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <label>Disease You Want to Post about:</label>
    <?php
        $get = mysqli_query($db, "SELECT Dname FROM diseases ORDER BY Dname ASC");
        $option = '';
        while($row = mysqli_fetch_assoc($get))
        {
        $option .= '<option value = "'.$row['Dname'].'">'.$row['Dname'].'</option>';
        }
    ?>

    <form method="post" id="search">
        <select name="disease"> 
            <?php echo $option; ?>
        </select>
        <br>
        <label>Symptoms You went through():</label>
        <input type="text" name=inputText>
        <br>
        <label>Share Your helpful solution:</label>
        <textarea name="descrip" cols="30" rows="10"></textarea>
        <input type="submit" name="SubmitButton"/>
    </form>
</body>
</html>