<?php
include 'connect_sql.php';

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "successfully";

?>