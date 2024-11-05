<?php
session_start();

if (isset($_POST['id_tin']) && !empty($_POST['email']) && !empty($_POST['noidung'])) {
    
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Email không hợp lệ!");</script>';
    } else {
        
        $thoigian = $_POST['thoigian'];
        $noidung = $_POST['noidung'];
        $trangthai = 0;
        $id_tin = $_POST['id_tin'];

        require_once 'DB/dbConnect.php';
        $qr = mysqli_query($conn, "INSERT INTO `binh_luan`(`email`, `thoigian`, `noidung`, `trangthai`, `id_tin`) 
                                VALUES ('$email','$thoigian','$noidung', '$trangthai','$id_tin')");
        if ($qr) {
            echo '<script>alert("Bình luận của bạn đã được gửi và chờ phê duyệt!");</script>';
            echo '<script>window.location.reload();</script>';
        } else {
            echo '<script>alert("Có lỗi xảy ra! Vui lòng thử lại sau.");</script>';
        }
    }
} else {
    echo '<script>alert("Vui lòng nhập đầy đủ thông tin!");</script>';
}
?>

<!-- Chưa fix đc captcha-->
<!-- <?php
session_start();

if (isset($_POST['id_tin']) && !empty($_POST['email']) && !empty($_POST['noidung']) 
    && !empty($_POST['captcha']) && isset($_SESSION['captcha'])) {
    
    if ($_POST['captcha'] !== $_SESSION['captcha']) {
        echo '<script>alert("Mã xác thực không đúng!");</script>';
    } else {
        
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<script>alert("Email không hợp lệ!");</script>';
        } else {
            
            $thoigian = $_POST['thoigian'];
            $noidung = $_POST['noidung'];
            $trangthai = 0;
            $id_tin = $_POST['id_tin'];

            require_once 'DB/dbConnect.php';
            $qr = mysqli_query($conn, "INSERT INTO `binh_luan`(`email`, `thoigian`, `noidung`, `trangthai`, `id_tin`) 
                                    VALUES ('$email','$thoigian','$noidung', '$trangthai','$id_tin')");
            if ($qr) {
                echo '<script>alert("Bình luận của bạn đã được gửi và chờ phê duyệt!");</script>';
                echo '<script>window.location.reload();</script>';
            } else {
                echo '<script>alert("Có lỗi xảy ra! Vui lòng thử lại sau.");</script>';
            }
        }
    }
} else {
    echo '<script>alert("Vui lòng nhập đầy đủ thông tin!");</script>';
}
?> -->
