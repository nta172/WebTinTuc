<?php $page = 'NHOMTIN' ?>
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
                        
                        $id=$_POST['id_nhomtin'];
                        $name  = $_POST['ten_nhomtin'];
                        $status=$_POST['trangthai'];
                        
                        $check_query = mysqli_query($conn, "SELECT * FROM `nhom_tin` 
                                                            WHERE `id_nhomtin`='$id' || `ten_nhomtin`='$name'");
                        $existing_brand = mysqli_fetch_assoc($check_query);
                        
                        if ($existing_brand) {
                            echo '<script>alert("Nhóm tin đã tồn tại. Vui lòng kiểm tra lại!");</script>';
                        } else {
                            $qr3 = mysqli_query($conn, "INSERT INTO `nhom_tin`(`id_nhomtin`, `ten_nhomtin`,`trangthai`) 
                                                        VALUES ('$id','$name', '$status')");
                            if ($qr3) {
                                echo '<script>alert("Thêm nhóm tin thành công!");</script>';
                                echo '<script>window.location="admin/nhomtin";</script>';
                            }
                        }
                    }
                    ?>

                    <?php
                        $get_max_id_query = mysqli_query($conn, "SELECT MAX(id_nhomtin) AS max_id FROM nhom_tin");
                        $max_id_row = mysqli_fetch_assoc($get_max_id_query);
                        $max_id = $max_id_row['max_id']; 
                        $new_id = $max_id + 1;
                    ?>
                    <form action="" method="post" name="addForm" onsubmit="return validateForm()">
                        <div class="form-group">
                            <label for="">Mã nhóm tin</label>
                            <input type="text" class="form-control" name="id_nhomtin" value="<?php echo $new_id; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Tên nhóm tin</label>
                            <input type="text" class="form-control" name="ten_nhomtin">
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <select name="trangthai" class="form-control">
                                <option value="1">Được hiển thị</option>
                                <option value="0">Không được hiển thị</option>
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
                <a href="admin/nhomtin/index.php"><button class="btn btn-back">Quay về</button></a>
            </div>
</div>
<script>
    function validateForm() {
        var id = document.forms["addForm"]["id_nhomtin"].value;
        var name = document.forms["addForm"]["ten_nhomtin"].value;

        if (id == "" || name == "") {
            alert("Vui lòng nhập đủ thông tin trong các ô text!");
            return false;
        }
    }
</script>

<?php require_once '../template/inc/footer.php' ?>