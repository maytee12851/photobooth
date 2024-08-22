<?php
include '../connect_sql.php';

session_start();

$charge_id = $_SESSION['charge_id'];

$sql = "SELECT status FROM photo WHERE charge_id = '$charge_id'";
$result = $connect->query($sql);

$response = array('status' => 'pending', 'charge_id' => $charge_id);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response['status'] = $row['status'];
}

echo json_encode($response);

// Close the database connection
if (isset($connect)) {
    $connect->close();
}
?>