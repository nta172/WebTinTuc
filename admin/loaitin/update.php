<?php $page = 'LOAITIN' ?>
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

                    $id = (isset($_GET['id_loaitin'])) ? $_GET['id_loaitin'] : '';

                    $qr2 = mysqli_query($conn, "SELECT * FROM loai_tin WHERE id_loaitin = '$id'");

                    $row_cat2 = mysqli_fetch_assoc($qr2);

                    if(isset($_POST['submit'])) {
                        
                        $ten_loaitin = $_POST['ten_loaitin'];
                        $trangthai = $_POST['trangthai'];
                        $id_nhomtin = $_POST['id_nhomtin'];

                        $check_query = mysqli_query($conn, "SELECT * FROM `loai_tin` ");

                        $qr3 = mysqli_query($conn, "UPDATE `loai_tin` 
                                        SET `ten_loaitin`='$ten_loaitin', `trangthai`='$trangthai', `id_nhomtin`='$id_nhomtin'
                                        WHERE id_loaitin = '$id'");

                            if ($qr3) {
                                echo '<script>alert("Sửa loại tin thành công!");</script>';
                                echo '<script>window.location="admin/loaitin";</script>';
                            }
                    }
                    ?>


                    <form action="" method="post">
                        <div class="form-group">
                            <label for="">Mã loại tin</label>
                            <span class="form-control"><?php echo $row_cat2['id_loaitin'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Tên loại tin</label>
                            <input type="text" value="<?php echo $row_cat2['ten_loaitin'] ?>" class="form-control" name="ten_loaitin">
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <select name="trangthai" class="form-control">
                                <option value="1">Được hiển thị</option>
                                <option value="0">Không được hiển thị</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Mã nhóm tin</label>
                            <select name="id_nhomtin" class="form-control">
                                <?php
                                $qr = mysqli_query($conn, "SELECT * FROM nhom_tin ");
                                while ($row_cat = mysqli_fetch_assoc($qr)) {
                                    if ($row_cat['id_nhomtin'] == $row_cat2['id_nhomtin']) {
                                ?>
                                        <option selected value="<?php echo $row_cat['id_nhomtin'] ?>">
                                                <?php echo $row_cat['ten_nhomtin'] ?></option>
                                    <?php
                                    } else {

                                    ?>
                                        <option value="<?php echo $row_cat['id_nhomtin'] ?>">
                                                <?php echo $row_cat['ten_nhomtin'] ?></option>
                                <?php
                                    }
                                }
                                ?>
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
                <a href="admin/loaitin/index.php"><button class="btn btn-back">Quay về</button></a>
            </div>
</div>

<?php require_once '../template/inc/footer.php' ?>