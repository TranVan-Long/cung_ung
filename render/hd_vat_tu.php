<?
include('config.php');

$id = $_POST['id_vt'];
$id_v = $_POST['id_v'];
$com_id = $_POST['id_com'];


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
$list_vt = json_decode($response, true);
$vat_tu_data = $list_vt['data']['items'];

$vat_tu_detail = [];
for ($i = 0; $i < count($vat_tu_data); $i++) {
    $items_vt = $vat_tu_data[$i];
    $vat_tu_detail[$items_vt['dsvt_id']] = $items_vt;
}
$ten_vt = $vat_tu_detail[$id]['dsvt_name'];
$ten_hsx = $vat_tu_detail[$id]['hsx_name'];
$ten_dvt = $vat_tu_detail[$id]['dvt_name'];
$ten_hsx = $vat_tu_detail[$id]['hsx_name'];
$ten_xx = $vat_tu_detail[$id]['xx_name'];
$ten_dg = $vat_tu_detail[$id]['dsvt_donGia'];


if ($id_v != "") {
?>
    <td class="share_tb_one">
        <p><img src="../img/remove.png" alt="xóa" data-id="<?= $id_v ?>" class="remo_cot_ngang share_cursor"></p>
        <input type="hidden" name="id_vat_tu" value="<?= $id_v ?>">
    </td>
    <td class="share_tb_three">
        <div class="form-group share_form_select">
            <select name="ma_vt_ban" class="ma_vt_ban share_select" onchange="hd_vt_change(this)">
                <option value="">-- Chọn Vật tư --</option>
                <? foreach ($vat_tu_data as $key => $items) { ?>
                    <option value="<?= $items['dsvt_id'] ?>" <?= ($items['dsvt_id'] == $id) ? "selected" : "" ?>><?= $items['dsvt_name'] ?></option>
                <? } ?>
            </select>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="text" name="don_vi_tinh" value="<?= $ten_dvt ?>" class="form-control" disabled>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="text" name="hang_san_xuat" value="<?= $ten_hsx ?>" class="form-control" disabled>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="text" name="xuat_xu" value="<?= $ten_xx ?>" class="form-control" disabled>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="number" name="so_luong" class="form-control so_luong" onkeyup="sl_doi(this),tong_vt(), baoHanh(), baoLanh()">
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="number" name="don_gia" value="<?= $ten_dg ?>" class="form-control don_gia" disabled>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="number" name="vt_tien_tvat" class="form-control tong_trvat" disabled>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="number" name="vt_thue_vat" class="form-control thue_vat" onkeyup="thue_doi(this),tong_vt(), baoHanh(), baoLanh()">
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="text" name="vt_tien_svat" class="form-control tong_svat" disabled>
        </div>
    </td>
<? } else { ?>
    <td class="share_tb_one">
        <p><img src="../img/remove.png" alt="xóa" data-id="<?= $id_v ?>" class="remo_cot_ngang share_cursor"></p>
        <input type="hidden" name="id_vat_tu" value="<?= $id_v ?>">
    </td>
    <td class="share_tb_three">
        <div class="form-group share_form_select">
            <select name="ma_vt_ban" class="ma_vt_ban share_select" onchange="hd_vt_change(this)">
                <option value="">-- Chọn Vật tư --</option>
                <? foreach ($vat_tu_data as $key => $items) { ?>
                    <option value="<?= $items['dsvt_id'] ?>" <?= ($items['dsvt_id'] == $id) ? "selected" : "" ?>><?= $items['dsvt_name'] ?></option>
                <? } ?>
            </select>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="text" name="don_vi_tinh" value="<?= $ten_dvt ?>" class="form-control" disabled>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="text" name="hang_san_xuat" value="<?= $ten_hsx ?>" class="form-control" disabled>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="text" name="xuat_xu" value="<?= $ten_xx ?>" class="form-control" disabled>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="number" name="so_luong" class="form-control so_luong" onkeyup="sl_doi(this),tong_vt(), baoHanh(), baoLanh()">
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="number" name="don_gia" value="<?= $ten_dg ?>" class="form-control don_gia" disabled>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="number" name="vt_tien_tvat" class="form-control tong_trvat" disabled>
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="number" name="vt_thue_vat" class="form-control thue_vat" onkeyup="thue_doi(this),tong_vt(), baoHanh(), baoLanh()">
        </div>
    </td>
    <td class="share_tb_two">
        <div class="form-group">
            <input type="text" name="vt_tien_svat" class="form-control tong_svat" disabled>
        </div>
    </td>
<? } ?>