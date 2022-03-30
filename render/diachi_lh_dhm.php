<?

include("config.php");
$id_ncc = getValue('id_ncc', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');

if($id_ncc != "" && $com_id != ""){
    $list_dchhi = new db_query("SELECT `dia_chi_lh` FROM `nha_cc_kh` WHERE `id` = $id_ncc AND `id_cong_ty` = $com_id AND `phan_loai` = 1 ");
    $dia_chi = mysql_fetch_assoc($list_dchhi -> result)['dia_chi_lh'];
}

?>
    <label>Địa chỉ</label>
    <input type="text" name="dia_chi" class="form-control" value="<?= $dia_chi ?>" placeholder="Địa chỉ nhà cung cấp" readonly>