<?
include("config.php");
$list_id = $_POST['list_id'];
?>
<option value="">Nhập thông tin cần tìm kiếm</option>
<? if ($list_id == 1) {
    $danh_sach = new db_query("SELECT `id` FROM `yeu_cau_vat_tu`");
    while ($item = mysql_fetch_assoc($danh_sach->result)) {
?>
        <option value="<?= $item['id'] ?>">YC-<?= $item['id'] ?></option>
    <? }
} else if ($list_id == 2) {
    $danh_sach = new db_query("SELECT DISTINCT `ngay_tao` FROM `yeu_cau_vat_tu`");
    while ($item = mysql_fetch_assoc($danh_sach->result)) {
    ?>
        <option value="<?= $item['ngay_tao'] ?>"><?= date("d/m/Y", $item['ngay_tao']); ?></option>
        <? }
} else if ($list_id == 3) {
    $danh_sach = new db_query("SELECT DISTINCT `id_cong_trinh` FROM `yeu_cau_vat_tu`");
    while ($item = mysql_fetch_assoc($danh_sach->result)) {
        if ($item['id_cong_trinh'] != "") {
        ?>
            <option value="<?= $item['id_cong_trinh'] ?>"><?= $item['id_cong_trinh'] ?></option>
        <? }
    }
} else if ($list_id == 4) {
    $danh_sach = new db_query("SELECT DISTINCT `ngay_ht_yc` FROM `yeu_cau_vat_tu`");
    while ($item = mysql_fetch_assoc($danh_sach->result)) {
        ?>
        <option value="<?= $item['ngay_ht_yc'] ?>"><?= date("d/m/Y", $item['ngay_ht_yc']); ?></option>
<?
    }
} ?>