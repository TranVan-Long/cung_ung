<?

include("config.php");

$com_id = getValue('com_id', 'int', 'POST', '');
$ngay_dg = strtotime($_POST['ngay_dg']);
$dep_id = $_POST['dep_id'];
$id_nhacc = getValue('id_nhacc', 'int', 'POST','');
$dg_khac = $_POST['dg_khac'];
$tong_diem_dg = $_POST['tong_diem_dg'];

$user_id = getValue('user_id', 'int', 'POST', '');
$phan_quyen_nk = getValue('phan_quyen_nk', 'int', 'POST', '');

$ten_nhacc = mysql_fetch_assoc((new db_query("SELECT `id`, `ten_nha_cc_kh` FROM `nha_cc_kh` WHERE `id` = $id_nhacc "))->result)['ten_nha_cc_kh'];


$id_tc = $_POST['id_tc'];
$cou1 = count($id_tc);

$diem_dg = $_POST['diem_dg'];
$cou2 = count($diem_dg);

$tong_diem = $_POST['tong_diem'];
$cou3 = count($tong_diem);

$dg_ctiet = $_POST['dg_ctiet'];

$thang_diem = $_POST['thang_diem'];
$cou4 = count($thang_diem);

if ($ngay_dg != "" && $id_nhacc != "") {
    if($cou1 == 0){
        echo "Thêm ít nhất 1 tiêu chí đánh giá nhà cung cấp";
    }else if($cou1 > 0){
        if ($cou1 != $cou2 || $cou2 != $cou3 || $cou3 != $cou4) {
            echo "Điền đầy đủ thông tin đánh giá";
        } else if ($cou1 == $cou2 && $cou2 == $cou3 && $cou3 == $cou4) {
            $them_dg = new db_query("INSERT INTO `danh_gia`(`id`, `ngay_danh_gia`, `nguoi_danh_gia`, `quyen_nlap`, `phong_ban`, `id_nha_cc`, `danh_gia_khac`,
                            `tong_diem`, `id_cong_ty`) VALUES ('','$ngay_dg','$user_id','$phan_quyen_nk','$dep_id','$id_nhacc','$dg_khac','$tong_diem_dg','$com_id')");

            $row = new db_query("SELECT LAST_INSERT_ID() AS dg_id");
            $row0 = mysql_fetch_assoc($row->result);
            $dg_id = $row0['dg_id'];

            for ($j = 0; $j < $cou1; $j++) {
                $inser_dg = new db_query("INSERT INTO `chi_tiet_danh_gia`(`id`, `id_danh_gia`, `id_tieu_chi`, `diem_danh_gia`, `tong_diem_danh_gia`, `thang_diem`,
            `danh_gia_chi_tiet`) VALUES ('','$dg_id','$id_tc[$j]','$diem_dg[$j]','$tong_diem[$j]','$thang_diem[$j]','$dg_ctiet[$j]')");
            }
            $noi_dung = "Bạn đã đánh giá nhà cung cấp " . $ten_nhacc . "phiếu đánh giá: PH - " . $dg_id;
            $ngay_tao = strtotime(date('Y-m-d', time()));
            $gio_tao = strtotime(date('H:i:s', time()));
            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                            VALUES('', '$user_id','$phan_quyen_nk', '$ngay_tao','$gio_tao', '$noi_dung','$com_id')");
        }
    }
} else {
    echo "Bạn đánh giá nhà cung cấp không thành công, vui lòng thử lại! ";
}
