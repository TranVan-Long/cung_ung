<?
include("config.php");

$com_id = getValue('com_id', 'int', 'POST', '');
$loai_phieu = getValue('loai_phieu', 'int', 'POST', '');
$hd_dh = getValue('hd_dh', 'int', 'POST', '');

if ($com_id != "" && $hd_dh != "") {
    if ($loai_phieu == 1) {
        $list_ncc = new db_query("SELECT h.`phan_loai`, n.`ten_nha_cc_kh`, h.`id_nha_cc_kh` FROM `hop_dong` AS h INNER JOIN `nha_cc_kh` AS n
                                ON h.`id_nha_cc_kh` = n.`id` WHERE h.`id_cong_ty` = $com_id AND h.`id` = $hd_dh ");
        $row = mysql_fetch_assoc($list_ncc->result);
        $id_ncc_kh = $row['id_nha_cc_kh'];
        $phan_loai = $row['phan_loai'];
        if ($phan_loai == 1 || $phan_loai == 3 || $phan_loai == 4) {
            $tieu_de = "Nhà cung cấp";
            $ten_ncc_kh = $row['ten_nha_cc_kh'];
        } else if ($phan_loai == 2) {
            $tieu_de = "Khách hàng";
            $ten_ncc_kh = $row['ten_nha_cc_kh'];
        };

        if($phan_loai == 1){
            $ploai = 1;
        }else if($phan_loai == 2){
            $ploai = 2;
        }else if($phan_loai == 3){
            $ploai = 3;
        }else if($phan_loai == 4){
            $ploai = 4;
        };

    } else if ($loai_phieu == 2) {
        $list_ncc = new db_query("SELECT h.`phan_loai`, n.`ten_nha_cc_kh`, h.`id_nha_cc_kh` FROM `don_hang` AS h INNER JOIN `nha_cc_kh` AS n
                                ON h.`id_nha_cc_kh` = n.`id` WHERE h.`id_cong_ty` = $com_id AND h.`id` = $hd_dh ");
        $row = mysql_fetch_assoc($list_ncc->result);
        $id_ncc_kh = $row['id_nha_cc_kh'];
        $phan_loai = $row['phan_loai'];
        if ($phan_loai == 1) {
            $tieu_de = "Nhà cung cấp";
            $ten_ncc_kh = $row['ten_nha_cc_kh'];
            $ploai = 5;
        } else if ($phan_loai == 2) {
            $tieu_de = "Khách hàng";
            $ten_ncc_kh = $row['ten_nha_cc_kh'];
            $ploai = 6;
        }
    }
}


?>
<label class="label_pl" data="<?= $phan_loai ?>"><?= $tieu_de ?></label>
<input type="text" name="khachh_nhacc" value="<?= $ten_ncc_kh ?>" data="<?= $id_ncc_kh ?>" data1="<?= $ploai ?>" class="form-control cr_weight h_border">