<?php
include 'connect_sql.php';

$sql = 'SELECT * FROM photo';
    $qeury = mysqli_query($connect,$sql);

    $search_data = array();

    while($result = mysqli_fetch_assoc($qeury)){
        $search_data[] = $result;
    }

    /* for test
    echo "<pre>";
    print_r($search_data);
    echo "</pre>";*/

    echo json_encode($search_data);
?>