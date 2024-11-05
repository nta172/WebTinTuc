<?php
require_once '../../DB/dbConnect.php';

if (isset($_POST['id_nhomtin'])) {
    $id = $_POST['id_nhomtin'];

    $check_query = mysqli_query($conn, "SELECT * FROM `loai_tin` WHERE `id_nhomtin` = $id");
    $num_rows = mysqli_num_rows($check_query);

    if ($num_rows > 0) {
        echo 'Không thể xóa nhóm tin này vì tồn tại khóa ngoại!';
    } else {
        $qr = mysqli_query($conn, "DELETE FROM `nhom_tin` WHERE id_nhomtin = $id");
        if ($qr) {
            echo 'Xóa thành công';
        } else {
            echo 'Lỗi xóa: ' . mysqli_error($conn);
        }
    }
}
?>
