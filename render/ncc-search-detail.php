<?
include("config.php");
$list_id = $_POST['list_id'];
?>
<option value="">Nhập thông tin cần tìm kiếm</option>
<? if ($list_id == '1') {
    $danh_sach = new db_query("SELECT `id`, `phan_loai` FROM `nha_cc_kh` WHERE `phan_loai` = 1 ");
    while ($item = mysql_fetch_assoc($danh_sach->result)) {
?>
        <option value="<?= $item['id'] ?>">NCC - <?= $item['id'] ?></option>
    <? }
} else if ($list_id == '2') {
    $danh_sach = new db_query("SELECT `id`, `ten_nha_cc_kh` , `phan_loai` FROM `nha_cc_kh` WHERE `phan_loai` = 1 ");
    while ($item = mysql_fetch_assoc($danh_sach->result)) {
    ?>
        <option value="<?= $item['id'] ?>"><?= $item['ten_nha_cc_kh'] ?></option>
        <? }
} else if ($list_id == '3') {
    $danh_sach = new db_query("SELECT `id`, `so_dkkd`, `phan_loai` FROM `nha_cc_kh` WHERE `phan_loai` = 1");
    while ($item = mysql_fetch_assoc($danh_sach->result)) {
        if ($item['so_dkkd'] != "") {
        ?>
            <option value="<?= $item['id'] ?>"><?= $item['so_dkkd'] ?></option>
        <? }
    }
} else if ($list_id == '4') {
    $danh_sach = new db_query("SELECT `id`, `ma_so_thue`, `phan_loai` FROM `nha_cc_kh` WHERE `phan_loai` = 1 ");
    while ($item = mysql_fetch_assoc($danh_sach->result)) {
        if ($item['ma_so_thue'] != "") {
        ?>
            <option value="<?= $item['id'] ?>"><?= $item['ma_so_thue'] ?></option>
<? }
    }
} ?>