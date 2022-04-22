<?
include("config.php");
$com_id = getValue('com_id', 'int', 'POST', '');
$id_hs = getValue('id_hs', 'int', 'POST', '');
$loai_hs = getValue('loai_hs', 'int', 'POST', '');
$id_hd_dh = getValue('id_hd_dh', 'int', 'POST', '');

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

if ($com_id != "" && $id_hs != "" && $id_hd_dh != "" && $loai_hs != "") {

    $ds_vattu_hs = new db_query("SELECT `id`, `id_vat_tu`, `kl_ky_nay`, `gia_tri_ky_nay`, `ngay_tao`, `id_cong_ty`
                                FROM `chi_tiet_hs` WHERE `id_hs` = $id_hs AND `id_hd_dh` = $id_hd_dh ");

    $hs_tt = mysql_fetch_assoc((new db_query("SELECT `id`, `id_hd_dh`, `loai_hs`, `dot_nghiem_thu`, `tg_nghiem_thu`, `thoi_han_thanh_toan`, `tong_tien_tatca`,
                                            `tong_tien_tt`, `tong_tien_thue`, `chi_phi_khac` FROM `ho_so_thanh_toan` WHERE `id_cong_ty` = $com_id
                                            AND `id` = $id_hs AND `id_hd_dh` = $id_hd_dh "))->result);

    if ($loai_hs == 1) {
        $tong_tien = mysql_fetch_assoc((new db_query("SELECT `id_du_an_ctrinh`, `gia_tri_trvat`, `thue_vat`, `gia_tri_svat`
                                                        FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `id` = $id_hd_dh "))->result);

        $check_tt = new db_query("SELECT DISTINCT h.`id_hd_dh` FROM `ho_so_thanh_toan` AS h INNER JOIN `chi_tiet_hs` AS c ON h.`id` = c.`id_hs`
                                WHERE h.`id_cong_ty` = $com_id AND h.`loai_hs` = 1 AND h.`id_hd_dh` = $id_hd_dh AND h.`id` = $id_hs ");

        $check_ttai = new db_query("SELECT DISTINCT h.`id_hd_dh` FROM `ho_so_thanh_toan` AS h INNER JOIN `chi_tiet_hs` AS c ON h.`id` = c.`id_hs`
                                    WHERE h.`id_cong_ty` = $com_id AND h.`loai_hs` = 1 AND h.`id_hd_dh` = $id_hd_dh ");

        $ploai = mysql_fetch_assoc((new db_query("SELECT `phan_loai` FROM `hop_dong` WHERE `id_cong_ty` = $com_id AND `id` = $id_hd_dh "))->result)['phan_loai'];
        if ($ploai == 1 || $ploai == 2) {
            $ds_vt = new db_query("SELECT `id_vat_tu`, `so_luong`, `don_gia`, `tien_trvat`, `thue_vat`, `tien_svat`
                                    FROM `vat_tu_hd_dh` WHERE `id_hd_mua_ban` = $id_hd_dh ");
            if (mysql_num_rows($check_tt->result) > 0) { ?>
                <div class="tbl-header">
                    <table>
                        <thead>
                            <tr>
                                <th class="w-10" rowspan="2">STT</th>
                                <th class="w-20" rowspan="2">Tên vật tư</th>
                                <th class="w-10" rowspan="2">Hãng sản xuất</th>
                                <th class="w-10" rowspan="2">Xuất xứ</th>
                                <th class="w-10" rowspan="2">Đơn vị tính</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Hợp đồng</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Khối lượng thực hiện</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Giá trị thực hiện</th>
                                <th class="w-5" rowspan="2">% Thực hiện</th>
                                <th class="w-20 border-bottom-w" colspan="2" scope="colgroup">Giá trị đơn hàng còn lại</th>

                            </tr>
                            <tr class="border-top-w">
                                <th scope="colgroup">Số lượng</th>
                                <th scope="colgroup">Đơn giá(VNĐ)</th>
                                <th scope="colgroup">Giá trị(VNĐ)</th>
                                <th scope="colgroup">Lũy kế kỳ trước</th>
                                <th scope="colgroup">Kỳ này</th>
                                <th scope="colgroup">Lũy kế đến nay</th>
                                <th scope="colgroup">Lũy kế kỳ trước(VNĐ)</th>
                                <th scope="colgroup">Kỳ này(VNĐ)</th>
                                <th scope="colgroup">Lũy kế đến nay(VNĐ)</th>
                                <th scope="colgroup">Số lượng</th>
                                <th scope="colgroup">Giá trị(VNĐ)</th>

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
                                        <p class="tong_sluong"><?= $row1['so_luong'] ?></p>
                                    </td>
                                    <td class="w-10">
                                        <p class="don_gia"><?= $row1['don_gia'] ?></p>
                                    </td>
                                    <td class="w-10">
                                        <p class="tong_tienvt"><?= $row1['tien_trvat'] ?></p>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="kl_luy_ke_ky_truoc" data="<?= $row1['thue_vat'] ?>" value="<?= ($sum_one != 0) ? $sum_one : "0" ?>" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="kl_luy_ke_ky_nay" autocomplete="off" oninput="<?= $oninput ?>" value="<?= $all_vt['kl_ky_nay'] ?>" class="tex_center" onkeyup="sl_hs_doi(this)">
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="kl_luy_ke_den_nay" data="<?= ($all_vt['gia_tri_ky_nay'] * $row1['thue_vat']) / 100 ?>" value="<?= $sum_one + $all_vt['kl_ky_nay'] ?>" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_ky_truoc" value="<?= ($sum_two != 0) ? $sum_two : "0" ?>" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_ky_nay" class="tex_center" value="<?= $all_vt['gia_tri_ky_nay'] ?>" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_den_nay" data="<?= $all_vt['gia_tri_ky_nay'] + (($all_vt['gia_tri_ky_nay'] * $row1['thue_vat']) / 100) ?>" value="<?= $sum_two + $all_vt['gia_tri_ky_nay'] ?>" class="tex_center" readonly>
                                    </td>
                                    <td class="w-5">
                                        <input type="text" name="phan_tram_thuc_hien" value="<?= (($sum_two + $all_vt['gia_tri_ky_nay']) / $row1['tien_trvat']) * 100 ?>" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="con_lai_so_luong" value="<?= $row1['so_luong'] - ($sum_one + $all_vt['kl_ky_nay']) ?>" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="con_lai_gia_tri" value="<?= $row1['tien_trvat'] - ($sum_two + $all_vt['gia_tri_ky_nay']) ?>" class="tex_center" readonly>
                                    </td>
                                </tr>
                            <? } ?>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">Tổng cộng trước VAT</td>
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
                                <td class="w-10 text-bold">Thuế VAT</td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <span class="tong_thue_vat"><?= $tong_tien['thue_vat'] ?></span>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <span class="thue_ky_nay"><?= $hs_tt['tong_tien_thue'] ?></span>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">Chi phí khác</td>
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
                                    <input name="chi_phi_khac" class="chi_phi_khac tex_center" value="<?= $hs_tt['chi_phi_khac'] ?>" type="text" oninput="<?= $oninput ?>" onkeyup="chiphi_khac(this)" placeholder="Nhập chi phí khác">
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">Tổng cộng sau VAT</td>
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
            <? } else {
                if (mysql_num_rows($check_ttai->result) > 0) { ?>
                    <div class="tbl-header">
                        <table>
                            <thead>
                                <tr>
                                    <th class="w-10" rowspan="2">STT</th>
                                    <th class="w-20" rowspan="2">Tên vật tư</th>
                                    <th class="w-10" rowspan="2">Hãng sản xuất</th>
                                    <th class="w-10" rowspan="2">Xuất xứ</th>
                                    <th class="w-10" rowspan="2">Đơn vị tính</th>
                                    <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Hợp đồng</th>
                                    <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Khối lượng thực hiện</th>
                                    <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Giá trị thực hiện</th>
                                    <th class="w-5" rowspan="2">% Thực hiện</th>
                                    <th class="w-20 border-bottom-w" colspan="2" scope="colgroup">Giá trị thực hiện</th>

                                </tr>
                                <tr class="border-top-w">
                                    <th scope="colgroup">Số lượng</th>
                                    <th scope="colgroup">Đơn giá(VNĐ)</th>
                                    <th scope="colgroup">Giá trị(VNĐ)</th>
                                    <th scope="colgroup">Lũy kế kỳ trước</th>
                                    <th scope="colgroup">Kỳ này</th>
                                    <th scope="colgroup">Lũy kế đến nay</th>
                                    <th scope="colgroup">Lũy kế kỳ trước(VNĐ)</th>
                                    <th scope="colgroup">Kỳ này(VNĐ)</th>
                                    <th scope="colgroup">Lũy kế đến nay(VNĐ)</th>
                                    <th scope="colgroup">Số lượng</th>
                                    <th scope="colgroup">Giá trị(VNĐ)</th>

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
                                            <p class="tong_tienvt"><?= $row1['tien_svat'] ?></p>
                                        </td>
                                        <?
                                        $id_vtu = $row1['id_vat_tu'];
                                        $sum_kl_kt = new db_query("SELECT SUM(c.`kl_ky_nay`) AS sum_one, SUM(c.`gia_tri_ky_nay`) AS sum_two FROM `chi_tiet_hs` AS c
                                                                        INNER JOIN `ho_so_thanh_toan` AS h ON h.`id` = c.`id_hs`
                                                                        WHERE h.`id_hd_dh` = $id_hd_dh AND h.`id_cong_ty` = $com_id AND h.`loai_hs` = 1
                                                                        AND c.`id_vat_tu` = $id_vtu ");
                                        $list_sum = mysql_fetch_assoc($sum_kl_kt->result);
                                        $sum_one = $list_sum['sum_one'];
                                        $sum_two = $list_sum['sum_two'];
                                        ?>
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
                                            <input type="text" name="phan_tram_thuc_hien" value="<?= ($sum_two * 100) / $row1['tien_svat'] ?>" class="tex_center" readonly>
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
                                    <td class="w-10 text-bold">Tổng cộng trước VAT</td>
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
                                        <p class="tong_tien_ky_nay" data=""></p>
                                    </td>
                                    <td class="w-10"></td>
                                    <td class="w-5"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                </tr>
                                <tr class="bg-ed">
                                    <td class="w-10 text-bold">Thuế VAT</td>
                                    <td class="w-20"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10">
                                        <span class="tong_thue_vat"><?= $tong_tien['thue_vat'] ?></span>
                                        <span></span>
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
                                    <td class="w-10 text-bold">Chi phí khác</td>
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
                                        <input name="chi_phi_khac" class="chi_phi_khac" type="text" oninput="<?= $oninput ?>" onkeyup="chiphi_khac(this)" placeholder="Nhập chi phí khác">
                                    </td>
                                    <td class="w-10"></td>
                                    <td class="w-5"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                </tr>
                                <tr class="bg-ed">
                                    <td class="w-10 text-bold">Tổng cộng sau VAT</td>
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
                                    <th class="w-20" rowspan="2">Tên vật tư</th>
                                    <th class="w-10" rowspan="2">Hãng sản xuất</th>
                                    <th class="w-10" rowspan="2">Xuất xứ</th>
                                    <th class="w-10" rowspan="2">Đơn vị tính</th>
                                    <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Hợp đồng</th>
                                    <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Khối lượng thực hiện</th>
                                    <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Giá trị thực hiện</th>
                                    <th class="w-5" rowspan="2">% Thực hiện</th>
                                    <th class="w-20 border-bottom-w" colspan="2" scope="colgroup">Giá trị thực hiện</th>

                                </tr>
                                <tr class="border-top-w">
                                    <th scope="colgroup">Số lượng</th>
                                    <th scope="colgroup">Đơn giá(VNĐ)</th>
                                    <th scope="colgroup">Giá trị(VNĐ)</th>
                                    <th scope="colgroup">Lũy kế kỳ trước</th>
                                    <th scope="colgroup">Kỳ này</th>
                                    <th scope="colgroup">Lũy kế đến nay</th>
                                    <th scope="colgroup">Lũy kế kỳ trước(VNĐ)</th>
                                    <th scope="colgroup">Kỳ này(VNĐ)</th>
                                    <th scope="colgroup">Lũy kế đến nay(VNĐ)</th>
                                    <th scope="colgroup">Số lượng</th>
                                    <th scope="colgroup">Giá trị(VNĐ)</th>

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
                                    <td class="w-10 text-bold">Tổng cộng trước VAT</td>
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
                                        <p class="tong_tien_ky_nay" data=""></p>
                                    </td>
                                    <td class="w-10"></td>
                                    <td class="w-5"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                </tr>
                                <tr class="bg-ed">
                                    <td class="w-10 text-bold">Thuế VAT</td>
                                    <td class="w-20"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10">
                                        <span class="tong_thue_vat"><?= $tong_tien['thue_vat'] ?></span>
                                        <span></span>
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
                                    <td class="w-10 text-bold">Chi phí khác</td>
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
                                        <input name="chi_phi_khac" class="chi_phi_khac" type="text" oninput="<?= $oninput ?>" autocomplete="off" onkeyup="chiphi_khac(this)" placeholder="Nhập chi phí khác">
                                    </td>
                                    <td class="w-10"></td>
                                    <td class="w-5"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                </tr>
                                <tr class="bg-ed">
                                    <td class="w-10 text-bold">Tổng cộng sau VAT</td>
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
        } else if ($ploai == 3) {
            $ds_vt = new db_query("SELECT `id_vat_tu_thiet_bi`, `so_luong`, `hinh_thuc_thue`, `khoi_luong_du_kien`, `han_muc_ca_may`,
                                    `don_gia_thue`, `dg_ca_may_phu_troi`, `thanh_tien_du_kien` FROM `vat_tu_hd_thue` WHERE `id_hd_thue` = $id_hd_dh ");
            if (mysql_num_rows($check_tt->result) > 0) { ?>
                <div class="tbl-header">
                    <table>
                        <thead>
                            <tr>
                                <th class="w-10" rowspan="2">STT</th>
                                <th class="w-20" rowspan="2">Tên vật tư</th>
                                <th class="w-10" rowspan="2">Hãng sản xuất</th>
                                <th class="w-10" rowspan="2">Xuất xứ</th>
                                <th class="w-10" rowspan="2">Đơn vị tính</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Hợp đồng</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Khối lượng thực hiện</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Giá trị thực hiện</th>
                                <th class="w-5" rowspan="2">% Thực hiện</th>
                                <th class="w-20 border-bottom-w" colspan="2" scope="colgroup">Giá trị đơn hàng còn lại</th>

                            </tr>
                            <tr class="border-top-w">
                                <th scope="colgroup">Số lượng</th>
                                <th scope="colgroup">Đơn giá(VNĐ)</th>
                                <th scope="colgroup">Giá trị(VNĐ)</th>
                                <th scope="colgroup">Lũy kế kỳ trước</th>
                                <th scope="colgroup">Kỳ này</th>
                                <th scope="colgroup">Lũy kế đến nay</th>
                                <th scope="colgroup">Lũy kế kỳ trước(VNĐ)</th>
                                <th scope="colgroup">Kỳ này(VNĐ)</th>
                                <th scope="colgroup">Lũy kế đến nay(VNĐ)</th>
                                <th scope="colgroup">Số lượng</th>
                                <th scope="colgroup">Giá trị(VNĐ)</th>

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
                                        <input type="text" name="kl_luy_ke_ky_truoc" value="<?= ($sum_one != 0) ? $sum_one : "0" ?>" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="kl_luy_ke_ky_nay" autocomplete="off" oninput="<?= $oninput ?>" value="<?= $all_vt['kl_ky_nay'] ?>" class="tex_center" onkeyup="klt_hs_doi(this)">
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="kl_luy_ke_den_nay" value="<?= $sum_one + $all_vt['kl_ky_nay'] ?>" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_ky_truoc" value="<?= ($sum_two != 0) ? $sum_two : "0" ?>" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_ky_nay" class="tex_center" value="<?= $all_vt['gia_tri_ky_nay'] ?>" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_den_nay" value="<?= $sum_two + $all_vt['gia_tri_ky_nay'] ?>" class="tex_center" readonly>
                                    </td>
                                    <td class="w-5">
                                        <input type="text" name="phan_tram_thuc_hien" value="<?= (($sum_two + $all_vt['gia_tri_ky_nay']) / $row1['thanh_tien_du_kien']) * 100 ?>" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="con_lai_so_luong" value="<?= $row1['khoi_luong_du_kien'] - ($sum_one + $all_vt['kl_ky_nay']) ?>" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="con_lai_gia_tri" value="<?= $row1['thanh_tien_du_kien'] - ($sum_two + $all_vt['gia_tri_ky_nay']) ?>" class="tex_center" readonly>
                                    </td>
                                </tr>
                            <? } ?>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">Tổng cộng trước VAT</td>
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
                                <td class="w-10 text-bold">Thuế VAT </td>
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
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">Chi phí khác</td>
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
                                    <input name="chi_phi_khac" class="chi_phi_khac tex_center" value="<?= $hs_tt['chi_phi_khac'] ?>" type="text" oninput="<?= $oninput ?>" onkeyup="chiphi_khac_vc(this)" placeholder="Nhập chi phí khác">
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">Tổng cộng sau VAT</td>
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
            <? } else {
                if (mysql_num_rows($check_ttai->result) > 0) { ?>
                    <div class="tbl-header">
                        <table>
                            <thead>
                                <tr>
                                    <th class="w-10" rowspan="2">STT</th>
                                    <th class="w-20" rowspan="2">Tên vật tư</th>
                                    <th class="w-10" rowspan="2">Hãng sản xuất</th>
                                    <th class="w-10" rowspan="2">Xuất xứ</th>
                                    <th class="w-10" rowspan="2">Đơn vị tính</th>
                                    <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Hợp đồng</th>
                                    <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Khối lượng thực hiện</th>
                                    <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Giá trị thực hiện</th>
                                    <th class="w-5" rowspan="2">% Thực hiện</th>
                                    <th class="w-20 border-bottom-w" colspan="2" scope="colgroup">Giá trị thực hiện</th>

                                </tr>
                                <tr class="border-top-w">
                                    <th scope="colgroup">Số lượng</th>
                                    <th scope="colgroup">Đơn giá(VNĐ)</th>
                                    <th scope="colgroup">Giá trị(VNĐ)</th>
                                    <th scope="colgroup">Lũy kế kỳ trước</th>
                                    <th scope="colgroup">Kỳ này</th>
                                    <th scope="colgroup">Lũy kế đến nay</th>
                                    <th scope="colgroup">Lũy kế kỳ trước(VNĐ)</th>
                                    <th scope="colgroup">Kỳ này(VNĐ)</th>
                                    <th scope="colgroup">Lũy kế đến nay(VNĐ)</th>
                                    <th scope="colgroup">Số lượng</th>
                                    <th scope="colgroup">Giá trị(VNĐ)</th>

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
                                                                        WHERE h.`id_hd_dh` = $id_hd_dh AND h.`id_cong_ty` = $com_id AND h.`loai_hs` = 1
                                                                        AND c.`id_vat_tu` = $id_vtu ");
                                        $list_sum = mysql_fetch_assoc($sum_kl_kt->result);
                                        $sum_one = $list_sum['sum_one'];
                                        $sum_two = $list_sum['sum_two'];
                                        ?>
                                        <td class="w-10">
                                            <input type="text" name="kl_luy_ke_ky_truoc" class="tex_center" value="<?= ($sum_one == 0) ? "0" : $sum_one ?>" readonly>
                                        </td>
                                        <td class="w-10">
                                            <? if ($sum_one != $row1['khoi_luong_du_kien']) { ?>
                                                <input type="text" name="kl_luy_ke_ky_nay" autocomplete="off" oninput="<?= $oninput ?>" class="tex_center" onkeyup="klt_hs_doi(this)">
                                            <? } else { ?>
                                                <input type="text" name="kl_luy_ke_ky_nay" oninput="<?= $oninput ?>" class="tex_center" readonly>
                                            <? } ?>
                                        </td>
                                        <td class="w-10">
                                            <input type="text" name="kl_luy_ke_den_nay" class="tex_center" value="<?= ($sum_one == 0) ? "0" : $sum_one ?>" readonly>
                                        </td>
                                        <td class="w-10">
                                            <input type="text" name="gt_luy_ke_ky_truoc" class="tex_center" value="<?= ($sum_two == 0) ? "0" : $sum_two ?>" readonly>
                                        </td>
                                        <td class="w-10">
                                            <input type="text" name="gt_luy_ke_ky_nay" class="tex_center" readonly>
                                        </td>
                                        <td class="w-10">
                                            <input type="text" name="gt_luy_ke_den_nay" class="tex_center" value="<?= ($sum_two == 0) ? "0" : $sum_two ?>" readonly>
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
                                    <td class="w-10 text-bold">Tổng cộng trước VAT</td>
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
                                        <p class="tong_tien_ky_nay" data=""></p>
                                    </td>
                                    <td class="w-10"></td>
                                    <td class="w-5"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                </tr>
                                <tr class="bg-ed">
                                    <td class="w-10 text-bold">Thuế VAT</td>
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
                                    <td class="w-10 text-bold">Chi phí khác</td>
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
                                        <input name="chi_phi_khac" class="chi_phi_khac" type="text" oninput="<?= $oninput ?>" onkeyup="chiphi_khac_thue(this)" placeholder="Nhập chi phí khác">
                                    </td>
                                    <td class="w-10"></td>
                                    <td class="w-5"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                </tr>
                                <tr class="bg-ed">
                                    <td class="w-10 text-bold">Tổng cộng sau VAT</td>
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
                                    <th class="w-20" rowspan="2">Tên vật tư</th>
                                    <th class="w-10" rowspan="2">Hãng sản xuất</th>
                                    <th class="w-10" rowspan="2">Xuất xứ</th>
                                    <th class="w-10" rowspan="2">Đơn vị tính</th>
                                    <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Hợp đồng</th>
                                    <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Khối lượng thực hiện</th>
                                    <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Giá trị thực hiện</th>
                                    <th class="w-5" rowspan="2">% Thực hiện</th>
                                    <th class="w-20 border-bottom-w" colspan="2" scope="colgroup">Giá trị thực hiện</th>

                                </tr>
                                <tr class="border-top-w">
                                    <th scope="colgroup">Số lượng</th>
                                    <th scope="colgroup">Đơn giá(VNĐ)</th>
                                    <th scope="colgroup">Giá trị(VNĐ)</th>
                                    <th scope="colgroup">Lũy kế kỳ trước</th>
                                    <th scope="colgroup">Kỳ này</th>
                                    <th scope="colgroup">Lũy kế đến nay</th>
                                    <th scope="colgroup">Lũy kế kỳ trước(VNĐ)</th>
                                    <th scope="colgroup">Kỳ này(VNĐ)</th>
                                    <th scope="colgroup">Lũy kế đến nay(VNĐ)</th>
                                    <th scope="colgroup">Số lượng</th>
                                    <th scope="colgroup">Giá trị(VNĐ)</th>

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
                                            <input type="text" name="kl_luy_ke_ky_truoc" value="0" class="tex_center" readonly>
                                        </td>
                                        <td class="w-10">
                                            <input type="text" name="kl_luy_ke_ky_nay" autocomplete="off" oninput="<?= $oninput ?>" class="tex_center" onkeyup="klt_hs_doi(this)">
                                        </td>
                                        <td class="w-10">
                                            <input type="text" name="kl_luy_ke_den_nay" value="0" class="tex_center" readonly>
                                        </td>
                                        <td class="w-10">
                                            <input type="text" name="gt_luy_ke_ky_truoc" value="0" class="tex_center" readonly>
                                        </td>
                                        <td class="w-10">
                                            <input type="text" name="gt_luy_ke_ky_nay" class="tex_center" readonly>
                                        </td>
                                        <td class="w-10">
                                            <input type="text" name="gt_luy_ke_den_nay" value="0" class="tex_center" readonly>
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
                                    <td class="w-10 text-bold">Tổng cộng trước VAT</td>
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
                                        <p class="tong_tien_ky_nay" data=""></p>
                                    </td>
                                    <td class="w-10"></td>
                                    <td class="w-5"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                </tr>
                                <tr class="bg-ed">
                                    <td class="w-10 text-bold">Thuế VAT</td>
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
                                    <td class="w-10 text-bold">Chi phí khác</td>
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
                                        <input name="chi_phi_khac" class="chi_phi_khac" type="text" oninput="<?= $oninput ?>" onkeyup="chiphi_khac_thue(this)" placeholder="Nhập chi phí khác">
                                    </td>
                                    <td class="w-10"></td>
                                    <td class="w-5"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                </tr>
                                <tr class="bg-ed">
                                    <td class="w-10 text-bold">Tổng cộng sau VAT</td>
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
        } else if ($ploai == 4) {
            $ds_vt = new db_query("SELECT `vat_tu`, `don_vi_tinh`, `khoi_luong`, `don_gia`, `thanh_tien` FROM `vat_tu_hd_vc` WHERE `id_hd_vc` = $id_hd_dh ");
            if (mysql_num_rows($check_tt->result) > 0) { ?>
                <div class="tbl-header">
                    <table>
                        <thead>
                            <tr>
                                <th class="w-10" rowspan="2">STT</th>
                                <th class="w-20" rowspan="2">Tên vật tư</th>
                                <th class="w-10" rowspan="2">Hãng sản xuất</th>
                                <th class="w-10" rowspan="2">Xuất xứ</th>
                                <th class="w-10" rowspan="2">Đơn vị tính</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Hợp đồng</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Khối lượng thực hiện</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Giá trị thực hiện</th>
                                <th class="w-5" rowspan="2">% Thực hiện</th>
                                <th class="w-20 border-bottom-w" colspan="2" scope="colgroup">Giá trị đơn hàng còn lại</th>

                            </tr>
                            <tr class="border-top-w">
                                <th scope="colgroup">Số lượng</th>
                                <th scope="colgroup">Đơn giá(VNĐ)</th>
                                <th scope="colgroup">Giá trị(VNĐ)</th>
                                <th scope="colgroup">Lũy kế kỳ trước</th>
                                <th scope="colgroup">Kỳ này</th>
                                <th scope="colgroup">Lũy kế đến nay</th>
                                <th scope="colgroup">Lũy kế kỳ trước(VNĐ)</th>
                                <th scope="colgroup">Kỳ này(VNĐ)</th>
                                <th scope="colgroup">Lũy kế đến nay(VNĐ)</th>
                                <th scope="colgroup">Số lượng</th>
                                <th scope="colgroup">Giá trị(VNĐ)</th>

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
                                        <input type="text" name="kl_luy_ke_ky_truoc" data="<?= $row1['thue_vat'] ?>" value="<?= ($sum_one != 0) ? $sum_one : "0" ?>" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="kl_luy_ke_ky_nay" autocomplete="off" oninput="<?= $oninput ?>" value="<?= $all_vt['kl_ky_nay'] ?>" class="tex_center" onkeyup="kl_hs_doi(this)">
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="kl_luy_ke_den_nay" data="<?= $all_vt['gia_tri_ky_nay'] ?>" value="<?= $sum_one + $all_vt['kl_ky_nay'] ?>" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_ky_truoc" value="<?= ($sum_two != 0) ? $sum_two : "0" ?>" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_ky_nay" class="tex_center" value="<?= $all_vt['gia_tri_ky_nay'] ?>" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_den_nay" data="<?= $all_vt['gia_tri_ky_nay'] ?>" value="<?= $sum_two + $all_vt['gia_tri_ky_nay'] ?>" class="tex_center" readonly>
                                    </td>
                                    <td class="w-5">
                                        <input type="text" name="phan_tram_thuc_hien" value="<?= (($sum_two + $all_vt['gia_tri_ky_nay']) / $row1['thanh_tien']) * 100 ?>" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="con_lai_so_luong" value="<?= $row1['khoi_luong'] - ($sum_one + $all_vt['kl_ky_nay']) ?>" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="con_lai_gia_tri" value="<?= $row1['thanh_tien'] - ($sum_two + $all_vt['gia_tri_ky_nay']) ?>" class="tex_center" readonly>
                                    </td>
                                </tr>
                            <? } ?>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">Tổng cộng trước VAT</td>
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
                                <td class="w-10 text-bold">Thuế VAT </td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <span class="tong_thue_vat"><?= ($tong_tien['gia_tri_trvat'] * $tong_tien['thue_vat']) / 100 ?></span>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <span class="thue_ky_nay"><?= $hs_tt['tong_tien_thue'] ?></span>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">Chi phí khác</td>
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
                                    <input name="chi_phi_khac" class="chi_phi_khac tex_center" value="<?= $hs_tt['chi_phi_khac'] ?>" type="text" oninput="<?= $oninput ?>" onkeyup="chiphi_khac_vc(this)" placeholder="Nhập chi phí khác">
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">Tổng cộng sau VAT</td>
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
            <? } else {
                if (mysql_num_rows($check_ttai->result) > 0) { ?>
                    <div class="tbl-header">
                        <table>
                            <thead>
                                <tr>
                                    <th class="w-10" rowspan="2">STT</th>
                                    <th class="w-20" rowspan="2">Tên vật tư</th>
                                    <th class="w-10" rowspan="2">Hãng sản xuất</th>
                                    <th class="w-10" rowspan="2">Xuất xứ</th>
                                    <th class="w-10" rowspan="2">Đơn vị tính</th>
                                    <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Hợp đồng</th>
                                    <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Khối lượng thực hiện</th>
                                    <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Giá trị thực hiện</th>
                                    <th class="w-5" rowspan="2">% Thực hiện</th>
                                    <th class="w-20 border-bottom-w" colspan="2" scope="colgroup">Giá trị thực hiện</th>

                                </tr>
                                <tr class="border-top-w">
                                    <th scope="colgroup">Số lượng</th>
                                    <th scope="colgroup">Đơn giá(VNĐ)</th>
                                    <th scope="colgroup">Giá trị(VNĐ)</th>
                                    <th scope="colgroup">Lũy kế kỳ trước</th>
                                    <th scope="colgroup">Kỳ này</th>
                                    <th scope="colgroup">Lũy kế đến nay</th>
                                    <th scope="colgroup">Lũy kế kỳ trước(VNĐ)</th>
                                    <th scope="colgroup">Kỳ này(VNĐ)</th>
                                    <th scope="colgroup">Lũy kế đến nay(VNĐ)</th>
                                    <th scope="colgroup">Số lượng</th>
                                    <th scope="colgroup">Giá trị(VNĐ)</th>

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
                                                                    WHERE h.`id_hd_dh` = $id_hd_dh AND h.`id_cong_ty` = $com_id AND h.`loai_hs` = 1
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
                                    <td class="w-10 text-bold">Tổng cộng trước VAT</td>
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
                                        <p class="tong_tien_ky_nay" data=""></p>
                                    </td>
                                    <td class="w-10"></td>
                                    <td class="w-5"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                </tr>
                                <tr class="bg-ed">
                                    <td class="w-10 text-bold">Thuế VAT</td>
                                    <td class="w-20"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10">
                                        <span class="tong_thue_vat"><?= ($tong_tien['gia_tri_trvat'] * $tong_tien['thue_vat']) / 100 ?></span>
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
                                    <td class="w-10 text-bold">Chi phí khác</td>
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
                                        <input name="chi_phi_khac" class="chi_phi_khac" type="text" oninput="<?= $oninput ?>" onkeyup="chiphi_khac_vc(this)" placeholder="Nhập chi phí khác">
                                    </td>
                                    <td class="w-10"></td>
                                    <td class="w-5"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                </tr>
                                <tr class="bg-ed">
                                    <td class="w-10 text-bold">Tổng cộng sau VAT</td>
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
                                    <th class="w-20" rowspan="2">Tên vật tư</th>
                                    <th class="w-10" rowspan="2">Hãng sản xuất</th>
                                    <th class="w-10" rowspan="2">Xuất xứ</th>
                                    <th class="w-10" rowspan="2">Đơn vị tính</th>
                                    <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Hợp đồng</th>
                                    <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Khối lượng thực hiện</th>
                                    <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Giá trị thực hiện</th>
                                    <th class="w-5" rowspan="2">% Thực hiện</th>
                                    <th class="w-20 border-bottom-w" colspan="2" scope="colgroup">Giá trị thực hiện</th>

                                </tr>
                                <tr class="border-top-w">
                                    <th scope="colgroup">Số lượng</th>
                                    <th scope="colgroup">Đơn giá(VNĐ)</th>
                                    <th scope="colgroup">Giá trị(VNĐ)</th>
                                    <th scope="colgroup">Lũy kế kỳ trước</th>
                                    <th scope="colgroup">Kỳ này</th>
                                    <th scope="colgroup">Lũy kế đến nay</th>
                                    <th scope="colgroup">Lũy kế kỳ trước(VNĐ)</th>
                                    <th scope="colgroup">Kỳ này(VNĐ)</th>
                                    <th scope="colgroup">Lũy kế đến nay(VNĐ)</th>
                                    <th scope="colgroup">Số lượng</th>
                                    <th scope="colgroup">Giá trị(VNĐ)</th>

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
                                    <td class="w-10 text-bold">Tổng cộng trước VAT</td>
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
                                        <p class="tong_tien_ky_nay" data=""></p>
                                    </td>
                                    <td class="w-10"></td>
                                    <td class="w-5"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                </tr>
                                <tr class="bg-ed">
                                    <td class="w-10 text-bold">Thuế VAT</td>
                                    <td class="w-20"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10">
                                        <span class="tong_thue_vat"><?= ($tong_tien['gia_tri_trvat'] * $tong_tien['thue_vat']) / 100 ?></span>
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
                                    <td class="w-10 text-bold">Chi phí khác</td>
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
                                        <input name="chi_phi_khac" class="chi_phi_khac" type="text" oninput="<?= $oninput ?>" onkeyup="chiphi_khac_vc(this)" placeholder="Nhập chi phí khác">
                                    </td>
                                    <td class="w-10"></td>
                                    <td class="w-5"></td>
                                    <td class="w-10"></td>
                                    <td class="w-10"></td>
                                </tr>
                                <tr class="bg-ed">
                                    <td class="w-10 text-bold">Tổng cộng sau VAT</td>
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
    } else if ($loai_hs == 2) {

        $ds_vt = new db_query("SELECT `id_vat_tu`, `so_luong_ky_nay`, `don_gia`, `tong_tien_trvat`,
                                `thue_vat`, `tong_tien_svat` FROM `vat_tu_dh_mua_ban` WHERE `id_don_hang` = $id_hd_dh AND `id_cong_ty` = $com_id ");

        $tong_tien = mysql_fetch_assoc((new db_query("SELECT  `gia_tri_don_hang`, `thue_vat`, `gia_tri_svat` FROM `don_hang`
                                                        WHERE `id` = $id_hd_dh AND `id_cong_ty` = $com_id "))->result);

        $check_tt = new db_query("SELECT DISTINCT h.`id_hd_dh` FROM `ho_so_thanh_toan` AS h
                                            INNER JOIN `chi_tiet_hs` AS c ON h.`id` = c.`id_hs`
                                            WHERE h.`id_cong_ty` = $com_id AND h.`loai_hs` = 2 AND h.`id_hd_dh` = $id_hd_dh AND h.`id` = $id_hs ");

        $check_ttai = new db_query("SELECT DISTINCT h.`id_hd_dh` FROM `ho_so_thanh_toan` AS h
                                        INNER JOIN `chi_tiet_hs` AS c ON h.`id` = c.`id_hs`
                                        WHERE h.`id_cong_ty` = $com_id AND h.`loai_hs` = 2 AND h.`id_hd_dh` = $id_hd_dh ");

        if (mysql_num_rows($check_tt->result) > 0) { ?>
            <div class="tbl-header">
                <table>
                    <thead>
                        <tr>
                            <th class="w-10" rowspan="2">STT</th>
                            <th class="w-20" rowspan="2">Tên vật tư</th>
                            <th class="w-10" rowspan="2">Hãng sản xuất</th>
                            <th class="w-10" rowspan="2">Xuất xứ</th>
                            <th class="w-10" rowspan="2">Đơn vị tính</th>
                            <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Đơn hàng</th>
                            <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Khối lượng thực hiện</th>
                            <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Giá trị thực hiện</th>
                            <th class="w-5" rowspan="2">% Thực hiện</th>
                            <th class="w-20 border-bottom-w" colspan="2" scope="colgroup">Giá trị đơn hàng còn lại</th>

                        </tr>
                        <tr class="border-top-w">
                            <th scope="colgroup">Số lượng</th>
                            <th scope="colgroup">Đơn giá(VNĐ)</th>
                            <th scope="colgroup">Giá trị(VNĐ)</th>
                            <th scope="colgroup">Lũy kế kỳ trước</th>
                            <th scope="colgroup">Kỳ này</th>
                            <th scope="colgroup">Lũy kế đến nay</th>
                            <th scope="colgroup">Lũy kế kỳ trước(VNĐ)</th>
                            <th scope="colgroup">Kỳ này(VNĐ)</th>
                            <th scope="colgroup">Lũy kế đến nay(VNĐ)</th>
                            <th scope="colgroup">Số lượng</th>
                            <th scope="colgroup">Giá trị(VNĐ)</th>

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
                                    <input type="text" name="kl_luy_ke_ky_truoc" data="<?= $row1['thue_vat'] ?>" value="<?= $sum_one ?>" class="tex_center" readonly>
                                </td>
                                <td class="w-10">
                                    <input type="text" name="kl_luy_ke_ky_nay" autocomplete="off" oninput="<?= $oninput ?>" value="<?= $all_vt['kl_ky_nay'] ?>" class="tex_center" onkeyup="sl_hs_doi(this)">
                                </td>
                                <td class="w-10">
                                    <input type="text" name="kl_luy_ke_den_nay" data="<?= ($all_vt['gia_tri_ky_nay'] * $row1['thue_vat']) / 100 ?>" value="<?= $sum_one + $all_vt['kl_ky_nay'] ?>" class="tex_center" readonly>
                                </td>
                                <td class="w-10">
                                    <input type="text" name="gt_luy_ke_ky_truoc" value="<?= $sum_two ?>" class="tex_center" readonly>
                                </td>
                                <td class="w-10">
                                    <input type="text" name="gt_luy_ke_ky_nay" class="tex_center" value="<?= $all_vt['gia_tri_ky_nay'] ?>" readonly>
                                </td>
                                <td class="w-10">
                                    <input type="text" name="gt_luy_ke_den_nay" data="<?= $all_vt['gia_tri_ky_nay'] + (($all_vt['gia_tri_ky_nay'] * $row1['thue_vat']) / 100) ?>" value="<?= $sum_two + $all_vt['gia_tri_ky_nay'] ?>" class="tex_center" readonly>
                                </td>
                                <td class="w-5">
                                    <input type="text" name="phan_tram_thuc_hien" value="<?= (($sum_two + $all_vt['gia_tri_ky_nay']) / $row1['tong_tien_trvat']) * 100 ?>" class="tex_center" readonly>
                                </td>
                                <td class="w-10">
                                    <input type="text" name="con_lai_so_luong" value="<?= $row1['so_luong_ky_nay'] - ($sum_one + $all_vt['kl_ky_nay']) ?>" class="tex_center" readonly>
                                </td>
                                <td class="w-10">
                                    <input type="text" name="con_lai_gia_tri" value="<?= $row1['tong_tien_trvat'] - ($sum_two + $all_vt['gia_tri_ky_nay']) ?>" class="tex_center" readonly>
                                </td>
                            </tr>
                        <? } ?>
                        <tr class="bg-ed">
                            <td class="w-10 text-bold">Tổng cộng trước VAT</td>
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
                            <td class="w-10 text-bold">Thuế VAT </td>
                            <td class="w-20"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10">
                                <span class="tong_thue_vat"><?= $tong_tien['thue_vat'] ?></span>
                            </td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                            <td class="w-10">
                                <span class="thue_ky_nay"><?= $hs_tt['tong_tien_thue'] ?></span>
                            </td>
                            <td class="w-10"></td>
                            <td class="w-5"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                        </tr>
                        <tr class="bg-ed">
                            <td class="w-10 text-bold">Chi phí khác</td>
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
                                <input name="chi_phi_khac" class="chi_phi_khac tex_center" value="<?= $hs_tt['chi_phi_khac'] ?>" type="text" oninput="<?= $oninput ?>" onkeyup="chiphi_khac(this)" placeholder="Nhập chi phí khác">
                            </td>
                            <td class="w-10"></td>
                            <td class="w-5"></td>
                            <td class="w-10"></td>
                            <td class="w-10"></td>
                        </tr>
                        <tr class="bg-ed">
                            <td class="w-10 text-bold">Tổng cộng sau VAT</td>
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
        <? } else {
            if (mysql_num_rows($check_ttai->result) > 0) { ?>
                <div class="tbl-header">
                    <table>
                        <thead>
                            <tr>
                                <th class="w-10" rowspan="2">STT</th>
                                <th class="w-20" rowspan="2">Tên vật tư</th>
                                <th class="w-10" rowspan="2">Hãng sản xuất</th>
                                <th class="w-10" rowspan="2">Xuất xứ</th>
                                <th class="w-10" rowspan="2">Đơn vị tính</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Đơn hàng</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Khối lượng thực hiện</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Giá trị thực hiện</th>
                                <th class="w-5" rowspan="2">% Thực hiện</th>
                                <th class="w-20 border-bottom-w" colspan="2" scope="colgroup">Giá trị thực hiện</th>

                            </tr>
                            <tr class="border-top-w">
                                <th scope="colgroup">Số lượng</th>
                                <th scope="colgroup">Đơn giá(VNĐ)</th>
                                <th scope="colgroup">Giá trị(VNĐ)</th>
                                <th scope="colgroup">Lũy kế kỳ trước</th>
                                <th scope="colgroup">Kỳ này</th>
                                <th scope="colgroup">Lũy kế đến nay</th>
                                <th scope="colgroup">Lũy kế kỳ trước(VNĐ)</th>
                                <th scope="colgroup">Kỳ này(VNĐ)</th>
                                <th scope="colgroup">Lũy kế đến nay(VNĐ)</th>
                                <th scope="colgroup">Số lượng</th>
                                <th scope="colgroup">Giá trị(VNĐ)</th>

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
                                                                WHERE h.`id_hd_dh` = $id_hd_dh AND h.`id_cong_ty` = $com_id
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
                                        <p class="tong_tienvt"><?= $row1['tong_tien_svat'] ?></p>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="kl_luy_ke_ky_truoc" value="<?= ($sum_one == 0) ? "0" : $sum_one ?>" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <? if ($sum_one != $row1['so_luong_ky_nay']) { ?>
                                            <input type="text" name="kl_luy_ke_ky_nay" autocomplete="off" oninput="<?= $oninput ?>" class="tex_center" onkeyup="sl_hs_doi(this)">
                                        <? } else { ?>
                                            <input type="text" name="kl_luy_ke_ky_nay" oninput="<?= $oninput ?>" class="tex_center" readonly>
                                        <? } ?>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="kl_luy_ke_den_nay" value="<?= ($sum_one == 0) ? "0" : $sum_one ?>" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_ky_truoc" class="tex_center" value="<?= ($sum_two == 0) ? "0" : $sum_two ?>" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_ky_nay" class="tex_center" readonly>
                                    </td>
                                    <td class="w-10">
                                        <input type="text" name="gt_luy_ke_den_nay" class="tex_center" value="<?= ($sum_two == 0) ? "0" : $sum_two ?>" readonly>
                                    </td>
                                    <td class="w-5">
                                        <input type="text" name="phan_tram_thuc_hien" value="<?= ($sum_two * 100) / $row1['tong_tien_svat'] ?>" class="tex_center" readonly>
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
                                <td class="w-10 text-bold">Tổng cộng trước VAT</td>
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
                                    <p class="tong_tien_ky_nay" data=""></p>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">Thuế VAT</td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <span class="tong_thue_vat"><?= $tong_tien['thue_vat'] ?></span>
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
                                <td class="w-10 text-bold">Chi phí khác</td>
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
                                    <input name="chi_phi_khac" class="chi_phi_khac" type="text" oninput="<?= $oninput ?>" onkeyup="chiphi_khac(this)" placeholder="Nhập chi phí khác">
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">Tổng cộng sau VAT</td>
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
                                <th class="w-20" rowspan="2">Tên vật tư</th>
                                <th class="w-10" rowspan="2">Hãng sản xuất</th>
                                <th class="w-10" rowspan="2">Xuất xứ</th>
                                <th class="w-10" rowspan="2">Đơn vị tính</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Đơn hàng</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Khối lượng thực hiện</th>
                                <th class="w-30 border-bottom-w" colspan="3" scope="colgroup">Giá trị thực hiện</th>
                                <th class="w-5" rowspan="2">% Thực hiện</th>
                                <th class="w-20 border-bottom-w" colspan="2" scope="colgroup">Giá trị thực hiện</th>

                            </tr>
                            <tr class="border-top-w">
                                <th scope="colgroup">Số lượng</th>
                                <th scope="colgroup">Đơn giá(VNĐ)</th>
                                <th scope="colgroup">Giá trị(VNĐ)</th>
                                <th scope="colgroup">Lũy kế kỳ trước</th>
                                <th scope="colgroup">Kỳ này</th>
                                <th scope="colgroup">Lũy kế đến nay</th>
                                <th scope="colgroup">Lũy kế kỳ trước(VNĐ)</th>
                                <th scope="colgroup">Kỳ này(VNĐ)</th>
                                <th scope="colgroup">Lũy kế đến nay(VNĐ)</th>
                                <th scope="colgroup">Số lượng</th>
                                <th scope="colgroup">Giá trị(VNĐ)</th>

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
                                        <p class="tong_tienvt"><?= $row1['tong_tien_svat'] ?></p>
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
                                <td class="w-10 text-bold">Tổng cộng trước VAT</td>
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
                                    <p class="tong_tien_ky_nay" data=""></p>
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">Thuế VAT</td>
                                <td class="w-20"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                                <td class="w-10">
                                    <p class="tong_thue_vat"><?= $tong_tien['thue_vat'] ?></p>
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
                                <td class="w-10 text-bold">Chi phí khác</td>
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
                                    <input name="chi_phi_khac" class="chi_phi_khac" type="text" oninput="<?= $oninput ?>" onkeyup="chiphi_khac(this)" placeholder="Nhập chi phí khác">
                                </td>
                                <td class="w-10"></td>
                                <td class="w-5"></td>
                                <td class="w-10"></td>
                                <td class="w-10"></td>
                            </tr>
                            <tr class="bg-ed">
                                <td class="w-10 text-bold">Tổng cộng sau VAT</td>
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
}
?>