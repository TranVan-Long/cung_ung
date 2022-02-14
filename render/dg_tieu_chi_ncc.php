<?

include("config.php");
$id_tc = $_POST['id_tc'];
$x = $_POST['x'];
$list_tchi = new db_query("SELECT `id`, `tieu_chi`, `he_so`, `kieu_gia_tri` FROM `tieu_chi_danh_gia` ");

if($id_tc != ""){
    $list_tc = mysql_fetch_assoc((new db_query("SELECT `id`, `tieu_chi`, `he_so`, `kieu_gia_tri` FROM `tieu_chi_danh_gia` WHERE `id` = $id_tc")) -> result);
    if($list_tc['kieu_gia_tri'] == 1){
        $maxd = mysql_fetch_assoc((new db_query("SELECT `id_tieu_chi`, `gia_tri` FROM `ds_gia_tri_dg` WHERE `id_tieu_chi` = $id_tc ")) -> result);
?>
        <td class="w-5"><p class="removeItem"><i class="ic-delete remove-btn"></i></p></td>
        <td class="w-10"><p class="one_stt"><?= $x ?></p></td>
        <td class="w-20">
            <div class="v-select2">
                <select name="ten_tchi_dg" class="share_select ten_tieuchi" onchange="thay_doi()">
                    <option value="">Chọn tiêu chí đánh giá</option>
                    <? while($item_tc = mysql_fetch_assoc($list_tchi -> result)) {?>
                    <option value="<?= $item_tc['id'] ?>" <?= ( $item_tc['id'] == $id_tc) ? "selected" : "" ?>><?= $item_tc['tieu_chi'] ?></option>
                    <? } ?>
                </select>
            </div>
        </td>
        <td class="w-10">
            <p class="he_so_<?= $x ?>" data="<?= $list_tc['he_so'] ?>">x<?= $list_tc['he_so'] ?></p>
        </td>
        <td class="w-10">
            <!-- <p class="diem_lon_nhat_<?= $x ?>"><?= $maxd['gia_tri'] ?></p> -->
            <input type="number" name="thang_diem" class="diem_lon_nhat_<?= $x ?> hidden_bd" value="<?= $maxd['gia_tri'] ?>" readonly>
        </td>
        <td class="w-15">
            <input type="number" name="diem_danh_gia" class="diem_danh_gia_<?= $x ?>" data="<?= $list_tc['kieu_gia_tri'] ?>" style="margin-bottom: 5px">
            <span class="error_<?= $x ?>" style="display: none; font-size: 14px; color: #FF3333">Điểm phải nhỏ hơn hoặc bằng <?= $maxd['gia_tri'] ?></span>
        </td>
        <td class="w-15">
            <input type="text" name="tdiem_dg" class="hidden_bd tongd_<?= $x ?>" readonly>
        </td>
        <td class="w-15">
            <input type="text" name="dg_ctiet">
        </td>
    <?} else{
            $maxd = mysql_fetch_assoc((new db_query("SELECT `id_tieu_chi`, Max(`gia_tri`) AS gt_lnhat FROM `ds_gia_tri_dg` WHERE `id_tieu_chi` = $id_tc ")) -> result);
            $list_gtri = new db_query("SELECT  `id_tieu_chi`, `gia_tri`, `ten_gia_tri` FROM `ds_gia_tri_dg` WHERE `id_tieu_chi` = $id_tc  ");
    ?>

        <td class="w-5"><p class="removeItem"><i class="ic-delete remove-btn"></i></p></td>
        <td class="w-10"><p class="one_stt"><?= $x ?></p></td>
        <td class="w-20">
            <div class="v-select2">
                <select name="ten_tchi_dg" class="share_select ten_tieuchi" onchange="thay_doi()">
                    <option value="">Chọn tiêu chí đánh giá</option>
                    <? while($item_tc = mysql_fetch_assoc($list_tchi -> result)) {?>
                    <option value="<?= $item_tc['id'] ?>" <?= ( $item_tc['id'] == $id_tc) ? "selected" : "" ?>><?= $item_tc['tieu_chi'] ?></option>
                    <? } ?>
                </select>
            </div>
        </td>
        <td class="w-10">
            <p class="he_so_<?= $x ?>" data="<?= $list_tc['he_so'] ?>">x<?= $list_tc['he_so'] ?></p>
        </td>
        <td class="w-10">
            <!-- <p class="diem_lon_nhat"><?= $maxd['gt_lnhat'] ?></p> -->
            <input type="number" name="thang_diem" class="diem_lon_nhat_<?= $x ?> hidden_bd" value="<?= $maxd['gt_lnhat'] ?>" readonly>
        </td>
        <td class="w-15">
            <div class="v-select2">
                <select name="diem_danh_gia" class="diem_danh_gia_<?= $x ?>" data="<?= $list_tc['kieu_gia_tri'] ?>">
                    <option value="">Chọn giá trị</option>
                    <? while($item = mysql_fetch_assoc($list_gtri -> result)) { ?>
                        <option value="<?= $item['gia_tri'] ?>"><?= $item['gia_tri'] ?></option>
                    <? } ?>
                </select>
            </div>
        </td>
        <td class="w-15">
            <input type="text" name="tdiem_dg" class="hidden_bd tongd_<?= $x ?>" readonly>
        </td>
        <td class="w-15"><input type="text" name="dg_ctiet"></td>

<?}} else{?>

    <td class="w-5"><p class="removeItem"><i class="ic-delete remove-btn"></i></p></td>
    <td class="w-10"><p class="one_stt"><?= $x ?></p></td>
    <td class="w-20">
        <div class="v-select2">
            <select name="ten_tchi_dg" class="share_select ten_tieuchi"  onchange="thay_doi()">
                <option value="">Chọn tiêu chí đánh giá</option>
                <? while($item_tc = mysql_fetch_assoc($list_tchi -> result)) {?>
                <option value="<?= $item_tc['id'] ?>"><?= $item_tc['tieu_chi'] ?></option>
                <? } ?>
            </select>
        </div>
    </td>
    <td class="w-10"><p></p></td>
    <td class="w-10"><p></p></td>
    <td class="w-15"><input type="text" name="diem_danh_gia"></td>
    <td class="w-15"><p></p></td>
    <td class="w-15"><input type="text" name="dg_ctiet"></td>

<?}?>

<script type="text/javascript">
    $(document).on('click', function(){
        var he_so = Number($(".he_so_<?= $x ?>").attr("data"));
        var diem = Number($(".diem_danh_gia_<?= $x ?>").val());
        var a = 0;
        var diem_lon_nhat = Number($(".diem_lon_nhat_<?= $x ?>").val());
        var kieu_gt = Number($(".diem_danh_gia_<?= $x ?>").attr("data"));
        var b = 0;
        var tdiem_dg = Number($("input[name='tdiem_dg']").val());
        var diems = Number()
        if(kieu_gt == 1){
            if(diem > diem_lon_nhat){
                $(".error_<?= $x ?>").show();
                $(".tongd_<?= $x ?>").val(a);
            }else{
                if(diem != 0){
                    a = he_so * diem;
                    $(".tongd_<?= $x ?>").val(a);
                }else if(diem == 0){
                    $(".tongd_<?= $x ?>").val(a);
                }
                $(".error_<?= $x ?>").hide();
            }
        }else if(kieu_gt == 2){
            if(diem != 0){
                a = he_so * diem;
                $(".tongd_<?= $x ?>").val(a);
            }else if(diem == 0){
                $(".tongd_<?= $x ?>").val(a);
            }
        }
    })
</script>
