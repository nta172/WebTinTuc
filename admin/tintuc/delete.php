<?php
require_once '../../DB/dbConnect.php';

if (isset($_POST['id_tin'])) {
    $id = $_POST['id_tin'];

    $check_query = mysqli_query($conn, "SELECT * FROM `binh_luan` WHERE `id_tin` = $id");
    $num_rows = mysqli_num_rows($check_query);

    if ($num_rows > 0) {
        echo 'Không thể xóa bài viết này vì tồn tại khóa ngoại!';
    } else {
        $qr = mysqli_query($conn, "DELETE FROM `tin` WHERE id_tin = $id");
        if ($qr) {
            echo 'Xóa thành công';
        } else {
            echo 'Lỗi xóa: ' . mysqli_error($conn);
        }
    }
}
?>