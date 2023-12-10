<?php
    function updateProcessingStatus($orderId, $newStatus) {
        global $conn;

        $updateQuery = "UPDATE orders SET processing_status = '$newStatus' WHERE order_id = $orderId";
        mysqli_query($conn, $updateQuery);
    }
?>
<?php
require_once("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin đơn hàng từ form
    $orderId = $_POST['order_id'];
    $newStatus = $_POST['new_status'];

    // Cập nhật trạng thái đơn hàng
    updateProcessingStatus($orderId, $newStatus);

    // Redirect hoặc thực hiện các hành động khác sau khi xử lý đơn hàng
    header("Location: list_orders.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Xử lý đơn hàng</title>
</head>
<body>
    <div class="container">
        <h2>Xử lý đơn hàng</h2>
        <form action="process_order.php" method="post">
            <div class="mb-3">
                <label for="order_id" class="form-label">ID Đơn hàng:</label>
                <input type="text" class="form-control" id="order_id" name="order_id" required>
            </div>
            <div class="mb-3">
                <label for="new_status" class="form-label">Trạng thái mới:</label>
                <select class="form-select" id="new_status" name="new_status" required>
                    <option value="new">Đơn hàng mới</option>
                    <option value="processing">Đang xử lý</option>
                    <option value="completed">Đã xử lý</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary"><a href="order.php" style="text-decoration: none; color:black">Cập nhật trạng thái</a></button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

 