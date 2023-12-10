<?php
// Kết nối đến cơ sở dữ liệu
require_once("../db.php");

// Bắt đầu một transaction
mysqli_begin_transaction($conn);

try {
    // Lấy ID khách hàng từ tham số URL
    $ctmid = $_GET['sid'];

    // Câu lệnh SQL DELETE
    $del_sql = "DELETE FROM customers WHERE customer_id=$ctmid";

    // Thực hiện câu lệnh DELETE
    mysqli_query($conn, $del_sql);

    // Commit transaction nếu mọi thứ thành công
    mysqli_commit($conn);

    // Chuyển hướng về trang danh sách khách hàng
    // header("Location: list_customer.php");
    header("Location: ../auth/dashboard.php");
} catch (Exception $e) {
    // Nếu có lỗi, rollback transaction
    mysqli_rollback($conn);

    // Xử lý lỗi hoặc redirect đến trang lỗi
    echo "Error: " . $e->getMessage();
    // hoặc header("Location: error.php");
}

// Đóng kết nối
mysqli_close($conn);
?>
