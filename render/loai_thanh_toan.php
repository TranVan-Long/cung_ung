<?
include("config.php");
include("../includes/icon.php");
$loai_tt = getValue('all_ltt', 'int', 'POST', '');
$hd_dh = getValue('hd_dh', 'int', 'POST', '');
$loai_phieu = getValue('loai_phieu', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
$id_phieu = getValue('id_phieu', 'int', 'POST', '');

if ($loai_phieu != "" && $hd_dh != "" && $loai_tt != "" && $id_phieu == "") {
    if ($loai_tt == 1) { ?>
        <div class="ctn_ct_from w_100 float_l">
            <div class="form-row w_100 float_l">
                <div class="form-group">
                    <label>Số tiền <span class="cr_red">*</span></label>
                    <input type="text" name="so_tien" class="form-control so_tien" onkeyup="so_tien_doi(this)" oninput="<?= $oninput ?>" placeholder="Nhập số tiền">
                </div>
                <div class="form-group">
                    <label>Tỷ giá</label>
                    <input type="text" name="ty_gia" class="form-control ty_gia" onkeyup="ty_gia_doi(this)" oninput="<?= $oninput ?>" placeholder="Nhập tỷ giá">
                </div>
            </div>
            <div class="form-row w_100 float_l">
                <div class="form-group">
                    <label>Giá trị quy đổi</label>
                    <input type="text" name="so_tien_qdoi" class="form-control h_border cr_weight gia_qdoi" readonly>
                </div>
            </div>
        </div>
    <? } else if ($loai_tt == 2) {
        if ($loai_phieu == 1) {

            $tong_tatca = mysql_fetch_assoc((new db_query("SELECT SUM(`tong_tien_tatca`) AS tongtien FROM `ho_so_thanh_toan` WHERE `id_cong_ty` = $com_id
                                                            AND `id_hd_dh` = $hd_dh AND `loai_hs` = 1 "))->result)['tongtien'];

            $ten_hs = new db_query("SELECT `id`, `thoi_han_thanh_toan`, `tong_tien_tatca` FROM `ho_so_thanh_toan`
                                        WHERE `loai_hs` = 1 AND `id_cong_ty` = $com_id AND `id_hd_dh` = $hd_dh AND `trang_thai` = 1 ");

            $check_tt = new db_query("SELECT `id` FROM `phieu_thanh_toan` WHERE `id_hd_dh` = $hd_dh AND `id_cong_ty` = $com_id
                                        AND `loai_phieu_tt` = 1 AND `loai_thanh_toan` = 2 ");

            if (mysql_num_rows($check_tt->result) > 0) {
                $tong_da_tt = mysql_fetch_assoc((new db_query("SELECT SUM(`so_tien`) AS sotien FROM `phieu_thanh_toan` WHERE `loai_phieu_tt` = 1 AND `loai_thanh_toan` = 2
                                                            AND `id_hd_dh` = $hd_dh AND `id_cong_ty` = $com_id "))->result)['sotien'];
                $gia_tri_tt = $tong_tatca - $tong_da_tt; ?>
                <div class="ctn_table">
                    <table class="table">
                        <thead>
                            <tr>

                                <th class="share_tb_five">Hồ sơ thanh toán</th>
                                <th class="share_tb_five">Giá trị còn phải thanh toán</th>
                                <th class="share_tb_five">Thời hạn thanh toán</th>
                                <th class="share_tb_five">Thanh toán</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="sh_bgr_four">
                                <td class="tex_left share_clr_four cr_weight share_h_52 share_tb_five">Tổng</td>
                                <td class="share_clr_four cr_weight share_tb_five tong_tien_tatca_tr" data="<?= $gia_tri_tt ?>"><?= number_format($gia_tri_tt) ?></td>
                                <td class="share_tb_five"></td>
                                <td class="share_clr_four cr_weight share_tb_five sum_tatca">0</td>
                            </tr>
                            <? while ($row1 = mysql_fetch_assoc($ten_hs->result)) {
                                $id_hs = $row1['id'];
                                $tien_datra = mysql_fetch_assoc((new db_query("SELECT SUM(`da_thanh_toan`) AS summ FROM `chi_tiet_phieu_tt_vt`
                                                                    WHERE `id_hs` = $id_hs AND `id_hd_dh` = $hd_dh AND `id_cong_ty` = $com_id "))->result);
                            ?>
                                <tr>
                                    <!-- <td><input type="checkbox" class="tbl_chkbx ml-20"></td> -->
                                    <td class="tex_left share_h_52 share_tb_five ho_so" data="<?= $row1['id'] ?>">HS - <?= $row1['id'] ?></td>
                                    <td class="share_tb_five tongtien" data="<?= $row1['tong_tien_tatca'] - $tien_datra['summ'] ?>">
                                        <?= number_format($row1['tong_tien_tatca'] - $tien_datra['summ']) ?>
                                    </td>
                                    <td class="share_tb_five"><?= ($row1['thoi_han_thanh_toan'] == 0) ? "" : date('d/m/Y', $row1['thoi_han_thanh_toan']) ?></td>
                                    <td class="share_tb_five">
                                        <div class="form-group">
                                            <input type="text" name="so_tien_ctra" data="" oninput="<?= $oninput ?>" autocomplete="off" onkeyup="change_tien(this)" class="form-control tex_center">
                                        </div>
                                    </td>
                                </tr>
                            <? } ?>
                        </tbody>
                    </table>
                </div>
            <?  } else { ?>
                <div class="ctn_table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="share_tb_five">Hồ sơ thanh toán</th>
                                <th class="share_tb_five">Giá trị còn phải thanh toán</th>
                                <th class="share_tb_five">Thời hạn thanh toán</th>
                                <th class="share_tb_five">Thanh toán</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="sh_bgr_four">
                                <td class="tex_left share_clr_four cr_weight share_h_52 share_tb_five">Tổng</td>
                                <td class="share_clr_four cr_weight share_tb_five tong_tien_tatca_tr" data="<?= $tong_tatca ?>"><?= number_format($tong_tatca) ?></td>
                                <td class="share_tb_five"></td>
                                <td class="share_clr_four cr_weight share_tb_five sum_tatca">0</td>
                            </tr>
                            <? while ($row1 = mysql_fetch_assoc($ten_hs->result)) { ?>
                                <tr>
                                    <td class="tex_left share_h_52 share_tb_five ho_so" data="<?= $row1['id'] ?>">HS - <?= $row1['id'] ?></td>
                                    <td class="share_tb_five tongtien" data="<?= $row1['tong_tien_tatca'] ?>"><?= number_format($row1['tong_tien_tatca']) ?></td>
                                    <td class="share_tb_five"><?= ($row1['thoi_han_thanh_toan'] == 0) ? "" : date('d/m/Y', $row1['thoi_han_thanh_toan']) ?></td>
                                    <td class="share_tb_five">
                                        <div class="form-group">
                                            <input type="text" name="so_tien_ctra" data="" oninput="<?= $oninput ?>" autocomplete="off" onkeyup="change_tien(this)" class="form-control tex_center">
                                        </div>
                                    </td>
                                </tr>
                            <? } ?>
                        </tbody>
                    </table>
                </div>
            <?  }
        } else if ($loai_phieu == 2) {

            $tong_tatca = mysql_fetch_assoc((new db_query("SELECT SUM(`tong_tien_tatca`) AS tongtien FROM `ho_so_thanh_toan` WHERE `id_cong_ty` = $com_id
                                                            AND `id_hd_dh` = $hd_dh AND `loai_hs` = 2 "))->result)['tongtien'];

            $ten_hs = new db_query("SELECT `id`, `thoi_han_thanh_toan`, `tong_tien_tatca` FROM `ho_so_thanh_toan`
                                        WHERE `loai_hs` = 2 AND `id_cong_ty` = $com_id AND `id_hd_dh` = $hd_dh AND `trang_thai` = 1 ");

            $check_tt = new db_query("SELECT `id` FROM `phieu_thanh_toan` WHERE `id_hd_dh` = $hd_dh AND `id_cong_ty` = $com_id
                                        AND `loai_phieu_tt` = 2 AND `loai_thanh_toan` = 2 ");

            if (mysql_num_rows($check_tt->result) > 0) {
                $tong_da_tt = mysql_fetch_assoc((new db_query("SELECT SUM(`so_tien`) AS sotien FROM `phieu_thanh_toan` WHERE `loai_phieu_tt` = 2 AND `loai_thanh_toan` = 2
                                                            AND `id_hd_dh` = $hd_dh AND `id_cong_ty` = $com_id "))->result)['sotien'];
                $gia_tri_tt = $tong_tatca - $tong_da_tt; ?>
                <div class="ctn_table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="share_tb_five">Hồ sơ thanh toán</th>
                                <th class="share_tb_five">Giá trị còn phải thanh toán</th>
                                <th class="share_tb_five">Thời hạn thanh toán</th>
                                <th class="share_tb_five">Thanh toán</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="sh_bgr_four">
                                <td class="tex_left share_clr_four cr_weight share_h_52 share_tb_five">Tổng</td>
                                <td class="share_clr_four cr_weight share_tb_five tong_tien_tatca_tr" data="<?= $gia_tri_tt ?>"><?= number_format($gia_tri_tt) ?></td>
                                <td class="share_tb_five"></td>
                                <td class="share_clr_four cr_weight share_tb_five sum_tatca">0</td>
                            </tr>
                            <? while ($row1 = mysql_fetch_assoc($ten_hs->result)) {
                                $id_hs = $row1['id'];
                                $tien_datra = mysql_fetch_assoc((new db_query("SELECT SUM(`da_thanh_toan`) AS summ FROM `chi_tiet_phieu_tt_vt`
                                                                    WHERE `id_hs` = $id_hs AND `id_hd_dh` = $hd_dh AND `id_cong_ty` = $com_id "))->result);
                            ?>
                                <tr>
                                    <td class="tex_left share_h_52 share_tb_five ho_so" data="<?= $row1['id'] ?>">HS - <?= $row1['id'] ?></td>
                                    <td class="share_tb_five tongtien" data="<?= $row1['tong_tien_tatca'] - $tien_datra['summ'] ?>">
                                        <?= number_format($row1['tong_tien_tatca'] - $tien_datra['summ']) ?>
                                    </td>
                                    <td class="share_tb_five"><?= ($row1['thoi_han_thanh_toan'] == 0) ? "" : date('d/m/Y', $row1['thoi_han_thanh_toan']) ?></td>
                                    <td class="share_tb_five">
                                        <div class="form-group">
                                            <input type="text" name="so_tien_ctra" data="" autocomplete="off" oninput="<?= $oninput ?>" onkeyup="change_tien(this)" class="form-control tex_center">
                                        </div>
                                    </td>
                                </tr>
                            <? } ?>
                        </tbody>
                    </table>
                </div>
            <? } else { ?>
                <div class="ctn_table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="share_tb_five">Hồ sơ thanh toán</th>
                                <th class="share_tb_five">Giá trị còn phải thanh toán</th>
                                <th class="share_tb_five">Thời hạn thanh toán</th>
                                <th class="share_tb_five">Thanh toán</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="sh_bgr_four">
                                <td class="tex_left share_clr_four cr_weight share_h_52 share_tb_five">Tổng</td>
                                <td class="share_clr_four cr_weight share_tb_five tong_tien_tatca_tr" data="<?= $tong_tatca ?>"><?= number_format($tong_tatca) ?></td>
                                <td class="share_tb_five"></td>
                                <td class="share_clr_four cr_weight share_tb_five sum_tatca">0</td>
                            </tr>
                            <? while ($row1 = mysql_fetch_assoc($ten_hs->result)) { ?>
                                <tr>
                                    <td class="tex_left share_h_52 share_tb_five ho_so" data="<?= $row1['id'] ?>">HS - <?= $row1['id'] ?></td>
                                    <td class="share_tb_five tongtien" data="<?= $row1['tong_tien_tatca'] ?>"><?= number_format($row1['tong_tien_tatca']) ?></td>
                                    <td class="share_tb_five"><?= ($row1['thoi_han_thanh_toan'] == 0) ? "" : date('d/m/Y', $row1['thoi_han_thanh_toan']) ?></td>
                                    <td class="share_tb_five">
                                        <div class="form-group">
                                            <input type="text" name="so_tien_ctra" data="" oninput="<?= $oninput ?>" autocomplete="off" onkeyup="change_tien(this)" class="form-control tex_center">
                                        </div>
                                    </td>
                                </tr>
                            <? } ?>
                        </tbody>
                    </table>
                </div>
            <? }
        }
    }
} else if ($loai_phieu != "" && $hd_dh != "" && $loai_tt != "" && $id_phieu != "") {
    if ($loai_tt == 1) {
        $check_tt = new db_query("SELECT `id` FROM `phieu_thanh_toan` WHERE `id` = $id_phieu AND `id_cong_ty` = $com_id AND `id_hd_dh` = $hd_dh
                                AND `loai_thanh_toan` = $loai_tt AND `loai_phieu_tt` = $loai_phieu ");
        if (mysql_num_rows($check_tt->result) > 0) {
            $tai_khoan = mysql_fetch_assoc((new db_query("SELECT `so_tien`, `ty_gia`, `gia_tri_quy_doi`
                                        FROM `phieu_thanh_toan` WHERE `id` = $id_phieu AND `id_cong_ty` = $com_id
                                        AND `id_hd_dh` = $hd_dh AND `loai_thanh_toan` = $loai_tt AND `loai_phieu_tt` = $loai_phieu  "))->result);
            ?>
            <div class="ctn_ct_from w_100 float_l">
                <div class="form-row w_100 float_l">
                    <div class="form-group">
                        <label>Số tiền <span class="cr_red">*</span></label>
                        <input type="text" name="so_tien" class="form-control so_tien" value="<?= $tai_khoan['so_tien'] ?>" onkeyup="so_tien_doi(this)" oninput="<?= $oninput ?>" placeholder="Nhập số tiền">
                    </div>
                    <div class="form-group">
                        <label>Tỷ giá</label>
                        <input type="text" name="ty_gia" class="form-control ty_gia" value="<?= $tai_khoan['ty_gia'] ?>" onkeyup="ty_gia_doi(this)" oninput="<?= $oninput ?>" placeholder="Nhập tỷ giá">
                    </div>
                </div>
                <div class="form-row w_100 float_l">
                    <div class="form-group">
                        <label>Giá trị quy đổi</label>
                        <input type="text" name="so_tien_qdoi" value="<?= $tai_khoan['gia_tri_quy_doi'] ?>" class="form-control h_border cr_weight gia_qdoi" readonly>
                    </div>
                </div>
            </div>
        <? } else {  ?>
            <div class="ctn_ct_from w_100 float_l">
                <div class="form-row w_100 float_l">
                    <div class="form-group">
                        <label>Số tiền <span class="cr_red">*</span></label>
                        <input type="text" name="so_tien" class="form-control so_tien" onkeyup="so_tien_doi(this)" oninput="<?= $oninput ?>" placeholder="Nhập số tiền">
                    </div>
                    <div class="form-group">
                        <label>Tỷ giá</label>
                        <input type="text" name="ty_gia" class="form-control ty_gia" onkeyup="ty_gia_doi(this)" oninput="<?= $oninput ?>" placeholder="Nhập tỷ giá">
                    </div>
                </div>
                <div class="form-row w_100 float_l">
                    <div class="form-group">
                        <label>Giá trị quy đổi</label>
                        <input type="text" name="so_tien_qdoi" class="form-control h_border cr_weight gia_qdoi" readonly>
                    </div>
                </div>
            </div>
            <? }
    } else if ($loai_tt == 2) {
        if ($loai_phieu == 1) {
            $tong_tatca = mysql_fetch_assoc((new db_query("SELECT SUM(`tong_tien_tatca`) AS tongtien FROM `ho_so_thanh_toan`
                                                            WHERE `id_cong_ty` = $com_id AND `id_hd_dh` = $hd_dh
                                                            AND `loai_hs` = 1 "))->result)['tongtien'];

            $check_tt = new db_query("SELECT `id` FROM `phieu_thanh_toan` WHERE `id` = $id_phieu AND `id_cong_ty` = $com_id
                                AND `loai_thanh_toan` = 2 AND `id_hd_dh` = $hd_dh AND `loai_phieu_tt` = 1 ");

            if (mysql_num_rows($check_tt->result) > 0) {
                $ctiet_phieu = mysql_fetch_assoc((new db_query("SELECT `so_tien`, `ngay_tao` FROM `phieu_thanh_toan` WHERE `id` = $id_phieu
                                                AND `id_cong_ty` = $com_id AND `id_hd_dh` = $hd_dh AND `loai_phieu_tt` = 1 AND `loai_thanh_toan` = 2 "))->result);
                $ngay_tao_phieu = $ctiet_phieu['ngay_tao'];
                $tong_datt = $ctiet_phieu['so_tien'];

                $list_hs = new db_query("SELECT `id`, `id_phieu_tt`, `id_hd_dh`, `id_hs`, `da_thanh_toan`
                                        FROM `chi_tiet_phieu_tt_vt` WHERE `id_cong_ty` = $com_id AND `id_phieu_tt` = $id_phieu
                                        AND `id_hd_dh` = $hd_dh ");

                $check_ttoan_tt = new db_query("SELECT `id` FROM `phieu_thanh_toan` WHERE `id` != $id_phieu AND `id_cong_ty` = $com_id
                                                AND `ngay_tao` < $ngay_tao_phieu AND `loai_thanh_toan` = 2
                                                AND `id_hd_dh` = $hd_dh AND `loai_phieu_tt` = 1 ");

                if (mysql_num_rows($check_ttoan_tt->result) > 0) {
                    $tong_da_tt = mysql_fetch_assoc((new db_query("SELECT SUM(`so_tien`) AS tongtien_tra FROM `phieu_thanh_toan` WHERE `id` != $id_phieu
                                                        AND `id_cong_ty` = $com_id
                                                        AND `ngay_tao` < $ngay_tao_phieu AND `loai_thanh_toan` = 2 AND `id_hd_dh` = $hd_dh
                                                        AND `loai_phieu_tt` = 1 "))->result)['tongtien_tra'];
                } else {
                    $tong_da_tt = 0;
                }
                $gia_tri_tt = $tong_tatca - $tong_da_tt;

            ?>

                <div class="ctn_table w_100 float_l">
                    <table class="table" data="<?= $id ?>">
                        <thead>
                            <tr>
                                <th class="share_tb_five">Hồ sơ thanh toán</th>
                                <th class="share_tb_five">Giá trị còn phải thanh toán</th>
                                <th class="share_tb_five">Thời hạn thanh toán</th>
                                <th class="share_tb_five">Thanh toán</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="sh_bgr_four">
                                <td class="tex_left share_clr_four cr_weight share_h_52 share_tb_five">Tổng</td>
                                <td class="share_clr_four cr_weight share_tb_five tong_tien_tatca_tr" data="<?= $gia_tri_tt ?>"><?= formatMoney($gia_tri_tt) ?></td>
                                <td class="share_tb_five"></td>
                                <td class="share_clr_four cr_weight share_tb_five sum_tatca"><?= $tong_datt ?></td>
                            </tr>
                            <? while ($row1 = mysql_fetch_assoc($list_hs->result)) {
                                $id_hs = $row1['id_hs'];

                                $than_tient = mysql_fetch_assoc((new db_query("SELECT `thoi_han_thanh_toan`, `tong_tien_tatca` FROM `ho_so_thanh_toan`
                                                                        WHERE `id` = $id_hs AND `id_cong_ty` = $com_id "))->result);

                                $check_ttoan_tt = new db_query("SELECT `id` FROM `phieu_thanh_toan` WHERE `id` != $id_phieu AND `id_cong_ty` = $com_id
                                                AND `ngay_tao` < $ngay_tao_phieu AND `loai_thanh_toan` = 2
                                                AND `id_hd_dh` = $hd_dh AND `loai_phieu_tt` = 1 ");

                                if (mysql_num_rows($check_ttoan_tt->result) > 0) {
                                    $tienda_tt = mysql_fetch_assoc((new db_query("SELECT SUM(c.`da_thanh_toan`) AS tongda_ttoan FROM `chi_tiet_phieu_tt_vt` AS c
                                                INNER JOIN `phieu_thanh_toan` AS p ON c.`id_phieu_tt` = p.`id`
                                                WHERE c.`id_cong_ty` = $com_id AND c.`id_hs` = $id_hs AND c.`id_phieu_tt` != $id_phieu
                                                AND c.`id_hd_dh` = $hd_dh AND p.`ngay_tao` < $ngay_tao_phieu
                                                AND p.`loai_phieu_tt` = 1 AND p.`loai_thanh_toan` = 2 "))->result)['tongda_ttoan'];
                                } else {
                                    $tienda_tt = 0;
                                }
                            ?>

                                <tr>
                                    <td class="tex_left share_h_52 share_tb_five ho_so" data="<?= $row1['id_hs'] ?>" data1="<?= $row1['id'] ?>">HS - <?= $row1['id_hs'] ?></td>
                                    <td class="share_tb_five tongtien" data="<?= $than_tient['tong_tien_tatca'] - $tienda_tt ?>"><?= formatMoney($than_tient['tong_tien_tatca'] - $tienda_tt) ?></td>
                                    <td class="share_tb_five"><?= ($than_tient['thoi_han_thanh_toan'] == 0) ? "" : date('d/m/Y', $than_tient['thoi_han_thanh_toan']) ?></td>
                                    <td class="share_tb_five">
                                        <div class="form-group">
                                            <input type="text" name="so_tien_ctra" data="<?= $row1['da_thanh_toan'] ?>" value="<?= $row1['da_thanh_toan'] ?>" oninput="<?= $oninput ?>" onkeyup=" change_tien(this)" class="form-control tex_center">
                                        </div>
                                    </td>
                                </tr>
                            <? } ?>
                        </tbody>
                    </table>
                </div>
                <? } else {

                $ten_hs = new db_query("SELECT `id`, `thoi_han_thanh_toan`, `tong_tien_tatca` FROM `ho_so_thanh_toan`
                                        WHERE `loai_hs` = 1 AND `id_cong_ty` = $com_id AND `id_hd_dh` = $hd_dh AND `trang_thai` = 1 ");

                $check_tt = new db_query("SELECT `id` FROM `phieu_thanh_toan` WHERE `id_hd_dh` = $hd_dh AND `id_cong_ty` = $com_id
                                        AND `loai_phieu_tt` = 1 AND `loai_thanh_toan` = 2 ");
                if (mysql_num_rows($check_tt->result) > 0) {
                    $tong_da_tt = mysql_fetch_assoc((new db_query("SELECT SUM(`so_tien`) AS sotien FROM `phieu_thanh_toan` WHERE `loai_phieu_tt` = 1 AND `loai_thanh_toan` = 2
                                                            AND `id_hd_dh` = $hd_dh AND `id_cong_ty` = $com_id "))->result)['sotien'];
                    $gia_tri_tt = $tong_tatca - $tong_da_tt; ?>
                    <div class="ctn_table">
                        <table class="table">
                            <thead>
                                <tr>

                                    <th class="share_tb_five">Hồ sơ thanh toán</th>
                                    <th class="share_tb_five">Giá trị còn phải thanh toán</th>
                                    <th class="share_tb_five">Thời hạn thanh toán</th>
                                    <th class="share_tb_five">Thanh toán</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="sh_bgr_four">
                                    <td class="tex_left share_clr_four cr_weight share_h_52 share_tb_five">Tổng</td>
                                    <td class="share_clr_four cr_weight share_tb_five tong_tien_tatca_tr" data="<?= $gia_tri_tt ?>"><?= number_format($gia_tri_tt) ?></td>
                                    <td class="share_tb_five"></td>
                                    <td class="share_clr_four cr_weight share_tb_five sum_tatca">0</td>
                                </tr>
                                <? while ($row1 = mysql_fetch_assoc($ten_hs->result)) {
                                    $id_hs = $row1['id'];
                                    $tien_datra = mysql_fetch_assoc((new db_query("SELECT SUM(`da_thanh_toan`) AS summ FROM `chi_tiet_phieu_tt_vt`
                                                                    WHERE `id_hs` = $id_hs AND `id_hd_dh` = $hd_dh AND `id_cong_ty` = $com_id "))->result);
                                ?>
                                    <tr>
                                        <!-- <td><input type="checkbox" class="tbl_chkbx ml-20"></td> -->
                                        <td class="tex_left share_h_52 share_tb_five ho_so" data="<?= $row1['id'] ?>">HS - <?= $row1['id'] ?></td>
                                        <td class="share_tb_five tongtien" data="<?= $row1['tong_tien_tatca'] - $tien_datra['summ'] ?>">
                                            <?= number_format($row1['tong_tien_tatca'] - $tien_datra['summ']) ?>
                                        </td>
                                        <td class="share_tb_five"><?= ($row1['thoi_han_thanh_toan'] == 0) ? "" : date('d/m/Y', $row1['thoi_han_thanh_toan']) ?></td>
                                        <td class="share_tb_five">
                                            <div class="form-group">
                                                <input type="text" name="so_tien_ctra" data="" oninput="<?= $oninput ?>" autocomplete="off" onkeyup="change_tien(this)" class="form-control tex_center">
                                            </div>
                                        </td>
                                    </tr>
                                <? } ?>
                            </tbody>
                        </table>
                    </div>
                <?  } else { ?>
                    <div class="ctn_table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="share_tb_five">Hồ sơ thanh toán</th>
                                    <th class="share_tb_five">Giá trị còn phải thanh toán</th>
                                    <th class="share_tb_five">Thời hạn thanh toán</th>
                                    <th class="share_tb_five">Thanh toán</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="sh_bgr_four">
                                    <td class="tex_left share_clr_four cr_weight share_h_52 share_tb_five">Tổng</td>
                                    <td class="share_clr_four cr_weight share_tb_five tong_tien_tatca_tr" data="<?= $tong_tatca ?>"><?= number_format($tong_tatca) ?></td>
                                    <td class="share_tb_five"></td>
                                    <td class="share_clr_four cr_weight share_tb_five sum_tatca">0</td>
                                </tr>
                                <? while ($row1 = mysql_fetch_assoc($ten_hs->result)) { ?>
                                    <tr>
                                        <td class="tex_left share_h_52 share_tb_five ho_so" data="<?= $row1['id'] ?>">HS - <?= $row1['id'] ?></td>
                                        <td class="share_tb_five tongtien" data="<?= $row1['tong_tien_tatca'] ?>"><?= number_format($row1['tong_tien_tatca']) ?></td>
                                        <td class="share_tb_five"><?= ($row1['thoi_han_thanh_toan'] == 0) ? "" : date('d/m/Y', $row1['thoi_han_thanh_toan']) ?></td>
                                        <td class="share_tb_five">
                                            <div class="form-group">
                                                <input type="text" name="so_tien_ctra" data="" oninput="<?= $oninput ?>" autocomplete="off" onkeyup="change_tien(this)" class="form-control tex_center">
                                            </div>
                                        </td>
                                    </tr>
                                <? } ?>
                            </tbody>
                        </table>
                    </div>
                <?  }
            }
        } else if ($loai_phieu == 2) {

            $tong_tatca = mysql_fetch_assoc((new db_query("SELECT SUM(`tong_tien_tatca`) AS tongtien FROM `ho_so_thanh_toan`
                                                        WHERE `id_cong_ty` = $com_id AND `id_hd_dh` = $hd_dh
                                                        AND `loai_hs` = 2 "))->result)['tongtien'];

            $check_tt = new db_query("SELECT `id` FROM `phieu_thanh_toan` WHERE `id` = $id_phieu AND `id_cong_ty` = $com_id
                                AND `loai_thanh_toan` = 2 AND `id_hd_dh` = $hd_dh AND `loai_phieu_tt` = 2 ");

            if (mysql_num_rows($check_tt->result) > 0) {
                $ctiet_phieu = mysql_fetch_assoc((new db_query("SELECT `so_tien`, `ngay_tao` FROM `phieu_thanh_toan` WHERE `id` = $id_phieu
                                            AND `id_cong_ty` = $com_id AND `id_hd_dh` = $hd_dh AND `loai_phieu_tt` = 2 AND `loai_thanh_toan` = 2 "))->result);
                $ngay_tao_phieu = $ctiet_phieu['ngay_tao'];
                $tong_datt = $ctiet_phieu['so_tien'];

                $list_hs = new db_query("SELECT `id`, `id_phieu_tt`, `id_hd_dh`, `id_hs`, `da_thanh_toan`
                                    FROM `chi_tiet_phieu_tt_vt` WHERE `id_cong_ty` = $com_id AND `id_phieu_tt` = $id_phieu
                                    AND `id_hd_dh` = $hd_dh ");

                $check_ttoan_tt = new db_query("SELECT `id` FROM `phieu_thanh_toan` WHERE `id` != $id_phieu AND `id_cong_ty` = $com_id
                                            AND `ngay_tao` < $ngay_tao_phieu AND `loai_thanh_toan` = 2
                                            AND `id_hd_dh` = $hd_dh AND `loai_phieu_tt` = 2 ");

                if (mysql_num_rows($check_ttoan_tt->result) > 0) {
                    $tong_da_tt = mysql_fetch_assoc((new db_query("SELECT SUM(`so_tien`) AS tongtien_tra FROM `phieu_thanh_toan` WHERE `id` != $id_phieu
                                                    AND `id_cong_ty` = $com_id
                                                    AND `ngay_tao` < $ngay_tao_phieu AND `loai_thanh_toan` = 2 AND `id_hd_dh` = $hd_dh
                                                    AND `loai_phieu_tt` = 2 "))->result)['tongtien_tra'];
                } else {
                    $tong_da_tt = 0;
                }
                $gia_tri_tt = $tong_tatca - $tong_da_tt; ?>

                <div class="ctn_table w_100 float_l">
                    <table class="table" data="<?= $id ?>">
                        <thead>
                            <tr>
                                <th class="share_tb_five">Hồ sơ thanh toán</th>
                                <th class="share_tb_five">Giá trị còn phải thanh toán</th>
                                <th class="share_tb_five">Thời hạn thanh toán</th>
                                <th class="share_tb_five">Thanh toán</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="sh_bgr_four">
                                <td class="tex_left share_clr_four cr_weight share_h_52 share_tb_five">Tổng</td>
                                <td class="share_clr_four cr_weight share_tb_five tong_tien_tatca_tr" data="<?= $gia_tri_tt ?>"><?= formatMoney($gia_tri_tt) ?></td>
                                <td class="share_tb_five"></td>
                                <td class="share_clr_four cr_weight share_tb_five sum_tatca"><?= $tong_datt ?></td>
                            </tr>
                            <? while ($row1 = mysql_fetch_assoc($list_hs->result)) {
                                $id_hs = $row1['id_hs'];

                                $than_tient = mysql_fetch_assoc((new db_query("SELECT `thoi_han_thanh_toan`, `tong_tien_tatca` FROM `ho_so_thanh_toan`
                                                                        WHERE `id` = $id_hs AND `id_cong_ty` = $com_id "))->result);

                                $check_ttoan_tt = new db_query("SELECT `id` FROM `phieu_thanh_toan` WHERE `id` != $id_phieu AND `id_cong_ty` = $com_id
                                                AND `ngay_tao` < $ngay_tao_phieu AND `loai_thanh_toan` = 2
                                                AND `id_hd_dh` = $hd_dh AND `loai_phieu_tt` = 2 ");

                                if (mysql_num_rows($check_ttoan_tt->result) > 0) {
                                    $tienda_tt = mysql_fetch_assoc((new db_query("SELECT SUM(c.`da_thanh_toan`) AS tongda_ttoan FROM `chi_tiet_phieu_tt_vt` AS c
                                                INNER JOIN `phieu_thanh_toan` AS p ON c.`id_phieu_tt` = p.`id`
                                                WHERE c.`id_cong_ty` = $com_id AND c.`id_hs` = $id_hs AND c.`id_phieu_tt` != $id_phieu
                                                AND c.`id_hd_dh` = $hd_dh AND p.`ngay_tao` < $ngay_tao_phieu
                                                AND p.`loai_phieu_tt` = 2 AND p.`loai_thanh_toan` = 2 "))->result)['tongda_ttoan'];
                                } else {
                                    $tienda_tt = 0;
                                };
                            ?>

                                <tr>
                                    <td class="tex_left share_h_52 share_tb_five ho_so" data="<?= $row1['id_hs'] ?>" data1="<?= $row1['id'] ?>">HS - <?= $row1['id_hs'] ?></td>
                                    <td class="share_tb_five tongtien" data="<?= $than_tient['tong_tien_tatca'] - $tienda_tt ?>"><?= formatMoney($than_tient['tong_tien_tatca'] - $tienda_tt) ?></td>
                                    <td class="share_tb_five"><?= ($than_tient['thoi_han_thanh_toan'] == 0) ? "" : date('d/m/Y', $than_tient['thoi_han_thanh_toan']) ?></td>
                                    <td class="share_tb_five">
                                        <div class="form-group">
                                            <input type="text" name="so_tien_ctra" data="<?= $row1['da_thanh_toan'] ?>" value="<?= $row1['da_thanh_toan'] ?>" oninput="<?= $oninput ?>" onkeyup=" change_tien(this)" class="form-control tex_center">
                                        </div>
                                    </td>
                                </tr>
                            <? } ?>
                        </tbody>
                    </table>
                </div>
                <? } else {
                $tong_tatca = mysql_fetch_assoc((new db_query("SELECT SUM(`tong_tien_tatca`) AS tongtien FROM `ho_so_thanh_toan` WHERE `id_cong_ty` = $com_id
                                                            AND `id_hd_dh` = $hd_dh AND `loai_hs` = 2 "))->result)['tongtien'];

                $ten_hs = new db_query("SELECT `id`, `thoi_han_thanh_toan`, `tong_tien_tatca` FROM `ho_so_thanh_toan`
                                        WHERE `loai_hs` = 2 AND `id_cong_ty` = $com_id AND `id_hd_dh` = $hd_dh AND `trang_thai` = 1 ");

                $check_tt = new db_query("SELECT `id` FROM `phieu_thanh_toan` WHERE `id_hd_dh` = $hd_dh AND `id_cong_ty` = $com_id
                                        AND `loai_phieu_tt` = 2 AND `loai_thanh_toan` = 2 ");

                if (mysql_num_rows($check_tt->result) > 0) {
                    $tong_da_tt = mysql_fetch_assoc((new db_query("SELECT SUM(`so_tien`) AS sotien FROM `phieu_thanh_toan` WHERE `loai_phieu_tt` = 2 AND `loai_thanh_toan` = 2
                                                            AND `id_hd_dh` = $hd_dh AND `id_cong_ty` = $com_id "))->result)['sotien'];
                    $gia_tri_tt = $tong_tatca - $tong_da_tt; ?>
                    <div class="ctn_table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="share_tb_five">Hồ sơ thanh toán</th>
                                    <th class="share_tb_five">Giá trị còn phải thanh toán</th>
                                    <th class="share_tb_five">Thời hạn thanh toán</th>
                                    <th class="share_tb_five">Thanh toán</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="sh_bgr_four">
                                    <td class="tex_left share_clr_four cr_weight share_h_52 share_tb_five">Tổng</td>
                                    <td class="share_clr_four cr_weight share_tb_five tong_tien_tatca_tr" data="<?= $gia_tri_tt ?>"><?= number_format($gia_tri_tt) ?></td>
                                    <td class="share_tb_five"></td>
                                    <td class="share_clr_four cr_weight share_tb_five sum_tatca">0</td>
                                </tr>
                                <? while ($row1 = mysql_fetch_assoc($ten_hs->result)) {
                                    $id_hs = $row1['id'];
                                    $tien_datra = mysql_fetch_assoc((new db_query("SELECT SUM(`da_thanh_toan`) AS summ FROM `chi_tiet_phieu_tt_vt`
                                                                    WHERE `id_hs` = $id_hs AND `id_hd_dh` = $hd_dh AND `id_cong_ty` = $com_id "))->result);
                                ?>
                                    <tr>
                                        <td class="tex_left share_h_52 share_tb_five ho_so" data="<?= $row1['id'] ?>">HS - <?= $row1['id'] ?></td>
                                        <td class="share_tb_five tongtien" data="<?= $row1['tong_tien_tatca'] - $tien_datra['summ'] ?>">
                                            <?= number_format($row1['tong_tien_tatca'] - $tien_datra['summ']) ?>
                                        </td>
                                        <td class="share_tb_five"><?= ($row1['thoi_han_thanh_toan'] == 0) ? "" : date('d/m/Y', $row1['thoi_han_thanh_toan']) ?></td>
                                        <td class="share_tb_five">
                                            <div class="form-group">
                                                <input type="text" name="so_tien_ctra" data="" autocomplete="off" oninput="<?= $oninput ?>" onkeyup="change_tien(this)" class="form-control tex_center">
                                            </div>
                                        </td>
                                    </tr>
                                <? } ?>
                            </tbody>
                        </table>
                    </div>
                <? } else { ?>
                    <div class="ctn_table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="share_tb_five">Hồ sơ thanh toán</th>
                                    <th class="share_tb_five">Giá trị còn phải thanh toán</th>
                                    <th class="share_tb_five">Thời hạn thanh toán</th>
                                    <th class="share_tb_five">Thanh toán</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="sh_bgr_four">
                                    <td class="tex_left share_clr_four cr_weight share_h_52 share_tb_five">Tổng</td>
                                    <td class="share_clr_four cr_weight share_tb_five tong_tien_tatca_tr" data="<?= $tong_tatca ?>"><?= number_format($tong_tatca) ?></td>
                                    <td class="share_tb_five"></td>
                                    <td class="share_clr_four cr_weight share_tb_five sum_tatca">0</td>
                                </tr>
                                <? while ($row1 = mysql_fetch_assoc($ten_hs->result)) { ?>
                                    <tr>
                                        <td class="tex_left share_h_52 share_tb_five ho_so" data="<?= $row1['id'] ?>">HS - <?= $row1['id'] ?></td>
                                        <td class="share_tb_five tongtien" data="<?= $row1['tong_tien_tatca'] ?>"><?= number_format($row1['tong_tien_tatca']) ?></td>
                                        <td class="share_tb_five"><?= ($row1['thoi_han_thanh_toan'] == 0) ? "" : date('d/m/Y', $row1['thoi_han_thanh_toan']) ?></td>
                                        <td class="share_tb_five">
                                            <div class="form-group">
                                                <input type="text" name="so_tien_ctra" data="" oninput="<?= $oninput ?>" autocomplete="off" onkeyup="change_tien(this)" class="form-control tex_center">
                                            </div>
                                        </td>
                                    </tr>
                                <? } ?>
                            </tbody>
                        </table>
                    </div>
<? }
            }
        }
    }
} ?>