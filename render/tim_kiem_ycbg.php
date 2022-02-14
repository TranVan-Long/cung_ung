<?
include("config.php");
$tk = $_POST['tk'];
$quyen = $_POST['quyen'];
$token = $_POST['token'];
if(isset($quyen) && isset($token)){
?>
<option value="">Chọn thông tin tìm kiếm</option>
<? if($tk == 1) {
    $list_tt = new db_query("SELECT `id`, `phan_loai` FROM `yeu_cau_bao_gia` WHERE `phan_loai` = 1 ");
    while($row = mysql_fetch_assoc($list_tt -> result)){
?>

<option value="<?= $row['id'] ?>">BG - <?= $row['id'] ?></option>

<?}}else if($tk == 3) {
    $list_tt = new db_query("SELECT `id`, `ngay_tao`, `phan_loai` FROM `yeu_cau_bao_gia` WHERE `phan_loai` = 1");
    while($row = mysql_fetch_assoc($list_tt -> result)){
?>

<option value="<?= $row['ngay_tao'] ?>"><?= date('d-m-Y', $row['ngay_tao']) ?></option>

<?}} else if($tk == 4) {
    $list_tt = new db_query("SELECT DISTINCT y.`nha_cc_kh`, y.`phan_loai`, n.`ten_nha_cc_kh`, n.`phan_loai` FROM `yeu_cau_bao_gia` AS y INNER JOIN `nha_cc_kh` AS n ON y.`nha_cc_kh` = n.`id` WHERE y.`phan_loai` = 1 AND n.`phan_loai` = 1 ");
    while($row = mysql_fetch_assoc($list_tt -> result)){
?>

<option value="<?= $row['nha_cc_kh'] ?>"><?= $row['ten_nha_cc_kh'] ?></option>

<?}}}?>