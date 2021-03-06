<?
include("../home/config.php");

isset($_GET['id']) ? $id = $_GET['id'] : $id = "";

$cs_ycvt = '/chinh-sua-yeu-cau-vat-tu-' . $id . '.html';
$ct_ycvt = '/quan-ly-chi-tiet-yeu-cau-vat-tu-' . $id . '.html';

$yc_vattu = ['/quan-ly-yeu-cau-vat-tu.html', '/quan-ly-yeu-cau-vat-tu-nhan-vien.html', '/them-yeu-cau-vat-tu.html', $cs_ycvt, $ct_ycvt, '/duyet-yeu-cau-vat-tu.html'];

$ct_hd = '/chi-tiet-hop-dong-' . $id . '.html';
$ct_hdm = '/quan-ly-chi-tiet-hop-dong-mua-' . $id . '.html';
$cs_hdm = '/chinh-sua-hop-dong-mua-' . $id . '.html';
$ct_hdb = '/quan-ly-chi-tiet-hop-dong-ban-' . $id . '.html';
$cs_hdb = '/chinh-sua-hop-dong-ban-' . $id . '.html';
$ct_hdt = '/quan-ly-chi-tiet-hop-dong-thue-thiet-bi-' . $id . '.html';
$cs_hdt = '/chinh-sua-hop-dong-thue-thiet-bi-' . $id . '.html';
$ct_hdv = '/quan-ly-chi-tiet-hop-dong-van-chuyen-' . $id . '.html';
$cs_hdv = '/chinh-sua-hop-dong-van-chuyen-' . $id . '.html';

$ct_dhb = '/chi-tiet-don-hang-ban-' . $id . '.html';
$cs_dhb = '/chinh-sua-don-hang-ban-' . $id . '.html';
$ct_dhm = '/chi-tiet-don-hang-mua-' . $id . '.html';
$cs_dhm = '/chinh-sua-don-hang-mua-' . $id . '.html';

$cs_hs = '/chinh-sua-ho-so-thanh-toan-' . $id . '.html';
$ct_hs = '/chi-tiet-ho-so-thanh-toan-' . $id . '.html';

$cs_ptt = '/chinh-sua-phieu-thanh-toan-' . $id . '.html';
$ct_ptt = '/chi-tiet-phieu-thanh-toan-' . $id . '.html';
$ct_pttu = '/chi-tiet-phieu-thanh-toan-tam-ung-' . $id . '.html';

$all_hopd = [
    '/quan-ly-hop-dong.html', $ct_hd, $ct_hdm, '/them-hop-dong-mua.html', $cs_hdm, $ct_hdb, '/them-hop-dong-ban.html', $cs_hdb, $ct_hdt,
    '/them-hop-dong-thue-thiet-bi.html', $cs_hdt, $ct_hdv, '/them-hop-dong-van-chuyen.html',
    $cs_hdv, '/quan-ly-don-hang.html', $ct_dhb, '/them-don-hang-ban.html', $cs_dhb,
    $ct_dhm, '/them-don-hang-mua.html', $cs_dhm, '/quan-ly-ho-so-thanh-toan.html', '/them-ho-so-thanh-toan.html',
    $cs_hs, $ct_hs, '/quan-ly-phieu-thanh-toan.html', '/them-phieu-thanh-toan.html', $cs_ptt, $ct_ptt, $ct_pttu
];

$hop_dong = [
    '/quan-ly-hop-dong.html', $ct_hd, $ct_hdm, '/them-hop-dong-mua.html', $cs_hdm, $ct_hdb, '/them-hop-dong-ban.html', $cs_hdb,
    $ct_hdt, '/them-hop-dong-thue-thiet-bi.html', $cs_hdt, $ct_hdv, '/them-hop-dong-van-chuyen.html', $cs_hdv
];

$don_hang = ['/quan-ly-don-hang.html', $ct_dhb, '/them-don-hang-ban.html', $cs_dhb, $ct_dhm, $cs_dhm, '/them-don-hang-mua.html'];

