<?
include("config.php");

$cong_trinh             = $_POST['cong_trinh'];
$ngay_tao_yeu_cau       =  strtotime($_POST['ngay_tao_yeu_cau']);
$ngay_phai_hoan_thanh   =  strtotime($_POST['ngay_phai_hoan_thanh']);
$dien_giai              = $_POST['dien_giai'];
$trang_thai             = 1;

$vat_tu                 = $_POST['vat_tu'];
$so_luong               = $_POST['so_luong'];

$user_id                = $_POST['user_id'];
$comp_id                = $_POST['comp_id'];

$count = count($vat_tu);
$count1 = count($so_luong);



if ($user_id != "") {
    if ($count > 0 && $count1 > 0) {
        $them_ycvt = new db_query("INSERT INTO `yeu_cau_vat_tu` (`id`,`id_nguoi_yc`, `id_cong_trinh`, `ngay_ht_yc`, `dien_giai`, `trang_thai`, `ngay_tao`, `id_cong_ty`) VALUES (NULL, '$user_id', '$cong_trinh', '$ngay_phai_hoan_thanh', '$dien_giai', '$trang_thai', '$ngay_tao_yeu_cau', '$comp_id')");

        $row = mysql_fetch_assoc((new db_query("SELECT LAST_INSERT_ID() AS yc_id"))->result);
        $id_yc = $row['yc_id'];


        for ($i = 0; $i < $count; $i++) {
            if ($vat_tu[$i] != 0 && $so_luong[$i] != 0) {
                $them_vt = new db_query("INSERT INTO `chi_tiet_yc_vt` (`id`, `id_yc_vt`, `id_vat_tu`, `so_luong_yc_duyet`) VALUES (NULL, '$id_yc', '$vat_tu[$i]', '$so_luong[$i]')");
            }else{
                echo "Vui lòng điền đầy đủ thông tin!";
            }
        }
        //save log
        $noi_dung = 'Bạn đã thêm phiếu yêu cầu vật tư: YC-' . $id_yc;
        $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_gio`, `noi_dung`)
                          VALUES('', '$user_id', '$ngay_tao_yeu_cau', '$noi_dung')");
    } else {
        echo "Thêm ít nhất 1 vật tư!";
    }
} else {
    echo "Thao tác thất bại vui lòng thử lại!";
}
