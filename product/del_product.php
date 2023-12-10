<?php
$productid = $_GET['sid'];

require_once("../db.php");

// Bắt đầu một transaction
mysqli_begin_transaction($conn);

try {
    // Thực hiện truy vấn DELETE trong transaction
    $del_sql = "DELETE FROM products WHERE product_id=$productid";
    mysqli_query($conn, $del_sql);

    // Nếu không có lỗi, commit transaction
    mysqli_commit($conn);

    // Chuyển hướng sau khi xóa thành công
    header("Location: ../auth/dashboard.php");
} catch (Exception $e) {
    // Nếu có lỗi, rollback transaction và xử lý lỗi
    mysqli_rollback($conn);

    echo "Có lỗi xảy ra: " . $e->getMessage();
}

// Đóng kết nối
mysqli_close($conn);
?>
