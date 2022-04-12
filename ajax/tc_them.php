<?
include("config.php");

$tieu_chi_danh_gia  = $_POST['tieu_chi_danh_gia'];
$he_so              = $_POST['he_so'];
$kieu_gia_tri       = $_POST['kieu_gia_tri'];

$gia_tri            = $_POST['gia_tri'];
$ten_hien_thi       = $_POST['ten_hien_thi'];

$user_id              = getValue('user_id', 'int', 'POST', '');
$com_id              = getValue('com_id', 'int', 'POST', '');
$phan_quyen_nk = getValue('phan_quyen_nk', 'int', 'POST', '');
$ngay_tao = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));

$count1 = count($gia_tri);

if ($tieu_chi_danh_gia != "") {
    if ($kieu_gia_tri == 1 && $count1 = 1) {
        $them_tc = new db_query("INSERT INTO `tieu_chi_danh_gia` (`id`, `tieu_chi`, `he_so`, `kieu_gia_tri`, `id_cong_ty`) VALUES ('', '$tieu_chi_danh_gia', '$he_so', '$kieu_gia_tri', '$com_id')");
        $row = mysql_fetch_assoc((new db_query("SELECT LAST_INSERT_ID() AS tc_id"))->result);
        $tc_id = $row['tc_id'];
        $ds_gt = new db_query("INSERT INTO `ds_gia_tri_dg` (`id`, `id_tieu_chi`, `gia_tri`, `ten_gia_tri`) VALUES ('', '$tc_id', '$gia_tri[0]', '');");

        //save log
        $noi_dung = 'Bạn đã thêm tiêu chí đánh giá: ' . $tieu_chi_danh_gia . '. Kiểu nhập tay.';
        $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`,`role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                            VALUES('', '$user_id','$phan_quyen_nk', '$ngay_tao','$gio_tao', '$noi_dung','$com_id')");

    } elseif ($kieu_gia_tri == 2 && $count1 > 0) {
        $them_tc = new db_query("INSERT INTO `tieu_chi_danh_gia` (`id`, `tieu_chi`, `he_so`, `kieu_gia_tri`, `id_cong_ty`) VALUES ('', '$tieu_chi_danh_gia', '$he_so', '$kieu_gia_tri', '$com_id')");
        $row = mysql_fetch_assoc((new db_query("SELECT LAST_INSERT_ID() AS tc_id"))->result);
        $tc_id = $row['tc_id'];

        for ($i = 0; $i < count($gia_tri); $i++) {
            $ds_gt = new db_query("INSERT INTO `ds_gia_tri_dg` (`id`, `id_tieu_chi`, `gia_tri`, `ten_gia_tri`) VALUES ('', '$tc_id', '$gia_tri[$i]', '$ten_hien_thi[$i]');");
        }
        //save log
        $noi_dung = 'Bạn đã thêm tiêu chí đánh giá: ' . $tieu_chi_danh_gia . '. Kiểu danh sách.';
        $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`,`role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                            VALUES('', '$user_id','$phan_quyen_nk', '$ngay_tao','$gio_tao', '$noi_dung','$com_id')");
    } else {
        echo "Vui lòng thêm ít nhất một giá trị hoặc chọn kiểu nhập tay.";
    }
} else {
    echo "fail!";
}
