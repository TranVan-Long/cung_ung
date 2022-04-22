<?
include("config.php");
$com_id = getValue('com_id', 'int', 'POST', '');
$bg_vat = getValue('bg_vat', 'int', 'POST', '');

if ($com_id != "") {
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
    $list_vt = json_decode($response, true);
    $vat_tu_data = $list_vt['data']['items'];
    $cou = count($vat_tu_data); ?>

    <tr class="item">
        <td class="share_tb_one">
            <p>
                <img src="../img/remove.png" alt="xóa" class="remo_cot_ngang share_cursor">
            </p>
        </td>
        <td class="share_tb_five">
            <div class="form-group v-select2">
                <select name="thietb_vt" class="share_select form-control">
                    <option value="">-- Chọn vật tư/thiết bị --</option>
                    <? for ($i = 0; $i < $cou; $i++) { ?>
                        <option value="<?= $vat_tu_data[$i]['dsvt_id'] ?>">(<?= $vat_tu_data[$i]['dsvt_id'] ?>) <?= $vat_tu_data[$i]['dsvt_name'] ?></option>
                    <? } ?>
                </select>
            </div>
        </td>
        <td class="share_tb_three">
            <div class="form-group">
                <input type="text" name="don_vi_tinh" class="form-control">
            </div>
        </td>
        <td class="share_tb_three">
            <div class="form-group">
                <input type="text" name="khoi_luong" class="form-control so_luong" oninput="<?= $oninput ?>" onkeyup="sl_doi(this), tong_hd_vc()">
            </div>
        </td>
        <td class="share_tb_four">
            <div class="form-group">
                <input type="text" name="don_gia" class="form-control don_gia" oninput="<?= $oninput ?>" onkeyup="dg_doi(this), tong_hd_vc()">
            </div>
        </td>
        <td class="share_tb_four">
            <div class="form-group">
                <input type="number" name="thanh_tien" class="form-control h_border tong_trvat tong_trvat_hd" readonly>
            </div>
        </td>
    </tr>`
<? }
?>