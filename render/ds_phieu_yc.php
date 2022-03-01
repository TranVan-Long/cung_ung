<?
include("config.php");
$id_phieu = $_POST['id_phieu'];
$id_nhacc = $_POST['id_nhacc'];
$com_id = $_POST['com_id'];

?>
<option value="">-- Chọn yêu cầu báo giá --</option>
<? if($id_nhacc != "" && $com_id != ""){
        $list_nhacc = new db_query("SELECT `id`, `nha_cc_kh`, `id_cong_ty` FROM `yeu_cau_bao_gia` WHERE `nha_cc_kh` = $id_nhacc AND `id_cong_ty` = $com_id AND `phan_loai` = 1 ");
        while($row = mysql_fetch_assoc($list_nhacc -> result)){
?>
<option value="<?= $row['id'] ?>" <?= ($row['id'] == $id_phieu) ? "selected" : "" ?>>BG - <?= $row['id'] ?></option>
<?}}?>