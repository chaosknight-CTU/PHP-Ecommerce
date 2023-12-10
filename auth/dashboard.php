    <?php
    session_start();

    // Kiểm tra vai trò của người dùng
    if (isset($_SESSION["role"])) {
        if ($_SESSION["role"] == "admin") {
            $welcomeMessage =  "Welcome, " . $_SESSION["username"] . "!";
        } else {
            $welcomeMessage =  "Welcome, " . $_SESSION["username"] . "!";
        }
    } else {
        $welcomeMessage = "User not logged in";
    }

    // Nội dung cụ thể dựa trên vai trò
    if (isset($_SESSION["role"])) {
        if ($_SESSION["role"] == "admin") {
            ob_start(); // Start output buffering
            include("../product/list_product.php");
            $content = ob_get_clean();
        } else {
            ob_start(); // Start output buffering
            include("../product/list_product.php");
            $content = ob_get_clean(); // Get the buffer contents and clean the buffer
        }
    } else {
        $content = "";
    }

    // Kiểm tra xem người dùng đã đăng nhập chưa để hiển thị modal
    $showWelcomeModal = false;
    if (isset($_SESSION["username"]) && !isset($_SESSION["welcome_modal_shown"])) {
        $showWelcomeModal = true;
        $_SESSION["welcome_modal_shown"] = true; // Đánh dấu đã hiển thị modal chào mừng
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Dashboard</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- <a class="navbar-brand" href="#">Dashboard</a> -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
            
                <li class="nav-item">
                    <a class="nav-link" href="#" data-url="../product/list_product.php" id="loadProduct">Sản Phẩm</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../customer/list_customer.php">Khách Hàng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../deliveries/list_delivery.php">Giao Hàng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../order/order.php">Đặt Hàng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#welcomeModal"><?php echo $welcomeMessage; ?></a>
                </li>
                <li class="nav-item">
                    <a href="login.php" class="btn btn-danger">Đăng Xuất</a>
                    
                </li>
            </ul>
        </div>
    </nav>

    <!-- Modal -->
    <?php if ($showWelcomeModal): ?>
    <div class="modal fade" id="welcomeModal" tabindex="-1" role="dialog" aria-labelledby="welcomeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="welcomeModalLabel">Welcome Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo $welcomeMessage; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div id="dynamicContentContainer" class="container mt-5">
        <h2>Sản phẩm</h2>
        
        <?php echo $content; ?>
    </div>

    <!-- Bootstrap JS and dependencies (place these at the end of the body) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Thêm đoạn mã script vào cuối thẻ body hoặc trong thẻ head -->
    <script>
        $(document).ready(function(){
            // Hàm để tải nội dung qua AJAX
            function loadContent(url) {
                $.ajax({
                    url: url,
                    success: function(data) {
                        $('#dynamicContentContainer').html(data);
                    },
                    error: function() {
                        $('#dynamicContentContainer').html('Lỗi khi tải nội dung.');
                    }
                });
            }

            // Sự kiện khi nhấp vào liên kết "Sản phẩm"
            $('#loadProduct').click(function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                loadContent(url);
            });

            

            // Tải nội dung ban đầu (nếu cần)
            // Bỏ comment dòng dưới nếu bạn muốn tải nội dung sản phẩm ngay từ đầu.
            // loadContent($('#loadProduct').data('url'));
        });
    </script>

    </body>
    </html>
