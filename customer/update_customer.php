<?php
// Kết nối đến cơ sở dữ liệu
require_once("../db.php");

// Bắt đầu một transaction
mysqli_begin_transaction($conn);

try {
    // Lấy dữ liệu từ form
    $ten = $_POST['customerName'];
    $diachi = $_POST['customerAddress'];
    $sdt = $_POST['customerPhone'];
    $mail = $_POST['customerEmail'];
    $id = $_POST['sid'];

    // Câu lệnh SQL UPDATE
    $update_sql = "UPDATE customers SET name='$ten', address='$diachi', phone='$sdt', email='$mail' WHERE customer_id=$id";

    // Thực hiện câu lệnh UPDATE
    mysqli_query($conn, $update_sql);

    // Commit transaction nếu mọi thứ thành công
    mysqli_commit($conn);

    // Chuyển hướng về trang danh sách khách hàng
    header("Location: list_customer.php");
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
