<?php
require_once '../../DB/dbConnect.php';

if (isset($_POST['id_loaitin'])) {
    $id = $_POST['id_loaitin'];

    $check_query = mysqli_query($conn, "SELECT * FROM `tin` WHERE `id_loaitin` = '$id'");
    $num_rows = mysqli_num_rows($check_query);

    if ($num_rows > 0) {
        echo 'Không thể xóa nhóm tin này vì tồn tại khóa ngoại!';
    } else {
        $qr = mysqli_query($conn, "DELETE FROM `loai_tin` WHERE id_loaitin = '$id'");
        if ($qr) {
            echo 'Xóa thành công';
        } else {
            echo 'Lỗi xóa: ' . mysqli_error($conn);
        }
    }
}
?>
