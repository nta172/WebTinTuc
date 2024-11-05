<?php
session_start();
require_once '../../DB/dbConnect.php';
require_once '../../DB/checkUser.php';
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>NTA News</title>
	<link rel="icon" href="public/images/logonew.png" type="image/png">
	<link rel="icon" type="image/png" href="images/favicon.png">
	<base href="http://localhost/webtintuc/">
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="public/css/bootstrap.css">
	
	<link rel="stylesheet" href="public/css/magnific-popup.min.css">
	
	<link rel="stylesheet" href="public/css/font-awesome.css">
	
	<link rel="stylesheet" href="public/css/jquery.fancybox.min.css">
	
	<link rel="stylesheet" href="public/css/themify-icons.css">
	
	<link rel="stylesheet" href="public/css/niceselect.css">
	
	<link rel="stylesheet" href="public/css/animate.css">
	
	<link rel="stylesheet" href="public/css/flex-slider.min.css">
	
	<link rel="stylesheet" href="public/css/owl-carousel.css">

	<link rel="stylesheet" href="public/css/slicknav.min.css">

	<link rel="stylesheet" href="public/css/reset.css">
	<link rel="stylesheet" href="public/style.css">
	<link rel="stylesheet" href="public/css/responsive.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="admin/template/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="admin/template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <link rel="stylesheet" href="admin/template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="admin/template/plugins/jqvmap/jqvmap.min.css">

    <link rel="stylesheet" href="admin/template/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="admin/template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <link rel="stylesheet" href="admin/template/plugins/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" href="admin/template/plugins/summernote/summernote-bs4.min.css">
</head>
<body>
<div class="row">
    <div class="col-12" style="font-family:'Arial'; top: 50px;">
        <div class="section-title">
            <h2>CHI TIẾT BÀI VIẾT</h2>
        </div>
    </div>
