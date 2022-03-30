<?
include("config.php");
$com_id = $_POST['com_id'];
$id_ncc = $_POST['id_ncc'];
?>
<option value="">-- Chọn phiếu báo giá --</option>
<?
if ($com_id != "" && $id_ncc != "") {
    $get_bg = new db_query("SELECT `id` FROM `bao_gia` WHERE `id_nha_cc` = $id_ncc AND `id_cong_ty`= $com_id");
    while ($list_bg = mysql_fetch_assoc($get_bg->result)) {
?>
        <option value="<?= $list_bg['id'] ?>">BG - <?= $list_bg['id'] ?></option>
<? }
} ?>