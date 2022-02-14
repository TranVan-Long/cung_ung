<?

include("config.php");

$ngay_dg = strtotime($_POST['ngay_dg']);
$ep_id = $_POST['ep_id'];
$dep_id = $_POST['dep_id'];
$id_nhacc = $_POST['id_nhacc'];
$dg_khac = $_POST['dg_khac'];

$user_id = $_POST['user_id'];
$time = strtotime(date('Y-m-d H:i:s', time()));

$ten_nhacc = mysql_fetch_assoc((new db_query("SELECT `id`, `ten_nha_cc_kh` FROM `nha_cc_kh` WHERE `id` = $id_nhacc ")) -> result)['ten_nha_cc_kh'];
$noi_dung = "Bạn đã đánh giá nhà cung cấp ".$ten_nhacc;

$id_tc = $_POST['id_tc'];
$id_tc = str_replace('_', ',', $id_tc);
$id_tc = rtrim($id_tc, ',');
$id_tc = explode(',', $id_tc);
$count = count($id_tc);

$diem_dg = $_POST['diem_dg'];
$diem_dg = str_replace('_', ',', $diem_dg);
$diem_dg = rtrim($diem_dg, ',');
$diem_dg = explode(',', $diem_dg);

// $ab = 0;
// for($a = 0; $a < count($diem_dg); $a++){
//     $ab += $diem_dg[$a];
// }

$tong_diem = $_POST['tong_diem'];
$tong_diem = str_replace('_', ',', $tong_diem);
$tong_diem = rtrim($tong_diem, ',');
$tong_diem = explode(',', $tong_diem);

$dg_ctiet = $_POST['dg_ctiet'];
$dg_ctiet = str_replace('_', ',', $dg_ctiet);
$dg_ctiet = rtrim($dg_ctiet, ',');
$dg_ctiet = explode(',', $dg_ctiet);

$thang_diem = $_POST['thang_diem'];
$thang_diem = str_replace('_', ',', $thang_diem);
$thang_diem = rtrim($thang_diem, ',');
$thang_diem = explode(',', $thang_diem);

// $ac = 0;
// for($b = 0; $b < count($thang_diem); $b++){
//     $ac += $thang_diem[$b];
// }


if($ngay_dg != "" && $id_nhacc != "" && $count > 0){
    $them_dg = new db_query("INSERT INTO `danh_gia`(`id`, `ngay_danh_gia`, `nguoi_danh_gia`, `phong_ban`,
                        `id_nha_cc`, `danh_gia_khac`, `tong_diem`) VALUES ('','$ngay_dg','$ep_id','$dep_id','$id_nhacc','$dg_khac','')");

    $row = new db_query("SELECT LAST_INSERT_ID() AS dg_id");
    $row0 = mysql_fetch_assoc($row -> result);
    $dg_id = $row0['dg_id'];

    for($j = 0; $j < $count; $j++){
        $inser_dg = new db_query("INSERT INTO `chi_tiet_danh_gia`(`id`, `id_danh_gia`, `id_tieu_chi`, `diem_danh_gia`, `tong_diem_danh_gia`, `thang_diem`,
        `danh_gia_chi_tiet`) VALUES ('','$dg_id','$id_tc[$j]','$diem_dg[$j]','$tong_diem[$j]','$thang_diem[$j]','$dg_ctiet[$j]')");
    }

    $inser_nk = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_gio`, `noi_dung`)
                                VALUES ('','$user_id','$time','$noi_dung')");

}else{
    echo "Bạn đánh giá nhà cung cấp không thành công, vui lòng thử lại! ";
}

?>