<?
include("config.php");
$com_id = getValue('com_id', 'int', 'POST', '');
$loai_hs = getValue('loai_hs', 'int', 'POST', '');
$dh_hd = getValue('dh_hd', 'int', 'POST', '');

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

if ($com_id != "" && $loai_hs != "" && $dh_hd != "") {
    if ($loai_hs == 1) {
        $list_ploai = mysql_fetch_assoc((new db_query("SELECT `phan_loai`, `ngay_ky_hd` FROM `hop_dong`  WHERE `id_cong_ty` = $com_id AND `id` = $dh_hd"))->result);
        $ploai_hd = $list_ploai['phan_loai'];
        $ngay_ky = date('Y-m-d', $list_ploai['ngay_ky_hd']);

        $check_ttai = new db_query("SELECT DISTINCT h.`id_hd_dh` FROM `ho_so_thanh_toan` AS h
                                        INNER JOIN `chi_tiet_hs` AS c ON h.`id` = c.`id_hs`
                                        WHERE h.`id_cong_ty` = $com_id AND h.`loai_hs` = 1 AND h.`id_hd_dh` = $dh_hd ");

        $tien_trs = mysql_fetch_assoc((new db_query("SELECT `gia_tri_trvat`, `thue_vat`, `gia_tri_svat` FROM `hop_dong`
                                            WHERE `id` = $dh_hd AND `id_cong_ty` = $com_id "))->result);

        if ($ploai_hd == 1 || $ploai_hd == 2) {

            $ds_vt = new db_query("SELECT `id_vat_tu`, `so_luong`, `don_gia`, `tien_trvat`, `thue_vat`, `tien_svat`
                                    FROM `vat_tu_hd_dh` WHERE `id_hd_mua_ban` = $dh_hd ");

            if (mysql_num_rows($check_ttai->result) > 0) { ?>
                <div class="tbl-header" data="<?= $ngay_ky ?>">
                    <table>
                        <thead>
                            <tr>
                                <th class="w-10" rowspan="2">STT</th>
                                <th class="w-20" rowspan="2">T??n v???t t??</th>
                                <th class="w-10" rowspan="2">H??ng s???n xu???t</th>
                                <th class="w-10" rowspan="2">Xu???t x???</th>
                                <th class="w-10" rowspan="2">????n v??? t??nh</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">H???p ?????ng</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Kh???i l?????ng th???c hi???n</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Gi?? tr??? th???c hi???n</th>
                                <th class="w-5" rowspan="2">% Th???c hi???n</th>
                                <th class="w-20 border-bottom-w" colspan="2" scope="colgroup">Gi?? tr??? th???c hi???n</th>

                            </tr>
                            <tr class="border-top-w">
                                <th scope="colgroup">S??? l?????ng</th>
                                <th scope="colgroup">????n gi??(VN??)</th>
                                <th scope="colgroup">Gi?? tr???(VN??)</th>
                                <th scope="colgroup">L??y k??? k??? tr?????c</th>
                                <th scope="colgroup">K??? n??y</th>
                                <th scope="colgroup">L??y k??? ?????n nay</th>
                                <th scope="colgroup">L??y k??? k??? tr?????c(VN??)</th>
                                <th scope="colgroup">K??? n??y(VN??)</th>
                                <th scope="colgroup">L??y k??? ?????n nay(VN??)</th>
                                <th scope="colgroup">S??? l?????ng</th>
                                <th scope="colgroup">Gi?? tr???(VN??)</th>

                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="tbl-content table-2-row">
                    <table>
                        <tbody>
                            <? while ($row1 = mysql_fetch_assoc($ds_vt->result)) {
                                $id_vtu = $row1['id_vat_tu'];
                                $sum_kl_kt = new db_query("SELECT SUM(c.`kl_ky_nay`) AS sum_one, SUM(c.`gia_tri_ky_nay`) AS sum_two FROM `chi_tiet_hs` AS c
                                                                INNER JOIN `ho_so_thanh_toan` AS h ON h.`id` = c.`id_hs`
                                                                WHERE h.`id_hd_dh` = $dh_hd AND h.`id_cong_ty` = $com_id AND h.`loai_hs` = 1
                                                                AND c.`id_vat_tu` = $id_vtu ");
                                $list_sum = mysql_fetch_assoc($sum_kl_kt->result);
                                $sum_one = $list_sum['sum_one'];
                                $sum_two = $list_sum['sum_two']; ?>
                                <tr>
                                    <td class="w-10"><?= $stt++ ?></td>
                                    <td class="w-20 vat_tu_dh" data="<?= $row1['id_vat_tu'] ?>"><?= $all_vattu[$row1['id_vat_tu']]['dsvt_name'] ?></td>
                                    <td class="w-10"><?= $all_vattu[$row1['id_vat_tu']]['hsx_name'] ?></td>
                                    <td class="w-10"><?= $all_vattu[$row1['id_vat_tu']]['xx_name'] ?></td>
                                    <td class="w-10"><?= $all_vattu[$row1['id_vat_tu']]['dvt_name'] ?></td>
                                    <td class="w-10">
                                        <p class="tong_sluong"><?= $row1['so_luong'] ?></p>
                                    </td>
                                    <td class="w-10">
                                        <p class="don_gia"><?= $row1['don_gia'] ?></p>
                                    </td>
                                    <td class="w-10">
                                        <p class="tong_tienvt"><?= $row1['tien_trvat'] ?></p>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="kl_luy_ke_ky_truoc" data="<?= $row1['thue_vat'] ?>" class="tex_center" value="<?= ($sum_one == 0) ? "0" : $sum_one ?>" readonly>
                                    </td>
                                    <td class="w-10">
                                        <? if ($sum_one != $row1['so_luong']) { ?>
                                            <input type="text" name="kl_luy_ke_ky_nay" autocomplete="off" oninput="<?= $oninput ?>" class="tex_center" onkeyup="sl_hs_doi(this)">
                                        <? } else { ?>
                                            <input type="text" name="kl_luy_ke_ky_nay" oninput="<?= $oninput ?>" class="tex_center" readonly>
                                        <? } ?>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="kl_luy_ke_den_nay" data="" class="tex_center" value="<?= ($sum_one == 0) ? "0" : $sum_one ?>" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_ky_truoc" class="tex_center" value="<?= ($sum_two == 0) ? "0" : $sum_two ?>" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_ky_nay" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_den_nay" data="" class="tex_center" value="<?= ($sum_two == 0) ? "0" : $sum_two ?>" readonly>
                                    </td>
                                    <td class="w-5">
                                        <input type="text" name="phan_tram_thuc_hien" value="<?= ($sum_two * 100) / $row1['tien_trvat'] ?>" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="con_lai_so_luong" value="<?= $row1['so_luong'] - $sum_one ?>" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="con_lai_gia_tri" value="<?= $row1['tien_svat'] - $sum_two ?>" class="tex_center" readonly>
                                    </td>
                                </tr>
                            <? } ?>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">T???ng c???ng tr?????c VAT</td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"><?= formatMoney($tien_trs['gia_tri_trvat']) ?></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <p class="tong_tien_ky_nay" data=""></p>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">Thu??? VAT</td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <span class="tong_thue_vat"><?= $tien_trs['thue_vat'] ?></span>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <span class="thue_ky_nay"></span>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">Chi ph?? kh??c</td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <input name="chi_phi_khac" class="chi_phi_khac" type="text" autocomplete="off" oninput="<?= $oninput ?>" onkeyup="chiphi_khac(this)" placeholder="Nh???p chi ph?? kh??c">
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">T???ng c???ng sau VAT</td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"><?= formatMoney($tien_trs['gia_tri_svat']) ?></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <p class="tong_tatca"></p>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <? } else { ?>
                <div class="tbl-header" data="<?= $ngay_ky ?>">
                    <table>
                        <thead>
                            <tr>
                                <th class="w-10" rowspan="2">STT</th>
                                <th class="w-20" rowspan="2">T??n v???t t??</th>
                                <th class="w-10" rowspan="2">H??ng s???n xu???t</th>
                                <th class="w-10" rowspan="2">Xu???t x???</th>
                                <th class="w-10" rowspan="2">????n v??? t??nh</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">H???p ?????ng</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Kh???i l?????ng th???c hi???n</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Gi?? tr??? th???c hi???n</th>
                                <th class="w-5" rowspan="2">% Th???c hi???n</th>
                                <th class="w-20 border-bottom-w" colspan="2" scope="colgroup">Gi?? tr??? th???c hi???n</th>

                            </tr>
                            <tr class="border-top-w">
                                <th scope="colgroup">S??? l?????ng</th>
                                <th scope="colgroup">????n gi??(VN??)</th>
                                <th scope="colgroup">Gi?? tr???(VN??)</th>
                                <th scope="colgroup">L??y k??? k??? tr?????c</th>
                                <th scope="colgroup">K??? n??y</th>
                                <th scope="colgroup">L??y k??? ?????n nay</th>
                                <th scope="colgroup">L??y k??? k??? tr?????c(VN??)</th>
                                <th scope="colgroup">K??? n??y(VN??)</th>
                                <th scope="colgroup">L??y k??? ?????n nay(VN??)</th>
                                <th scope="colgroup">S??? l?????ng</th>
                                <th scope="colgroup">Gi?? tr???(VN??)</th>

                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="tbl-content table-2-row">
                    <table>
                        <tbody>
                            <? while ($row1 = mysql_fetch_assoc($ds_vt->result)) { ?>
                                <tr>
                                    <td class="w-10"><?= $stt++ ?></td>
                                    <td class="w-20 vat_tu_dh" data="<?= $row1['id_vat_tu'] ?>"><?= $all_vattu[$row1['id_vat_tu']]['dsvt_name'] ?></td>
                                    <td class="w-10"><?= $all_vattu[$row1['id_vat_tu']]['hsx_name'] ?></td>
                                    <td class="w-10"><?= $all_vattu[$row1['id_vat_tu']]['xx_name'] ?></td>
                                    <td class="w-10"><?= $all_vattu[$row1['id_vat_tu']]['dvt_name'] ?></td>
                                    <td class="w-10">
                                        <p class="tong_sluong"><?= $row1['so_luong'] ?></p>
                                    </td>
                                    <td class="w-10">
                                        <p class="don_gia"><?= $row1['don_gia'] ?></p>
                                    </td>
                                    <td class="w-10">
                                        <p class="tong_tienvt"><?= $row1['tien_trvat'] ?></p>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="kl_luy_ke_ky_truoc" data="<?= $row1['thue_vat'] ?>" value="0" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="kl_luy_ke_ky_nay" autocomplete="off" oninput="<?= $oninput ?>" class="tex_center" onkeyup="sl_hs_doi(this)">
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="kl_luy_ke_den_nay" data="" value="0" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_ky_truoc" value="0" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_ky_nay" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_den_nay" data="" value="0" class="tex_center" readonly>
                                    </td>
                                    <td class="w-5">
                                        <input type="text" name="phan_tram_thuc_hien" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="con_lai_so_luong" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="con_lai_gia_tri" class="tex_center" readonly>
                                    </td>
                                </tr>
                            <? } ?>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">T???ng c???ng tr?????c VAT</td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"><?= formatMoney($tien_trs['gia_tri_trvat']) ?></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <p class="tong_tien_ky_nay" data=""></p>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">Thu??? VAT</td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <span class="tong_thue_vat"><?= $tien_trs['thue_vat'] ?></span>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <span class="thue_ky_nay"></span>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">Chi ph?? kh??c</td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <input name="chi_phi_khac" class="chi_phi_khac" type="text" oninput="<?= $oninput ?>" autocomplete="off" onkeyup="chiphi_khac(this)" placeholder="Nh???p chi ph?? kh??c">
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">T???ng c???ng sau VAT</td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"><?= formatMoney($tien_trs['gia_tri_svat']) ?></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <p class="tong_tatca"></p>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <? }
        } else if ($ploai_hd == 3) {
            $ds_vt = new db_query("SELECT `id_vat_tu_thiet_bi`, `khoi_luong_du_kien`, `han_muc_ca_may`, `don_gia_thue`, `dg_ca_may_phu_troi`,
                                `thanh_tien_du_kien` FROM `vat_tu_hd_thue` WHERE `id_hd_thue` = $dh_hd ");
            if (mysql_num_rows($check_ttai->result) > 0) { ?>
                <div class="tbl-header" data="<?= $ngay_ky ?>">
                    <table>
                        <thead>
                            <tr>
                                <th class="w-10" rowspan="2">STT</th>
                                <th class="w-20" rowspan="2">T??n v???t t??</th>
                                <th class="w-10" rowspan="2">H??ng s???n xu???t</th>
                                <th class="w-10" rowspan="2">Xu???t x???</th>
                                <th class="w-10" rowspan="2">????n v??? t??nh</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">H???p ?????ng</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Kh???i l?????ng th???c hi???n</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Gi?? tr??? th???c hi???n</th>
                                <th class="w-5" rowspan="2">% Th???c hi???n</th>
                                <th class="w-20 border-bottom-w" colspan="2" scope="colgroup">Gi?? tr??? th???c hi???n</th>

                            </tr>
                            <tr class="border-top-w">
                                <th scope="colgroup">S??? l?????ng</th>
                                <th scope="colgroup">????n gi??(VN??)</th>
                                <th scope="colgroup">Gi?? tr???(VN??)</th>
                                <th scope="colgroup">L??y k??? k??? tr?????c</th>
                                <th scope="colgroup">K??? n??y</th>
                                <th scope="colgroup">L??y k??? ?????n nay</th>
                                <th scope="colgroup">L??y k??? k??? tr?????c(VN??)</th>
                                <th scope="colgroup">K??? n??y(VN??)</th>
                                <th scope="colgroup">L??y k??? ?????n nay(VN??)</th>
                                <th scope="colgroup">S??? l?????ng</th>
                                <th scope="colgroup">Gi?? tr???(VN??)</th>

                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="tbl-content table-2-row">
                    <table>
                        <tbody>
                            <? while ($row1 = mysql_fetch_assoc($ds_vt->result)) { ?>
                                <tr>
                                    <td class="w-10"><?= $stt++ ?></td>
                                    <td class="w-20 vat_tu_dh" data="<?= $row1['id_vat_tu_thiet_bi'] ?>"><?= $all_vattu[$row1['id_vat_tu_thiet_bi']]['dsvt_name'] ?></td>
                                    <td class="w-10"><?= $all_vattu[$row1['id_vat_tu_thiet_bi']]['hsx_name'] ?></td>
                                    <td class="w-10"><?= $all_vattu[$row1['id_vat_tu_thiet_bi']]['xx_name'] ?></td>
                                    <td class="w-10"><?= $all_vattu[$row1['id_vat_tu_thiet_bi']]['dvt_name'] ?></td>
                                    <td class="w-10">
                                        <p class="tong_sluong"><?= $row1['khoi_luong_du_kien'] ?></p>
                                    </td>
                                    <td class="w-10">
                                        <p class="don_gia"><?= $row1['don_gia_thue'] ?></p>
                                    </td>
                                    <td class="w-10">
                                        <p class="tong_tienvt"><?= $row1['thanh_tien_du_kien'] ?></p>
                                    </td>
                                    <?
                                    $id_vtu = $row1['id_vat_tu_thiet_bi'];
                                    $sum_kl_kt = new db_query("SELECT SUM(c.`kl_ky_nay`) AS sum_one, SUM(c.`gia_tri_ky_nay`) AS sum_two FROM `chi_tiet_hs` AS c
                                                                INNER JOIN `ho_so_thanh_toan` AS h ON h.`id` = c.`id_hs`
                                                                WHERE h.`id_hd_dh` = $dh_hd AND h.`id_cong_ty` = $com_id AND h.`loai_hs` = 1
                                                                AND c.`id_vat_tu` = $id_vtu ");
                                    $list_sum = mysql_fetch_assoc($sum_kl_kt->result);
                                    $sum_one = $list_sum['sum_one'];
                                    $sum_two = $list_sum['sum_two'];
                                    ?>
                                    <td class="w-10">
                                        <input type="text" name="kl_luy_ke_ky_truoc" data="0" class="tex_center" value="<?= ($sum_one == 0) ? "0" : $sum_one ?>" readonly>
                                    </td>
                                    <td class="w-10">
                                        <? if ($sum_one != $row1['khoi_luong_du_kien']) { ?>
                                            <input type="text" name="kl_luy_ke_ky_nay" autocomplete="off" oninput="<?= $oninput ?>" class="tex_center" onkeyup="klt_hs_doi(this)">
                                        <? } else { ?>
                                            <input type="text" name="kl_luy_ke_ky_nay" oninput="<?= $oninput ?>" class="tex_center" readonly>
                                        <? } ?>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="kl_luy_ke_den_nay" data="" class="tex_center" value="<?= ($sum_one == 0) ? "0" : $sum_one ?>" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_ky_truoc" class="tex_center" value="<?= ($sum_two == 0) ? "0" : $sum_two ?>" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_ky_nay" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_den_nay" data="" class="tex_center" value="<?= ($sum_two == 0) ? "0" : $sum_two ?>" readonly>
                                    </td>
                                    <td class="w-5">
                                        <input type="text" name="phan_tram_thuc_hien" value="<?= ($sum_two * 100) / $row1['thanh_tien_du_kien'] ?>" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="con_lai_so_luong" value="<?= $row1['khoi_luong_du_kien'] - $sum_one ?>" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="con_lai_gia_tri" value="<?= $row1['thanh_tien_du_kien'] - $sum_two ?>" class="tex_center" readonly>
                                    </td>
                                </tr>
                            <? } ?>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">T???ng c???ng tr?????c VAT</td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"><?= formatMoney($tien_trs['gia_tri_trvat']) ?></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <p class="tong_tien_ky_nay" data=""></p>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">Thu??? VAT</td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <span class="tong_thue_vat">0</span>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <span class="thue_ky_nay">0</span>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">Chi ph?? kh??c</td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <input name="chi_phi_khac" class="chi_phi_khac" type="text" autocomplete="off" oninput="<?= $oninput ?>" onkeyup="chiphi_khac_thue(this)" placeholder="Nh???p chi ph?? kh??c">
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">T???ng c???ng sau VAT</td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"><?= formatMoney($tien_trs['gia_tri_svat']) ?></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <p class="tong_tatca"></p>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <? } else { ?>
                <div class="tbl-header" data="<?= $ngay_ky ?>">
                    <table>
                        <thead>
                            <tr>
                                <th class="w-10" rowspan="2">STT</th>
                                <th class="w-20" rowspan="2">T??n v???t t??</th>
                                <th class="w-10" rowspan="2">H??ng s???n xu???t</th>
                                <th class="w-10" rowspan="2">Xu???t x???</th>
                                <th class="w-10" rowspan="2">????n v??? t??nh</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">H???p ?????ng</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Kh???i l?????ng th???c hi???n</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Gi?? tr??? th???c hi???n</th>
                                <th class="w-5" rowspan="2">% Th???c hi???n</th>
                                <th class="w-20 border-bottom-w" colspan="2" scope="colgroup">Gi?? tr??? th???c hi???n</th>

                            </tr>
                            <tr class="border-top-w">
                                <th scope="colgroup">S??? l?????ng</th>
                                <th scope="colgroup">????n gi??(VN??)</th>
                                <th scope="colgroup">Gi?? tr???(VN??)</th>
                                <th scope="colgroup">L??y k??? k??? tr?????c</th>
                                <th scope="colgroup">K??? n??y</th>
                                <th scope="colgroup">L??y k??? ?????n nay</th>
                                <th scope="colgroup">L??y k??? k??? tr?????c(VN??)</th>
                                <th scope="colgroup">K??? n??y(VN??)</th>
                                <th scope="colgroup">L??y k??? ?????n nay(VN??)</th>
                                <th scope="colgroup">S??? l?????ng</th>
                                <th scope="colgroup">Gi?? tr???(VN??)</th>

                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="tbl-content table-2-row">
                    <table>
                        <tbody>
                            <? while ($row1 = mysql_fetch_assoc($ds_vt->result)) { ?>
                                <tr>
                                    <td class="w-10"><?= $stt++ ?></td>
                                    <td class="w-20 vat_tu_dh" data="<?= $row1['id_vat_tu_thiet_bi'] ?>"><?= $all_vattu[$row1['id_vat_tu_thiet_bi']]['dsvt_name'] ?></td>
                                    <td class="w-10"><?= $all_vattu[$row1['id_vat_tu_thiet_bi']]['hsx_name'] ?></td>
                                    <td class="w-10"><?= $all_vattu[$row1['id_vat_tu_thiet_bi']]['xx_name'] ?></td>
                                    <td class="w-10"><?= $all_vattu[$row1['id_vat_tu_thiet_bi']]['dvt_name'] ?></td>
                                    <td class="w-10">
                                        <p class="tong_sluong"><?= $row1['khoi_luong_du_kien'] ?></p>
                                    </td>
                                    <td class="w-10">
                                        <p class="don_gia"><?= $row1['don_gia_thue'] ?></p>
                                    </td>
                                    <td class="w-10">
                                        <p class="tong_tienvt"><?= $row1['thanh_tien_du_kien'] ?></p>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="kl_luy_ke_ky_truoc" data="0" value="0" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="kl_luy_ke_ky_nay" autocomplete="off" oninput="<?= $oninput ?>" class="tex_center" onkeyup="klt_hs_doi(this)">
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="kl_luy_ke_den_nay" data="" value="0" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_ky_truoc" value="0" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_ky_nay" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_den_nay" data="" value="0" class="tex_center" readonly>
                                    </td>
                                    <td class="w-5">
                                        <input type="text" name="phan_tram_thuc_hien" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="con_lai_so_luong" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="con_lai_gia_tri" class="tex_center" readonly>
                                    </td>
                                </tr>
                            <? } ?>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">T???ng c???ng tr?????c VAT</td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"><?= formatMoney($tien_trs['gia_tri_trvat']) ?></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <p class="tong_tien_ky_nay" data=""></p>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">Thu??? VAT</td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <span class="tong_thue_vat">0</span>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <span class="thue_ky_nay">0</span>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">Chi ph?? kh??c</td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <input name="chi_phi_khac" class="chi_phi_khac" type="text" autocomplete="off" oninput="<?= $oninput ?>" onkeyup="chiphi_khac_thue(this)" placeholder="Nh???p chi ph?? kh??c">
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">T???ng c???ng sau VAT</td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"><?= formatMoney($tien_trs['gia_tri_svat']) ?></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <p class="tong_tatca"></p>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <? }
        } else if ($ploai_hd == 4) {
            $ds_vt = new db_query("SELECT `vat_tu`, `khoi_luong`, `don_gia`, `thanh_tien` FROM `vat_tu_hd_vc` WHERE `id_hd_vc` = $dh_hd ");
            if (mysql_num_rows($check_ttai->result) > 0) { ?>
                <div class="tbl-header" data="<?= $ngay_ky ?>">
                    <table>
                        <thead>
                            <tr>
                                <th class="w-10" rowspan="2">STT</th>
                                <th class="w-20" rowspan="2">T??n v???t t??</th>
                                <th class="w-10" rowspan="2">H??ng s???n xu???t</th>
                                <th class="w-10" rowspan="2">Xu???t x???</th>
                                <th class="w-10" rowspan="2">????n v??? t??nh</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">H???p ?????ng</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Kh???i l?????ng th???c hi???n</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Gi?? tr??? th???c hi???n</th>
                                <th class="w-5" rowspan="2">% Th???c hi???n</th>
                                <th class="w-20 border-bottom-w" colspan="2" scope="colgroup">Gi?? tr??? th???c hi???n</th>

                            </tr>
                            <tr class="border-top-w">
                                <th scope="colgroup">S??? l?????ng</th>
                                <th scope="colgroup">????n gi??(VN??)</th>
                                <th scope="colgroup">Gi?? tr???(VN??)</th>
                                <th scope="colgroup">L??y k??? k??? tr?????c</th>
                                <th scope="colgroup">K??? n??y</th>
                                <th scope="colgroup">L??y k??? ?????n nay</th>
                                <th scope="colgroup">L??y k??? k??? tr?????c(VN??)</th>
                                <th scope="colgroup">K??? n??y(VN??)</th>
                                <th scope="colgroup">L??y k??? ?????n nay(VN??)</th>
                                <th scope="colgroup">S??? l?????ng</th>
                                <th scope="colgroup">Gi?? tr???(VN??)</th>

                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="tbl-content table-2-row">
                    <table>
                        <tbody>
                            <? while ($row1 = mysql_fetch_assoc($ds_vt->result)) { ?>
                                <tr>
                                    <td class="w-10"><?= $stt++ ?></td>
                                    <td class="w-20 vat_tu_dh" data="<?= $row1['vat_tu'] ?>"><?= $all_vattu[$row1['vat_tu']]['dsvt_name'] ?></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"><?= $all_vattu[$row1['vat_tu']]['dvt_name'] ?></td>
                                    <td class="w-10">
                                        <p class="tong_sluong"><?= $row1['khoi_luong'] ?></p>
                                    </td>
                                    <td class="w-10">
                                        <p class="don_gia"><?= $row1['don_gia'] ?></p>
                                    </td>
                                    <td class="w-10">
                                        <p class="tong_tienvt"><?= $row1['thanh_tien'] ?></p>
                                    </td>
                                    <?
                                    $id_vtu = $row1['vat_tu'];
                                    $sum_kl_kt = new db_query("SELECT SUM(c.`kl_ky_nay`) AS sum_one, SUM(c.`gia_tri_ky_nay`) AS sum_two FROM `chi_tiet_hs` AS c
                                                                INNER JOIN `ho_so_thanh_toan` AS h ON h.`id` = c.`id_hs`
                                                                WHERE h.`id_hd_dh` = $dh_hd AND h.`id_cong_ty` = $com_id AND h.`loai_hs` = 1
                                                                AND c.`id_vat_tu` = $id_vtu ");
                                    $list_sum = mysql_fetch_assoc($sum_kl_kt->result);
                                    $sum_one = $list_sum['sum_one'];
                                    $sum_two = $list_sum['sum_two'];
                                    ?>
                                    <td class="w-10">
                                        <input type="text" name="kl_luy_ke_ky_truoc" data="0" class="tex_center" value="<?= ($sum_one == 0) ? "0" : $sum_one ?>" readonly>
                                    </td>
                                    <td class="w-10">
                                        <? if ($sum_one != $row1['so_luong']) { ?>
                                            <input type="text" name="kl_luy_ke_ky_nay" autocomplete="off" oninput="<?= $oninput ?>" class="tex_center" onkeyup="kl_hs_doi(this)">
                                        <? } else { ?>
                                            <input type="text" name="kl_luy_ke_ky_nay" oninput="<?= $oninput ?>" class="tex_center" readonly>
                                        <? } ?>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="kl_luy_ke_den_nay" data="" class="tex_center" value="<?= ($sum_one == 0) ? "0" : $sum_one ?>" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_ky_truoc" class="tex_center" value="<?= ($sum_two == 0) ? "0" : $sum_two ?>" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_ky_nay" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_den_nay" data="" class="tex_center" value="<?= ($sum_two == 0) ? "0" : $sum_two ?>" readonly>
                                    </td>
                                    <td class="w-5">
                                        <input type="text" name="phan_tram_thuc_hien" value="<?= ($sum_two * 100) / $row1['thanh_tien'] ?>" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="con_lai_so_luong" value="<?= $row1['khoi_luong'] - $sum_one ?>" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="con_lai_gia_tri" value="<?= $row1['thanh_tien'] - $sum_two ?>" class="tex_center" readonly>
                                    </td>
                                </tr>
                            <? } ?>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">T???ng c???ng tr?????c VAT</td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"><?= formatMoney($tien_trs['gia_tri_trvat']) ?></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <p class="tong_tien_ky_nay" data=""></p>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">Thu??? VAT</td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <span class="tong_thue_vat"><?= formatMoney(($tien_trs['gia_tri_trvat'] * $tien_trs['thue_vat']) / 100) ?></span>
                                    <span class="thue_vat" data="<?= $tien_trs['thue_vat'] ?>">(<?= $tien_trs['thue_vat'] ?> %)</span>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <span class="thue_ky_nay"></span>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">Chi ph?? kh??c</td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <input name="chi_phi_khac" class="chi_phi_khac" type="text" autocomplete="off" oninput="<?= $oninput ?>" onkeyup="chiphi_khac_vc(this)" placeholder="Nh???p chi ph?? kh??c">
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">T???ng c???ng sau VAT</td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"><?= formatMoney($tien_trs['gia_tri_svat']) ?></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <p class="tong_tatca"></p>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <? } else { ?>
                <div class="tbl-header" data="<?= $ngay_ky ?>">
                    <table>
                        <thead>
                            <tr>
                                <th class="w-10" rowspan="2">STT</th>
                                <th class="w-20" rowspan="2">T??n v???t t??</th>
                                <th class="w-10" rowspan="2">H??ng s???n xu???t</th>
                                <th class="w-10" rowspan="2">Xu???t x???</th>
                                <th class="w-10" rowspan="2">????n v??? t??nh</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">H???p ?????ng</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Kh???i l?????ng th???c hi???n</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Gi?? tr??? th???c hi???n</th>
                                <th class="w-5" rowspan="2">% Th???c hi???n</th>
                                <th class="w-20 border-bottom-w" colspan="2" scope="colgroup">Gi?? tr??? th???c hi???n</th>

                            </tr>
                            <tr class="border-top-w">
                                <th scope="colgroup">S??? l?????ng</th>
                                <th scope="colgroup">????n gi??(VN??)</th>
                                <th scope="colgroup">Gi?? tr???(VN??)</th>
                                <th scope="colgroup">L??y k??? k??? tr?????c</th>
                                <th scope="colgroup">K??? n??y</th>
                                <th scope="colgroup">L??y k??? ?????n nay</th>
                                <th scope="colgroup">L??y k??? k??? tr?????c(VN??)</th>
                                <th scope="colgroup">K??? n??y(VN??)</th>
                                <th scope="colgroup">L??y k??? ?????n nay(VN??)</th>
                                <th scope="colgroup">S??? l?????ng</th>
                                <th scope="colgroup">Gi?? tr???(VN??)</th>

                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="tbl-content table-2-row">
                    <table>
                        <tbody>
                            <? while ($row1 = mysql_fetch_assoc($ds_vt->result)) { ?>
                                <tr>
                                    <td class="w-10"><?= $stt++ ?></td>
                                    <td class="w-20 vat_tu_dh" data="<?= $row1['vat_tu'] ?>"><?= $all_vattu[$row1['vat_tu']]['dsvt_name'] ?></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"><?= $all_vattu[$row1['vat_tu']]['dvt_name'] ?></td>
                                    <td class="w-10">
                                        <p class="tong_sluong"><?= $row1['khoi_luong'] ?></p>
                                    </td>
                                    <td class="w-10">
                                        <p class="don_gia"><?= $row1['don_gia'] ?></p>
                                    </td>
                                    <td class="w-10">
                                        <p class="tong_tienvt"><?= $row1['thanh_tien'] ?></p>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="kl_luy_ke_ky_truoc" data="0" value="0" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="kl_luy_ke_ky_nay" autocomplete="off" oninput="<?= $oninput ?>" class="tex_center" onkeyup="kl_hs_doi(this)">
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="kl_luy_ke_den_nay" data="" value="0" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_ky_truoc" value="0" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_ky_nay" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_den_nay" data="" value="0" class="tex_center" readonly>
                                    </td>
                                    <td class="w-5">
                                        <input type="text" name="phan_tram_thuc_hien" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="con_lai_so_luong" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="con_lai_gia_tri" class="tex_center" readonly>
                                    </td>
                                </tr>
                            <? } ?>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">T???ng c???ng tr?????c VAT</td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"><?= formatMoney($tien_trs['gia_tri_trvat']) ?></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <p class="tong_tien_ky_nay" data=""></p>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">Thu??? VAT</td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <span class="tong_thue_vat"><?= formatMoney(($tien_trs['gia_tri_trvat'] * $tien_trs['thue_vat']) / 100) ?></span>
                                    <span class="thue_vat" data="<?= $tien_trs['thue_vat'] ?>">(<?= $tien_trs['thue_vat'] ?> %)</span>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <span class="thue_ky_nay"></span>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">Chi ph?? kh??c</td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <input name="chi_phi_khac" class="chi_phi_khac" type="text" autocomplete="off" oninput="<?= $oninput ?>" onkeyup="chiphi_khac_vc(this)" placeholder="Nh???p chi ph?? kh??c">
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">T???ng c???ng sau VAT</td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"><?= formatMoney($tien_trs['gia_tri_svat']) ?></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <p class="tong_tatca"></p>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <? }
        }
    } else if ($loai_hs == 2) {
        $id_ctr = mysql_fetch_assoc((new db_query("SELECT n.`id_du_an_ctrinh` FROM `vat_tu_dh_mua_ban` AS v INNER JOIN `hop_dong` AS n ON n.`id` = v.`id_hd`
                                    WHERE v.`id_don_hang` = $dh_hd  AND v.`id_cong_ty` = $com_id "))->result)['id_du_an_ctrinh'];

        $ds_vt = new db_query("SELECT `id_vat_tu`, `so_luong_ky_nay`, `don_gia`, `tong_tien_trvat`, `thue_vat`, `tong_tien_svat`
                            FROM `vat_tu_dh_mua_ban` WHERE `id_don_hang` = $dh_hd  AND `id_cong_ty` = $com_id ");

        $tien_trs = mysql_fetch_assoc((new db_query("SELECT `gia_tri_don_hang`, `thue_vat`, `gia_tri_svat` FROM `don_hang`
                                                    WHERE `id` = $dh_hd AND `id_cong_ty` = $com_id "))->result);

        $check_ttai = new db_query("SELECT DISTINCT h.`id_hd_dh` FROM `ho_so_thanh_toan` AS h
                                        INNER JOIN `chi_tiet_hs` AS c ON h.`id` = c.`id_hs`
                                        WHERE h.`id_cong_ty` = $com_id AND h.`loai_hs` = 2 AND h.`id_hd_dh` = $dh_hd ");

        if (mysql_num_rows($check_ttai->result) > 0) { ?>
            <div class="tbl-header">
                <table>
                    <thead>
                        <tr>
                            <th class="w-10" rowspan="2">STT</th>
                            <th class="w-20" rowspan="2">T??n v???t t??</th>
                            <th class="w-10" rowspan="2">H??ng s???n xu???t</th>
                            <th class="w-10" rowspan="2">Xu???t x???</th>
                            <th class="w-10" rowspan="2">????n v??? t??nh</th>
                            <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">????n h??ng</th>
                            <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Kh???i l?????ng th???c hi???n</th>
                            <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Gi?? tr??? th???c hi???n</th>
                            <th class="w-5" rowspan="2">% Th???c hi???n</th>
                            <th class="w-20 border-bottom-w" colspan="2" scope="colgroup">Gi?? tr??? th???c hi???n</th>

                        </tr>
                        <tr class="border-top-w">
                            <th scope="colgroup">S??? l?????ng</th>
                            <th scope="colgroup">????n gi??(VN??)</th>
                            <th scope="colgroup">Gi?? tr???(VN??)</th>
                            <th scope="colgroup">L??y k??? k??? tr?????c</th>
                            <th scope="colgroup">K??? n??y</th>
                            <th scope="colgroup">L??y k??? ?????n nay</th>
                            <th scope="colgroup">L??y k??? k??? tr?????c(VN??)</th>
                            <th scope="colgroup">K??? n??y(VN??)</th>
                            <th scope="colgroup">L??y k??? ?????n nay(VN??)</th>
                            <th scope="colgroup">S??? l?????ng</th>
                            <th scope="colgroup">Gi?? tr???(VN??)</th>

                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content table-2-row">
                <table>
                    <tbody>
                        <? while ($row1 = mysql_fetch_assoc($ds_vt->result)) {
                            $id_vtu = $row1['id_vat_tu'];
                            $sum_kl_kt = new db_query("SELECT SUM(c.`kl_ky_nay`) AS sum_one, SUM(c.`gia_tri_ky_nay`) AS sum_two FROM `chi_tiet_hs` AS c
                                                        INNER JOIN `ho_so_thanh_toan` AS h ON h.`id` = c.`id_hs`
                                                        WHERE h.`id_hd_dh` = $dh_hd AND h.`id_cong_ty` = $com_id
                                                        AND h.`loai_hs` = 2 AND c.`id_vat_tu` = $id_vtu ");
                            $list_sum = mysql_fetch_assoc($sum_kl_kt->result);
                            $sum_one = $list_sum['sum_one'];
                            $sum_two = $list_sum['sum_two']; ?>
                            <tr>
                                <td class="w-10"><?= $stt++ ?></td>
                                <td class="w-20 vat_tu_dh" data="<?= $row1['id_vat_tu'] ?>"><?= $all_vattu[$row1['id_vat_tu']]['dsvt_name'] ?></td>
                                <td class="w-10"><?= $all_vattu[$row1['id_vat_tu']]['hsx_name'] ?></td>
                                <td class="w-10"><?= $all_vattu[$row1['id_vat_tu']]['xx_name'] ?></td>
                                <td class="w-10"><?= $all_vattu[$row1['id_vat_tu']]['dvt_name'] ?></td>
                                <td class="w-10">
                                    <p class="tong_sluong"><?= $row1['so_luong_ky_nay'] ?></p>
                                </td>
                                <td class="w-10">
                                    <p class="don_gia"><?= $row1['don_gia'] ?></p>
                                </td>
                                <td class="w-10">
                                    <p class="tong_tienvt"><?= $row1['tong_tien_trvat'] ?></p>
                                </td>
                                <td class="w-10">
                                    <input type="text" name="kl_luy_ke_ky_truoc" data="<?= $row1['thue_vat'] ?>" value="<?= ($sum_one == 0) ? "0" : $sum_one ?>" class="tex_center" readonly>
                                </td>
                                <td class="w-10">
                                    <? if ($sum_one != $row1['so_luong_ky_nay']) { ?>
                                        <input type="text" name="kl_luy_ke_ky_nay" autocomplete="off" oninput="<?= $oninput ?>" class="tex_center" onkeyup="sl_hs_doi(this)">
                                    <? } else { ?>
                                        <input type="text" name="kl_luy_ke_ky_nay" oninput="<?= $oninput ?>" class="tex_center" readonly>
                                    <? } ?>
                                </td>
                                <td class="w-10">
                                    <input type="text" name="kl_luy_ke_den_nay" data="" value="<?= ($sum_one == 0) ? "0" : $sum_one ?>" class="tex_center" readonly>
                                </td>
                                <td class="w-10">
                                    <input type="text" name="gt_luy_ke_ky_truoc" class="tex_center" value="<?= ($sum_two == 0) ? "0" : $sum_two ?>" readonly>
                                </td>
                                <td class="w-10">
                                    <input type="text" name="gt_luy_ke_ky_nay" class="tex_center" readonly>
                                </td>
                                <td class="w-10">
                                    <input type="text" name="gt_luy_ke_den_nay" data="" class="tex_center" value="<?= ($sum_two == 0) ? "0" : $sum_two ?>" readonly>
                                </td>
                                <td class="w-5">
                                    <input type="text" name="phan_tram_thuc_hien" value="<?= ($sum_two * 100) / $row1['tong_tien_trvat'] ?>" class="tex_center" readonly>
                                </td>
                                <td class="w-10">
                                    <input type="text" name="con_lai_so_luong" value="<?= $row1['so_luong_ky_nay'] - $sum_one ?>" class="tex_center" readonly>
                                </td>
                                <td class="w-10">
                                    <input type="text" name="con_lai_gia_tri" value="<?= $row1['tong_tien_svat'] - $sum_two ?>" class="tex_center" readonly>
                                </td>
                            </tr>
                        <? } ?>
                        <tr class="bg-ed">
                            <td class="w-10 text-bold">T???ng c???ng tr?????c VAT</td>
                            <td class="w-20"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"><?= formatMoney($tien_trs['gia_tri_don_hang']) ?></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10">
                                <p class="tong_tien_ky_nay" data=""></p>
                            </td>
                            <td class="w-10"></td>
                            <td class="w-5"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                        </tr>
                        <tr class="bg-ed">
                            <td class="w-10 text-bold">Thu??? VAT</td>
                            <td class="w-20"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10">
                                <span class="tong_thue_vat"><?= $tien_trs['thue_vat'] ?></span>
                            </td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10">
                                <span class="thue_ky_nay"></span>
                            </td>
                            <td class="w-10"></td>
                            <td class="w-5"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                        </tr>
                        <tr class="bg-ed">
                            <td class="w-10 text-bold">Chi ph?? kh??c</td>
                            <td class="w-20"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10">
                                <input name="chi_phi_khac" class="chi_phi_khac" type="text" autocomplete="off" oninput="<?= $oninput ?>" onkeyup="chiphi_khac(this)" placeholder="Nh???p chi ph?? kh??c">
                            </td>
                            <td class="w-10"></td>
                            <td class="w-5"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                        </tr>
                        <tr class="bg-ed">
                            <td class="w-10 text-bold">T???ng c???ng sau VAT</td>
                            <td class="w-20"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"><?= formatMoney($tien_trs['gia_tri_svat']) ?></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10">
                                <p class="tong_tatca"></p>
                            </td>
                            <td class="w-10"></td>
                            <td class="w-5"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <? } else { ?>
            <div class="tbl-header">
                <table>
                    <thead>
                        <tr>
                            <th class="w-10" rowspan="2">STT</th>
                            <th class="w-20" rowspan="2">T??n v???t t??</th>
                            <th class="w-10" rowspan="2">H??ng s???n xu???t</th>
                            <th class="w-10" rowspan="2">Xu???t x???</th>
                            <th class="w-10" rowspan="2">????n v??? t??nh</th>
                            <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">????n h??ng</th>
                            <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Kh???i l?????ng th???c hi???n</th>
                            <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Gi?? tr??? th???c hi???n</th>
                            <th class="w-5" rowspan="2">% Th???c hi???n</th>
                            <th class="w-20 border-bottom-w" colspan="2" scope="colgroup">Gi?? tr??? th???c hi???n</th>

                        </tr>
                        <tr class="border-top-w">
                            <th scope="colgroup">S??? l?????ng</th>
                            <th scope="colgroup">????n gi??(VN??)</th>
                            <th scope="colgroup">Gi?? tr???(VN??)</th>
                            <th scope="colgroup">L??y k??? k??? tr?????c</th>
                            <th scope="colgroup">K??? n??y</th>
                            <th scope="colgroup">L??y k??? ?????n nay</th>
                            <th scope="colgroup">L??y k??? k??? tr?????c(VN??)</th>
                            <th scope="colgroup">K??? n??y(VN??)</th>
                            <th scope="colgroup">L??y k??? ?????n nay(VN??)</th>
                            <th scope="colgroup">S??? l?????ng</th>
                            <th scope="colgroup">Gi?? tr???(VN??)</th>

                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content table-2-row">
                <table>
                    <tbody>
                        <? while ($row1 = mysql_fetch_assoc($ds_vt->result)) { ?>
                            <tr>
                                <td class="w-10"><?= $stt++ ?></td>
                                <td class="w-20 vat_tu_dh" data="<?= $row1['id_vat_tu'] ?>"><?= $all_vattu[$row1['id_vat_tu']]['dsvt_name'] ?></td>
                                <td class="w-10"><?= $all_vattu[$row1['id_vat_tu']]['hsx_name'] ?></td>
                                <td class="w-10"><?= $all_vattu[$row1['id_vat_tu']]['xx_name'] ?></td>
                                <td class="w-10"><?= $all_vattu[$row1['id_vat_tu']]['dvt_name'] ?></td>
                                <td class="w-10">
                                    <p class="tong_sluong"><?= $row1['so_luong_ky_nay'] ?></p>
                                </td>
                                <td class="w-10">
                                    <p class="don_gia"><?= $row1['don_gia'] ?></p>
                                </td>
                                <td class="w-10">
                                    <p class="tong_tienvt"><?= $row1['tong_tien_trvat'] ?></p>
                                </td>
                                <td class="w-10">
                                    <input type="text" name="kl_luy_ke_ky_truoc" data="<?= $row1['thue_vat'] ?>" value="0" class="tex_center" readonly>
                                </td>
                                <td class="w-10">
                                    <input type="text" name="kl_luy_ke_ky_nay" autocomplete="off" oninput="<?= $oninput ?>" class="tex_center" onkeyup="sl_hs_doi(this)">
                                </td>
                                <td class="w-10">
                                    <input type="text" name="kl_luy_ke_den_nay" data="" value="0" class="tex_center" readonly>
                                </td>
                                <td class="w-10">
                                    <input type="text" name="gt_luy_ke_ky_truoc" value="0" class="tex_center" readonly>
                                </td>
                                <td class="w-10">
                                    <input type="text" name="gt_luy_ke_ky_nay" class="tex_center" readonly>
                                </td>
                                <td class="w-10">
                                    <input type="text" name="gt_luy_ke_den_nay" data="" value="0" class="tex_center" readonly>
                                </td>
                                <td class="w-5">
                                    <input type="text" name="phan_tram_thuc_hien" class="tex_center" readonly>
                                </td>
                                <td class="w-10">
                                    <input type="text" name="con_lai_so_luong" class="tex_center" readonly>
                                </td>
                                <td class="w-10">
                                    <input type="text" name="con_lai_gia_tri" class="tex_center" readonly>
                                </td>
                            </tr>
                        <? } ?>
                        <tr class="bg-ed">
                            <td class="w-10 text-bold">T???ng c???ng tr?????c VAT</td>
                            <td class="w-20"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"><?= formatMoney($tien_trs['gia_tri_don_hang']) ?></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10">
                                <p class="tong_tien_ky_nay" data=""></p>
                            </td>
                            <td class="w-10"></td>
                            <td class="w-5"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                        </tr>
                        <tr class="bg-ed">
                            <td class="w-10 text-bold">Thu??? VAT</td>
                            <td class="w-20"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10">
                                <p class="tong_thue_vat"><?= $tien_trs['thue_vat'] ?></p>
                            </td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10">
                                <span class="thue_ky_nay"></span>
                            </td>
                            <td class="w-10"></td>
                            <td class="w-5"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                        </tr>
                        <tr class="bg-ed">
                            <td class="w-10 text-bold">Chi ph?? kh??c</td>
                            <td class="w-20"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10">
                                <input name="chi_phi_khac" class="chi_phi_khac" type="text" autocomplete="off" oninput="<?= $oninput ?>" onkeyup="chiphi_khac(this)" placeholder="Nh???p chi ph?? kh??c">
                            </td>
                            <td class="w-10"></td>
                            <td class="w-5"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                        </tr>
                        <tr class="bg-ed">
                            <td class="w-10 text-bold">T???ng c???ng sau VAT</td>
                            <td class="w-20"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"><?= formatMoney($tien_trs['gia_tri_svat']) ?></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10">
                                <p class="tong_tatca"></p>
                            </td>
                            <td class="w-10"></td>
                            <td class="w-5"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
<? }
    }
}
?>