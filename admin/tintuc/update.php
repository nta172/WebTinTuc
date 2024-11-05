<?php $page = 'TINTUC' ?>
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

                    $id = (isset($_GET['id_tin'])) ? $_GET['id_tin'] : '';

                    $qr2 = mysqli_query($conn, "SELECT * FROM tin WHERE id_tin = $id");

                    $row_cat2 = mysqli_fetch_assoc($qr2);

                    if(isset($_POST['submit'])) {
                        $tieude = mysqli_real_escape_string($conn, $_POST['tieude']);
                        $mota = $_POST['mota'];
                        $noidung = $_POST['noidung'];
                        $ngaydangtin = $_POST['ngaydangtin'];
                        $tinhot = $_POST['tinhot'];
                        $trangthai = $_POST['trangthai'];
                        $id_loaitin = $_POST['id_loaitin'];
                    
                        if(isset($_FILES['new_hinhdaidien']['name']) && $_FILES['new_hinhdaidien']['name'] != '') {

                            $filename = $_FILES['new_hinhdaidien']['name'];
                            $tmp_name = $_FILES['new_hinhdaidien']['tmp_name'];
                            $name_file = 'hinhanh-' . time() . $filename;
                            $path = '../upload/' . $name_file;
                            
                            move_uploaded_file($tmp_name, $path);
                    
                            $qr = mysqli_query($conn,"UPDATE `tin` 
                                SET `tieude`='$tieude', `hinhdaidien`='$name_file',`mota`='$mota',`noidung`='$noidung',`ngaydangtin`='$ngaydangtin',
                                `tinhot`='$tinhot',`trangthai`='$trangthai',`id_loaitin`='$id_loaitin'
                                WHERE id_tin = $id");
                        } else {
                            $qr = mysqli_query($conn,"UPDATE `tin` 
                                SET `tieude`='$tieude', `mota`='$mota',`noidung`='$noidung',`ngaydangtin`='$ngaydangtin',
                                `tinhot`='$tinhot',`trangthai`='$trangthai',`id_loaitin`='$id_loaitin'
                                WHERE id_tin = $id");
                        }
                    
                        if($qr){
                            echo '<script>alert("Sửa bài viết thành công!");</script>';
                            echo '<script>window.location="admin/tintuc";</script>';
                        }
                    }                    
                    ?>

                    <form action="" method="post" enctype="multipart/form-data" >
                        <div class="form-group">
                            <label for="">Mã tin</label>
                            <span class="form-control"><?php echo $row_cat2['id_tin'] ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Tiêu đề</label>
                            <input type="text" value="<?php echo $row_cat2['tieude'] ?>" class="form-control" name="tieude">
                        </div>

                        <div class="form-group">
                            <label for="">Hình đại diện cũ</label>
                            <?php
                                echo '<input type="text" class="form-control" name="hinhdaidien" 
                                            value="' . $row_cat2['hinhdaidien'] . '" readonly>';
                            ?>
                            </br>
                            <label for="">Hình đại diện mới</label>
                            <input type="file" class="form-control" name="new_hinhdaidien">
                        </div>

                        <div class="form-group">
                            <label for="">Mô tả</label>
                            <textarea name="mota" class="form-control" id="" cols="5" rows="5">
                                        <?php echo $row_cat2['mota'] ?>
                            </textarea>
                        </div>

                        <div class="form-group">
                            <label for="">Nội dung</label>
                            <textarea name="noidung" class="form-control" id="noidung_summernote" cols="30" rows="10">
                                <?php echo $row_cat2['noidung'] ?>
                            </textarea>
                        </div>
                        <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'></script>  
                        <script>
                            var editor = new FroalaEditor('#noidung_summernote',{
                                height: 300,
                                imageUploadURL: 'admin/tintuc/upload.php',
                            });
                        </script> 
                        
                        <div class="form-group">
                            <label for="">Ngày đăng tin</label>
                            <input type="text" class="form-control" name="ngaydangtin" 
                                        value="<?php echo date('Y-m-d'); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Tác giả</label>
                            <input type="text" class="form-control" name="tacgia" 
                                        value="<?php echo $row_cat2['tacgia'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Số lần xem</label>
                            <input type="text" class="form-control" name="solanxem" 
                                        value="<?php echo $row_cat2['solanxem'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Tin nổi bật</label>
                            <select name="tinhot" class="form-control">
                                <option value="1" <?php if ($row_cat2['tinhot'] == 1) echo 'selected'; ?>>Tin nổi bật</option>
                                <option value="0" <?php if ($row_cat2['tinhot'] == 0) echo 'selected'; ?>>Tin thường</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <select name="trangthai" class="form-control">
                                <option value="1" <?php if ($row_cat2['trangthai'] == 1) echo 'selected'; ?>>Được hiển thị</option>
                                <option value="0" <?php if ($row_cat2['trangthai'] == 0) echo 'selected'; ?>>Không được hiển thị</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Loại tin</label>
                            <select name="id_loaitin" class="form-control">
                                <?php
                                    $qr_loaitin = mysqli_query($conn, "SELECT * FROM loai_tin");
                                    while ($row_loaitin = mysqli_fetch_assoc($qr_loaitin)) {
                                        $selected = ($row_loaitin['id_loaitin'] == $row_cat2['id_loaitin']) ? 'selected' : '';
                                    ?>
                                        <option value="<?php echo $row_loaitin['id_loaitin'] ?>" <?php echo $selected ?>>
                                            <?php echo $row_loaitin['ten_loaitin'] ?>
                                        </option>
                                    <?php
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
                <a href="admin/tintuc/index.php"><button class="btn btn-back">Quay về</button></a>
            </div>
</div>

<?php require_once '../template/inc/footer.php' ?>