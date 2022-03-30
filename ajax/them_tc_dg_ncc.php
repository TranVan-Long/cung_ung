<?
include("config.php");
$x = $_POST['x'];
$list_tc = new db_query("SELECT `id`, `tieu_chi`, `he_so`, `kieu_gia_tri` FROM `tieu_chi_danh_gia` ");
?>
<tr class="item" data1="">
    <td class="w-5"><p class="removeItem"><i class="ic-delete remove-btn"></i>
        </p>
    </td>
    <td class="w-10">
        <p class="one_stt"><?= $x ?></p>
    </td>
    <td class="w-20">
        <div class="v-select2">
            <select name="ten_tchi_dg" class="share_select ten_tieuchi" onchange="thay_doi(this)">
                <option value="">Chọn tiêu chí đánh giá</option>
                <? while($item_tc = mysql_fetch_assoc($list_tc -> result)) {?>
                <option value="<?= $item_tc['id'] ?>"><?= $item_tc['tieu_chi'] ?></option>
                <? } ?>
            </select>
        </div>
    </td>
    <td class="w-10">
        <p></p>
    </td>
    <td class="w-10">
        <p></p>
    </td>
    <td class="w-15">
        <input type="text" name="diem_danh_gia">
    </td>
    <td class="w-15">
        <input type="text" name="tdiem_dg" class="hidden_bd" readonly>
    </td>
    <td class="w-15">
        <input type="text" name="dg_ctiet">
    </td>
</tr>
