<?php
$masp = $_POST['productSku'];
$tensp = $_POST['productName'];
$giasp = $_POST['productPrice'];
$motasp = $_POST['productDesc'];
$soluongsp = $_POST['productQuantity'];

require_once("../db.php");

// Bắt đầu một transaction
mysqli_begin_transaction($conn);

try {
    // Thực hiện truy vấn INSERT trong transaction
    $themsql = "INSERT INTO products (sku, name, price, description, quantity) VALUES ('$masp', '$tensp', '$giasp', '$motasp', '$soluongsp')";
    mysqli_query($conn, $themsql);

    // Nếu không có lỗi, commit transaction
    mysqli_commit($conn);

    // Chuyển hướng sau khi thêm thành công
    header("Location: ../auth/dashboard.php");
} catch (Exception $e) {
    // Nếu có lỗi, rollback transaction và xử lý lỗi
    mysqli_rollback($conn);

    echo "Có lỗi xảy ra: " . $e->getMessage();
}

// Đóng kết nối
mysqli_close($conn);
?>
