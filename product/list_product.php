<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Danh sách sản phẩm</title>
</head>
<body>
    <div class="container">
    <table class="table">
    <thead class="thead-dark">
        <tr>
           <th>Mã sản phẩm</th>
           <th>Tên sản phẩm</th>
           <th>Giá sản phẩm</th>
           <th>Mô tả sản phẩm</th>
           <th>Số lượng</th>
           <th>Chỉnh sửa</th>
        </tr>
    </thead>
    <tbody>
        <?php

    require_once("../db.php");
    
    $list_product = "SELECT * FROM products order by sku , name , price , description, quantity ";
    
    $result = mysqli_query($conn, $list_product);  
    
    while ($r = mysqli_fetch_assoc($result)) {
       ?>
        <tr>
        <td><?php echo $r['sku']; ?></td>
        <td><?php echo $r['name']; ?></td>
        <td><?php echo $r['price']; ?></td>
        <td><?php echo $r['description']; ?></td>
        <td><?php echo $r['quantity']; ?></td>
        <td><a href="../product/edit_product.php?sid=<?php echo $r['product_id']; ?>" class="btn btn-primary">Sửa</a>
         <a onclick="return confirm('Bạn có muốn xóa sản phẩm này không');" href="../product/del_product.php?sid=<?php echo $r['product_id']; ?>"  class="btn btn-danger">Xóa</a>
        </td>
        </tr>
    <?php
    }
    ?>

    </tbody>
    </table>
    <a href="../product/add_product.html" class="btn btn-success">Thêm sản phẩm</a>



    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
