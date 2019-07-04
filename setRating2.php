<?php
$conn = mysqli_connect("localhost","root","","lsd");
$query = "SELECT VoteCount FROM posts WHERE UID=1";
$q = mysqli_query($conn,$query);
$res = mysqli_fetch_assoc($q);
$count = $res['VoteCount'];
$count1 = intval($count) - 1;
$query = "UPDATE posts SET VoteCount=".$count1." WHERE UID=1 ";
mysqli_query($conn,$query);
echo $count1;
mysqli_close($conn);
?>