<?
include("config.php");

$com_id = getValue('id_com', 'int', 'POST', '');

$curl = curl_init();
$data = array(
    'id_com' => $com_id,
);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_URL, "https://phanmemquanlykhoxaydung.timviec365.vn/api/api_get_dsvt.php");
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($curl);
curl_close($curl);
$emp0 = json_decode($response,true);
$emp = $emp0['data']['items'];
$cou = count($emp);

?>
<tr class="item" data="">
    <td class="w-5">
        <p class="removeItem"><i class="ic-delete remove-btn"></i></p>
    </td>
    <td class="w-15">
        <div class="v-select2">
            <select name="ten_day_du" class="share_select ten_vat_tu">
                <option value="">Chọn vật tư thiết bị</option>
                <? for($j = 0; $j < $cou; $j++) {?>
                    <option value="<?= $emp[$j]['dsvt_id'] ?>">(<?= $emp[$j]['dsvt_id'] ?>) <?= $emp[$j]['dsvt_name'] ?></option>
                <?}?>
            </select>
        </div>
    </td>
    <td class="w-15">
        <input type="text" name="hang_san_xuat" readonly>
    </td>
    <td class="w-10">
        <input type="text" name="don_vi_tinh" readonly>
    </td>
    <td class="w-15">
        <input type="text" name="so_luong" readonly>
    </td>
</tr>
<script>
    doi_vt();
    RefSelect2();
</script>