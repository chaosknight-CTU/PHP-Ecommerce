<?php

    $id = $_GET['sid'];

    require_once('../db.php');

    $edit_sql = "SELECT * FROM products WHERE product_id=$id";

    $result = mysqli_query($conn, $edit_sql);

    $row = mysqli_fetch_assoc($result);
    // if ($result) {
    //     // Redirect to the dashboard page
    //     header("Location: ../auth/dashboard.php");
    //     exit(); // Make sure to exit after a header redirection
    // } else {
    //     // Handle the case where the update failed
    //     echo "Update failed. Please try again.";
    // }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Chỉnh sửa sản phẩm</title>
</head>

<body>
    <div class="container">

        <!-- Form thêm khách hàng -->
        <div class="mb-4">
            <form action="update_product.php" method="post">
                <input type="hidden" name="sid"value="<?php echo $id?>" id="">
                <div class="form-group">
                    <label for="productSku">Mã sản phẩm</label>
                    <input type="text" class="form-control" id="productSku" name="productSku"
                    value="<?php echo $row['sku'] ?>">
                </div>
                <div class="form-group">
                    <label for="productName">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="productName" name="productName"
                    value="<?php echo $row['name'] ?>">
                </div>
                <div class="form-group">
                    <label for="productPrice">Giá</label>
                    <input type="text" class="form-control" id="productPrice" name="productPrice"
                    value="<?php echo $row['price'] ?>">
                </div>
                <div class="form-group">
                    <label for="productDesc">Mô tả</label>
                    <input type="text" class="form-control" id="productDesc" name="productDesc"
                    value="<?php echo $row['description'] ?>">
                </div>
                <div class="form-group">
                    <label for="productQuantity">Số lượng</label>
                    <input type="text" class="form-control" id="productQuantity" name="productQuantity"
                    value="<?php echo $row['quantity'] ?>">
                </div>
                <button type="submit"   class="btn btn-success"><a href="../auth/dashboard.php" style="text-decoration: none; color: black">Chỉnh sửa sản phẩm</a</button>
                
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