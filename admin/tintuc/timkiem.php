<?php $page = 'TINTUC' ?>
<?php require_once '../template/inc/header.php' ?>

<div class="content-wrapper">
<?php
    require_once '../../DB/dbConnect.php';
    if(isset($_GET['search'])) {

        $timkiem = $_GET['search'];
        
        $query = "SELECT * FROM tin 
                WHERE MATCH(tieude, noidung) AGAINST('$timkiem' IN BOOLEAN MODE) AND `trangthai` = 1";

        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $kqtimkiem = "Kết quả tìm kiếm cho <span style='color: red;'>\"$timkiem\"</span>";
        } else {
            $kqtimkiem = "Không có kết quả nào được tìm thấy.";
        }
    } else {
        $kqtimkiem = "Vui lòng nhập từ khóa tìm kiếm.";
    }
?>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3><?php echo $kqtimkiem; ?></h3>
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
                            while ($row_blog = mysqli_fetch_assoc($result)) {
                                $stt++;
                            ?>
                                <tr>
                                    <td><?php echo $stt ?></td>
                                    <td style="max-width: 150px; overflow: hidden; text-overflow: ellipsis;">
                                        <?php echo substr($row_blog['tieude'], 0, 85) . (strlen($row_blog['tieude']) > 85 ? '...' : ''); ?>
                                    </td>
                                    <td><img src="admin/upload/<?php echo $row_blog['hinhdaidien'] ?>" 
                                        alt="" width="100px"></td>
                                    <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis;">
                                        <?php echo substr($row_blog['noidung'], 0, 80) . (strlen($row_blog['noidung']) > 80 ? '...' : ''); ?>
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
    <div>
        <a href="admin/tintuc/index.php"><button class="btn btn-back">Quay về</button></a>
    </div>
</div>

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
