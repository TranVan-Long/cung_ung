<?
include("config.php");

$id_ncc = $_POST['id_ncc'];
if($id_ncc != ""){
$list_nlh = new db_query("SELECT `id`, `ten_nguoi_lh` FROM `nguoi_lien_he` WHERE `id_nha_cc` = $id_ncc ");

?>
<option value="">-- Chọn người tiếp nhận báo giá --</option>
<? while($row = mysql_fetch_assoc($list_nlh -> result)){ ?>
        <option value="<?= $row['id'] ?>"><?= $row['ten_nguoi_lh'] ?></option>
<?}}else{?>
    <option value="">-- Chọn người tiếp nhận báo giá --</option>
<?}?>