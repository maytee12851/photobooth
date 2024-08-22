<?php
include 'connect_sql.php';
if (isset($_POST['picurl'])){
    $picurl = $_POST['picurl'];
}

if (isset($_POST['frame'])){
    $frame = $_POST['frame'];
}

if($picurl == "data:," or $picurl == ''){
    return;
}

// Set data
$data = $picurl;

// Decode
list($type, $data) = explode(';', $data);
list(, $data)      = explode(',', $data);
$data = base64_decode($data);

// Find the last row
$sqlsearch = 'SELECT ID FROM photo ORDER BY ID DESC LIMIT 1';
$qeury = mysqli_query($connect,$sqlsearch);
$row = mysqli_fetch_array($qeury);

if(isset($row['ID'])){
    $last_row = intval($row['ID']);
}else{
    echo 'No rows found to update.';
    return;
}

// Set filename
$newname = $last_row . '-'.date("Y-m-d").'--'.date("h-i-sa").'-'.rand(100, 999);

// Save file to server
file_put_contents('../img/'.$newname.'.png', $data);

// Prepare update statement
$random_string = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
$newurl = $random_string;
$print_count = 0;
$date = date('d/m/Y');

// Update the last row
$sql_update = "UPDATE `photo` SET `frame`='".$frame."', `filename`='".$newname."', `url`='".$newurl."', `date`=now(), `time`=now(), `printcount`='".$print_count."' WHERE `ID`='".$last_row."'";
$qeury = mysqli_query($connect,$sql_update);

if($qeury){
    // Return the new URL
    echo $newurl.'+png';
} else {
    echo 'Update failed.';
}
?>
