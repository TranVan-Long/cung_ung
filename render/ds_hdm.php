<?

include("config.php");
$id_ncc = getValue('id_ncc', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');

if($id_ncc != "" && $com_id != ""){
    $list_hdm = new db_query("SELECT `id` FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `id_nha_cc_kh` = $id_ncc AND `phan_loai` = 1 ");
}

?>
<option value="">-- Chọn hợp đồng --</option>
<? while($row = mysql_fetch_assoc($list_hdm -> result)) {?>
    <option value="<?= $row['id'] ?>">HĐ - <?= $row['id'] ?></option>
<?}?>