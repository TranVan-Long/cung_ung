<?
include("config.php");
$tk = $_POST['timkiem'];

?>
<option value="">Nhập thông tin cần tìm kiếm</option>
<? if($tk == 1) {
    $ds_tk = new db_query("SELECT `id` FROM `danh_gia`");
    while($row = mysql_fetch_assoc($ds_tk -> result)){
?>
    <option value="<?= $row['id'] ?>">PH - <?= $row['id'] ?></option>
<?}} else if($tk == 2){
    $ds_tk = new db_query("SELECT d.`id`, d.`id_nha_cc`, n.`id`, n.`ten_nha_cc_kh`, n.`phan_loai` FROM `danh_gia` AS d
                            INNER JOIN `nha_cc_kh` AS n ON d.`id_nha_cc` = n.`id` WHERE n.`phan_loai` = 1 ");
    while($row = mysql_fetch_assoc($ds_tk -> result)){
?>
    <option value="<?= $row['id'] ?>"><?= $row['ten_nha_cc_kh'] ?></option>
<? }} ?>