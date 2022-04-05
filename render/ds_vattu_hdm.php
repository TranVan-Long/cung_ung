<?
include("config.php");
$id_hd = getValue('id_hd', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$id_ncc = getValue('id_ncc', 'int', 'POST', '');
$id_dh = getValue('id_dh', 'int', 'POST', '');

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
$response1 = curl_exec($curl);
curl_close($curl);
$data_list1 = json_decode($response1, true);
$list_vattu = $data_list1['data']['items'];
$cou2 = count($list_vattu);

$all_vattu = [];
for ($j = 0; $j < $cou2; $j++) {
    $item2 = $list_vattu[$j];
    $all_vattu[$item2['dsvt_id']] = $item2;
};


$ds_vattu = [];
for ($i = 0; $i < $cou; $i++) {
    $item = $all_ctrinh[$i];
    $ds_vattu[$item['dsvt_id']] = $item;
}

if ($id_dh != "" && $com_id != "" && $id_hd != "" && $id_ncc != "") {
    $check_tt = new db_query("SELECT `id` FROM `don_hang` WHERE `id` = $id_dh AND `id_cong_ty` = $com_id AND `id_hop_dong` = $id_hd AND `phan_loai` = 1 ");
    if (mysql_num_rows($check_tt->result) > 0) {
        $ds_vt = new db_query("SELECT `id`, `id_don_hang`, `id_hd`, `id_vat_tu`, `so_luong_theo_hd`, `so_luong_ky_nay`, `thoi_gian_giao_hang`,
                            `don_gia`, `tong_tien_trvat`, `thue_vat`, `tong_tien_svat`, `dia_diem_giao_hang` FROM `vat_tu_dh_mua_ban`
                            WHERE `id_cong_ty` = $com_id AND `id_don_hang` = $id_dh AND `id_hd` = $id_hd ");
        while ($row2 = mysql_fetch_assoc($ds_vt->result)) {
            $id_vttu = $row2['id_vat_tu'];
            $sum_vt = mysql_fetch_assoc((new db_query("SELECT SUM(`so_luong_ky_nay`) AS sum_vt FROM `vat_tu_dh_mua_ban`
                                                        WHERE `id_cong_ty` = $com_id AND `id_hd` = $id_hd AND `id_vat_tu` = $id_vttu "))->result)['sum_vt']; ?>
            <tr class="item">
                <td class="share_tb_seven">
                    <p>
                        <img src="../img/remove.png" alt="xóa" class="dele_cot_ngang share_cursor">
                    </p>
                </td>
                <td class="share_tb_seven">
                    <p><?= $stt++ ?></p>
                    <input type="hidden" name="vat_tu" value="<?= $row2['id'] ?>">
                </td>
                <td class="share_tb_one">
                    <div class="form-group share_form_select">
                        <input type="text" name="ma_vattu" value="VT - <?= $row2['id_vat_tu'] ?>" data="<?= $row2['id_vat_tu'] ?>" class="form-control" readonly>
                    </div>
                </td>
                <td class="share_tb_two">
                    <div class="form-group share_form_select">
                        <input type="text" name="ten_vt" value="<?= $all_vattu[$row2['id_vat_tu']]['dsvt_name'] ?>" class="form-control" readonly>
                    </div>
                </td>
                <td class="share_tb_seven">
                    <div class="form-group">
                        <input type="text" name="dvi_tinh" value="<?= $all_vattu[$row2['id_vat_tu']]['dvt_name'] ?>" class="form-control" readonly>
                    </div>
                </td>
                <td class="share_tb_two">
                    <div class="form-group">
                        <input type="text" name="hsan_xuat" value="<?= $all_vattu[$row2['id_vat_tu']]['hsx_name'] ?>" class="form-control">
                    </div>
                </td>
                <td class="share_tb_eight">
                    <div class="form-group">
                        <input type="number" name="so_luong_hd" value="<?= $row2['so_luong_theo_hd'] ?>" class="form-control" readonly>
                    </div>
                </td>
                <td class="share_tb_eight">
                    <div class="form-group">
                        <input type="number" name="so_luong_kt" value="<?= $sum_vt - $row2['so_luong_ky_nay'] ?>" class="form-control" readonly>
                    </div>
                </td>
                <td class="share_tb_one">
                    <div class="form-group">
                        <input type="type" name="sl_knay" value="<?= $row2['so_luong_ky_nay'] ?>" class="form-control so_luong" onkeyup="sl_doi(this)" oninput="<?= $oninput ?>">
                    </div>
                </td>
                <td class="share_tb_eight">
                    <div class="form-group">
                        <input type="date" name="thoig_ghang" value="<?= ($row2['thoi_gian_giao_hang'] != 0) ? date('Y-m-d', $row2['thoi_gian_giao_hang']) : "" ?>" class="form-control">
                    </div>
                </td>
                <td class="share_tb_two">
                    <div class="form-group">
                        <input type="number" name="don_gia" value="<?= $row2['don_gia'] ?>" class="form-control don_gia" readonly>
                    </div>
                </td>
                <td class="share_tb_two">
                    <div class="form-group">
                        <input type="number" name="ttr_vat" value="<?= $row2['tong_tien_trvat'] ?>" class="form-control tong_trvat" readonly>
                    </div>
                </td>
                <td class="share_tb_seven">
                    <div class="form-group">
                        <input type="type" name="thue_vat" data="<?= $row2['don_gia'] * $row2['so_luong_ky_nay'] * ($row2['thue_vat'] / 100) ?>" value="<?= $row2['thue_vat'] ?>" class="form-control thue_vat" readonly>
                    </div>
                </td>
                <td class="share_tb_eight">
                    <div class="form-group">
                        <input type="number" name="tts_vat" value="<?= $row2['tong_tien_svat'] ?>" class="form-control tong_svat" readonly>
                    </div>
                </td>
                <td class="share_tb_two">
                    <div class="form-group">
                        <input type="text" name="dia_chi_g" value="<?= $row2['dia_diem_giao_hang'] ?>" class="form-control">
                    </div>
                </td>
            </tr>
            <? }
    } else {
        $ds_vt = new db_query("SELECT `id_vat_tu`, `id_hd_mua_ban`, `so_luong`, `don_gia`, `thue_vat`
                            FROM `vat_tu_hd_dh` WHERE `id_hd_mua_ban` = $id_hd ");
        $check_tt = new db_query("SELECT `id_hop_dong` FROM `don_hang` WHERE `id_cong_ty` = $com_id AND `phan_loai` = 1 AND `id_hop_dong` = $id_hd ");
        if (mysql_num_rows($check_tt->result) > 0) {
            while ($row2 = mysql_fetch_assoc($ds_vt->result)) {
                $id_vt = $row2['id_vat_tu'];
                $sum_vt = mysql_fetch_assoc((new db_query("SELECT SUM(`so_luong_ky_nay`) AS sum_vt FROM `vat_tu_dh_mua_ban`
                                                        WHERE `id_cong_ty` = $com_id AND `id_hd` = $id_hd AND `id_vat_tu` = $id_vt "))->result)['sum_vt']; ?>
                <tr class="item">
                    <td class="share_tb_seven">
                        <p>
                            <img src="../img/remove.png" alt="xóa" class="dele_cot_ngang share_cursor">
                        </p>
                    </td>
                    <td class="share_tb_seven">
                        <p><?= $stt++ ?></p>
                        <input type="hidden" name="vat_tu" value="">
                    </td>
                    <td class="share_tb_one">
                        <div class="form-group share_form_select">
                            <input type="text" name="ma_vattu" value="VT - <?= $row2['id_vat_tu'] ?>" data="<?= $row2['id_vat_tu'] ?>" class="form-control" readonly>
                        </div>
                    </td>
                    <td class="share_tb_two">
                        <div class="form-group share_form_select">
                            <input type="text" name="ten_vt" value="<?= $all_vattu[$row2['id_vat_tu']]['dsvt_name'] ?>" class="form-control" readonly>
                        </div>
                    </td>
                    <td class="share_tb_seven">
                        <div class="form-group">
                            <input type="text" name="dvi_tinh" value="<?= $all_vattu[$row2['id_vat_tu']]['dvt_name'] ?>" class="form-control" readonly>
                        </div>
                    </td>
                    <td class="share_tb_two">
                        <div class="form-group">
                            <input type="text" name="hsan_xuat" value="<?= $all_vattu[$row2['id_vat_tu']]['hsx_name'] ?>" class="form-control">
                        </div>
                    </td>
                    <td class="share_tb_eight">
                        <div class="form-group">
                            <input type="number" name="so_luong_hd" value="<?= $row2['so_luong'] ?>" class="form-control" readonly>
                        </div>
                    </td>
                    <td class="share_tb_eight">
                        <div class="form-group">
                            <input type="number" name="so_luong_kt" value="<?= $sum_vt ?>" class="form-control" readonly>
                        </div>
                    </td>
                    <td class="share_tb_one">
                        <div class="form-group">
                            <input type="type" name="sl_knay" value="" class="form-control so_luong" onkeyup="sl_doi(this)" oninput="<?= $oninput ?>">
                        </div>
                    </td>
                    <td class="share_tb_eight">
                        <div class="form-group">
                            <input type="date" name="thoig_ghang" value="" class="form-control">
                        </div>
                    </td>
                    <td class="share_tb_two">
                        <div class="form-group">
                            <input type="number" name="don_gia" value="<?= $row2['don_gia'] ?>" class="form-control don_gia" readonly>
                        </div>
                    </td>
                    <td class="share_tb_two">
                        <div class="form-group">
                            <input type="number" name="ttr_vat" value="" class="form-control tong_trvat" readonly>
                        </div>
                    </td>
                    <td class="share_tb_seven">
                        <div class="form-group">
                            <input type="type" name="thue_vat" data="" value="<?= $row2['thue_vat'] ?>" class="form-control thue_vat" readonly>
                        </div>
                    </td>
                    <td class="share_tb_eight">
                        <div class="form-group">
                            <input type="number" name="tts_vat" value="" class="form-control tong_svat" readonly>
                        </div>
                    </td>
                    <td class="share_tb_two">
                        <div class="form-group">
                            <input type="text" name="dia_chi_g" value="" class="form-control">
                        </div>
                    </td>
                </tr>
            <? }
        } else {
            while ($row2 = mysql_fetch_assoc($ds_vt->result)) { ?>
                <tr class="item">
                    <td class="share_tb_seven">
                        <p>
                            <img src="../img/remove.png" alt="xóa" class="dele_cot_ngang share_cursor">
                        </p>
                    </td>
                    <td class="share_tb_seven">
                        <p><?= $stt++ ?></p>
                        <input type="hidden" name="vat_tu" value="">
                    </td>
                    <td class="share_tb_one">
                        <div class="form-group share_form_select">
                            <input type="text" name="ma_vattu" value="VT - <?= $row2['id_vat_tu'] ?>" data="<?= $row2['id_vat_tu'] ?>" class="form-control" readonly>
                        </div>
                    </td>
                    <td class="share_tb_two">
                        <div class="form-group share_form_select">
                            <input type="text" name="ten_vt" value="<?= $all_vattu[$row2['id_vat_tu']]['dsvt_name'] ?>" class="form-control" readonly>
                        </div>
                    </td>
                    <td class="share_tb_seven">
                        <div class="form-group">
                            <input type="text" name="dvi_tinh" value="<?= $all_vattu[$row2['id_vat_tu']]['dvt_name'] ?>" class="form-control" readonly>
                        </div>
                    </td>
                    <td class="share_tb_two">
                        <div class="form-group">
                            <input type="text" name="hsan_xuat" value="<?= $all_vattu[$row2['id_vat_tu']]['hsx_name'] ?>" class="form-control">
                        </div>
                    </td>
                    <td class="share_tb_eight">
                        <div class="form-group">
                            <input type="number" name="so_luong_hd" value="<?= $row2['so_luong'] ?>" class="form-control" readonly>
                        </div>
                    </td>
                    <td class="share_tb_eight">
                        <div class="form-group">
                            <input type="number" name="so_luong_kt" value="" class="form-control" readonly>
                        </div>
                    </td>
                    <td class="share_tb_one">
                        <div class="form-group">
                            <input type="type" name="sl_knay" value="" class="form-control so_luong" onkeyup="sl_doi(this)" oninput="<?= $oninput ?>">
                        </div>
                    </td>
                    <td class="share_tb_eight">
                        <div class="form-group">
                            <input type="date" name="thoig_ghang" value="" class="form-control">
                        </div>
                    </td>
                    <td class="share_tb_two">
                        <div class="form-group">
                            <input type="number" name="don_gia" value="<?= $row2['don_gia'] ?>" class="form-control don_gia" readonly>
                        </div>
                    </td>
                    <td class="share_tb_two">
                        <div class="form-group">
                            <input type="number" name="ttr_vat" value="" class="form-control tong_trvat" readonly>
                        </div>
                    </td>
                    <td class="share_tb_seven">
                        <div class="form-group">
                            <input type="type" name="thue_vat" data="" value="<?= $row2['thue_vat'] ?>" class="form-control thue_vat" readonly>
                        </div>
                    </td>
                    <td class="share_tb_eight">
                        <div class="form-group">
                            <input type="number" name="tts_vat" value="" class="form-control tong_svat" readonly>
                        </div>
                    </td>
                    <td class="share_tb_two">
                        <div class="form-group">
                            <input type="text" name="dia_chi_g" value="" class="form-control">
                        </div>
                    </td>
                </tr>
            <? }
        }
    }
} else if ($id_dh == "" && $com_id != "" && $id_hd != "" && $id_ncc != "") {
    $ds_vt = new db_query("SELECT `id_vat_tu`, `id_hd_mua_ban`, `so_luong`, `don_gia`, `thue_vat`
                            FROM `vat_tu_hd_dh` WHERE `id_hd_mua_ban` = $id_hd ");
    $check_tt = new db_query("SELECT `id_hop_dong` FROM `don_hang` WHERE `id_cong_ty` = $com_id AND `phan_loai` = 1 AND `id_hop_dong` = $id_hd ");
    if (mysql_num_rows($check_tt->result) > 0) {
        while ($row2 = mysql_fetch_assoc($ds_vt->result)) {
            $id_vt = $row2['id_vat_tu'];
            $sum_vt = mysql_fetch_assoc((new db_query("SELECT SUM(`so_luong_ky_nay`) AS sum_vt FROM `vat_tu_dh_mua_ban`
                                                        WHERE `id_cong_ty` = $com_id AND `id_hd` = $id_hd AND `id_vat_tu` = $id_vt "))->result)['sum_vt']; ?>
            <tr class="item">
                <td class="share_tb_seven">
                    <p>
                        <img src="../img/remove.png" alt="xóa" class="dele_cot_ngang share_cursor">
                    </p>
                </td>
                <td class="share_tb_seven">
                    <p><?= $stt++ ?></p>
                    <input type="hidden" name="vat_tu" value="">
                </td>
                <td class="share_tb_one">
                    <div class="form-group share_form_select">
                        <input type="text" name="ma_vattu" value="VT - <?= $row2['id_vat_tu'] ?>" data="<?= $row2['id_vat_tu'] ?>" class="form-control" readonly>
                    </div>
                </td>
                <td class="share_tb_two">
                    <div class="form-group share_form_select">
                        <input type="text" name="ten_vt" value="<?= $all_vattu[$row2['id_vat_tu']]['dsvt_name'] ?>" class="form-control" readonly>
                    </div>
                </td>
                <td class="share_tb_seven">
                    <div class="form-group">
                        <input type="text" name="dvi_tinh" value="<?= $all_vattu[$row2['id_vat_tu']]['dvt_name'] ?>" class="form-control" readonly>
                    </div>
                </td>
                <td class="share_tb_two">
                    <div class="form-group">
                        <input type="text" name="hsan_xuat" value="<?= $all_vattu[$row2['id_vat_tu']]['hsx_name'] ?>" class="form-control">
                    </div>
                </td>
                <td class="share_tb_eight">
                    <div class="form-group">
                        <input type="number" name="so_luong_hd" value="<?= $row2['so_luong'] ?>" class="form-control" readonly>
                    </div>
                </td>
                <td class="share_tb_eight">
                    <div class="form-group">
                        <input type="number" name="so_luong_kt" value="<?= $sum_vt ?>" class="form-control" readonly>
                    </div>
                </td>
                <td class="share_tb_one">
                    <div class="form-group">
                        <input type="type" name="sl_knay" value="" class="form-control so_luong" onkeyup="sl_doi(this)" oninput="<?= $oninput ?>">
                    </div>
                </td>
                <td class="share_tb_eight">
                    <div class="form-group">
                        <input type="date" name="thoig_ghang" value="" class="form-control">
                    </div>
                </td>
                <td class="share_tb_two">
                    <div class="form-group">
                        <input type="number" name="don_gia" value="<?= $row2['don_gia'] ?>" class="form-control don_gia" readonly>
                    </div>
                </td>
                <td class="share_tb_two">
                    <div class="form-group">
                        <input type="number" name="ttr_vat" value="" class="form-control tong_trvat" readonly>
                    </div>
                </td>
                <td class="share_tb_seven">
                    <div class="form-group">
                        <input type="type" name="thue_vat" data="" value="<?= $row2['thue_vat'] ?>" class="form-control thue_vat" readonly>
                    </div>
                </td>
                <td class="share_tb_eight">
                    <div class="form-group">
                        <input type="number" name="tts_vat" value="" class="form-control tong_svat" readonly>
                    </div>
                </td>
                <td class="share_tb_two">
                    <div class="form-group">
                        <input type="text" name="dia_chi_g" value="" class="form-control">
                    </div>
                </td>
            </tr>
        <? }
    } else {
        while ($row2 = mysql_fetch_assoc($ds_vt->result)) { ?>
            <tr class="item">
                <td class="share_tb_seven">
                    <p>
                        <img src="../img/remove.png" alt="xóa" class="dele_cot_ngang share_cursor">
                    </p>
                </td>
                <td class="share_tb_seven">
                    <p><?= $stt++ ?></p>
                    <input type="hidden" name="vat_tu" value="">
                </td>
                <td class="share_tb_one">
                    <div class="form-group share_form_select">
                        <input type="text" name="ma_vattu" value="VT - <?= $row2['id_vat_tu'] ?>" data="<?= $row2['id_vat_tu'] ?>" class="form-control" readonly>
                    </div>
                </td>
                <td class="share_tb_two">
                    <div class="form-group share_form_select">
                        <input type="text" name="ten_vt" value="<?= $all_vattu[$row2['id_vat_tu']]['dsvt_name'] ?>" class="form-control" readonly>
                    </div>
                </td>
                <td class="share_tb_seven">
                    <div class="form-group">
                        <input type="text" name="dvi_tinh" value="<?= $all_vattu[$row2['id_vat_tu']]['dvt_name'] ?>" class="form-control" readonly>
                    </div>
                </td>
                <td class="share_tb_two">
                    <div class="form-group">
                        <input type="text" name="hsan_xuat" value="<?= $all_vattu[$row2['id_vat_tu']]['hsx_name'] ?>" class="form-control">
                    </div>
                </td>
                <td class="share_tb_eight">
                    <div class="form-group">
                        <input type="number" name="so_luong_hd" value="<?= $row2['so_luong'] ?>" class="form-control" readonly>
                    </div>
                </td>
                <td class="share_tb_eight">
                    <div class="form-group">
                        <input type="number" name="so_luong_kt" value="" class="form-control" readonly>
                    </div>
                </td>
                <td class="share_tb_one">
                    <div class="form-group">
                        <input type="type" name="sl_knay" value="" class="form-control so_luong" onkeyup="sl_doi(this)" oninput="<?= $oninput ?>">
                    </div>
                </td>
                <td class="share_tb_eight">
                    <div class="form-group">
                        <input type="date" name="thoig_ghang" value="" class="form-control">
                    </div>
                </td>
                <td class="share_tb_two">
                    <div class="form-group">
                        <input type="number" name="don_gia" value="<?= $row2['don_gia'] ?>" class="form-control don_gia" readonly>
                    </div>
                </td>
                <td class="share_tb_two">
                    <div class="form-group">
                        <input type="number" name="ttr_vat" value="" class="form-control tong_trvat" readonly>
                    </div>
                </td>
                <td class="share_tb_seven">
                    <div class="form-group">
                        <input type="type" name="thue_vat" data="" value="<?= $row2['thue_vat'] ?>" class="form-control thue_vat" readonly>
                    </div>
                </td>
                <td class="share_tb_eight">
                    <div class="form-group">
                        <input type="number" name="tts_vat" value="" class="form-control tong_svat" readonly>
                    </div>
                </td>
                <td class="share_tb_two">
                    <div class="form-group">
                        <input type="text" name="dia_chi_g" value="" class="form-control">
                    </div>
                </td>
            </tr>
<? }
    }
} ?>