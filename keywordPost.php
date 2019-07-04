<?php
 include 'dbconn.php';
if(!empty($_POST))
{
    $array = array_keys($_POST);
    $aKeyword = explode(" ", $array[0]);
      $query ="SELECT * FROM posts WHERE Dataa like '%" . $aKeyword[0] . "%'";
     for($i = 1; $i < count($aKeyword); $i++) {
        if(!empty($aKeyword[$i])) {
            $query .= " OR Data like '%" . $aKeyword[$i] . "%'";
        }
      }
     
     $result = $db->query($query);
     if(mysqli_num_rows($result) > 0) {
        $row_count=0;
        while($row = $result->fetch_assoc()) {   
            echo $row['Dataa'];
            echo "<br>";
        }
    }
}
 
?>
