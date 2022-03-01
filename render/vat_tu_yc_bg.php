<?
include("config.php");

$id = $_POST['id_vt'];
$id_v = $_POST['id_v'];
$com_id = $_POST['id_com'];
// echo $id_v;
// die();

$curl = curl_init();
$data = array(
    'id_com' => $com_id,
);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_URL, "https://phanmemquanlykho.timviec365.vn/api/api_get_dsvt.php");
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($curl);
curl_close($curl);
$emp0 = json_decode($response,true);
$emp = $emp0['data']['items'];
$cou = count($emp);

$id_vt = [];

for($i = 0; $i < $cou; $i++){
    $vat_tu = $emp[$i];
    $id_vt[$vat_tu['dsvt_id']] = $vat_tu;
}

$ten_vt = $id_vt[$id]['dsvt_name'];
$ten_hsx = $id_vt[$id]['hsx_name'];
$ten_dvt = $id_vt[$id]['dvt_name'];

if($id_v != ""){
?>
<td class="w-5">
    <p><i class="ic-delete remove-item" data-id="<?= $id_v ?>"></i></p>
    <input type="hidden" name="id_vat_tu" value="<?= $id_v ?>">
</td>
<td class="w-15">
    <div class="v-select2">
        <select name="ten_vat_tu" class="share_select ten_vat_tu">
            <option value="">Chọn vật tư thiết bị</option>
            <? for($j = 0; $j < $cou; $j++) {?>
                <option value="<?= $emp[$j]['dsvt_id'] ?>" <?= ($emp[$j]['dsvt_id'] == $id) ? "selected" : "" ?>>(<?= $emp[$j]['dsvt_id'] ?>) <?= $emp[$j]['dsvt_name'] ?></option>
            <?}?>
        </select>
    </div>
</td>
<td class="w-15">
    <input type="text" name="hang_san_xuat" value="<?= $ten_hsx ?>" readonly>
</td>
<td class="w-10">
    <input type="text" name="don_vi_tinh" value="<?= $ten_dvt ?>" readonly>
</td>
<td class="w-15">
    <? if($id != ""){ ?>
    <input type="text" name="so_luong_vt">
    <? } else{ ?>
        <input type="text" name="so_luong_vt" disabled>
    <? } ?>
</td>

<?}else{?>

<td class="w-5">
    <p class="removeItem"><i class="ic-delete remove-btn"></i></p>
</td>
<td class="w-15">
    <div class="v-select2">
        <select name="ten_day_du" class="share_select ten_vat_tu">
            <option value="">Chọn vật tư thiết bị</option>
            <? for($j = 0; $j < $cou; $j++) {?>
                <option value="<?= $emp[$j]['dsvt_id'] ?>" <?= ($emp[$j]['dsvt_id'] == $id) ? "selected" : "" ?>>(<?= $emp[$j]['dsvt_id'] ?>) <?= $emp[$j]['dsvt_name'] ?></option>
            <?}?>
        </select>
    </div>
</td>
<td class="w-15">
    <input type="text" name="hang_san_xuat" value="<?= $ten_hsx ?>" readonly>
</td>
<td class="w-10">
    <input type="text" name="don_vi_tinh" value="<?= $ten_dvt ?>" readonly>
</td>
<td class="w-15">
    <? if($id != ""){ ?>
    <input type="text" name="so_luong">
    <? } else{ ?>
        <input type="text" name="so_luong" disabled>
    <? } ?>
</td>

<?}?>
<script>
    var id_v = "<?= $id_v ?>";
    if(id_v != ""){
        xoa_v();
    }
    doi_vt();
    RefSelect2();
</script>