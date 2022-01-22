<?
include("config.php");
$list_id = $_POST['list_id'];
?>
<option value="">Nhập thông tin cần tìm kiếm</option>
<? if ($list_id == '1') {
    $danh_sach = new db_query("SELECT * FROM `tieu_chi_danh_gia`");
    while ($item = mysql_fetch_assoc($danh_sach->result)) {
?>
        <option value="<?= $item['id'] ?>"><?= $item['tieu_chi'] ?></option>
    <? }
} else if ($list_id == '2') {
    $danh_sach = new db_query("SELECT DISTINCT `kieu_gia_tri` FROM `tieu_chi_danh_gia`");
    while ($item = mysql_fetch_assoc($danh_sach->result)) {
    ?>
        <option value="<?= $item['kieu_gia_tri'] ?>"><?=  ($item['kieu_gia_tri'] == 1) ? "Nhập tay" : "Danh sách"; ?></option>
        <? }
} 