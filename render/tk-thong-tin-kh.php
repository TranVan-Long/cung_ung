<?
include("config.php");
$id_ds = $_POST['id_ds'];
?>
<option value="">Nhập thông tin cần tìm kiếm</option>
<? if($id_ds == '1'){
    $danh_sach = new db_query("SELECT `id`, `phan_loai` FROM `nha_cc_kh` WHERE `phan_loai` = '2' ");
    while($item = mysql_fetch_assoc($danh_sach->result)){
?>
    <option value="<?= $item['id'] ?>">KH - <?= $item['id'] ?></option>
<? }} else if($id_ds == '2') {
    $danh_sach = new db_query("SELECT `id`, `ten_nha_cc_kh` , `phan_loai` FROM `nha_cc_kh` WHERE `phan_loai` = '2' ");
    while($item = mysql_fetch_assoc($danh_sach->result)){
?>
    <option value="<?= $item['id'] ?>"><?= $item['ten_nha_cc_kh'] ?></option>
<? }} else if($id_ds == '3') {
    $danh_sach = new db_query("SELECT `id`, `so_dien_thoai`, `phan_loai` FROM `nha_cc_kh` WHERE `phan_loai` = '2' ");
    while($item = mysql_fetch_assoc($danh_sach->result)){
        if($item['so_dien_thoai'] != ""){
?>
<option value="<?= $item['id'] ?>"><?= $item['so_dien_thoai'] ?></option>
<? }}} else if($id_ds == '4') {
    $danh_sach = new db_query("SELECT `id`, `email`, `phan_loai` FROM `nha_cc_kh` WHERE `phan_loai` = '2' ");
    while($item = mysql_fetch_assoc($danh_sach->result)){
        if($item['email'] != ""){
?>
    <option value="<?= $item['id'] ?>"><?= $item['email'] ?></option>
<? }}} ?>