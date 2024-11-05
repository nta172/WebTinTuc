<?php
require_once '../../DB/dbConnect.php';

if (isset($_POST['name'])) {
    $search_query = mysqli_real_escape_string($conn, $_POST['name']);

    $query = "SELECT tin.*, COUNT(binh_luan.id_binhluan) AS soluotbinhluan,
              SUM(CASE WHEN binh_luan.trangthai = 0 THEN 1 ELSE 0 END) AS binhluanmoi,
              SUM(CASE WHEN binh_luan.trangthai = 1 THEN 1 ELSE 0 END) AS binhluandaduyet
              FROM tin
              LEFT JOIN binh_luan ON tin.id_tin = binh_luan.id_tin
              WHERE tieude LIKE '%{$search_query}%'
              GROUP BY tin.id_tin
              HAVING soluotbinhluan > 0 OR binhluanmoi > 0
              LIMIT 10";

    $result = mysqli_query($conn, $query);
    $stt = 0;
    
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $soluotbinhluan = $row['soluotbinhluan'];
            $binhluanmoi = $row['binhluanmoi'];
            $binhluandaduyet = $row['binhluandaduyet'];
            ?>
            <tr>
                <td><?php echo ++$stt; ?></td>
                <td style="max-width: 150px; overflow: hidden; text-overflow: ellipsis;"><?php echo substr($row['tieude'], 0, 60) . (strlen($row['tieude']) > 60 ? '...' : ''); ?></td>
                <td><img src="admin/upload/<?php echo $row['hinhdaidien'] ?>" alt="" width="100px"></td>
                <td style="white-space: nowrap; text-align: center;"><?php echo $soluotbinhluan; ?></td>
                <td style="white-space: nowrap; text-align: center;"><?php echo $binhluandaduyet; ?></td>
                <td style="white-space: nowrap; text-align: center; color: red; font-weight: bold;"><?php echo $binhluanmoi; ?></td>
                <td>
                    <a class="btn btn-success" href="admin/binhluan/xem.php?id_tin=<?php echo $row['id_tin']?>">Xem</a>
                </td>
            </tr>
            <?php
        }
    } else {
        echo "<tr><td colspan='7' style='color: red;'>Không tìm thấy!</td></tr>";
    }
}
?>
