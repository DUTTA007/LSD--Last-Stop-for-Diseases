<?php
 include 'dbconn.php';
echo "<script src='https://code.jquery.com/jquery-1.12.4.min.js'></script>";


if(!empty($_POST))
{
    $array = htmlspecialchars($_POST["search"]);
    $aKeyword = explode(" ", $array);
      $query ="SELECT * FROM diseases WHERE Dname like '%" . $aKeyword[0] . "%'";
      
     for($i = 1; $i < count($aKeyword); $i++) {
        if(!empty($aKeyword[$i])) {
            $query .= " OR Descr like '%" . $aKeyword[$i] . "%'";
        }
      }

     $result = $db->query($query);
                     
     if(mysqli_num_rows($result) > 0) {
        $row_count=0;
        while($row = $result->fetch_assoc()) {   
            $row_count++;                         
            echo "<a id=".$row['Dname']."1>".$row['Dname']."</a>";
            echo "<p>".$row['Descr']."</p>";
            echo "<script type='text/javascript'>
                $(document).ready(function(){
                $('#".$row['Dname']."1').click(function(event){
                    event.preventDefault();
                    var formValues = $(this).text();
                    console.log(formValues);
                    $.post('keywordPost.php', formValues, function(data){
                        $('#result2').html(data);
                    });
                });
             });
            </script>";

        }
    }
}

echo "<div id='result2'></div>";

?>
