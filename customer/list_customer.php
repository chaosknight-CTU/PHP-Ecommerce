<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Danh sách người dùng</title>
</head>
<body>
    
    <div class="container">
    <h1>Danh Sách Khách Hàng</h1>
    <table class="table">
    <thead class="thead-dark">
        <tr>
           <th>Tên</th>
           <th>Địa chỉ</th>
           <th>Số điện thoại</th>
           <th>Email</th>
           <th>Chỉnh sửa</th>
        </tr>
    </thead>
    <tbody>
        <?php

    require_once("../db.php");
    
    $list_customer = "SELECT * FROM customers order by name , address , phone , email ";
    
    $result = mysqli_query($conn, $list_customer);  
    
    while ($r = mysqli_fetch_assoc($result)) {
       ?>
        <tr>
        <td><?php echo $r['name']; ?></td>
        <td><?php echo $r['address']; ?></td>
        <td><?php echo $r['phone']; ?></td>
        <td><?php echo $r['email']; ?></td>
        <td><a href="edit_customer.php?sid=<?php echo $r['customer_id']; ?>" class="btn btn-primary">Sửa</a>
         <a onclick="return confirm('Bạn có muốn xóa khách hàng này không');" href="del_customer.php?sid=<?php echo $r['customer_id']; ?>"  class="btn btn-danger">Xóa</a>
        </td>
        </tr>
    <?php
    }
    ?>

    </tbody>
    </table>
    <a href="add_customer.html" class="btn btn-success">Thêm khách hàng</a>



    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
