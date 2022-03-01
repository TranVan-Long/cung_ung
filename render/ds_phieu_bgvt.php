<?
include("config.php");
$com_id = $_POST['com_id'];
$id_ncc = $_POST['id_ncc'];

?>
<option value="">-- Chọn yêu cầu báo giá --</option>

<? if($com_id != "" && $id_ncc != ""){
        $list_phieu_yc = new db_query("SELECT `id`, `id_nguoi_lap`, `nha_cc_kh`, `id_cong_ty` FROM `yeu_cau_bao_gia`
                                        WHERE `nha_cc_kh` = $id_ncc AND `id_cong_ty` = $com_id AND `trang_thai` = 1 ");
        while($row = mysql_fetch_assoc($list_phieu_yc -> result)) {?>
    <option value="<?= $row['id'] ?>">BG - <?= $row['id'] ?></option>
<?}}?>
