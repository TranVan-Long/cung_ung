<?
include("config.php");
$id_hd = getValue('id_hd', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$id_kh = getValue('id_kh', 'int', 'POST', '');
$stt = 1;

$curl = curl_init();
$data = array(
    'id_com' => $com_id,
);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlykhoxaydung.timviec365.vn/api/api_get_dsvt.php');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($curl);
curl_close($curl);
$data_list = json_decode($response, true);
$all_dsvt = $data_list['data']['items'];
$cou = count($all_dsvt);

$list_dsvt = [];
for ($i = 0; $i < $cou; $i++) {
    $item1 = $all_dsvt[$i];
    $list_dsvt[$item1['dsvt_id']] = $item1;
}

if ($id_hd != "" && $id_kh != "") {
    $list_vt = new db_query("SELECT `id`, `id_vat_tu`, `id_hd_mua_ban`, `so_luong`, `don_gia`, `tien_trvat`, `thue_vat`, `tien_svat` FROM `vat_tu_hd_dh` WHERE `id_hd_mua_ban` = $id_hd ");
    while ($row = mysql_fetch_assoc($list_vt->result)) {
?>
        <tr class="item">
            <td class="share_tb_seven">
                <p>
                    <img src="../img/remove.png" alt="xóa" class="remo_cot_ngang share_cursor">
                </p>
            </td>

            <td class="share_tb_seven"><?= $stt++ ?></td>

            <td class="share_tb_two">
                <div class="form-group">
                    <input type="text" name="ma_vatt" value="<?= $list_dsvt[$row['id_vat_tu']]['dsvt_name'] ?>" data-id="<?= $list_dsvt[$row['id_vat_tu']]['dsvt_id'] ?>" class="form-control" readonly>
                </div>
            </td>

            <td class="share_tb_one">
                <div class="form-group">
                    <input type="text" name="dvi_tinh" value="<?= $list_dsvt[$row['id_vat_tu']]['dvt_name'] ?>" class="form-control tex_center" readonly>
                </div>
            </td>

            <td class="share_tb_two">
                <div class="form-group">
                    <input type="text" name="hsan_xuat" class="form-control tex_center" value="<?= $list_dsvt[$row['id_vat_tu']]['hsx_name'] ?>" readonly>
                </div>
            </td>

            <td class="share_tb_eight">
                <div class="form-group">
                    <input type="text" name="so_luong_hd" class="form-control tex_center" value="<?= $row['so_luong'] ?>" readonly>
                </div>
            </td>

            <td class="share_tb_two">
                <div class="form-group">
                    <input type="number" name="so_luong_kt" class="form-control tex_center" readonly>
                </div>
            </td>

            <td class="share_tb_one">
                <div class="form-group">
                    <input type="text" name="sl_knay" class="form-control tex_center so_luong" oninput="<?= $oninput ?>" onkeyup="sl_doi(this)">
                </div>
            </td>

            <td class="share_tb_one">
                <div class="form-group">
                    <input type="date" name="thoig_ghang" class="form-control">
                </div>
            </td>

            <td class="share_tb_two">
                <div class="form-group">
                    <input type="number" name="don_gia" value="<?= $row['don_gia'] ?>" class="form-control tex_center don_gia" readonly>
                </div>
            </td>

            <td class="share_tb_two">
                <div class="form-group">
                    <input type="number" name="ttr_vat" class="form-control tex_center tong_trvat" readonly>
                </div>
            </td>

            <td class="share_tb_one">
                <div class="form-group">
                    <input type="text" name="thue_vat_vt" class="form-control tex_center thue_vat" oninput="<?= $oninput ?>" onkeyup="thue_doi(this)" readonly>
                </div>
            </td>

            <td class="share_tb_eight">
                <div class="form-group">
                    <input type="number" name="tts_vat" class="form-control tex_center tong_svat" readonly>
                </div>
            </td>

            <td class="share_tb_two">
                <div class="form-group">
                    <input type="text" name="dia_chi_g" class="form-control tex_center">
                </div>
            </td>
        </tr>
<? }
} ?>