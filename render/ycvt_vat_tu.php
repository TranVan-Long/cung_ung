<?
include('config.php');

$id = getValue('id_vt', 'int', 'POST', '');
$id_v = getValue('id_v', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$vattu_chon = getValue('vattu_chon1', 'arr', 'POST', '');
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

$id_vt = [];

for ($i = 0; $i < $count; $i++) {
    $vat_tu = $kho_vt[$i];
    $id_vt[$vat_tu['dsvt_id']] = $vat_tu;
}
$ten_dvt = $id_vt[$id]['dvt_name'];

if ($id_v != "") { ?>
    <td class="w-10">
        <p class="modal-btn vattu_cu" data-target="remove-<?= $id_v ?>" data="<?= $id_v ?>"><i class="ic-delete remove-item"></i></p>
    </td>
    <td class="w-25">
        <div class="v-select2">
            <select name="vat_tu_old" class="share_select materials_name" onchange="change_vt(this)">
                <option value="">-- Chọn vật tư/thiết bị --</option>
                <? for ($i = 0; $i < $count; $i++) { ?>
                    <option value="<?= $kho_vt[$i]['dsvt_id'] ?>" <?= ($kho_vt[$i]['dsvt_id'] == $id) ? "selected" : "" ?>><?= $kho_vt[$i]['dsvt_name'] ?></option>
                <? } ?>
            </select>
        </div>
    </td>
    <td class="w-20">
        <input type="text" name="don_vi_tinh_old" value="<?= $ten_dvt ?>" readonly>
    </td>
    <td class="w-25">
        <? if ($id != "") { ?>
            <input type="number" name="so_luong_old" oninput="<?= $oninput ?>">
        <? } else { ?>
            <input type="number" name="so_luong_old" disabled>
        <? } ?>

    </td>
<? } else if ($id_v == "") { ?>

    <td class="w-10">
        <p class="removeItem"><i class="ic-delete remove-btn"></i>
        </p>
    </td>
    <td class="w-25">
        <div class="v-select2">
            <select name="materials_name" class="share_select materials_name" onchange="change_vt(this)">
                <option value="">-- Chọn vật tư/thiết bị --</option>
                <? for ($i = 0; $i < $count; $i++) {
                    if (in_array($kho_vt[$i]['dsvt_id'], $vattu_chon) == false) { ?>
                        <option value="<?= $kho_vt[$i]['dsvt_id'] ?>" <?= ($kho_vt[$i]['dsvt_id'] == $id) ? "selected" : "" ?>><?= $kho_vt[$i]['dsvt_name'] ?></option>
                <? }
                } ?>
            </select>
        </div>
    </td>
    <td class="w-20">
        <input type="text" name="dv_tinh" value="<?= $ten_dvt ?>" readonly>
    </td>
    <td class="w-25">
        <? if ($id != "") { ?>
            <input type="number" name="so_luong" onkeyup="check_slnhap(this)" placeholder="Nhập số lượng yêu cầu và phải lớn hơn 0">
        <? } else { ?>
            <input type="number" name="so_luong" disabled>
        <? } ?>
    </td>

<? } ?>