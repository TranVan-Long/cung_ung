<?
include("config.php");
$loai_hs = getValue('loai_hs', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
?>
<option value="">-- Chọn hợp đồng / Đơn hàng --</option>
<? if($loai_hs == 1 && $com_id != "") {
    $list_hd = new db_query("SELECT `id` FROM `hop_dong` WHERE `id_cong_ty` = $com_id ");
    while($row = mysql_fetch_assoc($list_hd -> result)){
        // $id = $row['id'];
        // $all_hs = new db_query("SELECT DISTINCT `id_hd_dh` FROM `ho_so_thanh_toan` WHERE `loai_hs` = 1 AND `id_cong_ty` = $com_id AND `id_hd_dh` = $id ");
        // if(mysql_num_rows($all_hs -> result) > 0){
?>
    <option value="<?= $row['id'] ?>">HĐ - <?= $row['id'] ?></option>
<?}}else if($loai_hs == 2 && $com_id != ""){
    $list_dh = new db_query("SELECT `id` FROM `don_hang` WHERE `id_cong_ty` = $com_id ");
    while ($row1 = mysql_fetch_assoc($list_dh->result)) {
        // $id = $row1['id'];
        // $all_hs = new db_query("SELECT DISTINCT `id_hd_dh` FROM `ho_so_thanh_toan` WHERE `loai_hs` = 2 AND `id_cong_ty` = $com_id AND `id_hd_dh` = $id ");
        // if (mysql_num_rows($all_hs->result) > 0) {
?>
    <option value="<?= $row1['id'] ?>">ĐH - <?= $row1['id'] ?></option>
<?}}?>