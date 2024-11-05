<?php
// Kiểm tra xem đã có tệp tin hình ảnh được tải lên chưa
if(isset($_FILES['file']['name'])) {
    $filename = $_FILES['file']['name'];
    $tmp_name = $_FILES['file']['tmp_name'];
    $name_file = 'hinhanh-' . time() . $filename;
    $path = '../upload/' . $name_file;

    // Di chuyển tệp tin hình ảnh vào thư mục upload
    if(move_uploaded_file($tmp_name, $path)) {
        // Trả về đường dẫn thực tế của hình ảnh để FroalaEditor hiển thị
        $response = array(
            'link' => 'admin/upload/' . $name_file // Đường dẫn thực tế của hình ảnh
        );
        echo stripslashes(json_encode($response));
    } else {
        // Trường hợp di chuyển tệp tin thất bại
        echo json_encode(array('error' => 'Failed to move uploaded file.'));
    }
} else {
    // Trường hợp không có tệp tin nào được tải lên
    echo json_encode(array('error' => 'No file uploaded.'));
}
?>
