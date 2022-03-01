<?
include("config.php");

$com_id = $_POST['id_com'];
$curl = curl_init();
$data = array(
    'id_com' => $com_id,
);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlykho.timviec365.vn/api/api_get_dsvt.php');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response1 = curl_exec($curl);
curl_close($curl);

$list_vttb = json_decode($response1,true);
$data_vttb =$list_vttb['data']['items'];

?>
<tr class="item" data="">
    <td class="w-5">
        <p class="removeItem"><i class="ic-delete remove-btn" data=""></i></p>
    </td>
    <td class="w-20">
        <div class="v-select2">
            <select name="ten_day_du" class="share_select ten_vat_tu" data="<?= $com_id ?>" onchange="change_vt(this)">
                <option value="">Chọn vật tư thiết bị</option>
                <? for($i = 0; $i < count($data_vttb); $i++) {?>
                    <option value="<?= $data_vttb[$i]['dsvt_id'] ?>">(<?= $data_vttb[$i]['dsvt_id'] ?>) <?= $data_vttb[$i]['dsvt_name'] ?> </option>
                <? } ?>
            </select>
        </div>
    </td>
    <td class="w-20">
        <div class="v-select2">
            <input type="text" name="hang_sx" readonly>
        </div>
    </td>
    <td class="w-15">
        <input type="text" name="so_luong_bao_gia">
    </td>
    <td class="w-15">
        <input type="text" name="don_vi_tinh" readonly>
    </td>
    <td class="w-20">
        <input type="text" name="don_gia">
    </td>
    <td class="w-20">
        <input type="text" name="thanh_tien" readonly>
    </td>
</tr>
