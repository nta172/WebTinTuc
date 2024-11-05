<?php $page = 'USER'?>
<?php require_once '../template/inc/header.php' ?>
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Quản lý người dùng</h1>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <?php
    $sql = mysqli_query($conn, "SELECT * FROM `customers`");
    $nume_row = mysqli_num_rows($sql);
    $nume_page = ceil($nume_row / 5);
    if (isset($_GET['page'])) {
        $current_page = $_GET['page'];
    } else {
        $current_page = 1;
    }
    $offset = ($current_page - 1) * 5;
    ?>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>ID</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stt = 0;
                            $qr = mysqli_query($conn, "SELECT * FROM `customers` LIMIT $offset,5");
                            while ($row = mysqli_fetch_assoc($qr)) {
                                $stt++;
                            ?>
                                <tr>
                                    <td><?php echo $stt ?></td>
                                    <td><?php echo $row['id'] ?></td>
                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['email'] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <br>
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
                            <a class="page-link" href="admin/userAdmin?page=<?php echo $previous ?>"><<</a>
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
                            <a class="page-link" href="admin/userAdmin?page=<?php echo $i ?>"><?php echo $i ?></a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if ($current_page < $nume_page) {
                        $next = $current_page + 1;

                    ?>
                        <li class="page-item">
                            <a class="page-link" href="admin/userAdmin?page=<?php echo $next ?>">Trang kế</a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>
    </section>
            <div>
                <a href="admin/dashboard/index.php"><button class="btn btn-back">Quay về</button></a>
            </div>
</div>

<?php require_once '../template/inc/footer.php' ?>