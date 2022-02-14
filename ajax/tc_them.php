<?
include("config.php");

$tieu_chi_danh_gia  = $_POST['tieu_chi_danh_gia'];
$he_so              = $_POST['he_so'];
$kieu_gia_tri       = $_POST['kieu_gia_tri'];

$gia_tri            = $_POST['gia_tri'];
$ten_hien_thi       = $_POST['ten_hien_thi'];

$ep_id              = $_POST['ep_id'];
$ngay_gio = strtotime(date('Y-m-d H:i:s', time()));

$count1 = count($gia_tri);

if ($tieu_chi_danh_gia != "") {
    if ($kieu_gia_tri == 1 && $count1 = 1) {
        $them_tc = new db_query("INSERT INTO `tieu_chi_danh_gia` (`id`, `tieu_chi`, `he_so`, `kieu_gia_tri`) VALUES ('', '" . $tieu_chi_danh_gia . "', '" . $he_so . "', '" . $kieu_gia_tri . "')");
        $row = mysql_fetch_assoc((new db_query("SELECT LAST_INSERT_ID() AS tc_id"))->result);
        $tc_id = $row['tc_id'];
        $ds_gt = new db_query("INSERT INTO `ds_gia_tri_dg` (`id`, `id_tieu_chi`, `gia_tri`, `ten_gia_tri`) VALUES ('', '$tc_id', '$gia_tri[0]', '');");
        
        //save log
        $noi_dung = 'Bạn đã thêm tiêu chí đánh giá: ' . $tieu_chi_danh_gia . '. Kiểu giá trị: Nhập tay.';
        $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_gio`, `noi_dung`)
                    VALUES('', '$ep_id', '$ngay_gio', '$noi_dung')");
    } elseif ($kieu_gia_tri == 2 && $count1 > 0) {
        $them_tc = new db_query("INSERT INTO `tieu_chi_danh_gia` (`id`, `tieu_chi`, `he_so`, `kieu_gia_tri`) VALUES ('', '" . $tieu_chi_danh_gia . "', '" . $he_so . "', '" . $kieu_gia_tri . "')");
        $row = mysql_fetch_assoc((new db_query("SELECT LAST_INSERT_ID() AS tc_id"))->result);
        $tc_id = $row['tc_id'];

        for ($i = 0; $i < count($gia_tri); $i++) {
            $ds_gt = new db_query("INSERT INTO `ds_gia_tri_dg` (`id`, `id_tieu_chi`, `gia_tri`, `ten_gia_tri`) VALUES ('', '$tc_id', '$gia_tri[$i]', '$ten_hien_thi[$i]');");
        }
        //save log
        $noi_dung = 'Bạn đã thêm tiêu chí đánh giá: ' . $tieu_chi_danh_gia . '. Kiểu giá trị: Danh sách.';
        $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_gio`, `noi_dung`)
                    VALUES('', '$ep_id', '$ngay_gio', '$noi_dung')");
    } else {
        echo "Vui lòng thêm ít nhất một giá trị hoặc chọn kiểu nhập tay.";
    }
} else {
    echo "fail!";
}
