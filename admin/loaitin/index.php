<?php $page = 'LOAITIN' ?>
<?php require_once '../template/inc/header.php' ?>
<div class="content-wrapper">

    <?php
    $sql = mysqli_query($conn, "SELECT * FROM `loai_tin`");
    $nume_row = mysqli_num_rows($sql);
    $nume_page = ceil($nume_row / 5);
    if (isset($_GET['page'])) {
        $current_page = $_GET['page'];
    } else {
        $current_page = 1;
    }
    $offset = ($current_page - 1) * 5;
    ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Quản lý loại tin</h1>
                    <br>
                    <h5><a href="admin/loaitin/add.php" class="btn btn-success">Thêm</a></h5>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã</th>
                                <th>Tên</th>
                                <th>Trạng thái</th>
                                <th>Nhóm tin</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="load">
                            <?php
                            $stt = 0;
                            
                            $qr = mysqli_query($conn, "SELECT * FROM loai_tin LIMIT $offset,5");
                            while ($row_cat = mysqli_fetch_assoc($qr)) {
                                $stt++;
                            ?>
                                <tr>
                                    <td><?php echo $stt ?></td>

                                    <td><?php echo $row_cat['id_loaitin'] ?></td>

                                    <td><?php echo $row_cat['ten_loaitin'] ?></td>

                                    <td><?php echo ($row_cat['trangthai'] == 1) ? 
                                                    '<span style="background-color: green; padding: 3px 10px; border-radius: 3px; color: #fff">Được hiển thị</span>' 
                                                    : '<span style="background-color: gray; padding: 3px 10px; border-radius: 3px; color: #fff">Không được hiển thị</span>'; 
                                        ?></td>

                                    <?php
                                        $query = "SELECT loai_tin.*, nhom_tin.ten_nhomtin 
                                                    FROM loai_tin 
                                                    INNER JOIN nhom_tin ON loai_tin.id_nhomtin = nhom_tin.id_nhomtin 
                                                    WHERE loai_tin.id_nhomtin = '{$row_cat['id_nhomtin']}'";

                                        $result = mysqli_query($conn, $query);
                                        if ($result && mysqli_num_rows($result) > 0) {
                                            $row = mysqli_fetch_assoc($result);
                                            $tennhomtin = $row['ten_nhomtin'];
                                        } else {
                                            $tennhomtin = "Không xác định"; 
                                        }
                                    ?>

                                    <td><?php echo $tennhomtin ?></td>

                                    <td>
                                        <a href="admin/loaitin/update.php?id_loaitin=<?php echo $row_cat['id_loaitin'] ?>" 
                                            class="btn btn-success">Sửa</a> 
                                        <a href="javascript:void(0)" onclick="xnXoaLoaitin('<?php echo $row_cat['id_loaitin'] ?>')" 
                                            class="btn btn-danger">Xóa</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>

    <br>
    <div class="col-sm-6" style="text-align: right;">
        <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
            <nav aria-label="...">
                <ul class="pagination">
                    <?php
                    if ($current_page > 1) {
                        $previous = $current_page - 1;

                    ?>
                        <li class="page-item">
                            <a class="page-link" href="admin/loaitin?page=<?php echo $previous ?>"><<</a>
                        </li>
                    <?php } ?>
                    <?php
                    for ($i = 1; $i <= $nume_page; $i++) {
                        $active = '';
                        if ($i == $current_page) {
                            $active = 'active';
                        }
                    ?>
                        <li class="page-item <?php echo $active ?>">
                            <a class="page-link" href="admin/loaitin?page=<?php echo $i ?>"><?php echo $i ?></a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if ($current_page < $nume_page) {
                        $next = $current_page + 1;

                    ?>
                        <li class="page-item">
                            <a class="page-link" href="admin/loaitin?page=<?php echo $next ?>">Trang tiếp theo</a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>
            <div>
                <a href="admin/dashboard/index.php"><button class="btn btn-back">Quay về</button></a>
            </div>
</div>
<br>

<?php require_once '../template/inc/footer.php' ?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function xnXoaLoaitin(id) {
        var isConfirmed = confirm('Bạn có chắc muốn xóa loại này không?');
        if (isConfirmed) {
            xoaloaitin(id);
        }
    }

    function xoaloaitin(id) {
    $.post('admin/loaitin/delete.php', {
        'id_loaitin': id
    }, function(data) {
        alert(data);
        location.reload();
    });
}
</script>