<?php
include 'connect_sql.php';
if (isset($_POST['img'])){
    $img = $_POST['img'];
}

$sqlsearch = 'SELECT * FROM photo WHERE url = "'.$img.'"';
$qeury = mysqli_query($connect,$sqlsearch);
$row = mysqli_fetch_array($qeury);

if(isset($row['filename'])){
    echo $row['filename'].'.png';
}else{
    echo('Not found Image');
}

?>