$ho_so_tt = ['/quan-ly-ho-so-thanh-toan.html', $ct_hs, '/them-ho-so-thanh-toan.html', $cs_hs];

$phieu_tt = ['/quan-ly-phieu-thanh-toan.html', $ct_ptt, $ct_pttu, '/them-phieu-thanh-toan.html', $cs_ptt];

$ctiet_ncc = '/quan-ly-chi-tiet-nha-cung-cap-' . $id . '.html';
$cs_ncc = '/chinh-sua-nha-cung-cap-' . $id . '.html';
$cs_tc = '/chinh-sua-tieu-chi-danh-gia-' . $id . '.html';
$cs_dg_ncc = '/chinh-sua-danh-gia-nha-cung-cap-' . $id . '.html';
$ct_dg_ncc = '/chi-tiet-danh-gia-nha-cung-cap-' . $id . '.html';

$all_ncc = [
    '/quan-ly-nha-cung-cap.html', $ctiet_ncc, '/them-nha-cung-cap.html', $cs_ncc,
    '/tieu-chi-danh-gia.html', '/them-tieu-chi-danh-gia.html', $cs_tc, '/danh-gia-nha-cung-cap.html',
    '/them-danh-gia-nha-cung-cap.html', $cs_dg_ncc, $ct_dg_ncc
];

$nha_cc = ['/quan-ly-nha-cung-cap.html', $ctiet_ncc, '/them-nha-cung-cap.html', $cs_ncc];

$tieuc_dg = ['/tieu-chi-danh-gia.html', '/them-tieu-chi-danh-gia.html', $cs_tc];

$danhg_ncc = ['/danh-gia-nha-cung-cap.html', '/them-danh-gia-nha-cung-cap.html', $cs_dg_ncc, $ct_dg_ncc];

$ctiet_kh = '/quan-ly-chi-tiet-khach-hang-' . $id . '.html';
$edit_kh = '/chinh-sua-khach-hang-' . $id . '.html';

$khach_hang = ['/quan-ly-khach-hang.html', $ctiet_kh, '/them-khach-hang.html', $edit_kh];

$bao_cao = ['/bao-cao-doanh-so-ban-hang.html', '/bao-cao-cong-no-phai-thu.html', '/bao-cao-cong-no-phai-tra.html'];

$cai_dat = ['/quan-ly-cai-dat.html', '/cai-dat-phan-quyen.html', '/nhat-ky-hoat-dong.html', '/quan-ly-cai-dat-nhan-vien.html', '/nhat-ky-hoat-dong-nhan-vien.html'];

$ct_ycbg = '/chi-tiet-yeu-cau-bao-gia-' . $id . '.html';
$cs_ycbg = '/chinh-sua-yeu-cau-bao-gia-' . $id . '.html';
$ct_bg = '/chi-tiet-bao-gia-' . $id . '.html';
$cs_bg = '/chinh-sua-bao-gia-' . $id . '.html';
$ct_bgkh = '/chi-tiet-bao-gia-cho-khach-hang-' . $id . '.html';
$cs_bgkh = '/chinh-sua-bao-gia-cho-khach-hang-' . $id . '.html';

$bang_gia = [
    '/quan-ly-bang-gia.html', '/quan-ly-yeu-cau-bao-gia.html', $ct_ycbg, '/them-yeu-cau-bao-gia.html', $cs_ycbg,
    '/quan-ly-bao-gia.html', $ct_bg, '/them-bao-gia.html', $cs_bg,
    '/quan-ly-bao-gia-cho-khach-hang.html', $ct_bgkh, '/them-bao-gia-cho-khach-hang.html', $cs_bgkh
];

$yc_baogia = ['/quan-ly-yeu-cau-bao-gia.html', $ct_ycbg, '/them-yeu-cau-bao-gia.html', $cs_ycbg];

$bao_gia = ['/quan-ly-bao-gia.html', $ct_bg, '/them-bao-gia.html', $cs_bg];

