<?
include("config.php");
$hd_dh = getValue('hd_dh', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$loai_phieu = getValue('loai_phieu', 'int', 'POST', '');
$com_name = $_POST['com_name'];

if ($com_id != "" && $hd_dh != "") {
    if ($loai_phieu == 1) {
        $list_ncc = new db_query("SELECT h.`phan_loai`, n.`ten_nha_cc_kh` FROM `hop_dong` AS h INNER JOIN `nha_cc_kh` AS n
                                ON h.`id_nha_cc_kh` = n.`id` WHERE h.`id_cong_ty` = $com_id AND h.`id` = $hd_dh ");
        $row = mysql_fetch_assoc($list_ncc->result);
        $phan_loai = $row['phan_loai'];
        if ($phan_loai == 1 || $phan_loai == 3 || $phan_loai == 4) {
            $ten_ncc_kh = $row['ten_nha_cc_kh'];    ?>
            <div class="form-group">
                <label>Đơn vị chi trả</label>
                <p class="cr_weight"><?= $com_name ?></p>
            </div>
            <div class="form-group">
                <label>Đơn vị thụ hưởng</label>
                <p class="cr_weight"><?= $ten_ncc_kh ?></p>
            </div>

        <? } else if ($phan_loai == 2) {
            $ten_ncc_kh = $row['ten_nha_cc_kh']; ?>
            <div class="form-group">
                <label>Đơn vị chi trả</label>
                <p class="cr_weight"><?= $ten_ncc_kh ?></p>
            </div>
            <div class="form-group">
                <label>Đơn vị thụ hưởng</label>
                <p class="cr_weight"><?= $com_name ?></p>
            </div>
        <? }
    } else if ($loai_phieu == 2) {
        $list_ncc = new db_query("SELECT h.`phan_loai`, n.`ten_nha_cc_kh` FROM `don_hang` AS h INNER JOIN `nha_cc_kh` AS n
                                ON h.`id_nha_cc_kh` = n.`id` WHERE h.`id_cong_ty` = $com_id AND h.`id` = $hd_dh ");
        $row = mysql_fetch_assoc($list_ncc->result);
        $phan_loai = $row['phan_loai'];
        if ($phan_loai == 1) {
            $ten_ncc_kh = $row['ten_nha_cc_kh']; ?>
            <div class="form-group">
                <label>Đơn vị chi trả</label>
                <p class="cr_weight"><?= $com_name ?></p>
            </div>
            <div class="form-group">
                <label>Đơn vị thụ hưởng</label>
                <p class="cr_weight"><?= $ten_ncc_kh ?></p>
            </div>
        <? } else if ($phan_loai == 2) {
            $ten_ncc_kh = $row['ten_nha_cc_kh']; ?>
            <div class="form-group">
                <label>Đơn vị chi trả</label>
                <p class="cr_weight"><?= $ten_ncc_kh ?></p>
            </div>
            <div class="form-group">
                <label>Đơn vị thụ hưởng</label>
                <p class="cr_weight"><?= $com_name ?></p>
            </div>
<? }
    }
}

?>