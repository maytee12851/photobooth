<?php

include 'connect_sql.php';

if (isset($_POST['pic1']) && isset($_POST['pic2'])){
    
    $pic1 = $_POST['pic1'];
    $pic2 = $_POST['pic2'];
    
    if($pic2 == "NOSELECTED"){
        $sqlsearch = 'SELECT * FROM photo WHERE ID = "'.$pic1.'"';
        $query = mysqli_query($connect, $sqlsearch);
        
        if ($query) {
            $row = mysqli_fetch_assoc($query);
            $data = array(
                'img1' => $row['filename'] . '.png',
                'img2' => $row['filename'] . '.png'
            );
            $sqlupdate = "UPDATE photo SET printcount = printcount + 1 WHERE ID = '".$pic1."'";
            mysqli_query($connect, $sqlupdate);
        }
    } else {
        $sqlsearch = 'SELECT * FROM photo WHERE ID = "'.$pic1.'"';
        $query = mysqli_query($connect, $sqlsearch);
        
        if ($query) {
            $row = mysqli_fetch_assoc($query);

            $sqlsearch2 = 'SELECT * FROM photo WHERE ID = "'.$pic2.'"';
            $query2 = mysqli_query($connect, $sqlsearch2);
            
            if ($query2) {
                $row2 = mysqli_fetch_assoc($query2);

                $data = array(
                    'img1' => $row['filename'] . '.png',
                    'img2' => $row2['filename'] . '.png'
                );
                $sqlupdate1 = "UPDATE photo SET printcount = printcount + 1 WHERE ID = '".$pic1."'";
                mysqli_query($connect, $sqlupdate1);
                $sqlupdate2 = "UPDATE photo SET printcount = printcount + 1 WHERE ID = '".$pic2."'";
                mysqli_query($connect, $sqlupdate2);
            }
        }
    }

    $json = json_encode($data);
    echo $json;
} else {
    echo json_encode(array('error' => 'Invalid input'));
}
?>
