<?php
include '../connect_sql.php';
session_start();

// Get data json from omise
$input = file_get_contents('php://input');
$event = json_decode($input, true);

// check event from omise
if (isset($event['object']) && $event['object'] === 'event') {
    if ($event['key'] === 'charge.complete') {
        $charge = $event['data'];

        if ($charge['status'] === 'successful') {
            error_log("Charge successful: " . json_encode($charge));

            // Pre data save to sql
            $charge_id = $connect->real_escape_string($charge['id']);
            $status = $connect->real_escape_string($charge['status']);

            $sql = "INSERT INTO photo (`ID`, `charge_id`, `status`) VALUES (null, '$charge_id', '$status')";

            // save to sql
            if ($connect->query($sql) === TRUE) {
                error_log("Record inserted successfully");
            } else {
                error_log("Error inserting record: " . $connect->error);
            }
        } else {
            error_log("Charge not successful or pending: " . json_encode($charge));
        }
    } else {
        error_log("Received event: " . json_encode($event));
    }
}

// ส่ง HTTP status 200 ให้ Omise เพื่อยืนยันว่าได้รับข้อมูลแล้ว
http_response_code(200);

// ปิดการเชื่อมต่อฐานข้อมูล
if (isset($connect)) {
    $connect->close();
}
?>