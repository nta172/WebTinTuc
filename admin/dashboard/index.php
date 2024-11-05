<?php $page = 'DB'?>
<?php require_once '../template/inc/header.php';
?>
        <div class="content-wrapper">

            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4>TRANG QUẢN LÝ ADMIN</h4>
                        </div>
                         
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-3 col-6">

                            <div class="small-box bg-info">
                                <div class="inner">
                                <?php 
                                 $qr = mysqli_query($conn,"SELECT * FROM `tin`");
                                 $row_or = mysqli_num_rows($qr);
                                ?>
                                    <h3><?php echo $row_or?> Bài viết</h3>
                                    <p>Quản lý tin tức</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                                <a href="admin/tintuc" class="small-box-footer">Xem <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                <?php 
                                 $qr1 = mysqli_query($conn,"SELECT * FROM `nhom_tin`");
                                 $row_or2 = mysqli_num_rows($qr1);
                                ?>
                                    <h3><?php echo $row_or2?> Nhóm tin</h3>

                                    <p>Quản lý nhóm tin</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                                <a href="admin/nhomtin" class="small-box-footer">Xem <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                <?php 
                                 $qr2 = mysqli_query($conn,"SELECT * FROM `loai_tin` ");
                                 $row_or3 = mysqli_num_rows($qr2);
                                ?>
                                    <h3><?php echo $row_or3?> Loại tin</h3>

                                    <p>Quản lý loại tin</p>
                                </div>
                                <div class="icon">
                                    <i class="far fa-newspaper"></i>
                                </div>
                                <a href="admin/loaitin" class="small-box-footer">Xem <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                <?php 
                                 $qr2 = mysqli_query($conn,"SELECT * FROM `binh_luan` ");
                                 $row_or3 = mysqli_num_rows($qr2);
                                 $qr4 = mysqli_query($conn,"SELECT * FROM `binh_luan` WHERE trangthai = 0;");
                                 $row_or4 = mysqli_num_rows($qr4);
                                ?>
                                    <h6 style="font-size: 18px;"><?php echo $row_or3?> Bình luận</h6>
                                    <strong class="blink" style="font-size: 14px; color: red;">Có <?php echo $row_or4?> bình luận mới</strong>
                                    <p>Quản lý bình luận</p>
                                </div>
                                <div class="icon">
                                    <i class="far fa-comments"></i>
                                </div>
                                <a href="admin/binhluan" class="small-box-footer">Xem <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <style>
            @keyframes blink {
                0% { opacity: 1; }
                50% { opacity: 0.5; }
                100% { opacity: 1; }
            }

            .blink {
                animation: blink 1s infinite;
            }
        </style>
        <?php require_once '../template/inc/footer.php' ?>