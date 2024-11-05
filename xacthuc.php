<!-- <?php
session_start();

$captcha = substr(md5(mt_rand()), 0, 5);    // Tạo một chuỗi CAPTCHA ngẫu nhiên.
$_SESSION['captcha'] = $captcha;    // Lưu trữ giá trị của CAPTCHA vào biến phiên.

$width = 100;
$height = 30;
$image = imagecreate($width, $height);  // Tạo một hình ảnh mới với kích thước đã chỉ định.
$background_color = imagecolorallocate($image, 255, 255, 255);  // Đặt màu nền của hình ảnh.
$text_color = imagecolorallocate($image, 0, 0, 0);  // Đặt màu chữ của hình ảnh.
imagestring($image, 5, 10, 5, $captcha, $text_color);   // Vẽ chuỗi CAPTCHA lên hình ảnh.

header("Content-type: image/png");  // Khai báo kiểu nội dung là hình ảnh PNG.
imagepng($image);   // Hiển thị hình ảnh PNG.
imagedestroy($image);   // Giải phóng bộ nhớ đã được sử dụng bởi hình ảnh.
?> -->