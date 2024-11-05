<?php $page = 'NHOMTIN' ?>
<?php require_once '../template/inc/header.php' ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Sửa</h1>
                    <br>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <?php

                    $id = (isset($_GET['id_nhomtin'])) ? $_GET['id_nhomtin'] : '';
                    $qr2 = mysqli_query($conn, "SELECT * FROM nhom_tin WHERE id_nhomtin = $id");
                    $row_cat2 = mysqli_fetch_assoc($qr2);

                    if(isset($_POST['submit'])) {
                        $name = $_POST['ten_nhomtin'];
                        $trangthai=$_POST['trangthai'];

                        $check_query = mysqli_query($conn, "SELECT * FROM `nhom_tin` WHERE `ten_nhomtin`='$name' AND `id_nhomtin` != $id");

                        if (mysqli_num_rows($check_query) > 0) {
                            echo '<script>alert("Tên nhóm tin đã tồn tại. Vui lòng chọn tên khác!");</script>';
                        } else {
        
                            $qr3 = mysqli_query($conn, "UPDATE `nhom_tin` SET `ten_nhomtin`='$name' , `trangthai`='$trangthai'
                                                        WHERE id_nhomtin = $id");

                            if ($qr3) {
                                echo '<script>alert("Sửa nhóm tin thành công!");</script>';
                                echo '<script>window.location="admin/nhomtin";</script>';
                            }
                        }
                    }
                    ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="">Mã nhóm tin</label>
                            <span class="form-control"><?php echo $row_cat2['id_nhomtin'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Tên thương hiệu</label>
                            <input type="text" value="<?php echo $row_cat2['ten_nhomtin'] ?>" class="form-control" name="ten_nhomtin">
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <select name="trangthai" class="form-control">
                                <option value="1">Được hiển thị</option>
                                <option value="0">Không được hiển thị</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-success" value="Sửa">
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
            <div>
                <a href="admin/nhomtin/index.php"><button class="btn btn-back">Quay về</button></a>
            </div>
</div>

<?php require_once '../template/inc/footer.php' ?>