<?
include("config.php");

$com_id = getValue('com_id', 'int', 'POST', '');
$id_hs = getValue('id_hs', 'int', 'POST', '');
$id_hd_dh = getValue('id_hd_dh', 'int', 'POST', '');
$loai_hs = getValue('loai_hs', 'int', 'POST', '');

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

$stt = 1;

if ($com_id != "" && $id_hs != "" && $loai_hs != "" && $id_hd_dh != "") {
    $hs_tt = mysql_fetch_assoc((new db_query("SELECT `id`, `id_hd_dh`, `loai_hs`, `dot_nghiem_thu`, `tg_nghiem_thu`, `thoi_han_thanh_toan`,
                                        `tong_tien_tt`, `tong_tien_thue`, `tong_tien_tatca`, `chi_phi_khac` FROM `ho_so_thanh_toan`
                                        WHERE `id_cong_ty` = $com_id AND `id` = $id_hs "))->result);
    if ($loai_hs == 1) {
        $tong_tien = mysql_fetch_assoc((new db_query("SELECT `gia_tri_trvat`, `thue_vat`, `gia_tri_svat`, `phan_loai` FROM `hop_dong`
                                                    WHERE `id_cong_ty` = $com_id AND `id` = $id_hd_dh "))->result);
        if ($tong_tien['phan_loai'] == 1 || $tong_tien['phan_loai'] == 2) {
            $ds_vt = new db_query("SELECT `id_vat_tu`, `so_luong`, `don_gia`, `tien_trvat` FROM `vat_tu_hd_dh` WHERE `id_hd_mua_ban` = $id_hd_dh "); ?>

            <div class="tbl-header">
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
                            <th class="w-20 border-bottom-w" colspan="2" scope="colgroup">Gi?? tr??? ????n h??ng c??n l???i</th>

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
                            $id_vt = $row1['id_vat_tu'];
                            $all_vt = mysql_fetch_assoc((new db_query("SELECT `id`, `kl_ky_nay`, `gia_tri_ky_nay` FROM `chi_tiet_hs`
                                                    WHERE `id_hs` = $id_hs AND `id_cong_ty` = $com_id AND `id_hd_dh` = $id_hd_dh AND `id_vat_tu` = $id_vt "))->result);

                            $sum_kl_kt = new db_query("SELECT SUM(c.`kl_ky_nay`) AS sum_one, SUM(c.`gia_tri_ky_nay`) AS sum_two FROM `chi_tiet_hs` AS c
                                                        INNER JOIN `ho_so_thanh_toan` AS h ON h.`id` = c.`id_hs`
                                                        WHERE h.`id_hd_dh` = $id_hd_dh AND h.`id_cong_ty` = $com_id
                                                        AND h.`loai_hs` = 2 AND c.`id_vat_tu` = $id_vt AND h.`id` != $id_hs ");
                            $list_sum = mysql_fetch_assoc($sum_kl_kt->result);
                            $sum_one = $list_sum['sum_one'];
                            $sum_two = $list_sum['sum_two']; ?>
                            <tr>
                                <td class="w-10 vat_tu_hs"><?= $stt++ ?></td>
                                <td class="w-20 vat_tu_dh"><?= $all_vattu[$row1['id_vat_tu']]['dsvt_name'] ?></td>
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
                                    <p><?= ($sum_one != 0) ? $sum_one : "0" ?></p>
                                </td>
                                <td class="w-10">
                                    <p><?= $all_vt['kl_ky_nay'] ?></p>
                                </td>
                                <td class="w-10">
                                    <p><?= $sum_one + $all_vt['kl_ky_nay'] ?></p>
                                </td>
                                <td class="w-10">
                                    <p><?= ($sum_two != 0) ? $sum_two : "0" ?></p>
                                </td>
                                <td class="w-10">
                                    <p><?= $all_vt['gia_tri_ky_nay'] ?></p>
                                </td>
                                <td class="w-10">
                                    <p><?= $sum_two + $all_vt['gia_tri_ky_nay'] ?></p>
                                </td>
                                <td class="w-5">
                                    <p><?= (($sum_two + $all_vt['gia_tri_ky_nay']) / $row1['tien_trvat']) * 100 ?></p>
                                </td>
                                <td class="w-10">
                                    <p><?= $row1['so_luong'] - ($sum_one + $all_vt['kl_ky_nay']) ?></p>
                                </td>
                                <td class="w-10">
                                    <p><?= $row1['tien_trvat'] - ($sum_two + $all_vt['gia_tri_ky_nay']) ?></p>
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
                            <td class="w-10"><?= $tong_tien['gia_tri_trvat'] ?></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10">
                                <p class="tong_tien_ky_nay"><?= $hs_tt['tong_tien_tt'] ?> </p>
                            </td>
                            <td class="w-10"></td>
                            <td class="w-5"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                        </tr>
                        <tr class="bg-ed">
                            <td class="w-10 text-bold">Thu??? VAT (%)</td>
                            <td class="w-20"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10">
                                <span class="tong_thue_vat"><?= $tong_tien['thue_vat'] ?></span>
                                <span>(<?= $tong_tien['thue_vat'] ?> %)</span>
                            </td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10">
                                <span class="thue_ky_nay"><?= $hs_tt['tong_tien_thue'] ?></span>
                                <span>(<?= $tong_tien['thue_vat'] ?>%)</span>
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
                                <p><?= $hs_tt['chi_phi_khac'] ?></p>
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
                            <td class="w-10"><?= $tong_tien['gia_tri_svat'] ?></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10">
                                <p class="tong_tatca"><?= $hs_tt['tong_tien_tatca'] ?></p>
                            </td>
                            <td class="w-10"></td>
                            <td class="w-5"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        <? } else if ($tong_tien['phan_loai'] == 3) {
            $ds_vt = new db_query("SELECT `id_vat_tu_thiet_bi`, `khoi_luong_du_kien`, `don_gia_thue`, `dg_ca_may_phu_troi`, `thanh_tien_du_kien`
                                FROM `vat_tu_hd_thue` WHERE `id_hd_thue` = $id_hd_dh "); ?>

            <div class="tbl-header">
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
                            <th class="w-20 border-bottom-w" colspan="2" scope="colgroup">Gi?? tr??? ????n h??ng c??n l???i</th>

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
                            $id_vt = $row1['id_vat_tu_thiet_bi'];
                            $all_vt = mysql_fetch_assoc((new db_query("SELECT `id`, `kl_ky_nay`, `gia_tri_ky_nay` FROM `chi_tiet_hs`
                                                    WHERE `id_hs` = $id_hs AND `id_cong_ty` = $com_id AND `id_hd_dh` = $id_hd_dh AND `id_vat_tu` = $id_vt "))->result);

                            $sum_kl_kt = new db_query("SELECT SUM(c.`kl_ky_nay`) AS sum_one, SUM(c.`gia_tri_ky_nay`) AS sum_two FROM `chi_tiet_hs` AS c
                                                        INNER JOIN `ho_so_thanh_toan` AS h ON h.`id` = c.`id_hs`
                                                        WHERE h.`id_hd_dh` = $id_hd_dh AND h.`id_cong_ty` = $com_id
                                                        AND h.`loai_hs` = 1 AND c.`id_vat_tu` = $id_vt AND h.`id` != $id_hs ");
                            $list_sum = mysql_fetch_assoc($sum_kl_kt->result);
                            $sum_one = $list_sum['sum_one'];
                            $sum_two = $list_sum['sum_two'];
                        ?>
                            <tr>
                                <td class="w-10 vat_tu_hs" data="<?= $all_vt['id'] ?>"><?= $stt++ ?></td>
                                <td class="w-20 vat_tu_dh" data="<?= $row1['id_vat_tu_thiet_bi'] ?>"><?= $all_vattu[$row1['id_vat_tu_thiet_bi']]['dsvt_name'] ?></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
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
                                    <p><?= ($sum_one != 0) ? $sum_one : "0" ?></p>
                                </td>
                                <td class="w-10">
                                    <p><?= $all_vt['kl_ky_nay'] ?></p>
                                </td>
                                <td class="w-10">
                                    <p><?= $sum_one + $all_vt['kl_ky_nay'] ?></p>
                                </td>
                                <td class="w-10">
                                    <p><?= ($sum_two != 0) ? $sum_two : "0" ?></p>
                                </td>
                                <td class="w-10">
                                    <p><?= $all_vt['gia_tri_ky_nay'] ?></p>
                                </td>
                                <td class="w-10">
                                    <p><?= $sum_two + $all_vt['gia_tri_ky_nay'] ?></p>
                                </td>
                                <td class="w-5">
                                    <p><?= (($sum_two + $all_vt['gia_tri_ky_nay']) / $row1['thanh_tien_du_kien']) * 100 ?></p>
                                </td>
                                <td class="w-10">
                                    <p><?= $row1['khoi_luong_du_kien'] - ($sum_one + $all_vt['kl_ky_nay']) ?></p>
                                </td>
                                <td class="w-10">
                                    <p><?= $row1['thanh_tien_du_kien'] - ($sum_two + $all_vt['gia_tri_ky_nay']) ?></p>
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
                            <td class="w-10"><?= $tong_tien['gia_tri_trvat'] ?></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10">
                                <p class="tong_tien_ky_nay"><?= $hs_tt['tong_tien_tt'] ?> </p>
                            </td>
                            <td class="w-10"></td>
                            <td class="w-5"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                        </tr>
                        <tr class="bg-ed">
                            <td class="w-10 text-bold">Thu??? VAT (%)</td>
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
                                <p>0</p>
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
                                <p><?= $hs_tt['chi_phi_khac'] ?></p>
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
                            <td class="w-10"><?= $tong_tien['gia_tri_svat'] ?></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10">
                                <p class="tong_tatca"><?= $hs_tt['tong_tien_tatca'] ?></p>
                            </td>
                            <td class="w-10"></td>
                            <td class="w-5"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        <? } else if ($tong_tien['phan_loai'] == 4) {
            $ds_vt = new db_query("SELECT `vat_tu`, `don_vi_tinh`, `khoi_luong`, `don_gia`, `thanh_tien` FROM `vat_tu_hd_vc` WHERE `id_hd_vc` = $id_hd_dh "); ?>

            <div class="tbl-header">
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
                            <th class="w-20 border-bottom-w" colspan="2" scope="colgroup">Gi?? tr??? ????n h??ng c??n l???i</th>

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
                            $id_vt = $row1['vat_tu'];
                            $all_vt = mysql_fetch_assoc((new db_query("SELECT `id`, `kl_ky_nay`, `gia_tri_ky_nay` FROM `chi_tiet_hs`
                                                    WHERE `id_hs` = $id_hs AND `id_cong_ty` = $com_id AND `id_hd_dh` = $id_hd_dh AND `id_vat_tu` = $id_vt "))->result);

                            $sum_kl_kt = new db_query("SELECT SUM(c.`kl_ky_nay`) AS sum_one, SUM(c.`gia_tri_ky_nay`) AS sum_two FROM `chi_tiet_hs` AS c
                                                        INNER JOIN `ho_so_thanh_toan` AS h ON h.`id` = c.`id_hs`
                                                        WHERE h.`id_hd_dh` = $id_hd_dh AND h.`id_cong_ty` = $com_id
                                                        AND h.`loai_hs` = 1 AND c.`id_vat_tu` = $id_vt AND h.`id` != $id_hs ");
                            $list_sum = mysql_fetch_assoc($sum_kl_kt->result);
                            $sum_one = $list_sum['sum_one'];
                            $sum_two = $list_sum['sum_two'];
                        ?>
                            <tr>
                                <td class="w-10 vat_tu_hs" data="<?= $all_vt['id'] ?>"><?= $stt++ ?></td>
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
                                    <p><?= ($sum_one != 0) ? $sum_one : "0" ?></p>
                                </td>
                                <td class="w-10">
                                    <p><?= $all_vt['kl_ky_nay'] ?></p>
                                </td>
                                <td class="w-10">
                                    <p><?= $sum_one + $all_vt['kl_ky_nay'] ?></p>
                                </td>
                                <td class="w-10">
                                    <p><?= ($sum_two != 0) ? $sum_two : "0" ?></p>
                                </td>
                                <td class="w-10">
                                    <p><?= $all_vt['gia_tri_ky_nay'] ?></p>
                                </td>
                                <td class="w-10">
                                    <p><?= $sum_two + $all_vt['gia_tri_ky_nay'] ?></p>
                                </td>
                                <td class="w-5">
                                    <p><?= (($sum_two + $all_vt['gia_tri_ky_nay']) / $row1['thanh_tien']) * 100 ?></p>
                                </td>
                                <td class="w-10">
                                    <p><?= $row1['khoi_luong'] - ($sum_one + $all_vt['kl_ky_nay']) ?></p>
                                </td>
                                <td class="w-10">
                                    <p><?= $row1['thanh_tien'] - ($sum_two + $all_vt['gia_tri_ky_nay']) ?></p>
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
                            <td class="w-10"><?= $tong_tien['gia_tri_trvat'] ?></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10">
                                <p class="tong_tien_ky_nay"><?= $hs_tt['tong_tien_tt'] ?> </p>
                            </td>
                            <td class="w-10"></td>
                            <td class="w-5"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                        </tr>
                        <tr class="bg-ed">
                            <td class="w-10 text-bold">Thu??? VAT (%)</td>
                            <td class="w-20"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10">
                                <span class="tong_thue_vat"><?= ($tong_tien['gia_tri_trvat'] * $tong_tien['thue_vat']) / 100 ?></span>
                                <span class="thue_vt" data="<?= $tong_tien['thue_vat'] ?>">(<?= $tong_tien['thue_vat'] ?> %)</span>
                            </td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10">
                                <span class="thue_ky_nay"><?= $hs_tt['tong_tien_thue'] ?></span>
                                <span>(<?= $tong_tien['thue_vat'] ?>%)</span>
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
                                <p><?= $hs_tt['chi_phi_khac'] ?></p>
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
                            <td class="w-10"><?= $tong_tien['gia_tri_svat'] ?></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10">
                                <p class="tong_tatca"><?= $hs_tt['tong_tien_tatca'] ?></p>
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
    } else if ($loai_hs == 2) {
        $tong_tien = mysql_fetch_assoc((new db_query("SELECT `gia_tri_don_hang`, `thue_vat`, `gia_tri_svat` FROM `don_hang`
                                                    WHERE `id` = $id_hd_dh AND `id_cong_ty` = $com_id "))->result);

        $ds_vt = new db_query("SELECT `id_vat_tu`, `so_luong_ky_nay`, `don_gia`, `tong_tien_trvat` FROM `vat_tu_dh_mua_ban` WHERE `id_don_hang` = $id_hd_dh AND `id_cong_ty` = $com_id "); ?>

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
                        <th class="w-20 border-bottom-w" colspan="2" scope="colgroup">Gi?? tr??? ????n h??ng c??n l???i</th>

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
                        $id_vt = $row1['id_vat_tu'];
                        $all_vt = mysql_fetch_assoc((new db_query("SELECT `id`, `kl_ky_nay`, `gia_tri_ky_nay` FROM `chi_tiet_hs`
                                                    WHERE `id_hs` = $id_hs AND `id_cong_ty` = $com_id AND `id_hd_dh` = $id_hd_dh AND `id_vat_tu` = $id_vt "))->result);

                        $sum_kl_kt = new db_query("SELECT SUM(c.`kl_ky_nay`) AS sum_one, SUM(c.`gia_tri_ky_nay`) AS sum_two FROM `chi_tiet_hs` AS c
                                                        INNER JOIN `ho_so_thanh_toan` AS h ON h.`id` = c.`id_hs`
                                                        WHERE h.`id_hd_dh` = $id_hd_dh AND h.`id_cong_ty` = $com_id
                                                        AND h.`loai_hs` = 2 AND c.`id_vat_tu` = $id_vt AND h.`id` != $id_hs ");
                        $list_sum = mysql_fetch_assoc($sum_kl_kt->result);
                        $sum_one = $list_sum['sum_one'];
                        $sum_two = $list_sum['sum_two']; ?>
                        <tr>
                            <td class="w-10 vat_tu_hs" data="<?= $all_vt['id'] ?>"><?= $stt++ ?></td>
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
                                <p><?= $sum_one ?></p>
                            </td>
                            <td class="w-10">
                                <p><?= $all_vt['kl_ky_nay'] ?></p>
                            </td>
                            <td class="w-10">
                                <p><?= $sum_one + $all_vt['kl_ky_nay'] ?></p>
                            </td>
                            <td class="w-10">
                                <p><?= $sum_two ?></p>
                            </td>
                            <td class="w-10">
                                <p><?= $all_vt['gia_tri_ky_nay'] ?></p>
                            </td>
                            <td class="w-10">
                                <p><?= $sum_two + $all_vt['gia_tri_ky_nay'] ?></p>
                            </td>
                            <td class="w-5">
                                <p><?= (($sum_two + $all_vt['gia_tri_ky_nay']) / $row1['tong_tien_trvat']) * 100 ?></p>
                            </td>
                            <td class="w-10">
                                <p><?= $row1['so_luong_ky_nay'] - ($sum_one + $all_vt['kl_ky_nay']) ?></p>
                            </td>
                            <td class="w-10">
                                <p><?= $row1['tong_tien_trvat'] - ($sum_two + $all_vt['gia_tri_ky_nay']) ?></p>
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
                        <td class="w-10"><?= $tong_tien['gia_tri_don_hang'] ?></td>
                        <td class="w-10"></td>
                        <td class="w-10"></td>
                        <td class="w-10"></td>
                        <td class="w-10"></td>
                        <td class="w-10">
                            <p class="tong_tien_ky_nay"><?= $hs_tt['tong_tien_tt'] ?> </p>
                        </td>
                        <td class="w-10"></td>
                        <td class="w-5"></td>
                        <td class="w-10"></td>
                        <td class="w-10"></td>
                    </tr>
                    <tr class="bg-ed">
                        <td class="w-10 text-bold">Thu??? VAT (%)</td>
                        <td class="w-20"></td>
                        <td class="w-10"></td>
                        <td class="w-10"></td>
                        <td class="w-10"></td>
                        <td class="w-10"></td>
                        <td class="w-10"></td>
                        <td class="w-10">
                            <span class="tong_thue_vat"><?= $tong_tien['thue_vat'] ?></span>
                            <span>(<?= $tong_tien['thue_vat'] ?> %)</span>
                        </td>
                        <td class="w-10"></td>
                        <td class="w-10"></td>
                        <td class="w-10"></td>
                        <td class="w-10"></td>
                        <td class="w-10">
                            <span class="thue_ky_nay"><?= $hs_tt['tong_tien_thue'] ?></span>
                            <span>(<?= $tong_tien['thue_vat'] ?>%)</span>
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
                            <p><?= $hs_tt['chi_phi_khac'] ?></p>
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
                        <td class="w-10"><?= $tong_tien['gia_tri_svat'] ?></td>
                        <td class="w-10"></td>
                        <td class="w-10"></td>
                        <td class="w-10"></td>
                        <td class="w-10"></td>
                        <td class="w-10">
                            <p class="tong_tatca"><?= $hs_tt['tong_tien_tatca'] ?></p>
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
} ?>