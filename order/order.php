<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Thông tin đơn hàng</title>
</head>
<body>
    <div class="container">
        <h2>Thông tin đơn hàng</h2>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Số đơn hàng</th>
                    <th>Ngày đặt hàng</th>
                    <th>Khách hàng</th>
                    <th>Sản phẩm</th>
                    <th>Giá tiền</th>
                    <th>Chỉnh sửa đơn hàng</th>
                    <th>Chi tiết đơn hàng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once("../db.php");

                $list_order = "SELECT o.order_id, o.order_number, o.order_date, c.name as customer_name, p.name as product_name, p.price
                               FROM orders o
                               JOIN customers c ON o.customer_id = c.customer_id
                               JOIN orderdetails od ON o.order_id = od.order_id
                               JOIN products p ON od.product_id = p.product_id
                               ORDER BY o.order_number, o.order_date";

                $result = mysqli_query($conn, $list_order);

                while ($r = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $r['order_number']; ?></td>
                        <td><?php echo $r['order_date']; ?></td>
                        <td><?php echo $r['customer_name']; ?></td>
                        <td><?php echo $r['product_name']; ?></td>
                        <td><?php echo $r['price']; ?></td>
                        <td>
                            <a href="edit_order.php?sid=<?php echo $r['order_id']; ?>" class="btn btn-primary">Sửa</a>
                            <a onclick="return confirm('Bạn có muốn xóa sản phẩm này không');" href="del_order.php?sid=<?php echo $r['order_id']; ?>"  class="btn btn-danger">Xóa</a>
                        </td>
                        <td><a href="orderdetail.php?sid=<?php echo $r['order_id']; ?>" class="btn btn-primary">Xem chi tiết</a></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Thông tin đơn hàng</title>
</head>
<body>
    <div class="container">
        <h2>Thông tin đơn hàng</h2>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Số đơn hàng</th>
                    <th>Ngày đặt hàng</th>
                    <th>Khách hàng</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá tiền</th>
                    <th>Chi tiết đơn hàng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once("../db.php");

                $list_order = "SELECT o.order_id, o.order_number, o.order_date, c.name as customer_name, c.address as customer_address, c.phone as customer_phone, p.name as product_name, p.price, od.quantity
                               FROM orders o
                               LEFT JOIN customers c ON o.customer_id = c.customer_id
                               LEFT JOIN orderdetails od ON o.order_id = od.order_id
                               LEFT JOIN products p ON od.product_id = p.product_id
                               ORDER BY o.order_number, o.order_date";

                $result = mysqli_query($conn, $list_order);

                $totalPrice = 0;

                while ($r = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $r['order_number']; ?></td>
                        <td><?php echo $r['order_date']; ?></td>
                        <td><?php echo $r['customer_name']; ?></td>
                        <td><?php echo $r['customer_address']; ?></td>
                        <td><?php echo $r['customer_phone']; ?></td>
                        <td><?php echo $r['product_name']; ?></td>
                        <td><?php echo $r['quantity']; ?></td>
                        <td><?php echo $r['price']; ?></td>
                        <td><a href="orderdetail.php?sid=<?php echo $r['order_id']; ?>" class="btn btn-primary">Xem chi tiết</a></td>
                    </tr>
                    <?php
                    $totalPrice += ($r['price'] * $r['quantity']);
                }
                ?>
            </tbody>
        </table>
        <h4>Tổng giá tiền của tất cả các đơn hàng: <?php echo $totalPrice; ?></h4>
        <a href="process_order.php" class="btn btn-success" style="text-decoration: none; color: black">Xử lí đơn hàng</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
