<?
include('config.php');
// $id_p = getValue('id_p', 'int', 'POST', '');
$id_ncc = getValue('id_ncc', 'int', 'POST', '');
$com_id = getValue('id_com', 'int', 'POST', '');
$vattu_chon = $_POST['vattu_chon'];

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
$list_vt = json_decode($response, true);
$vat_tu_data = $list_vt['data']['items'];
$count_vt = count($vat_tu_data);

// $all_vt = [];
// for ($i = 0; $i < $count_vt; $i++) {
//     $item1 = $vat_tu_data[$i];
//     $all_vt[$item1['dsvt_id']] = $item1;
// };
// }
?>
<tr class="item" data="">
    <td class="share_tb_one">
        <p><img src="../img/remove.png" alt="xóa" class="remo_cot_ngang share_cursor"></p>
    </td>
    <td class="share_tb_three">
        <div class="form-group share_form_select">
            <select name="ma_vt_ban" class="ma_vt_ban share_select" onchange="hd_vt_change(this)" data="<?= $com_id ?>">
                <option value="">-- Chọn Vật tư --</option>
                <? for ($i = 0; $i < $count_vt; $i++) {
                    if(in_array($vat_tu_data[$i]['dsvt_id'], $vattu_chon) == false){?>
                    <option value="<?= $vat_tu_data[$i]['dsvt_id'] ?>">(<?= $vat_tu_data[$i]['dsvt_id'] ?>) <?= $vat_tu_data[$i]['dsvt_name'] ?></option>
                <? } }?>
            </select>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="text" name="don_vi" class="form-control" readonly>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="text" name="hang_san_xuat" class="form-control" readonly>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="text" name="xuat_xu" class="form-control" readonly>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="number" name="so_luong" class="form-control so_luong" readonly>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="number" name="don_gia" class="form-control don_gia" readonly>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="number" name="tien_tvat" class="form-control tong_trvat" readonly>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="number" name="thue_vat" data="0" class="form-control thue_vat" readonly>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="text" name="tien_svat" class="form-control tong_svat" readonly>
        </div>
    </td>
</tr>