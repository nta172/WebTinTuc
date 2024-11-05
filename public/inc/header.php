<?php
session_start();
require_once 'DB/dbConnect.php';
require_once 'DB//utf8tolatintutil.php';
$page = isset($page) ? $page : '';
function makeUrl($string){
    $string = trim($string);	// Loại bỏ khoảng trắng ở đầu và cuối chuỗi.
	$string = mb_strtolower($string, 'UTF-8');	// Chuyển đổi chuỗi thành chữ thường (lowercase) và sử dụng bộ mã UTF-8.
    $string = str_replace(' ', '-', $string);	// Thay thế khoảng trắng bằng dấu gạch ngang.
    
    $char_map = array(
        'à' => 'a', 'á' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a',
        'ằ' => 'a', 'ắ' => 'a', 'ẳ' => 'a', 'ẵ' => 'a', 'ặ' => 'a',
        'ầ' => 'a', 'ấ' => 'a', 'ẩ' => 'a', 'ẫ' => 'a', 'ậ' => 'a',
        'è' => 'e', 'é' => 'e', 'ẻ' => 'e', 'ẽ' => 'e', 'ẹ' => 'e',
        'ề' => 'e', 'ế' => 'e', 'ể' => 'e', 'ễ' => 'e', 'ệ' => 'e',
        'ì' => 'i', 'í' => 'i', 'ỉ' => 'i', 'ĩ' => 'i', 'ị' => 'i',
        'ò' => 'o', 'ó' => 'o', 'ỏ' => 'o', 'õ' => 'o', 'ọ' => 'o',
        'ồ' => 'o', 'ố' => 'o', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o',
        'ờ' => 'o', 'ớ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o',
        'ù' => 'u', 'ú' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ụ' => 'u',
        'ừ' => 'u', 'ứ' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ự' => 'u',
        'ỳ' => 'y', 'ý' => 'y', 'ỷ' => 'y', 'ỹ' => 'y', 'ỵ' => 'y',
        'đ' => 'd', 'ô' => 'o', 'ă' => 'a', 'ư' => 'u', 'ơ' => 'o',
		'ê' => 'e', 'â' => 'a',
    );

    $string = strtr($string, $char_map);	// Thay thế các ký tự tiếng Việt thành ký tự Latin.

    $string = preg_replace('/[^a-z0-9\-]/', '', $string);	// Loại bỏ các ký tự không phải chữ cái, số hoặc dấu gạch ngang.

    return $string;	// Trả về chuỗi đã được chuyển đổi thành URL.
}
?>
<?php
    if (isset($_GET['id_tin'])) {	// Kiểm tra xem có tham số 'id_tin' được truyền qua phương thức GET không.
        $id = $_GET['id_tin'];	// Lấy giá trị của tham số 'id_tin'.

        if (!isset($_COOKIE['viewed_' . $id]) || time() - $_COOKIE['last_viewed_time_' . $id] > 300) {	// Kiểm tra xem cookie 'viewed_$id' 
			// không tồn tại hoặc thời gian giữa lần xem trước đó và hiện tại lớn hơn 300 giây.

            mysqli_query($conn, "UPDATE tin SET solanxem = solanxem + 1 WHERE id_tin = $id");
			// Tăng số lần xem của tin tức có ID tương ứng trong cơ sở dữ liệu.

            setcookie('viewed_' . $id, '1', time() + 300); 
			// Tạo cookie 'viewed_$id' với thời gian sống là 300 giây.

            setcookie('last_viewed_time_' . $id, time(), time() + 300); 
			// Tạo cookie 'last_viewed_time_$id' lưu thời gian lần xem cuối cùng với thời gian sống là 300 giây.
        }
    }
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
</head>

<body>
	<header class="header shop">
		<div class="topbar" style="background-color: #000;">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-12 col-12" style="font-family:'Arial';">
						<div class="top-left">
							<ul class="list-main">
								<li style="color: #fff !important;">
									<i class="fa fa-clock-o" style="color: #fff !important; font-size: 18px;"></i>
									<!-- Thẻ span với id này để hiện ra Thứ, ngày/tháng/năm, giờ/phút/giây -->
									<span id="currentDateTime"></span>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="middle-inner">
			<div class="container">

				<div class="row">

					<div class="col-lg-2 col-md-2 col-12">

						<div class="logo d-none d-md-block" style="margin-top: 0px;">
							<a 
								href="trang-chu.html"><img src="public/images/logonew.png" alt="logo" width="250" height="32">
							</a>
						</div>

						<div class="search-top">
							<div class="search-top">
								<form class="search-form" >
									<input type="text" placeholder="Tìm kiếm bài viết" name="search">
									<button value="search" type="submit"><i class="ti-search"></i></button>
								</form>
							</div>
						</div>

						<div class="mobile-nav"></div>
					</div>

					<!-- --- -->
					
					<div class="col-lg-8 col-md-7 col-12" style="font-family:'Arial';">
						<div class="search-bar-top" style="margin-top: 50px;">
							<div class="search-bar">
								<input name="search" id="search" placeholder="Nhập nội dung tìm kiếm" type="search">
							</div>
						</div>
						<div id="error-message" style="color: red; text-align: center;"></div>
					</div>

					<script src="https://kit.fontawesome.com/d69fb28507.js" crossorigin="anonymous"></script>
    				<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
					<script>
						document.getElementById("search").addEventListener("keypress", function(event) {
						// Bắt đầu lắng nghe sự kiện keypress trên phần tử có id là "search".

    						if (event.key === "Enter") {
							// Kiểm tra nếu phím nhấn là "Enter".

        						var searchQuery = this.value.trim();
								// Lấy giá trị của ô tìm kiếm và loại bỏ các khoảng trắng ở đầu và cuối.

        						if (searchQuery !== '') {
								// Kiểm tra nếu ô tìm kiếm không trống.
            						window.location.href = 'timkiem.php?search=' + encodeURIComponent(searchQuery);
									// Chuyển hướng đến trang 'timkiem.php' với tham số tìm kiếm được mã hóa.
        						}
    						}else{	// Nếu không phải phím "Enter" được nhấn.
								var specialCharacters = /[@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?!`~]/;
								// Tạo một biểu thức chính quy để kiểm tra ký tự đặc biệt.

            					if (specialCharacters.test(event.key)) {
								// Kiểm tra xem ký tự được nhấn có là ký tự đặc biệt hay không.

									document.getElementById("error-message").innerText = "Không được nhập ký tự đặc biệt!";
									// Hiển thị thông báo lỗi nếu ký tự đặc biệt được nhập.
                					event.preventDefault();
									// Ngăn chặn sự kiện mặc định của phím được nhấn.
								}else{
									// Nếu ký tự không phải là ký tự đặc biệt.
									document.getElementById("error-message").innerText = "";
									// Xóa thông báo lỗi (nếu có).
								}
							}
						});
					</script>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script>
    		function updateDateTime() {
        		var now = new Date();

        		var dayOfWeek = now.getDay();

        		var dayNames = ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'];

		        var dayName = dayNames[dayOfWeek];
        
				var dateString = now.toLocaleDateString('vi-VN');
        		var timeString = now.toLocaleTimeString();
        
        		document.getElementById('currentDateTime').textContent = dayName + ', ' + dateString + ' ' + timeString;
    		}
    		updateDateTime();
    		setInterval(updateDateTime, 1000); 
		</script>
