<?php

include 'connect_sql.php';

if (isset($_POST['pic1'])){
    
    $pic1 = mysqli_real_escape_string($connect, $_POST['pic1']);
    $data = array();

    $sqlsearch = 'SELECT * FROM photo WHERE filename = "'.$pic1.'"';
    $query = mysqli_query($connect, $sqlsearch);
    
    if ($query && $row = mysqli_fetch_assoc($query)) {
        $data = array(
            'img1' => $row['filename'] . '.png'
        );
        $sqlupdate = "UPDATE photo SET printcount = printcount + 1 WHERE filename = '".$pic1."'";
        mysqli_query($connect, $sqlupdate);
    } else {
        echo json_encode(array('error' => 'Image not found for pic1.'));
        exit;
    }

    echo json_encode($data);
} else {
    echo json_encode(array('error' => 'Invalid input'));
}
?>
