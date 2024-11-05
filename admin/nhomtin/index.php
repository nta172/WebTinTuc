<?php $page = 'NHOMTIN' ?>
<?php require_once '../template/inc/header.php' ?>

<div class="content-wrapper">

    <?php
    $sql = mysqli_query($conn, "SELECT * FROM `nhom_tin`");
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
                    <h1 class="m-0">Quản lý nhóm tin</h1>
                    <br>
                    <h5><a href="admin/nhomtin/add.php" class="btn btn-success">Thêm nhóm tin</a></h5>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã nhóm tin</th>
                                <th>Tên nhóm tin</th>
                                <th>Trạng thái</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="load">
                            <?php
                            $stt = 0;
                            $qr = mysqli_query($conn, "SELECT * FROM `nhom_tin` ORDER BY id_nhomtin ASC LIMIT $offset,5");
                            while ($row_cat = mysqli_fetch_assoc($qr)) {
                                $stt++;
                            ?>
                                <tr>
                                    <td><?php echo $stt ?></td>
                                    <td><?php echo $row_cat['id_nhomtin'] ?></td>
                                    <td><?php echo $row_cat['ten_nhomtin'] ?></td>
                                    <td><?php echo ($row_cat['trangthai'] == 1) ? 
                                                    '<span style="background-color: green; padding: 3px 10px; border-radius: 3px; color: #fff">Được hiển thị</span>' 
                                                    : '<span style="background-color: gray; padding: 3px 10px; border-radius: 3px; color: #fff">Không được hiển thị</span>'; 
                                        ?></td>
                                    <td>
                                        <a href="admin/nhomtin/update.php?id_nhomtin=<?php echo $row_cat['id_nhomtin'] ?>" 
                                            class="btn btn-success">Sửa</a> 
                                        <a href="javascript:void(0)" onclick="xnXoaNhomtin(<?php echo $row_cat['id_nhomtin'] ?>)" 
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
                            <a class="page-link" href="admin/nhomtin?page=<?php echo $previous ?>"><<</a>
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
                            <a class="page-link" href="admin/nhomtin?page=<?php echo $i ?>"><?php echo $i ?></a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if ($current_page < $nume_page) {
                        $next = $current_page + 1;

                    ?>
                        <li class="page-item">
                            <a class="page-link" href="admin/nhomtin?page=<?php echo $next ?>">Trang tiếp theo</a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>
    <div>
        <a href="admin/dashboard/index.php"><button class="btn btn-back">Quay về</button></a>
    </div>
    <br>
</div>
<br>
<?php require_once '../template/inc/footer.php' ?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function xnXoaNhomtin(id) {
        var isConfirmed = confirm('Bạn có chắc muốn xóa nhóm tin này không?');
        if (isConfirmed) {
            deleteBrand(id);
        }
    }

    function deleteBrand(id) {
    $.post('admin/nhomtin/delete.php', {
        'id_nhomtin': id
    }, function(data) {
        alert(data);
        location.reload();
    });
}
</script>