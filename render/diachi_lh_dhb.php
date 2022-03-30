<?
include("config.php");
$id_kh = getValue('id_kh','int','POST','');
$com_id = getValue('com_id','int','POST','');
$list_dc = mysql_fetch_assoc((new db_query("SELECT `dia_chi_lh` FROM `nha_cc_kh` WHERE `id` = $id_kh AND `id_cong_ty` = $com_id ")) -> result)['dia_chi_lh'];
?>
<label>Địa chỉ</label>
<input type="text" name="dia_chi" value="<?= $list_dc ?>" class="form-control" placeholder="Địa chỉ liên hệ khách hàng" readonly>