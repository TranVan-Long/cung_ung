<?
include("config.php");

$com_id = $_POST['com_id'];
$user_id = $_POST['user_id'];
$id_bg = $_POST['id_bg'];
$id_kh = $_POST['id_kh'];
$ngay_bd = strtotime($_POST['ngay_bd']);
$ngay_kt = strtotime($_POST['ngay_kt']);
$noi_dung_ph = $_POST['noi_dung_ph'];

$id_v = $_POST['id_v'];
$cou = count($id_v);

$id_vt = $_POST['id_vt'];
$cou1 = count($id_vt);

$so_luong = $_POST['so_luong'];
$cou2 = count($so_luong);

$new_id_vt = $_POST['new_id_vt'];
$cou3 = count($new_id_vt);

$new_so_luong = $_POST['new_so_luong'];
$cou4 = count($new_so_luong);

$noi_dung_nk = "Bạn đã cập nhật phiếu báo giá khách hàng phiếu: BG - ".$id_bg;

$thoi_gian = strtotime(date('Y-m-d H:i:s', time()));

if($com_id != "" && $id_bg != "" && ($cou > 0 || $cou3 > 0) && ( ( ($cou == $cou1) && ($cou1 == $cou2) ) || ($cou3 == $cou4) )){

    $upda_bg = new db_query("UPDATE `yeu_cau_bao_gia` SET `nha_cc_kh`='$id_kh',`noi_dung_thu`='$noi_dung_ph',`ngay_bd`='$ngay_bd',`ngay_kt`='$ngay_kt'
                                WHERE `id_cong_ty` = $com_id AND `id` = $id_bg ");

    $inser_nk = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_gio`, `noi_dung`) VALUES ('','$user_id','$thoi_gian','$noi_dung_nk')");

    if($cou > 0 && $cou == $cou1 && $cou1 == $cou2){
        for($i = 0; $i < $cou; $i++){
            $update_vt = new db_query("UPDATE `vat_tu_bao_gia` SET `id_vat_tu`='$id_vt[$i]',`so_luong_yc_bg`='$so_luong[$i]' WHERE `id` = $id_v[$i] AND `id_yc_bg` = $id_bg ");
        }

    }else{
        echo "Bạn cập nhật phiếu báo giá cho khách hàng không thành công, vui lòng thử lại!";
    };

    if($cou3 > 0 && $cou3 == $cou4){
        for($j = 0; $j < $cou3; $j++){
            $inser_vt = new db_query("INSERT INTO `vat_tu_bao_gia`(`id`, `id_yc_bg`, `id_vat_tu`, `so_luong_yc_bg`) VALUES ('','$id_bg','$new_id_vt[$j]','$new_so_luong[$j]')");
        }
    }
}
else{
    echo "Bạn cập nhật phiếu báo giá cho khách hàng không thành công, vui lòng thử lại!";
}

?>