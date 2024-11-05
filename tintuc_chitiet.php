<?php $page = "TINTUC" ?>
<?php require_once 'public/inc/header.php' ?>
<!DOCTYPE html>

<html lang="en" class="no-js">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="css/media_query.css" rel="stylesheet" type="text/css"/>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="css/animate.css" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet" type="text/css"/>
    <link href="css/owl.theme.default.css" rel="stylesheet" type="text/css"/>
    
    <link href="css/style_1.css" rel="stylesheet" type="text/css"/>
    
    
</head>
<body>

<div class="container-fluid bg-faded fh5co_padd_mediya padding_786">
    <div class="container padding_786">
        <nav class="navbar navbar-toggleable-md navbar-light ">
            <button class="navbar-toggler navbar-toggler-right mt-3" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation"><span class="fa fa-bars"></span>
            </button>
            <a 
                class="navbar-brand" href="#"><img src="public/images/logonew.png" alt="img" class="mobile_logo_width"/>
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent" style="font-family:'Arial'; white-space: nowrap;">
                <ul class="navbar-nav mr-auto">
                <li class="all-menu">
                        <div class="burger-icon">
                            <label class="burger" for="burger">
                                <input class="line" type="checkbox" id="burger" />
                            </label>
                            <ul class="main-category" style="background-color: #f7f7f7 !important;">
                                <?php
                                    
                                    $query = mysqli_query($conn, "SELECT * FROM nhom_tin 
                                                                  WHERE `trangthai` = 1");
                                    while ($row = mysqli_fetch_assoc($query)) {
                                        $tenNhomTin = $row['ten_nhomtin'];
                                        $idNhomTin = $row['id_nhomtin'];
                                        ?>
                                        <li class='category-item'>
                                            <a href='<?php echo "$idNhomTin/" . makeUrl($tenNhomTin) . ".html"; ?>'><?php echo $tenNhomTin; ?></a>
                                                <ul class="sub-category" style="background-color: #f7f7f7 !important;">
                                                    <?php
                                                        $qr = mysqli_query($conn, "SELECT * FROM `loai_tin` 
                                                                                WHERE `id_nhomtin` = $idNhomTin AND `trangthai` = 1");
                                                        while ($row = mysqli_fetch_assoc($qr)) {
                                                            $id_loaitin = $row['id_loaitin'];
                                                            $ten_loaitin = $row['ten_loaitin'];
                                                            ?>
                                                                <div class="loaitin" data-id_loaitin="<?php echo $id_loaitin; ?>">
                                                                    <a href='<?php echo "$id_loaitin/" . makeUrl($ten_loaitin) . ".html"; ?>'><?php echo $ten_loaitin; ?></a>
                                                                </div>
                                                            <?php
                                                        }
                                                    ?>
                                                </ul>
                                        </li>
                                        <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item" >
                        <a class="nav-link" href="trang-chu.html">TRANG CHỦ <span class="sr-only">(current)</span></a>
                    </li>
                    <?php
                        $query = mysqli_query($conn, "SELECT * FROM nhom_tin WHERE `trangthai` = 1 LIMIT 6");
                        $count = 0;
                        while ($row = mysqli_fetch_assoc($query)) {
                            $tenNhomTin = $row['ten_nhomtin'];
                            $idNhomTin = $row['id_nhomtin'];
                            echo "<li class='nav-item'>";
                            echo "<a class='nav-link' href='$idNhomTin/" . makeUrl($tenNhomTin) . ".html'>$tenNhomTin</a>";
                            echo "</li>";
                            $count++;
                            if ($count >= 6) { 
                                break;
                            }
                        }
                    ?>
                </ul>
            </div>
        </nav>
    </div>
</div>
</br>
</br>
</br>
<div class="row">
    <div class="col-12" style="font-family:'Arial';">
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
								$show = mysqli_query($conn, "SELECT * FROM `binh_luan` 
															WHERE trangthai = 1 AND id_tin = $id 
															ORDER BY thoigian DESC");
								while ($row = mysqli_fetch_assoc($show)) {
								?>
									<div class="single-comment">
										<img src="https://cdn.pixabay.com/photo/2020/07/01/12/58/icon-5359553_1280.png" alt="#">
										<div class="content">
										<td>
            								<strong style="color: red;">Người dùng: </strong>
												<?php echo $row['email'] ?></br>
            								<span><strong>Lúc: </strong>
												<?php echo date('d-m-Y H:i:s', strtotime($row['thoigian'])) ?>
											</span>
										</td>
											<p><strong style="color: blue;">Bình luận: </strong>
												<?php echo $row['noidung'] ?>
											</p>
										</div>
									</div>
								<?php
								}
								?>
							</div>
						</div>

						<div class="col-12">
							<div class="reply">
								<div class="reply-head">
									<h2 class="reply-title">Để lại bình luận của bạn</h2>
									
									<form id="form" class="form" action="javascript:void(0)" method="POST">
										<div class="row">
											<div class="col-lg-6 col-md-6 col-12">
												<div class="form-group">
													<label>Email<span>*</span></label>
													<input type="text" id="email" name="email" placeholder="Nhập email" required>
												</div>
											</div>
											<div class="col-12">
												<div class="form-group">
													<label>Nội dung<span>*</span></label>
													<textarea name="noidung" id="noidung" placeholder="Để lại ý kiến của bạn..." required></textarea>
												</div>
											</div>

                                            <?php
                                                date_default_timezone_set('Asia/Ho_Chi_Minh');
                                            ?>

                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="">Thời gian</label>
                                                    <input type="text" id="thoigian" name="thoigian" 
														value="<?php echo date('Y-m-d, H:i:s'); ?>" readonly>
                                                </div>
												<!-- <div class="form-group">
													<input type="text" name="captcha" placeholder="Nhập mã xác thực" required><br>
    												<img src="xacthuc.php" alt="CAPTCHA"><br>
												</div> -->
                                            </div>

											<div class="col-12">
												<div class="form-group button">
													<button name="submit" onclick="ajaxCMT(<?php echo $row_blog['id_tin'] ?>)" 
                                                    type="submit" class="btn">Gửi</button>
												</div>
											</div>
										</div>
									</form>
									
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>

			<!-- --- -->

			<?php

				if (isset($_GET['id_tin'])) {
    				$id_tin = $_GET['id_tin'];

	    			$query = "SELECT id_loaitin FROM tin WHERE id_tin = $id_tin";
    				$result = mysqli_query($conn, $query);
   	 				$row = mysqli_fetch_assoc($result);
    				$id_loaitin = $row['id_loaitin'];

	    			$qr = mysqli_query($conn, "SELECT * FROM tin
                                WHERE id_loaitin = '$id_loaitin' AND trangthai = 1 AND id_tin != $id_tin
                                ORDER BY id_tin ASC");
    		?>
    		<div class="col-lg-4 col-12">
        			<div class="main-sidebar">
            			<div class="single-widget recent-post" id="load_blog">
                			<h3 class="title">Các bài viết liên quan</h3>
                			<?php
                				if (mysqli_num_rows($qr) > 0) {
                    			while ($row_blog2 = mysqli_fetch_assoc($qr)) {
                			?>
                        		<div class="single-post" style="font-family: 'Arial';">
                            		<div class="image">
                            		    <img src="admin/upload/<?php echo $row_blog2['hinhdaidien'] ?>" alt="#">
                            		</div>
                            		<div class="content">
										<td style="max-width: 100px; overflow: hidden; text-overflow: ellipsis;">
                                            <a href="<?php echo $row_blog2['id_tin'] . "/" . makeUrl($row_blog2['tieude']) . ".html"; ?>" 
                                                title="<?php echo $row_blog2['tieude']; ?>">
                                                <strong style="font-size: 12px; ">
                                                    <?php echo strlen($row_blog2['tieude']) > 40 ? 
                                                    substr($row_blog2['tieude'], 0, 40) . '...' : $row_blog2['tieude']; ?>
                                                </strong>
                                            </a>
										</td>
                            	    	<ul class="comment">
                            	        	<li style="font-size: 12px;">
												<i class="fa fa-calendar" style="color:red;" aria-hidden="true"></i>
												<?php echo date('d-m-Y', strtotime($row_blog2['ngaydangtin'])) ?>
											</li>
                            	    	</ul>
                           			 </div>
                        		</div>
                			<?php
                   			 }
                		} else {
                    		echo "<div class='col-12' style='color: red; font-size: 15px'>Không có bài viết nào liên quan!</div>";
                		}
                		?>
            	</div>
        </div>
    </div>
<?php
}
?>
			<!--  -->
		</div>
	</div>
</section>
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
  top: 5px;
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
    function ajaxCMT(id) {
        var email = $("#email").val();
        var noidung = $("#noidung").val();
        var thoigian = $("#thoigian").val();
        var captcha = $("input[name='captcha']").val(); 
        if (email === '' || noidung === '' || captcha === '') { 
            alert("Vui lòng đầy đủ trước khi gửi!"); 
            return; 
        }

        $.ajax({
            url: 'binhluan.php',
            method: "POST",
            data: {
                email: email,
                noidung: noidung,
                thoigian: thoigian,
                id_tin: id,
                captcha: captcha 
            },
            success: function(data) {
                $("#div1").html(data);
                if (data.includes("Bình luận của bạn đã được gửi")) {
                    $("#email").val(''); 
                    $("#noidung").val(''); 
                }
            }
        });
    }
</script>
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
<div class="container-fluid fh5co_footer_bg pb-3" >
    <div class="container animate-box">
        <div class="row">
            <div class="col-12 spdp_right py-5"></div>
            <div class="clearfix"></div>
            <div class="col-12 col-md-4 col-lg-3" style="font-family:'Arial';">
                <div class="footer_main_title py-3" > 
                   <strong> Giới thiệu</strong>
                </div>
                <div class="footer_sub_about pb-3"> 
                    Đây là Website dùng để xem tin tức mỗi ngày của Nguyễn Thế Anh!
                </div>
            </div>
        </div>
    </div>
</div>
<div class="gototop js-top">
    <a href="" class="js-gotop"><i class="fa fa-arrow-up"></i></a>
</div>
<style>
.burger {
  width: 40px;
  height: 40px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  user-select: none;
  cursor: pointer;
  transition: 300ms;
  border-radius: 10px;
  /* margin-left: 320px; */
}
.burger input[type="checkbox"] {
  appearance: none;
  transition: 300ms;
}

.burger::before,
.burger::after {
  content: "";
  transition: 300ms;
  transform-origin: center center;
}

.burger::before {
  transform: translateY(8px);
}
.burger::after {
  transform: translateY(-8px);
}
.burger .line,
.burger::before,
.burger::after {
  width: 25px;
  height: 2.1px;
  display: block;
  background-color: black;
  border-radius: 5px;
  position: absolute;
}

.burger .line:checked {
  width: 0;
  transition-delay: 100ms;
}
.burger:has(.line:checked)::before {
  animation: animation1 400ms ease-out 0s 1 both;
}
.burger:has(.line:checked)::after {
  animation: animation2 400ms ease-out 0s 1 both;
}

.burger:hover {
  background: #aeaeae;
  border-radius: 50%;
}

.burger:hover .line,
.burger:hover::before,
.burger:hover::after {
  background: #e8e8e8;
}

.burger:active {
  scale: 0.95;
}
@keyframes animation1 {
  0% {
    transform: translateY(8px) rotate(0deg);
  }
  50% {
    transform: translateY(0px) rotate(0deg);
  }
  100% {
    transform: translateY(0px) rotate(45deg);
  }
}
@keyframes animation2 {
  0% {
    transform: translateY(-8px) rotate(0deg);
  }
  50% {
    transform: translateY(0px) rotate(0deg);
  }
  100% {
    transform: translateY(0px) rotate(-45deg);
  }
}
@media only screen and (max-width: 600px) {
  .all-menu {
    display: none;
  }
}
.main-category {
	position: absolute;
	left: 0;
	top: 64px;
	background: #fff;
	z-index: 1;
	width: 100%;
	-webkit-box-shadow: 0px 5px 15px #0000000a;
	-moz-box-shadow: 0px 5px 15px #0000000a;
	box-shadow: 0px 5px 15px #0000000a;
}

 .main-category li{
	display:block;
	border-bottom:1px solid #f6f6f6;
	position:relative;
}
.main-category .category-item {
    display: inline-block;
    width: calc(33.33% - 20px); 
    margin-right: 20px; 
    margin-bottom: 20px;
    vertical-align: top; 
}

 .main-category li:last-child{
	border:none;
}
 .main-category li a {
	font-size: 14px;
	font-weight: 600;
	color: #333;
	padding: 13px 25px 13px 25px;
	display: block;
	text-transform: uppercase;
}
 .main-category li a i{
	display:inline-block;
	float:right;
}
.sub-category {
	background: #fff;
	width: 220px;
	position: absolute;
	left: 238px;
	top: 0;
	z-index: 999999;
	opacity: 0;
	visibility: hidden;
	-webkit-transition: all 0.4s ease;
	-moz-transition: all 0.4s ease;
	transition: all 0.4s ease;
	border-left: 3px solid #F7941D;
	-webkit-box-shadow: 0px 5px 15px #0000000a;
	-moz-box-shadow: 0px 5px 15px #0000000a;
	box-shadow: 0px 5px 15px #0000000a;
}
 .main-category li:hover .sub-category{
	opacity:1;
	visibility:visible;
}
 .main-category li a{
	text-transform:capitalize;
	font-weight:400;
}
 .main-category li a:hover{
	color:#F7941D;
}
 .main-category .main-mega{
	position:relative;
}
 .main-category li .mega-menu {
	width: 850px;
	display: inline-block;
	height: auto;
	position: absolute;
	left: 238px;
	top: 0;
	z-index: 99999;
	background: #fff;
	border: none;
	padding: 30px;
	border-left: 3px solid #F7941D;
	opacity:0;
	visibility:hidden;
	-webkit-transition:all 0.4s ease;
	-moz-transition:all 0.4s ease;
	transition:all 0.4s ease;
}
 .main-category li:hover .mega-menu{
	opacity:1;
	visibility:visible;
}
 .main-category li .mega-menu .single-menu {
	width: 33%;
	display: inline-block;
	border: none;
	padding: 0;
	padding-right: 20px;
}
.main-category li .mega-menu .single-menu a{
 	padding:0;
}
 .main-category li .mega-menu .single-menu .image{
	overflow:hidden;
}
 .main-category li .mega-menu .single-menu img{
	display:block;
	height:100%;
	width:100%;
	cursor:pointer;
}
.main-category li .mega-menu .single-menu .image:hover img{
	transform:scale(1.1);
}
 .main-category li .mega-menu .single-menu .title-link {
	margin-bottom: 20px;
	background: #F7941D;
	color: #fff;
	padding: 2px 13px;
	border-radius: 3px;
	display: inline-block;
	font-size: 14px;
}
 .main-category li .mega-menu .single-menu .title-link:hover{
	background:#333;
	color:#fff;
}
.main-category li .mega-menu .single-menu .inner-link{
	margin-top:25px;
}
.main-category li .mega-menu .single-menu .inner-link a{
	margin-bottom:10px;
}
 .main-category li .mega-menu .single-menu .inner-link a:hover{
	color:#F7941D;
	background:transparent;
}
 .main-category li .mega-menu .single-menu .inner-link a:last-child{
	margin-bottom:0px;
}
</style>
<script>
    $(document).ready(function() {
        $('.main-category ').hide();
        $('.all-menu ').hover(
        	function() {
            	$('ul', this).stop().slideDown(200);
            },
            function() {
                $('ul', this).stop().slideUp(200);
            }
        );
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
        integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
        crossorigin="anonymous"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/main.js"></script>
<script src="js/modernizr-3.5.0.min.js"></script>
</body>
</html>