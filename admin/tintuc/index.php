<?php $page = 'TINTUC' ?>
<?php require_once '../template/inc/header.php' ?>

<div class="content-wrapper">
    
    <?php
    $sql = mysqli_query($conn, "SELECT * FROM `tin`");
    $nume_row = mysqli_num_rows($sql);
    $nume_page = ceil($nume_row / 20);
    if (isset($_GET['page'])) {
        $current_page = $_GET['page'];
    } else {
        $current_page = 1;
    }
    $offset = ($current_page - 1) * 20;
    ?>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Quản lý tin tức</h1>
                    <br>
                    <h5><a href="admin/tintuc/add.php" class="btn btn-success">Thêm bài viết</a></h5>
                    <input type="search" class="form-control" id="search" name="search" placeholder="Nhập để tìm kiếm bài viết...">
                    <select id="sort" class="form-sort" onchange="handleSorting(); saveSortOption();">
                        <option value="desc">Ngày đăng (Mới nhất)</option>
                        <option value="asc">Ngày đăng (Cũ nhất)</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
		document.getElementById("search").addEventListener("keypress", function(event) {
    		if (event.key === "Enter") {
        		var searchQuery = this.value.trim();
        	    	if (searchQuery !== '') {
            			window.location.href = 'admin/tintuc/timkiem.php?search=' + encodeURIComponent(searchQuery);
        			}
    		}
		});

        function handleSorting() {
            var sortOption = document.getElementById('sort').value; 
            var urlParams = new URLSearchParams(window.location.search); 
            urlParams.set('sort', sortOption); 
            window.location.href = 'admin/tintuc?' + urlParams.toString(); 
        }

        function saveSortOption() {
            var sortOption = document.getElementById('sort').value;
            localStorage.setItem('sortOption', sortOption);
        }

        function loadSortOption() {
            var sortOption = localStorage.getItem('sortOption');
            if (sortOption) {
                document.getElementById('sort').value = sortOption;
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            loadSortOption();
        });

	</script>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tiêu đề</th>
                                <th>Hình đại diện</th>
                                <th>Nội dung</th>
                                <th>Ngày đăng</th>
                                <th>Tin nổi bật</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stt = 0;
                            $sort = isset($_GET['sort']) ? $_GET['sort'] : 'desc';
                            $qr = mysqli_query($conn, "SELECT * FROM `tin` ORDER BY ngaydangtin $sort LIMIT $offset, 20");
                            while ($row_blog = mysqli_fetch_assoc($qr)) {
                                $stt++;
                            ?>
                                <tr>

                                    <td><?php echo $stt ?></td>

                                    <td style="max-width: 150px; overflow: hidden; text-overflow: ellipsis;">
                                        <?php echo substr($row_blog['tieude'], 0, 85) . (strlen($row_blog['tieude']) > 85 ? '...' : ''); ?>
                                    </td>

                                    <td><img src="admin/upload/<?php echo $row_blog['hinhdaidien'] ?>" 
                                        alt="" width="100px">
                                    </td>

                                    <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis;">
                                        <?php 
                                            $text_content = strip_tags($row_blog['noidung']);
                                            echo substr($text_content, 0, 72) . (strlen($text_content) > 72 ? '...' : '');
                                        ?>
                                    </td>
                                    
                                    <td><?php echo date('d-m-Y', strtotime($row_blog['ngaydangtin'])) ?></td>

                                    <td><?php echo ($row_blog['tinhot'] == 1) ? 
                                                    '<span style="background-color: red; padding: 3px 10px; border-radius: 3px; color: #fff">Tin nổi bật</span>'
                                                     : '<span style="background-color: gray; padding: 3px 10px; border-radius: 3px; color: #fff">Tin thường</span>'; 
                                        ?></td>

                                    <td><?php echo ($row_blog['trangthai'] == 1) ? 
                                                    '<span style="background-color: green; padding: 3px 10px; border-radius: 3px; color: #fff">Được hiển thị</span>' 
                                                    : '<span style="background-color: gray; padding: 3px 10px; border-radius: 3px; color: #fff">Không được hiển thị</span>'; 
                                        ?></td>

                                    <td>
                                        <a class="btn btn-success" href="admin/tintuc/update.php?id_tin=<?php echo $row_blog['id_tin']?>"
                                            class="btn btn-success">Sửa</a>  
                                        <a href="javascript:void(0)" onclick="xnXoaTin(<?php echo $row_blog['id_tin'] ?>)" 
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
                            <a class="page-link" href="admin/tintuc?page=<?php echo $previous ?>">Quay lại</a>
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
                            <a class="page-link" href="admin/tintuc?page=<?php echo $i ?>"><?php echo $i ?></a>
                        </li>
                    <?php
                    }
                    ?>
                    <?php
                    if ($current_page < $nume_page) {
                        $next = $current_page + 1;

                    ?>
                        <li class="page-item">
                            <a class="page-link" href="admin/tintuc?page=<?php echo $next ?>">Trang tiếp theo</a>
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
<style>
    .form-sort{
        display: block;
        width: 27%;
        font-size: 1rem;
        font-weight: 1rem;
        height: calc(2.25rem + 2px);
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        box-shadow: inset 0 0 0 transparent;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        position: relative;
        bottom: 30px;
        left: 1010px;
    }
</style>
<?php require_once '../template/inc/footer.php' ?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function xnXoaTin(id) {
        var isConfirmed = confirm('Bạn có chắc muốn xóa bài viết này không?');
        if (isConfirmed) {
            xoatin(id);
        }
    }

    function xoatin(id) {
    $.post('admin/tintuc/delete.php', {
        'id_tin': id
    }, function(data) {
        alert(data);
        location.reload();
    });
}
</script>