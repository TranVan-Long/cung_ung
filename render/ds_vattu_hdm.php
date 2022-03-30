<?
include("config.php");
$id_hd = getValue('id_hd', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$id_ncc = getValue('id_ncc', 'int', 'POST', '');

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
$all_ctrinh = $data_list['data']['items'];
$cou = count($all_ctrinh);


$ds_vattu = [];
for ($i = 0; $i < $cou; $i++) {
    $item = $all_ctrinh[$i];
    $ds_vattu[$item['dsvt_id']] = $item;
}

if ($id_hd != "" && $com_id != "") {
    $lay_sl = new db_query("SELECT DISTINCT `id_nha_cc_kh`, `id_hop_dong` FROM `don_hang` WHERE `id_cong_ty` = $com_id AND `id_nha_cc_kh` = $id_ncc AND `id_hop_dong` = $id_hd ");
    if (mysql_num_rows($lay_sl->result) > 0) {
        $list_vatt = new db_query("SELECT `id`, `id_vat_tu`, `id_hd_mua_ban`, `so_luong`, `don_gia`, `tien_trvat`, `thue_vat`, `tien_svat`
                            FROM `vat_tu_hd_dh` AS v
                            WHERE `id_hd_mua_ban` = $id_hd ");
        while ($row = mysql_fetch_assoc($list_vatt->result)) {
            $id_vttu = $row['id_vat_tu'];
            $sum_vt = mysql_fetch_assoc((new db_query("SELECT SUM(`so_luong_ky_nay`) AS sum_vt FROM `vat_tu_dh_mua_ban`
                                                    WHERE `id_cong_ty` = $com_id AND `id_hd` = $id_hd AND `id_vat_tu` = $id_vttu ")) -> result)['sum_vt'];
?>
            <tr class="item">
                <td class="share_tb_seven">
                    <p>
                        <img src="../img/remove.png" alt="xóa" class="remo_cot_ngang share_cursor">
                    </p>
                </td>
                <td class="share_tb_seven"><?= $stt++ ?></td>
                <td class="share_tb_two">
                    <div class="form-group share_form_select">
                        <input type="text" name="ma_vattu" class="form-control" value="<?= $ds_vattu[$row['id_vat_tu']]['dsvt_name']  ?>" data="<?= $ds_vattu[$row['id_vat_tu']]['dsvt_id'] ?>" readonly>
                    </div>
                </td>
                <td class="share_tb_one">
                    <div class="form-group">
                        <input type="text" name="dvi_tinh" class="form-control" value="<?= $ds_vattu[$row['id_vat_tu']]['dvt_name']  ?>" readonly>
                    </div>
                </td>
                <td class="share_tb_two">
                    <div class="form-group">
                        <input type="text" name="hsan_xuat" class="form-control" value="<?= $ds_vattu[$row['id_vat_tu']]['hsx_name']  ?>" readonly>
                    </div>
                </td>
                <td class="share_tb_eight">
                    <div class="form-group">
                        <input type="number" name="so_luong_hd" class="form-control" value="<?= $row['so_luong'] ?>" readonly>
                    </div>
                </td>
                <td class="share_tb_two">
                    <div class="form-group">
                        <input type="number" name="so_luong_kt" class="form-control" value="<?= $sum_vt ?>" readonly>
                    </div>
                </td>
                <td class="share_tb_one">
                    <div class="form-group">
                        <input type="text" name="sl_knay" class="form-control so_luong" oninput="<?= $oninput ?>" onkeyup="sl_doi(this)">
                    </div>
                </td>
                <td class="share_tb_one">
                    <div class="form-group">
                        <input type="date" name="thoig_ghang" class="form-control">
                    </div>
                </td>
                <td class="share_tb_two">
                    <div class="form-group">
                        <input type="number" name="don_gia" class="form-control don_gia" value="<?= $row['don_gia'] ?>" readonly>
                    </div>
                </td>
                <td class="share_tb_two">
                    <div class="form-group">
                        <input type="number" name="ttr_vat" class="form-control tong_trvat" readonly>
                    </div>
                </td>
                <td class="share_tb_one">
                    <div class="form-group">
                        <input type="text" name="thue_vat" class="form-control thue_vat" oninput="<?= $oninput ?>" onkeyup="thue_doi(this)">
                    </div>
                </td>
                <td class="share_tb_eight">
                    <div class="form-group">
                        <input type="number" name="tts_vat" class="form-control tong_svat" readonly>
                    </div>
                </td>
                <td class="share_tb_two">
                    <div class="form-group">
                        <input type="text" name="dia_chi_g" class="form-control">
                    </div>
                </td>
            </tr>
        <? }
    } else {
        $list_vatt = new db_query("SELECT `id`, `id_vat_tu`, `id_hd_mua_ban`, `so_luong`, `don_gia`, `tien_trvat`, `thue_vat`, `tien_svat`
                            FROM `vat_tu_hd_dh` AS v
                            WHERE `id_hd_mua_ban` = $id_hd ");
        $lay_sl = new db_query("SELECT DISTINCT `id_nha_cc_kh`, `id_hop_dong` FROM `don_hang` WHERE `id_cong_ty` = $com_id AND `id_nha_cc_kh` = $id_ncc AND `id_hop_dong` = $id_hd ");
        while ($row = mysql_fetch_assoc($list_vatt->result)) {
        ?>
            <tr class="item">
                <td class="share_tb_seven">
                    <p>
                        <img src="../img/remove.png" alt="xóa" class="remo_cot_ngang share_cursor">
                    </p>
                </td>
                <td class="share_tb_seven"><?= $stt++ ?></td>
                <td class="share_tb_two">
                    <div class="form-group share_form_select">
                        <input type="text" name="ma_vattu" class="form-control" value="<?= $ds_vattu[$row['id_vat_tu']]['dsvt_name']  ?>" data="<?= $ds_vattu[$row['id_vat_tu']]['dsvt_id'] ?>" readonly>
                    </div>
                </td>
                <td class="share_tb_one">
                    <div class="form-group">
                        <input type="text" name="dvi_tinh" class="form-control" value="<?= $ds_vattu[$row['id_vat_tu']]['dvt_name']  ?>" readonly>
                    </div>
                </td>
                <td class="share_tb_two">
                    <div class="form-group">
                        <input type="text" name="hsan_xuat" class="form-control" value="<?= $ds_vattu[$row['id_vat_tu']]['hsx_name']  ?>" readonly>
                    </div>
                </td>
                <td class="share_tb_eight">
                    <div class="form-group">
                        <input type="number" name="so_luong_hd" class="form-control" value="<?= $row['so_luong'] ?>" readonly>
                    </div>
                </td>
                <td class="share_tb_two">
                    <div class="form-group">
                        <input type="number" name="so_luong_kt" class="form-control" readonly>
                    </div>
                </td>
                <td class="share_tb_one">
                    <div class="form-group">
                        <input type="text" name="sl_knay" class="form-control so_luong" oninput="<?= $oninput ?>" onkeyup="sl_doi(this)">
                    </div>
                </td>
                <td class="share_tb_one">
                    <div class="form-group">
                        <input type="date" name="thoig_ghang" class="form-control">
                    </div>
                </td>
                <td class="share_tb_two">
                    <div class="form-group">
                        <input type="number" name="don_gia" class="form-control don_gia" value="<?= $row['don_gia'] ?>" readonly>
                    </div>
                </td>
                <td class="share_tb_two">
                    <div class="form-group">
                        <input type="number" name="ttr_vat" class="form-control tong_trvat" readonly>
                    </div>
                </td>
                <td class="share_tb_one">
                    <div class="form-group">
                        <input type="text" name="thue_vat" class="form-control thue_vat" oninput="<?= $oninput ?>" onkeyup="thue_doi(this)">
                    </div>
                </td>
                <td class="share_tb_eight">
                    <div class="form-group">
                        <input type="number" name="tts_vat" class="form-control tong_svat" readonly>
                    </div>
                </td>
                <td class="share_tb_two">
                    <div class="form-group">
                        <input type="text" name="dia_chi_g" class="form-control">
                    </div>
                </td>
            </tr>
<?      }
    }
} ?>