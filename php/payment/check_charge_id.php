<?php
include '../connect_sql.php'; // เชื่อมต่อกับฐานข้อมูล

if (isset($_GET['charge_id'])) {
    $charge_id = $_GET['charge_id'];

    // สร้างคำสั่ง SQL เพื่อค้นหา charge_id ในตารางของคุณ
    $sqlsearch = 'SELECT * FROM photo WHERE charge_id = ?';
    
    // ใช้ prepared statement เพื่อป้องกัน SQL Injection
    if ($stmt = $connect->prepare($sqlsearch)) {
        $stmt->bind_param("s", $charge_id); // ผูกค่า charge_id เข้ากับ statement
        $stmt->execute(); // รันคำสั่ง SQL
        $result = $stmt->get_result(); // รับผลลัพธ์ของการรันคำสั่ง
        
        if ($result->num_rows > 0) {
            // ถ้าพบ charge_id ในฐานข้อมูล
            echo json_encode(["status" => "success"]);
        } else {
            // ถ้าไม่พบ charge_id ในฐานข้อมูล
            echo json_encode(["status" => "not_found"]);
        }

        $stmt->close(); // ปิด statement
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to prepare statement."]);
    }

    $connect->close(); // ปิดการเชื่อมต่อฐานข้อมูล
} else {
    echo json_encode(["status" => "error", "message" => "No charge_id provided."]);
}
?>