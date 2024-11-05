<?php $page = 'LOAITIN' ?>
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
                        $id = $_POST['id_loaitin'];
                        $name = $_POST['ten_loaitin'];
                        $status = $_POST['trangthai'];
                        $id_nhomtin = $_POST['id_nhomtin'];

                        $check_query = mysqli_query($conn, "SELECT * FROM `loai_tin`
                                                            WHERE `id_loaitin`='$id' || `ten_loaitin`='$name'");
                        $existing_brand = mysqli_fetch_assoc($check_query);

                        if ($existing_brand) {
                            echo '<script>alert("Loại tin đã tồn tại. Vui lòng kiểm tra lại!");</script>';
                        } else {

                        $qr3 = mysqli_query($conn, "INSERT INTO `loai_tin`(`id_loaitin`, `ten_loaitin`,`trangthai`, `id_nhomtin`) 
                                                    VALUES ('$id','$name', '$status', '$id_nhomtin')");
                        if ($qr3) {
                            echo '<script>alert("Thêm loại tin thành công!");</script>';
                            echo '<script>window.location="admin/loaitin";</script>';
                        }
                        }
                    }
                    ?>

                    <form action="" method="post" name="addForm" onsubmit="return validateForm()">
                        <div class="form-group">
                            <label for="">Mã loại tin</label>
                            <input type="text" class="form-control" name="id_loaitin">
                        </div>
                        <div class="form-group">
                            <label for="">Tên loại tin</label>
                            <input type="text" class="form-control" name="ten_loaitin">
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <select name="trangthai" class="form-control">
                                <option value="1">Được hiển thị</option>
                                <option value="0">Không được hiển thị</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Nhóm tin</label>
                            <select name="id_nhomtin" class="form-control">
                                <?php
                                $qr = mysqli_query($conn, "SELECT * FROM nhom_tin");
                                while ($row_cat = mysqli_fetch_assoc($qr)) {
                                ?>
                                    <option value="<?php echo $row_cat['id_nhomtin'] ?>">
                                                    <?php echo $row_cat['ten_nhomtin'] ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="submit"  name="submit" class="btn btn-success" value="Thêm">
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
<script>
    function validateForm() {
        var id = document.forms["addForm"]["id_loaitin"].value;
        var name = document.forms["addForm"]["ten_loaitin"].value;

        if (id == "" || name == "") {
            alert("Vui lòng nhập đủ thông tin trong các ô text!");
            return false;
        }
    }
</script>

<?php require_once '../template/inc/footer.php' ?>