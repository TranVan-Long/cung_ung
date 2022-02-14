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
    $ds_tk = new db_query("SELECT `id`, `ten_nha_cc_kh`, `phan_loai` FROM `nha_cc_kh` WHERE `phan_loai` = 1 ");
    while($row = mysql_fetch_assoc($ds_tk -> result)){
?>
    <option value="<?= $row['id'] ?>"><?= $row['ten_nha_cc_kh'] ?></option>
<? }}?>
