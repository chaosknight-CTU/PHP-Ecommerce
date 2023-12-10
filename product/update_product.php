<?php
$masp = $_POST['productSku'];
$tensp = $_POST['productName'];
$giasp = $_POST['productPrice'];
$motasp = $_POST['productDesc'];
$soluongsp = $_POST['productQuantity'];
$id = $_POST['sid'];

require_once("../db.php");

// Bắt đầu một transaction
mysqli_begin_transaction($conn);

try {
    // Thực hiện các câu lệnh SQL trong transaction
    $update_sql = "UPDATE products SET sku='$masp', name='$tensp', price='$giasp', description='$motasp', quantity='$soluongsp' WHERE product_id=$id";
    mysqli_query($conn, $update_sql);

    // Nếu không có lỗi, commit transaction
    mysqli_commit($conn);

    // Chuyển hướng sau khi cập nhật thành công
    header("Location: ../auth/dashboard.php");
} catch (Exception $e) {
    // Nếu có lỗi, rollback transaction và xử lý lỗi
    mysqli_rollback($conn);

    echo "Có lỗi xảy ra: " . $e->getMessage();
}

// Đóng kết nối
mysqli_close($conn);
?>
