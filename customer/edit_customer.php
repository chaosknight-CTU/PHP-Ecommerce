<?php

$id = $_GET['sid'];

require_once('../db.php');

$edit_sql = "SELECT * FROM customers WHERE customer_id=$id";

$result = mysqli_query($conn, $edit_sql);

$row = mysqli_fetch_assoc($result);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Chỉnh sửa khách hàng</title>
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Chỉnh sửa khách hàng</h1>

        <!-- Form thêm khách hàng -->
        <div class="mb-4">
            <form action="update_customer.php" method="post">
                <input type="hidden" name="sid"value="<?php echo $id?>" id="">
                <div class="form-group">
                    <label for="customerName">Tên</label>
                    <input type="text" class="form-control" id="customerName" name="customerName"
                    value="<?php echo $row['name'] ?>">
                </div>
                <div class="form-group">
                    <label for="customerAddress">Địa chỉ</label>
                    <input type="text" class="form-control" id="customerAddress" name="customerAddress"
                    value="<?php echo $row['address'] ?>">
                </div>
                <div class="form-group">
                    <label for="customerPhone">Số điện thoại</label>
                    <input type="text" class="form-control" id="customerPhone" name="customerPhone"
                    value="<?php echo $row['phone'] ?>">
                </div>
                <div class="form-group">
                    <label for="customerEmail">Email</label>
                    <input type="email" class="form-control" id="customerEmail" name="customerEmail"
                    value="<?php echo $row['email'] ?>">
                </div>
                <button type="submit" class="btn btn-success" ><a href="../auth/dashboard.php" style="text-decoration: none; color: black"> Chỉnh sửa khách hàng</a></button>
            </form>
        </div>

        <!-- Danh sách khách hàng -->

    </div>
    <style>
        .btn-success {
            margin-top: 10px;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>