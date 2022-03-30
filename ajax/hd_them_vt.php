<?
include('config.php');

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
$list_vt = json_decode($response, true);
$vat_tu_data = $list_vt['data']['items'];
?>

<tr class="item">
    <td class="share_tb_one">
        <p><img src="../img/remove.png" alt="xóa" data-id="<?= $id_v ?>" class="remo_cot_ngang share_cursor"></p>
    </td>
    <td class="share_tb_three">
        <div class="form-group share_form_select">
            <select name="ma_vt_ban" class="ma_vt_ban share_select" onchange="hd_vt_change(this)" data="<?= $com_id ?>">
                <option value="">-- Chọn Vật tư --</option>
                <? foreach ($vat_tu_data as $key => $items) { ?>
                    <option value="<?= $items['dsvt_id'] ?>"><?= $items['dsvt_name'] ?></option>
                <? } ?>
            </select>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="text" name="don_vi" class="form-control" disabled>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="text" name="hang_san_xuat" class="form-control" disabled>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="text" name="xuat_xu" class="form-control" disabled>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="number" name="so_luong" class="form-control so_luong" disabled>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="number" name="don_gia" class="form-control don_gia" disabled>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="number" name="tien_tvat" class="form-control tong_trvat" disabled>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="number" name="thue_vat" class="form-control thue_vat" disabled>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="text" name="tien_svat" class="form-control tong_svat" disabled>
        </div>
    </td>
</tr>