</div>
<section class="blog-single section" style="font-family:'Arial'; padding: 0px 100px !important;">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-12">
				<div class="blog-single-main">
					<div class="row">
						<?php	
						$id_tin = (isset($_GET['id_tin'])) ? $_GET['id_tin'] : '';
						$qr = mysqli_query($conn, "SELECT * FROM tin WHERE id_tin = $id_tin");
						$row_blog = mysqli_fetch_assoc($qr);
						?>
						<div class="col-12">
							<div>
							<?php
								$query = "SELECT tin.*, loai_tin.ten_loaitin 
											FROM tin 
											INNER JOIN loai_tin ON tin.id_loaitin = loai_tin.id_loaitin 
											WHERE tin.id_tin = '{$row_blog['id_tin']}'";

								$result = mysqli_query($conn, $query);
								if ($result && mysqli_num_rows($result) > 0) {
									$row = mysqli_fetch_assoc($result);
									$tenloaitin = $row['ten_loaitin'];
								} else {
									$tenloaitin = "Không xác định"; 
								}
							?>
								<h2 class="blog-title" style="color: blue;">Loại tin: 
									<span style="color: gray;"><?php echo $tenloaitin ?></span>
								</h2>
							</div>

							<div class="image">
								<h2 class="blog-title"><?php echo $row_blog['tieude'] ?></h2></br>
								<img src="admin/upload/<?php echo $row_blog['hinhdaidien'] ?>" alt="#">
							</div>
							<div class="blog-detail">
								<div class="blog-meta">
								</br>
									<span class="author">
                                        <a>
                                            <i class="fa fa-user"></i>Được đăng bởi: <span><?php echo $row_blog['tacgia'] ?></span>
                                        </a>
                                        <a>
                                            <i class="fa fa-calendar"></i>
                                            <?php echo date('d-m-Y', strtotime($row_blog['ngaydangtin'])) ?>
                                        </a>
										<a>
											<i class="fa fa-eye"></i> Số lượt xem: <?php echo $row_blog['solanxem'] ?>
										</a>
										<a class="like-btn" data-id="<?php echo $row_blog['id_tin']; ?>">
											<label class="container-1">
												<input type="checkbox">
													<svg id="Glyph" version="1.1" viewBox="0 0 32 32" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M29.845,17.099l-2.489,8.725C26.989,27.105,25.804,28,24.473,28H11c-0.553,0-1-0.448-1-1V13  c0-0.215,0.069-0.425,0.198-0.597l5.392-7.24C16.188,4.414,17.05,4,17.974,4C19.643,4,21,5.357,21,7.026V12h5.002  c1.265,0,2.427,0.579,3.188,1.589C29.954,14.601,30.192,15.88,29.845,17.099z" id="XMLID_254_"></path><path d="M7,12H3c-0.553,0-1,0.448-1,1v14c0,0.552,0.447,1,1,1h4c0.553,0,1-0.448,1-1V13C8,12.448,7.553,12,7,12z   M5,25.5c-0.828,0-1.5-0.672-1.5-1.5c0-0.828,0.672-1.5,1.5-1.5c0.828,0,1.5,0.672,1.5,1.5C6.5,24.828,5.828,25.5,5,25.5z" id="XMLID_256_"></path></svg>
													<span class="like-count" data-id="<?php echo $row_blog['id_tin']; ?>">0</span> lượt thích											
											</label>
										</a>
                                    </span>
								</div>
                                <td><?php echo $row_blog['mota'] ?></td>
								<div class="content">
									<p><?php echo $row_blog['noidung'] ?></p>
								</div>
							</div>
						</div>

						<div class="col-12" id="div1">
							<div class="comments" id="showload">
								<h3 class="comment-title">Bình luận</h3>
								<?php
								$query = mysqli_query($conn, "SELECT * FROM binh_luan WHERE id_tin = $id_tin ORDER BY thoigian DESC");
								if(mysqli_num_rows($query) > 0) {
                                    ?>
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th></th>
                                                    <th>Trạng thái</th>
                                                    <th style="white-space: nowrap; text-align: center;">Được hiển thị</th>
                                                    <th style="white-space: nowrap;"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="load">
                                                <?php
                                                    $stt = 1;
                                                    while ($row = mysqli_fetch_assoc($query)) { 
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $stt++; ?></td>
                                                                <div class="single-comment">
                                                                    <div class="content">
                                                                        <td>
                                                                            <strong style="color: red;">Người dùng: </strong>
                                                                                <?php echo $row['email'] ?></br>
                                                                            <span><strong>Lúc: </strong>
                                                                                <?php echo date('d-m-Y H:i:s', strtotime($row['thoigian'])) ?>
                                                                            </span>
                                                                            <p><strong style="color: blue;">Bình luận: </strong>
                                                                                <strong><?php echo $row['noidung'] ?></strong>
                                                                            </p>
                                                                        </td>
                                                                    </div>
                                                                </div>
                                                                <td style="white-space: nowrap;"><?php echo ($row['trangthai'] == 1) ? 
                                                                        '<span style="background-color: green; padding: 3px 10px; border-radius: 3px; color: #fff">Đã duyệt</span>' 
                                                                        : '<span style="background-color: gray; padding: 3px 10px; border-radius: 3px; color: #fff">Chờ duyệt</span>'; 
                                                                ?></td>
                                                                <td style="white-space: nowrap; text-align: center;"><?php echo ($row['trangthai'] == 1) ? 
                                                                        '<span style="background-color: green; padding: 3px 10px; border-radius: 3px; color: #fff">Có</span>' 
                                                                        : '<span style="background-color: gray; padding: 3px 10px; border-radius: 3px; color: #fff">Không</span>'; 
                                                                ?></td>
                                                                <td style="white-space: nowrap;">
                                                                    <a href="javascript:void(0)" onclick="xnBinhluan(<?php echo $row['id_binhluan'] ?>)"  
                                                                        class="btn btn-success">Duyệt</a>
                                                                    <a href="javascript:void(0)" onclick="xnXoaBinhluan(<?php echo $row['id_binhluan'] ?>)" 
                                                                        class="btn btn-danger">Ẩn</a> 
                                                                </td>
                                                            </tr>
                                                        <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    <?php
                                }
								?>
                                <br> 
                                <div>
                                    <a href="admin/binhluan/index.php">
                                        <button class="btn btn-back" style="color: #fff;background-color: #28a745;
                                                                                    border-color: #28a745; box-shadow: none;">
                                            Quay về
                                        </button>
                                    </a>
                                </div>
                                <br>    
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>
</body>

<style>
.container-1 input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

.container-1 {
  display: block;
  position: relative;
  cursor: pointer;
  user-select: none;
}

svg {
  position: relative;
  top: 2px;
  left: 0;
  height: 25px;
  width: 25px;
  transition: all 0.3s;
  fill: #666;
}

svg:hover {
  transform: scale(1.1) rotate(-10deg);
}

.container-1 input:checked ~ svg {
  fill: #2196F3;
}
.blog-single .blog-meta .author a {
	display: inline-block; 
    vertical-align: middle;
	font-size: 13px;
	border-right:1px solid #ddd;
	padding:0px 15px;
}
</style>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('.like-btn input[type="checkbox"]').change(function() {
        var postId = $(this).closest('.like-btn').data('id');
        var likeCountElement = $('.like-count[data-id="' + postId + '"]');
        var likeCount = parseInt(likeCountElement.text());

        if ($(this).is(':checked')) {
            likeCount++;
        } else {
            likeCount--;
        }

        likeCountElement.text(likeCount);

        localStorage.setItem('likeCount_' + postId, likeCount);
    });

    $('.like-count').each(function() {
        var postId = $(this).data('id');
        var likeCount = localStorage.getItem('likeCount_' + postId);
        if (likeCount !== null) {
            $(this).text(likeCount);
        }
    });
});
</script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function xnXoaBinhluan(id) {
        var isConfirmed = confirm('Bạn có chắc muốn ẩn bình luận này không?');
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