$bao_gia_kh = ['/quan-ly-bao-gia-cho-khach-hang.html', $ct_bgkh, '/them-bao-gia-cho-khach-hang.html', $cs_bgkh];



?>
<div class="modal_menu">
    <div class="menu_header">
        <div class="modal-content">
            <div class="ctn_menu_mobi share_bgr_tow">
                <div class="side-bar share_bgr_tow">
                    <div class="logo-container">
                        <a href="#"><img alt="tim viec 365" class="logo" src="/img/logo_o.png"></a>
                    </div>
                    <ul class="menu">
                        <li class="<?= ($_SERVER['REDIRECT_URL'] == '/quan-ly-trang-chu.html') ? "active" : "" ?>">
                            <a href="quan-ly-trang-chu.html">
                                <span><?php echo $ic_home ?></span> Trang ch???
                            </a>
                        </li>
                        <? if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) { ?>
                            <li class="<?= (in_array($_SERVER['REDIRECT_URL'], $yc_vattu)) ? "active" : "" ?>">
                                <a href="quan-ly-yeu-cau-vat-tu.html">
                                    <span><?php echo $ic_wall; ?></span> Y??u c???u v???t t??
                                </a>
                            </li>
                            <li class="collapse share_cursor <?= (in_array($_SERVER['REDIRECT_URL'], $all_hopd)) ? "active" : "" ?>" data-tab="subt-menu1">
                                <a>
                                    <span><?php echo $ic_hop_dong ?></span>
                                    H???p ?????ng
                                </a>
                                <ul id="subt-menu1" class="<?= (in_array($_SERVER['REDIRECT_URL'], $all_hopd)) ? "active" : "" ?>">
                                    <li>
                                        <a href="quan-ly-hop-dong.html" class="<?= (in_array($_SERVER['REDIRECT_URL'], $hop_dong)) ? "active" : "" ?>"><span><?php echo $ic_circle ?></span>
                                            H???p ?????ng</a>
                                    </li>
                                    <li>
                                        <a href="quan-ly-don-hang.html" class="<?= (in_array($_SERVER['REDIRECT_URL'], $don_hang)) ? "active" : ""  ?>"><span><?php echo $ic_circle ?></span>????n
                                            h??ng</a>
                                    </li>
                                    <li>
                                        <a href="quan-ly-ho-so-thanh-toan.html" class="<?= (in_array($_SERVER['REDIRECT_URL'], $ho_so_tt)) ? "active" : "" ?>"><span><?php echo $ic_circle ?></span>H???
                                            s?? thanh to??n</a>
                                    </li>
                                    <li>
                                        <a href="quan-ly-phieu-thanh-toan.html" class="<?= (in_array($_SERVER['REDIRECT_URL'], $phieu_tt)) ? "active" : "" ?>"><span><?php echo $ic_circle ?></span>Phi???u
                                            thanh to??n</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="collapse share_cursor <?= (in_array($_SERVER['REDIRECT_URL'], $bang_gia)) ? "active" : "" ?>" data-tab="subt-menu2">
                                <a><span><?php echo $ic_bang_gia ?></span>B???ng gi??</a>
                                <ul id="subt-menu2" class="<?= (in_array($_SERVER['REDIRECT_URL'], $bang_gia)) ? "active" : "" ?>">
                                    <li>
                                        <a href="quan-ly-bang-gia.html" class="<?= ($_SERVER['REDIRECT_URL'] == '/quan-ly-bang-gia.html') ? "active" : "" ?>">
                                            <span><?php echo $ic_circle ?></span>B???ng gi??</a>
                                    </li>
                                    <li>
                                        <a href="quan-ly-yeu-cau-bao-gia.html" class="<?= (in_array($_SERVER['REDIRECT_URL'], $yc_baogia)) ? "active" : "" ?>">
                                            <span><?php echo $ic_circle ?> </span>Y??u c???u b??o gi??
                                        </a>
                                    </li>
                                    <li>
                                        <a href="quan-ly-bao-gia.html" class="<?= (in_array($_SERVER['REDIRECT_URL'], $bao_gia)) ? "active" : "" ?>">
                                            <span><?php echo $ic_circle ?></span>B??o gi??
                                        </a>
                                    </li>
                                    <li>
                                        <a href="quan-ly-bao-gia-cho-khach-hang.html" class="<?= (in_array($_SERVER['REDIRECT_URL'], $bao_gia_kh)) ? "active" : "" ?>">
                                            <span><?php echo $ic_circle ?></span>B??o gi?? cho kh??ch h??ng
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="collapse share_cursor share_height <?= (in_array($_SERVER['REDIRECT_URL'], $all_ncc)) ? "active" : "" ?>" data-tab="subt-menu3">
                                <a><span><?php echo $ic_producer ?></span>Nh?? cung c???p</a>
                                <ul id="subt-menu3" class="<?= (in_array($_SERVER['REDIRECT_URL'], $all_ncc)) ? "active" : "" ?>">
                                    <li>
                                        <a href="quan-ly-nha-cung-cap.html" class="<?= (in_array($_SERVER['REDIRECT_URL'], $nha_cc)) ? "active" : "" ?>"><span><?php echo $ic_circle ?></span>Nh??
                                            cung c???p</a>
                                    </li>
                                    <li>
                                        <a href="danh-gia-nha-cung-cap.html" class="<?= (in_array($_SERVER['REDIRECT_URL'], $danhg_ncc)) ? "active" : "" ?>"><span><?php echo $ic_circle ?></span>????nh
                                            gi?? nh?? cung c???p</a>
                                    </li>
                                    <li>
                                        <a href="tieu-chi-danh-gia.html" class="<?= (in_array($_SERVER['REDIRECT_URL'], $tieuc_dg)) ? "active" : "" ?>"><span><?php echo $ic_circle ?></span>Ti??u
                                            ch?? ????nh gi??</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="<?= (in_array($_SERVER['REDIRECT_URL'], $khach_hang)) ? "active" : "" ?>">
                                <a href="quan-ly-khach-hang.html"><span><?php echo $ic_customer ?></span>Kh??ch h??ng</a>
                            </li>
                            <li class="collapse share_cursor share_height  <?= (in_array($_SERVER['REDIRECT_URL'], $bao_cao)) ? "active" : "" ?>" data-tab="subt-menu4">
                                <a><span><?php echo $ic_report ?></span>B??o c??o</a>
                                <ul id="subt-menu4" class="<?= (in_array($_SERVER['REDIRECT_URL'], $bao_cao)) ? "active" : "" ?>">
                                    <li>
                                        <a href="bao-cao-doanh-so-ban-hang.html" class="<?= ($_SERVER['REDIRECT_URL'] == '/bao-cao-doanh-so-ban-hang.html') ? "active" : "" ?>">
                                            <span><?php echo $ic_circle ?></span>Doanh s??? b??n h??ng</a>
                                    </li>
                                    <li>
                                        <a href="bao-cao-cong-no-phai-thu.html" class="<?= ($_SERVER['REDIRECT_URL'] == '/bao-cao-cong-no-phai-thu.html') ? "active" : "" ?>">
                                            <span><?php echo $ic_circle ?></span>C??ng n??? ph???i thu</a>
                                    </li>
                                    <li>
                                        <a href="bao-cao-cong-no-phai-tra.html" class="<?= ($_SERVER['REDIRECT_URL'] == '/bao-cao-cong-no-phai-tra.html') ? "active" : "" ?>">
                                            <span><?php echo $ic_circle ?></span>C??ng n??? ph???i tr???</a>
                                    </li>
                                </ul>
                            </li>
                            <? } else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
                            $user_id = $_SESSION['ep_id'];
                            $com_id = $_SESSION['user_com_id'];
                            $kt_nhanvien = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
                            if (mysql_num_rows($kt_nhanvien->result) > 0) {
                                $item_nv = mysql_fetch_assoc((new db_query("SELECT `id`, `yeu_cau_vat_tu`, `hop_dong`, `don_hang`, `ho_so_tt`, `phieu_tt`, `bang_gia`,
                                                        `yeu_cau_bao_gia`, `bao_gia`, `bao_gia_kh`, `nha_cung_cap`, `danh_gia_ncc`, `tieu_chi_danh_gia`, `khach_hang`, `bc_doanh_so`,
                                                        `cog_no_thu`, `cong_no_tra` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
                                $ycvt = explode(',', $item_nv['yeu_cau_vat_tu']);
                                $hop_dong = explode(',', $item_nv['hop_dong']);
                                $don_hang = explode(',', $item_nv['don_hang']);
                                $hs_tt = explode(',', $item_nv['ho_so_tt']);
                                $phieu_tt = explode(',', $item_nv['phieu_tt']);
                                $bang_gia = explode(',', $item_nv['bang_gia']);
                                $ycbg = explode(',', $item_nv['yeu_cau_bao_gia']);
                                $bao_gia = explode(',', $item_nv['bao_gia']);
                                $bao_gia_kh = explode(',', $item_nv['bao_gia_kh']);
                                $nha_cc = explode(',', $item_nv['nha_cung_cap']);
                                $dgia_ncc = explode(',', $item_nv['danh_gia_ncc']);
                                $tieu_chi_dg = explode(',', $item_nv['tieu_chi_danh_gia']);
                                $khach_hang = explode(',', $item_nv['khach_hang']);
                                $bc_doanh_so = explode(',', $item_nv['bc_doanh_so']);
                                $cong_no_thu = explode(',', $item_nv['cog_no_thu']);
                                $cong_no_tra = explode(',', $item_nv['cong_no_tra']);
                            ?>
                                <? if (in_array(1, $ycvt)) { ?>
                                    <li class="<?= (in_array($_SERVER['REDIRECT_URL'], $yc_vattu)) ? "active" : "" ?>">
                                        <a href="quan-ly-yeu-cau-vat-tu.html">
                                            <span><?php echo $ic_wall; ?></span> Y??u c???u v???t t??
                                        </a>
                                    </li>
                                <? }
                                if (in_array(1, $hop_dong) || in_array(1, $don_hang) || in_array(1, $hs_tt) || in_array(1, $phieu_tt)) { ?>
                                    <li class="collapse share_cursor <?= (in_array($_SERVER['REDIRECT_URL'], $all_hopd)) ? "active" : "" ?>" data-tab="subt-menu1">
                                        <a>
                                            <span><?php echo $ic_hop_dong ?></span>
                                            H???p ?????ng
                                        </a>
                                        <ul id="subt-menu1" class="<?= (in_array($_SERVER['REDIRECT_URL'], $all_hopd)) ? "active" : "" ?>">
                                            <? if (in_array(1, $hop_dong)) { ?>
                                                <li>
                                                    <a href="quan-ly-hop-dong.html" class="<?= (in_array($_SERVER['REDIRECT_URL'], $hop_dong)) ? "active" : "" ?>"><span><?php echo $ic_circle ?></span> H???p ?????ng</a>
                                                </li>
                                            <? } ?>
                                            <? if (in_array(1, $don_hang)) { ?>
                                                <li>
                                                    <a href="quan-ly-don-hang.html" class="<?= (in_array($_SERVER['REDIRECT_URL'], $don_hang)) ? "active" : ""  ?>"><span><?php echo $ic_circle ?></span>????n h??ng</a>
                                                </li>
                                            <? } ?>
                                            <? if (in_array(1, $hs_tt)) { ?>
                                                <li>
                                                    <a href="quan-ly-ho-so-thanh-toan.html" class="<?= (in_array($_SERVER['REDIRECT_URL'], $ho_so_tt)) ? "active" : "" ?>"><span><?php echo $ic_circle ?></span>H??? s?? thanh to??n</a>
                                                </li>
                                            <? } ?>
                                            <? if (in_array(1, $phieu_tt)) { ?>
                                                <li>
                                                    <a href="quan-ly-phieu-thanh-toan.html" class="<?= (in_array($_SERVER['REDIRECT_URL'], $phieu_tt)) ? "active" : "" ?>"><span><?php echo $ic_circle ?></span>Phi???u thanh to??n</a>
                                                </li>
                                            <? } ?>
                                        </ul>
                                    </li>
                                <? }
                                if (in_array(1, $bang_gia) || in_array(1, $ycbg) || in_array(1, $bao_gia) || in_array(1, $bao_gia_kh)) { ?>
                                    <li class="collapse share_cursor <?= (in_array($_SERVER['REDIRECT_URL'], $bang_gia)) ? "active" : "" ?>" data-tab="subt-menu2">
                                        <a><span><?php echo $ic_bang_gia ?></span>B???ng gi??</a>
                                        <ul id="subt-menu2" class="<?= (in_array($_SERVER['REDIRECT_URL'], $bang_gia)) ? "active" : "" ?>">
                                            <? if (in_array(1, $bang_gia)) { ?>
                                                <li>
                                                    <a href="quan-ly-bang-gia.html" class="<?= ($_SERVER['REDIRECT_URL'] == '/quan-ly-bang-gia.html') ? "active" : "" ?>">
                                                        <span><?php echo $ic_circle ?></span>B???ng gi??</a>
                                                </li>

                                            <? }
                                            if (in_array(1, $ycbg)) { ?>
                                                <li>
                                                    <a href="quan-ly-yeu-cau-bao-gia.html" class="<?= (in_array($_SERVER['REDIRECT_URL'], $yc_baogia)) ? "active" : "" ?>">
                                                        <span><?php echo $ic_circle ?> </span>Y??u c???u b??o gi??
                                                    </a>
                                                </li>
                                            <? }
                                            if (in_array(1, $bao_gia)) { ?>
                                                <li>
                                                    <a href="quan-ly-bao-gia.html" class="<?= (in_array($_SERVER['REDIRECT_URL'], $bao_gia)) ? "active" : "" ?>">
                                                        <span><?php echo $ic_circle ?></span>B??o gi??
                                                    </a>
                                                </li>
                                            <? }
                                            if (in_array(1, $bao_gia_kh)) { ?>
                                                <li>
                                                    <a href="quan-ly-bao-gia-cho-khach-hang.html" class="<?= (in_array($_SERVER['REDIRECT_URL'], $bao_gia_kh)) ? "active" : "" ?>">
                                                        <span><?php echo $ic_circle ?></span>B??o gi?? cho kh??ch h??ng
                                                    </a>
                                                </li>
                                            <? } ?>
                                        </ul>
                                    </li>
                                <? }
                                if (in_array(1, $nha_cc) || in_array(1, $dgia_ncc) || in_array(1, $tieu_chi_dg)) { ?>
                                    <li class="collapse share_cursor share_height <?= (in_array($_SERVER['REDIRECT_URL'], $all_ncc)) ? "active" : "" ?>" data-tab="subt-menu3">
                                        <a><span><?php echo $ic_producer ?></span>Nh?? cung c???p</a>
                                        <ul id="subt-menu3" class="<?= (in_array($_SERVER['REDIRECT_URL'], $all_ncc)) ? "active" : "" ?>">
                                            <? if (in_array(1, $nha_cc)) { ?>
                                                <li>
                                                    <a href="quan-ly-nha-cung-cap.html" class="<?= (in_array($_SERVER['REDIRECT_URL'], $nha_cc)) ? "active" : "" ?>"><span><?php echo $ic_circle ?></span>Nh?? cung c???p</a>
                                                </li>
                                            <? }
                                            if (in_array(1, $dgia_ncc)) { ?>
                                                <li>
                                                    <a href="danh-gia-nha-cung-cap.html" class="<?= (in_array($_SERVER['REDIRECT_URL'], $danhg_ncc)) ? "active" : "" ?>"><span><?php echo $ic_circle ?></span>????nh gi?? nh?? cung c???p</a>
                                                </li>
                                            <? }
                                            if (in_array(1, $tieu_chi_dg)) { ?>
                                                <li>
                                                    <a href="tieu-chi-danh-gia.html" class="<?= (in_array($_SERVER['REDIRECT_URL'], $tieuc_dg)) ? "active" : "" ?>"><span><?php echo $ic_circle ?></span>Ti??u ch?? ????nh gi??</a>
                                                </li>
                                            <? } ?>
                                        </ul>
                                    </li>
                                <? }
                                if (in_array(1, $khach_hang)) { ?>
                                    <li class="<?= (in_array($_SERVER['REDIRECT_URL'], $khach_hang)) ? "active" : "" ?>">
                                        <a href="quan-ly-khach-hang.html"><span><?php echo $ic_customer ?></span>Kh??ch h??ng</a>
                                    </li>
                                <? }
                                if (in_array(1, $bc_doanh_so) || in_array(1, $cong_no_thu) || in_array(1, $cong_no_thu)) { ?>
                                    <li class="collapse share_cursor share_height  <?= (in_array($_SERVER['REDIRECT_URL'], $bao_cao)) ? "active" : "" ?>" data-tab="subt-menu4">
                                        <a><span><?php echo $ic_report ?></span>B??o c??o</a>
                                        <ul id="subt-menu4" class="<?= (in_array($_SERVER['REDIRECT_URL'], $bao_cao)) ? "active" : "" ?>">
                                            <? if (in_array(1, $bc_doanh_so)) { ?>
                                                <li>
                                                    <a href="bao-cao-doanh-so-ban-hang.html" class="<?= ($_SERVER['REDIRECT_URL'] == '/bao-cao-doanh-so-ban-hang.html') ? "active" : "" ?>">
                                                        <span><?php echo $ic_circle ?></span>Doanh s??? b??n h??ng</a>
                                                </li>
                                            <? }
                                            if (in_array(1, $cong_no_thu)) { ?>
                                                <li>
                                                    <a href="bao-cao-cong-no-phai-thu.html" class="<?= ($_SERVER['REDIRECT_URL'] == '/bao-cao-cong-no-phai-thu.html') ? "active" : "" ?>">
                                                        <span><?php echo $ic_circle ?></span>C??ng n??? ph???i thu</a>
                                                </li>
                                            <? }
                                            if (in_array(1, $cong_no_thu)) { ?>
                                                <li>
                                                    <a href="bao-cao-cong-no-phai-tra.html" class="<?= ($_SERVER['REDIRECT_URL'] == '/bao-cao-cong-no-phai-tra.html') ? "active" : "" ?>">
                                                        <span><?php echo $ic_circle ?></span>C??ng n??? ph???i tr???</a>
                                                </li>
                                            <? } ?>
                                        </ul>
                                    </li>
                        <?      }
                            } else {
                                echo "";
                            }
                        }
                        ?>
                        <li class="<?= (in_array($_SERVER['REDIRECT_URL'], $cai_dat)) ? "active" : "" ?>">
                            <a href="quan-ly-cai-dat.html"><span><?php echo $ic_setting ?></span>C??i ?????t chung</a>
                        </li>
                        <li class="collapse share_cursor" data-tab="subt-menu5">
                            <a><span><?php echo $ic_cds ?></span>Chuy???n ?????i s??? 365</a>
                            <ul id="subt-menu5">
                                <li>
                                    <a href="https://chamcong.timviec365.vn/"><span><?php echo $ic_circle ?></span>Ch???m
                                        c??ng</a>
                                </li>
                                <li>
                                    <a href="https://tinhluong.timviec365.vn/"><span><?php echo $ic_circle ?></span>T??nh
                                        l????ng</a>
                                </li>
                                <li>
                                    <a href="https://vanthu.timviec365.vn/"><span><?php echo $ic_circle ?></span>V??n th??
                                        l??u tr???</a>
                                </li>
                                <li>
                                    <a href="https://phanmemnhansu.timviec365.vn/"><span><?php echo $ic_circle ?></span>Qu???n
                                        tr??? nh??n s???</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>