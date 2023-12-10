<?php
session_start();
require_once("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kết nối đến cơ sở dữ liệu

    // Lấy dữ liệu từ form
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM Customers WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row["password_hash"])) {
            $_SESSION["customer_id"] = $row["customer_id"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["role"] = $row["role"];

            if ($_SESSION["role"] == "admin") {
                header("Location: dashboard.php?type=admin");
                exit();
            } else {
                header("Location: dashboard.php?type=user");
                
                exit();
            }
        } else {
            $error_message = "Incorrect password";
        }
    } else {
        $error_message = "User not found";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Đăng Nhập</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <form method="post" action="login.php" class="col-md-4 offset-md-4">
        <h2 class="mb-4">Đăng nhập</h2>

        <?php
        // Hiển thị thông báo lỗi nếu có
        if (isset($error_message)) {
            echo '<div class="alert alert-danger" role="alert">' . $error_message . '</div>';
        }
        ?>

        <div class="form-group">
            <label for="username">Tên đăng nhập:</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Mật Khẩu:</label>
            <div class="input-group">
                <input type="password" name="password" id="password" class="form-control" required>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="showPassword">Hiển thị</button>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Đăng Nhập</button>
        <a href="register.php">Đăng ký</a>
    </form>
</div>

<!-- Bootstrap JS and dependencies (place these at the end of the body) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        $("#showPassword").on("click", function () {
            var passwordField = $("#password");
            var passwordFieldType = passwordField.attr("type");

            // Toggle password visibility
            if (passwordFieldType === "password") {
                passwordField.attr("type", "text");
                $(this).text("Hide");
            } else {
                passwordField.attr("type", "password");
                $(this).text("Show");
            }
        });
    });
</script>

</body>
</html>
