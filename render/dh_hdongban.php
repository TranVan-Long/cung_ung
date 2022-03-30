<?
include("config.php");
$id_kh = getValue('id_kh','int','POST','');
$com_id = getValue('com_id','int','POST','');
$id_hd = getValue('id_hd','int','POST','');
?>
<option value="">-- Chọn hợp đồng --</option>
<? if($id_kh != "" && $com_id != ""){
    if($id_hd == ""){
        $list_hd = new db_query("SELECT `id` FROM `hop_dong` WHERE `id_nha_cc_kh` = $id_kh AND `id_cong_ty` = $com_id  AND `phan_loai` = 2 ");
        while($row = mysql_fetch_assoc($list_hd -> result)){
?>
<option value="<?= $row['id'] ?>">HĐ - <?= $row['id'] ?></option>
<?}}else if($id_hd != ""){
        $list_hd = new db_query("SELECT `id` FROM `hop_dong` WHERE `id_nha_cc_kh` = $id_kh AND `id_cong_ty` = $com_id  AND `phan_loai` = 2 ");
        while($row = mysql_fetch_assoc($list_hd -> result)){
?>
<option value="<?= $row['id'] ?>" <?= ($row['id'] == $id_hd) ? "selected":"" ?>>HĐ - <?= $row['id'] ?></option>
<? }}} ?>