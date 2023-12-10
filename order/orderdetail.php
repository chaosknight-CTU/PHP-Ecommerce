<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Chi tiết đơn hàng</title>
</head>
<body>
    <div class="container">
        <h2>Chi tiết đơn hàng</h2>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Số thứ tự</th>
                    <th>ID Đơn hàng</th>
                    <th>ID Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá tiền</th>
                    <th>Tình trạng xử lý</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once("../db.php");

                $list_orderdetail = "SELECT od.order_id, od.product_id, od.quantity, p.price, o.processing_status
                                    FROM orderdetails od
                                    LEFT JOIN products p ON od.product_id = p.product_id
                                    LEFT JOIN orders o ON od.order_id = o.order_id
                                    ORDER BY od.order_id, od.product_id, od.quantity";

                $result = mysqli_query($conn, $list_orderdetail);
                if (!$result) {
                    die("Truy vấn thất bại: " . mysqli_error($conn));
                }

                $orderNumber = 1;

                while ($r = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $orderNumber++; ?></td>
                        <td><?php echo $r['order_id']; ?></td>
                        <td><?php echo $r['product_id']; ?></td>
                        <td><?php echo $r['quantity']; ?></td>
                        <td><?php echo $r['price'] * $r['quantity']; ?></td>
                        <td><?php echo translateStatus($r['processing_status']); ?></td>
                    </tr>
                <?php
                }

                function translateStatus($status) {
                    switch ($status) {
                        case 'new':
                            return 'Đơn hàng mới';
                        case 'processing':
                            return 'Đang xử lý';
                        case 'completed':
                            return 'Đã xử lý';
                        default:
                            return 'Không xác định';
                    }
                }
                ?>
            </tbody>
        </table>'
        <a href="../auth/dashboard.php">Home</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
