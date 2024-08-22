<?php

include 'connect_sql.php';
if (isset($_POST['url'])){
    
    $url = $_POST['url'];

      $sqliupdate = "UPDATE photo SET printcount = printcount + 1 WHERE url = '".$url."'";
      $qeury3 = mysqli_query($connect,$sqliupdate);
    
    echo ('Printed!');
}

?>