<?
include("config.php");
$category = $_POST['list_id'];
?>
<option value="">Nhập thông tin cần tìm kiếm</option>
<? if ($category == '1') {
    $danh_sach = new db_query("SELECT `id` FROM `hop_dong` WHERE `phan_loai` = 1 ");
    while ($item = mysql_fetch_assoc($danh_sach->result)) {
?>
        <option value="<?= $item['id'] ?>">HĐ - <?= $item['id'] ?></option>
    <? }
} else if ($category == '2') {
    $danh_sach = new db_query("SELECT `id`, `phan_loai` FROM `hop_dong` WHERE `phan_loai` = 2 ");
    while ($item = mysql_fetch_assoc($danh_sach->result)) {
    ?>
        <option value="<?= $item['id'] ?>">HĐ - <?= $item['id'] ?></option>
    <? }
} else if ($category == '3') {
    $danh_sach = new db_query("SELECT `id`, `phan_loai` FROM `hop_dong` WHERE `phan_loai` = 3");
    while ($item = mysql_fetch_assoc($danh_sach->result)) {
    ?>
        <option value="<?= $item['id'] ?>">HĐ - <?= $item['id'] ?></option>
    <? }
} else if ($category == '4') {
    $danh_sach = new db_query("SELECT `id`, `phan_loai` FROM `hop_dong` WHERE `phan_loai` = 4 ");
    while ($item = mysql_fetch_assoc($danh_sach->result)) {
    ?>
        <option value="<?= $item['id'] ?>">HĐ - <?= $item['id'] ?></option>
<?
    }
} ?>