<?php $page = "LOAITIN";?>
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
                    <li class="nav-item " >
                        <a class="nav-link" href="trang-chu.html">TRANG CHỦ <span class="sr-only">(current)</span></a>
                    </li>
                    <?php
                        $query = mysqli_query($conn, "SELECT * FROM nhom_tin WHERE `trangthai` = 1 LIMIT 6");
                        $count = 0;
                        while ($row = mysqli_fetch_assoc($query)) {
                            $tenNhomTin = $row['ten_nhomtin'];
                            $idNhomTin = $row['id_nhomtin'];
                            $isActive = isset($_GET['id_nhomtin']) && $_GET['id_nhomtin'] == $idNhomTin;
                            echo "<li class='nav-item" . ($isActive ? ' active' : '') . "'>";
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

<div class="container-fluid pb-4 pt-4 paddding" style="font-family:'Arial';">
    <div class="container paddding">
        <div class="row mx-0">
            <div class="col-md-8 animate-box" data-animate-effect="fadeInLeft">
                <div>
                    <?php 
                        if(isset($_GET['id_loaitin'])) {
                            $id_loaitin = $_GET['id_loaitin'];

                            $query_loaitin = "SELECT ten_loaitin FROM loai_tin WHERE id_loaitin = '$id_loaitin'";
                            $result_loaitin = mysqli_query($conn, $query_loaitin);
                        
                            if($result_loaitin && mysqli_num_rows($result_loaitin) > 0) {
                                $row_loaitin = mysqli_fetch_assoc($result_loaitin);
                                $ten_loaitin = $row_loaitin['ten_loaitin'];

                                echo '<div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4"><strong>'.$ten_loaitin.'</strong></div>';
                            }
                        }
                    ?>
                </div>
                
                <div class="row">
                    <?php 
                        if(isset($_GET['id_loaitin'])) {
                            $id_loaitin = $_GET['id_loaitin'];
        
                            $query_posts = "SELECT * FROM tin 
                                            WHERE id_loaitin = '$id_loaitin' AND trangthai = 1
                                            ORDER BY ngaydangtin DESC";
                            $result_posts = mysqli_query($conn, $query_posts);
        
                            if(mysqli_num_rows($result_posts) > 0) {
                                while($row_blog1 = mysqli_fetch_assoc($result_posts)) {
                                ?>
                                <div class="row pb-4">
                                    <div class="col-md-5">
                                        <div class="fh5co_hover_news_img">
                                            <div class="fh5co_news_img"><img src="admin/upload/<?php echo $row_blog1['hinhdaidien']?>" alt="#"></div>
                                            <div></div>
                                        </div>
                                    </div>
                                    <div class="col-md-7 animate-box">
                                        <?php
                                            $query = "SELECT tin.*, loai_tin.ten_loaitin 
                                            FROM tin 
                                            INNER JOIN loai_tin ON tin.id_loaitin = loai_tin.id_loaitin 
                                            WHERE tin.id_tin = '{$row_blog1['id_tin']}'";

                                            $result = mysqli_query($conn, $query);
                                            if ($result && mysqli_num_rows($result) > 0) {
                                                $row = mysqli_fetch_assoc($result);
                                                $tenloaitin = $row['ten_loaitin'];
                                            } else {
                                                $tenloaitin = "Không xác định"; 
                                            }
                                        ?>
                                        <div class="info">
                                            <p class="category" style="float: left; ">
                                                <span style="color: blue;">Loại tin:</span> <?php echo $tenloaitin ?>
                                            </p>

                                            <p class="date" style="color:red; float: right;">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo date('d-m-Y', strtotime($row_blog1['ngaydangtin'])) ?>
                                            </p>
                                        </div>
                                        </br>
                                        <div class="content" style="float: left;">
                                            <h6><strong><?php echo $row_blog1['tieude']?></strong></h6>
                                            <td style="max-width: 150px; overflow: hidden; text-overflow: ellipsis;">
                                                <?php echo substr($row_blog1['mota'], 0, 85) . (strlen($row_blog1['mota']) > 85 ? '...' : ''); ?>
                                            </td>
                                            <a href='<?php echo $row_blog1['id_tin'] . "/" . makeUrl($row_blog1['tieude']) . ".html"; ?>' 
                                                class="more-btn" style="color: green">Tiếp tục đọc</a>
                                        </div>   
                                    </div>
                                </div>
                                <?php
                                }
                            } else {
                                echo "<div class='col-12' style='color: red; text-align: center; font-size: 20px'>Không có bài viết theo mã loại này!</div>";
                            }                
                        }
                    ?>
                </div>
            </div>

            <div class="col-md-3 animate-box" data-animate-effect="fadeInRight">
                <div>
                    <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">
                        <strong>Loại tin khác</strong>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="fh5co_tags_all">  
                    <?php
                        $qr = mysqli_query($conn, "SELECT * FROM `loai_tin` WHERE `trangthai` = 1");
                        while ($row = mysqli_fetch_assoc($qr)) {
                            $id_loaitin = $row['id_loaitin'];
                            $ten_loaitin = $row['ten_loaitin'];
                            ?>
                                 <div class="loaitin-1" data-id_loaitin="<?php echo $id_loaitin; ?>">
                                    <a href='<?php echo "$id_loaitin/" . makeUrl($ten_loaitin) . ".html"; ?>'><?php echo $ten_loaitin; ?></a>
                                 </div>
                            <?php
                        }
                    ?>
                </div>
                <style>
                    .loaitin-1 {
                        display: inline-block;
                        margin-right: 10px;
                        margin-bottom: 10px;
                        padding: 10px;
                        border: 1px solid #ccc;
                        border-radius: 5px;
                        background-color: #f9f9f9;
                    }
                    .loaitin-1 a {
                        text-decoration: none;
                        color: #333; 
                    }
                    .loaitin-1 a:hover {
                        color: #555; 
                    }
                </style>
                </div>
            </div> 
        </div>
    </div>  
</div>
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