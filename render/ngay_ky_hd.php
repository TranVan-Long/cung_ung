<?
include("config.php");
$com_id = getValue('com_id', 'int', 'POST', '');
$id_hd = getValue('id_hd', 'int', 'POST', '');
$loai_phieu = getValue('loai_phieu', 'int', 'POST', '');

if($com_id != "" && $id_hd != "" && $loai_phieu != ""){
    if($loai_phieu == 1){
        $ngay_ky_hd = mysql_fetch_assoc((new db_query("SELECT `ngay_ky_hd` FROM `hop_dong` WHERE `id` = $id_hd AND `id_cong_ty` = $com_id ")) -> result)['ngay_ky_hd'];
        $ngay_ky_hd = date('Y-m-d', $ngay_ky_hd);
        echo $ngay_ky_hd;
    }else if($loai_phieu == 2){
        $ngay_ky_hd = mysql_fetch_assoc((new db_query("SELECT `ngay_ky` FROM `don_hang` WHERE `id` = $id_hd AND `id_cong_ty` = $com_id ")) -> result)['ngay_ky'];
        if($ngay_ky_hd != 0){
            $ngay_ky_hd = date('Y-m-d', $ngay_ky_hd);
            echo $ngay_ky_hd;
        }else{
            $ngay_ky_hd = 0;
            echo $ngay_ky_hd;
        }
    }
}

?>