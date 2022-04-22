<?
include("config.php");
$com_id = getValue('id_com', 'int', 'POST', '');
$id_vt = getValue('id_vt', 'int', 'POST', '');
$id_p = getValue('id_p', 'int', 'POST', '');
$curl = curl_init();
$data = array(
    'id_com' => $com_id,
);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlykhoxaydung.timviec365.vn/api/api_get_dsvt.php');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response1 = curl_exec($curl);
curl_close($curl);

$list_vttb = json_decode($response1, true);
$data_vttb = $list_vttb['data']['items'];
$cou = count($data_vttb);

$arr_vt = [];
for ($i = 0; $i < $cou; $i++) {
    $item = $data_vttb[$i];
    $arr_vt[$item['dsvt_id']] = $item;
};

$hang_sx = $arr_vt[$id_vt]['hsx_name'];
$dv_tinh = $arr_vt[$id_vt]['dvt_name'];
$don_gia = $arr_vt[$id_vt]['dsvt_donGia'];

if ($id_p != "") {
?>
    <td class="w-5">
        <p class="removeItem_vtp" data="<?= $id_p ?>"><i class="ic-delete remove-btn" data="<?= $id_p ?>"></i></p>
    </td>
    <td class="w-20">
        <div class="v-select2">
            <select name="ten_vat_tu" class="share_select ten_vat_tu" data="<?= $com_id ?>" onchange="change_vt(this)">
                <option value="">Chọn vật tư thiết bị</option>
                <? for ($j = 0; $j < $cou; $j++) { ?>
                    <option value="<?= $data_vttb[$j]['dsvt_id'] ?>" <?= ($data_vttb[$j]['dsvt_id'] == $id_vt) ? "selected" : "" ?>>(<?= $data_vttb[$j]['dsvt_id'] ?>) <?= $data_vttb[$j]['dsvt_name'] ?> </option>
                <? } ?>
            </select>
        </div>
    </td>
    <td class="w-20">
        <div class="v-select2">
            <input type="text" name="hang_sx" value="<?= $hang_sx ?>" readonly>
        </div>
    </td>
    <td class="w-15">
        <input type="text" name="so_luong_bg" class="so_luong" oninput="<?= $oninput ?>" onkeyup="sl_doi(this)">
    </td>
    <td class="w-15">
        <input type="text" name="don_vi_tinh" value="<?= $dv_tinh ?>" readonly>
    </td>
    <td class="w-20">
        <input type="text" name="don_gia_bg" class="don_gia" value="<?= $don_gia ?>" readonly>
    </td>
    <td class="w-20">
        <input type="text" name="thanh_tien" class="tong_trvat" readonly>
    </td>
<? } else { ?>
    <td class="w-5">
        <p class="removeItem"><i class="ic-delete remove-btn" data=""></i></p>
    </td>
    <td class="w-20">
        <div class="v-select2">
            <select name="ten_day_du" class="share_select ten_vat_tu" data="<?= $com_id ?>" onchange="change_vt(this)">
                <option value="">Chọn vật tư thiết bị</option>
                <? for ($j = 0; $j < $cou; $j++) { ?>
                    <option value="<?= $data_vttb[$j]['dsvt_id'] ?>" <?= ($data_vttb[$j]['dsvt_id'] == $id_vt) ? "selected" : "" ?>>(<?= $data_vttb[$j]['dsvt_id'] ?>) <?= $data_vttb[$j]['dsvt_name'] ?> </option>
                <? } ?>
            </select>
        </div>
    </td>
    <td class="w-20">
        <div class="v-select2">
            <input type="text" name="hang_sx" value="<?= $hang_sx ?>" readonly>
        </div>
    </td>
    <td class="w-15">
        <input type="text" name="so_luong_bao_gia" class="so_luong" oninput="<?= $oninput ?>" onkeyup="sl_doi(this)">
    </td>
    <td class="w-15">
        <input type="text" name="don_vi_tinh" value="<?= $dv_tinh ?>" readonly>
    </td>
    <td class="w-20">
        <input type="text" name="don_gia" class="don_gia" value="<?= $don_gia ?>" readonly>
    </td>
    <td class="w-20">
        <input type="text" name="thanh_tien" class="tong_trvat" readonly>
    </td>
<? } ?>