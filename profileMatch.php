<?php
include "dbconn.php";
//session_start();
while ( $i<= 10) {
$query = "Select UID, DID from posts where DID = 1 " ;
$result = mysqli_query($db, $query);
if($result -> num_rows > 0)
{
	 while($row = $result->fetch_assoc()){
	 	// $uid = row['UID'];
	 	// $did = row['DID'];
	 	// $data = row['Data'];
  echo ("   ".$row['UID']);
 // echo "<br/>";
	 }
}

?>