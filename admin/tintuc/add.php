<?php $page = 'TINTUC' ?>
<?php require_once '../template/inc/header.php' ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Thêm</h1>
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
                  if(isset($_POST['submit'])) {

                      $tieude = mysqli_real_escape_string($conn, $_POST['tieude']);
                      $mota = $_POST['mota'];

                      $noidung = $_POST['noidung'];

                      $ngaydangtin = $_POST['ngaydangtin'];
                      $tacgia = $_POST['tacgia'];
                      $solanxem = $_POST['solanxem'];
                      $tinhot = $_POST['tinhot'];
                      $trangthai = $_POST['trangthai'];
                      $id_loaitin = $_POST['id_loaitin'];
                    
                      if(isset($_FILES['hinhdaidien']['name'])) {
                          $filename = $_FILES['hinhdaidien']['name'];
                          $tmp_name = $_FILES['hinhdaidien']['tmp_name'];
                          $name_file = 'hinhanh-' . time() . $filename;
                          $path = '../upload/' . $name_file;
                          move_uploaded_file($tmp_name, $path);
                      }
                      $qr = mysqli_query($conn,"INSERT INTO `tin`(`tieude`, `hinhdaidien`, `mota`, `noidung`,`ngaydangtin`
                            ,`tacgia`,`solanxem`,`tinhot`,`trangthai`,`id_loaitin`) 
                            VALUES ('$tieude','$name_file','$mota','$noidung','$ngaydangtin','$tacgia','$solanxem',
                                    '$tinhot','$trangthai','$id_loaitin')");
                      if($qr){
                        echo '<script>alert("Thêm bài viết thành công!");</script>';
                        echo '<script>window.location="admin/tintuc";</script>';
                      }
                  }
                ?>
                    <form action="" method="post" enctype="multipart/form-data" name="addForm" onsubmit="return validateForm()">
                        <div class="form-group">
                            <label for="">Tiêu đề</label>
                            <input type="text" class="form-control" name="tieude">
                        </div>
                        <div class="form-group">
                            <label for="">Hình đại diện</label>
                            <input type="file" class="form-control" name="hinhdaidien">
                        </div>

                        <div class="form-group">
                            <label for="">Mô tả</label>
                            <textarea class="form-control" name="mota"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Nội dung</label>
                            <textarea name="noidung" class="form-control" id="noidung_summernote" cols="30" rows="10"></textarea>
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
                            <input type="text" class="form-control" name="ngaydangtin" value="<?php echo date('Y-m-d'); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Tác giả</label>
                            <input type="text" class="form-control" name="tacgia" value="ADMIN" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Số lần xem</label>
                            <input type="text" class="form-control" name="solanxem" value="0" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Tin nổi bật</label>
                            <select name="tinhot" class="form-control">
                                <option value="1">Tin nổi bật</option>
                                <option value="0">Tin thường</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <select name="trangthai" class="form-control">
                                <option value="1">Được hiển thị</option>
                                <option value="0">Không được hiển thị</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Loại tin</label>
                            <select name="id_loaitin" class="form-control">
                                <?php
                                $qr = mysqli_query($conn, "SELECT * FROM loai_tin");
                                while ($row_cat = mysqli_fetch_assoc($qr)) {
                                ?>
                                    <option value="<?php echo $row_cat['id_loaitin'] ?>">
                                                    <?php echo $row_cat['ten_loaitin'] ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-success" value="Thêm">
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
    <div>
        <a href="admin/tintuc/index.php"><button class="btn btn-back">Quay về</button></a>
    </div>

<script>
    function validateForm() {
        var tieude = document.forms["addForm"]["tieude"].value;

        if (tieude == "" ) {
            alert("Vui lòng nhập đủ thông tin trong các ô text!");
            return false;
        }
    }
</script>
<?php require_once '../template/inc/footer.php' ?>