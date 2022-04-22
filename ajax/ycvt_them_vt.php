<?
include("config.php");
$com_id = getValue('com_id', 'int', 'POST', '');
$vattu_chon = getValue('vattu_chon', 'arr', 'POST', '');
$curl = curl_init();
$data = array(
    'id_com' => $com_id,
);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_URL, "https://phanmemquanlykhoxaydung.timviec365.vn/api/api_get_dsvt.php");
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($curl);
curl_close($curl);

$ql_kho = json_decode($response, true);
$kho_vt = $ql_kho['data']['items'];
$count = count($kho_vt);

?>
<tr class="item">
    <td class="w-10">
        <p class="removeItem"><i class="ic-delete remove-btn"></i></p>
    </td>
    <td class="w-25">
        <div class="v-select2">
            <select name="materials_name" class="share_select materials_name" onchange="change_vt(this)">
                <option value="">-- Chọn vật tư/thiết bị --</option>
                <? for ($i = 0; $i < $count; $i++) {
                    if(in_array($kho_vt[$i]['dsvt_id'], $vattu_chon) == false){ ?>
                    <option value="<?= $kho_vt[$i]['dsvt_id'] ?>"><?= $kho_vt[$i]['dsvt_name'] ?></option>
                <? }} ?>
            </select>
        </div>
    </td>
    <td class="w-20">
        <input type="text" name="dv_tinh" value="" readonly>
    </td>
    <td class="w-25">
        <input type="number" name="so_luong" readonly>
    </td>
</tr>