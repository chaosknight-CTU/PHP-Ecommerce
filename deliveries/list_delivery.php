<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Thông tin giao hàng</title>
</head>
<body>
    <div class="container">
    <table class="table">
    <thead class="thead-dark">
        <tr>
           <th>Số đơn hàng</th>
           <th>Khách hàng</th>
           <th>Địa chỉ giao hàng</th>
           <th>Tình trạng giao hàng</th>
          
        </tr>
    </thead>
    <tbody>
        <?php

    require_once("../db.php");
    
    $list_deliveries = "SELECT * FROM deliveries order by delivery_id , order_id , delivery_address , delivery_status";
    
    $result = mysqli_query($conn, $list_deliveries);  
    
    while ($r = mysqli_fetch_assoc($result)) {
       ?>
        <tr>
        <td><?php echo $r['delivery_id']; ?></td>
        <td><?php echo $r['order_id']; ?></td>
        <td><?php echo $r['delivery_address']; ?></td>
        <td><?php echo $r['delivery_status']; ?></td>
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
</html>
