<?
include("config.php");
$dh_hd = getValue('dh_hd', 'int', 'POST', '');
$loai_hs = getValue('loai_hs', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$com_name = $_POST['com_name'];

if($loai_hs != "" && $com_id != "" && $dh_hd != ""){
    if ($loai_hs == 1) {
        $phan_loai = mysql_fetch_assoc((new db_query("SELECT n.`ten_nha_cc_kh`, h.`phan_loai` FROM `hop_dong` AS h INNER JOIN `nha_cc_kh` AS n
                                        ON n.`id` = h.`id_nha_cc_kh` WHERE h.`id_cong_ty` = $com_id AND h.`id` = $dh_hd "))->result);
        $ploai_hd = $phan_loai['phan_loai'];
        if ($ploai_hd == 1 || $ploai_hd == 3 || $ploai_hd == 4) {
            $dv_thuc_hien = $phan_loai['ten_nha_cc_kh'];
        } else if ($ploai_hd == 2) {
            $dv_thuc_hien = $com_name;
        }
    } else if ($loai_hs == 2) {
        $phan_loai = mysql_fetch_assoc((new db_query("SELECT d.`phan_loai`, n.`ten_nha_cc_kh` FROM `don_hang` AS d INNER JOIN `nha_cc_kh` AS n
                                        ON n.`id` = d.`id_nha_cc_kh` WHERE d.`id` = $dh_hd AND d.`id_cong_ty` = $com_id "))->result);
        $ploai_dh = $phan_loai['phan_loai'];
        if ($ploai_dh == 1) {
            $dv_thuc_hien = $phan_loai['ten_nha_cc_kh'];
        } else if ($ploai_dh == 2) {
            $dv_thuc_hien = $com_name;
        }
    }
}
?>
<label>Đơn vị thực hiện</label>
<input type="text" name="dia_chi" value="<?= $dv_thuc_hien ?>" class="form-control" placeholder="Nhập địa chỉ" readonly>