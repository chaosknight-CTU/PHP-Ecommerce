<?php
session_start();
require_once("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Kiểm tra xác nhận mật khẩu
    if ($password != $confirm_password) {
        $error_message = "Password and confirm password do not match.";
    } else {
        // Kiểm tra xem số điện thoại, email và username có trùng nhau không
        $check_duplicate_sql = "SELECT * FROM Customers WHERE phone='$phone' OR email='$email' OR username='$username'";
        $duplicate_result = $conn->query($check_duplicate_sql);

        if ($duplicate_result->num_rows > 0) {
            $error_message = "Phone, email, or username already exists. Please choose a different one.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $insert_sql = "INSERT INTO Customers (name, address, phone, email, username, password_hash, role) VALUES ('$name', '$address', '$phone', '$email', '$username', '$hashed_password', 'user')";

            if ($conn->query($insert_sql) === TRUE) {
                echo "Registration successful!";
                header("Location: login.php");
            } else {
                echo "Error: " . $insert_sql . "<br>" . $conn->error;
            }
        }
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registration Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <form method="post" action="register.php" class="col-md-6 offset-md-3">
        <h2 class="mb-4">Đăng Ký</h2>

        <?php
        // Hiển thị thông báo lỗi nếu có
        if (isset($error_message)) {
            echo '<div class="alert alert-danger" role="alert">' . $error_message . '</div>';
        }
        ?>

        <div class="form-group">
            <label for="name">Họ & Tên:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="address">Địa Chỉ:</label>
            <input type="text" name="address" class="form-control">
        </div>
        <div class="form-group">
            <label for="phone">Số điện thoại:</label>
            <input type="text" name="phone" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="username">Tên đăng nhập:</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Xác nhận mật khẩu:</label>
            <input type="password" name="confirm_password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Đăng Ký</button>
        <a href="login.php">Đăng nhập</a>
    </form>
</div>

<!-- Bootstrap JS and dependencies (place these at the end of the body) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
