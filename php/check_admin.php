<?php
session_start();
include 'connect_sql.php';

if(isset($_POST['username'])){
    $username = $_POST['username'];
}

if(isset($_POST['password'])){
    $password = $_POST['password'];
}

$salt = 'vErSePHOtoB00TH';
$password_en = sha1($password.$salt);

$sqlsearch = 'SELECT * FROM useradmin WHERE user = "'.$username.'" ';
$qeury = mysqli_query($connect,$sqlsearch);
$row = mysqli_fetch_array($qeury);
if(isset($row['pass'])){
    if($row['pass'] === $password){
        echo('Welcome: ');
        echo($row['name']);
        $_SESSION['id'] = $row['name'];
    }else{
        echo('DENY');
    }
}else{
    echo('DENY');
}
?>