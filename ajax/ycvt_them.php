<?
include("config.php");

$cong_trinh             = getValue('cong_trinh','int','POST','');
$ngay_tao_yeu_cau       =  strtotime($_POST['ngay_tao_yeu_cau']);
$ngay_phai_hoan_thanh   =  strtotime($_POST['ngay_phai_hoan_thanh']);
$dien_giai              = $_POST['dien_giai'];
$trang_thai             = 1;

$vat_tu                 = $_POST['vat_tu'];
$so_luong               = $_POST['so_luong'];

$user_id                = getValue('user_id', 'int', 'POST', '');
$com_id                =  getValue('com_id', 'int', 'POST', '');
$role                =  getValue('role', 'int', 'POST', '');

$count = count($vat_tu);
$count1 = count($so_luong);



if ($user_id != "") {
    if ($count <= 0 && $count1 <= 0) {
        echo "Thêm ít nhất 1 vật tư.";
    } else {
        if ($count != $count1) {
            echo "Vui lòng điền đầy đủ thông tin vật tư.";
        } else {
            $them_ycvt = new db_query("INSERT INTO `yeu_cau_vat_tu` (`id`,`id_nguoi_yc`,`role`, `id_cong_trinh`, `ngay_ht_yc`, `dien_giai`,
                                    `trang_thai`, `ngay_tao`, `id_cong_ty`) VALUES (NULL, '$user_id','$role', '$cong_trinh', '$ngay_phai_hoan_thanh',
                                    '$dien_giai', '$trang_thai', '$ngay_tao_yeu_cau', '$com_id')");

            $row = mysql_fetch_assoc((new db_query("SELECT LAST_INSERT_ID() AS yc_id"))->result);
            $id_yc = $row['yc_id'];


            for ($i = 0; $i < $count; $i++) {

                $them_vt = new db_query("INSERT INTO `chi_tiet_yc_vt` (`id`, `id_yc_vt`, `id_vat_tu`, `so_luong_yc_duyet`) VALUES (NULL, '$id_yc', '$vat_tu[$i]', '$so_luong[$i]')");
            }
            $noi_dung = 'Bạn đã thêm phiếu yêu cầu vật tư: YC-' . $id_yc;
            $ngay_tao = strtotime(date('Y-m-d', time()));
            $gio_tao  = strtotime(date('H:i:s', time()));
            $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`,`role`, `ngay_tao`, `gio_tao`, `noi_dung`)
                          VALUES('', '$user_id','$role', '$ngay_tao', '$gio_tao', '$noi_dung')");
        }
    }
} else {
    echo "Thao tác thất bại vui lòng thử lại!";
}
