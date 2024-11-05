<?php $page = 'BINHLUAN' ?>
<?php require_once '../template/inc/header.php' ?>

<div class="content-wrapper">

    <?php
    $sql = mysqli_query($conn, "SELECT * FROM tin
                                         LEFT JOIN binh_luan ON tin.id_tin = binh_luan.id_tin
                                         GROUP BY tin.id_tin");
    $nume_row = mysqli_num_rows($sql);
    $nume_page = ceil($nume_row / 50);
    if (isset($_GET['page'])) {
        $current_page = $_GET['page'];
    } else {
        $current_page = 1;
    }
    $offset = ($current_page - 1) * 50;
    ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Quản lý bình luận</h1>
                    <br>
                    <input type="search" class="form-control" id="search" name="search" placeholder="Nhập để tìm kiếm bình luận...">
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#search").keypress(function() {
                $.ajax({
                    type: "POST",
                    url: 'admin/binhluan/timkiem.php',
                    data: {
                        name: $("#search").val(),
                    },
                    success: function(data) {
                        $("#load").html(data);
                    }
                })
            });
        })
    </script>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tiêu đề</th>
                                <th style="white-space: nowrap;">Hình đại diện</th>
                                <th style="white-space: nowrap;">Số lượt bình luận</th>
                                <th style="white-space: nowrap;">Đã duyệt</th>
                                <th style="white-space: nowrap; color: red; font-weight: bold;">Bình luận mới</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="load">
                            <?php
                                $sql = mysqli_query($conn, "SELECT tin.*, COUNT(binh_luan.id_binhluan) AS soluotbinhluan,
                                         SUM(CASE WHEN binh_luan.trangthai = 0 THEN 1 ELSE 0 END) AS binhluanmoi,
                                         SUM(CASE WHEN binh_luan.trangthai = 1 THEN 1 ELSE 0 END) AS binhluandaduyet
                                         FROM tin
                                         LEFT JOIN binh_luan ON tin.id_tin = binh_luan.id_tin
                                         GROUP BY tin.id_tin
                                         HAVING soluotbinhluan > 0 OR binhluanmoi > 0
                                         LIMIT $offset, 50");
                                $stt = $offset + 1;
                                while ($row = mysqli_fetch_assoc($sql)) {
                                    $soluotbinhluan = $row['soluotbinhluan'];
                                    $binhluanmoi = $row['binhluanmoi'];
                                    $binhluandaduyet = $row['binhluandaduyet'];
                                ?>
                                    <tr>
                                        <td><?php echo $stt++; ?></td>
                                        <td style="max-width: 150px; overflow: hidden; text-overflow: ellipsis;">
                                            <?php echo substr($row['tieude'], 0, 60) . (strlen($row['tieude']) > 60 ? '...' : ''); ?>
                                        </td>
                                        <td><img src="admin/upload/<?php echo $row['hinhdaidien'] ?>" 
                                                alt="" width="100px"></td>
                                        <td style="white-space: nowrap; text-align: center;"><?php echo $soluotbinhluan; ?></td>
                                        <td style="white-space: nowrap; text-align: center;"><?php echo $binhluandaduyet; ?></td>
                                        <td style="white-space: nowrap; text-align: center; color: red; font-weight: bold;"><?php echo $binhluanmoi; ?></td>
                                        <td>
                                            <a class="btn btn-success" href="admin/binhluan/xem.php?id_tin=<?php echo $row['id_tin']?>"
                                                class="btn btn-success">Xem</a>
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
                            <a class="page-link" href="admin/binhluan?page=<?php echo $previous ?>"><<</a>
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
                            <a class="page-link" href="admin/binhluan?page=<?php echo $i ?>"><?php echo $i ?></a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if ($current_page < $nume_page) {
                        $next = $current_page + 1;

                    ?>
                        <li class="page-item">
                            <a class="page-link" href="admin/binhluan?page=<?php echo $next ?>">Trang kế</a>
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

<?php require_once '../template/inc/footer.php' ?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function xnXoaBinhluan(id) {
        var isConfirmed = confirm('Bạn có chắc muốn xóa bình luận này không?');
        if (isConfirmed) {
            xoabinhluan(id);
        }
    }

    function xoabinhluan(id) {
    $.post('admin/binhluan/delete.php', {
        'id_binhluan': id
    }, function(data) {
        alert(data);
        location.reload();
    });
    }
</script>
<script>
function xnBinhluan(id) {
        var isConfirmed = confirm('Bạn có muốn duyệt bình luận này không?');
        if (isConfirmed) {
            xacnhan(id);
        }
    }

    function xacnhan(id) {
    $.post('admin/binhluan/update.php', {
        'id_binhluan': id
    }, function(data) {
        alert(data);
        location.reload();
    });}
</script>