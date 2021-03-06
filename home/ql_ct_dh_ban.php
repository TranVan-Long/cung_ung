<?
include "../includes/icon.php";
include("config.php");

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
        $user_id = $_SESSION['com_id'];
        $com_name = $_SESSION['com_name'];
        $phan_quyen_nk = 1;

        $curl = curl_init();
        $token = $_COOKIE['acc_token'];
        curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_employee_of_company.php');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
        $response = curl_exec($curl);
        curl_close($curl);

        $data_list = json_decode($response, true);
        $data_list_nv = $data_list['data']['items'];
        $count = count($data_list_nv);

    } else if ($_COOKIE['role'] == 2) {
        $com_id = $_SESSION['user_com_id'];
        $com_name = $_SESSION['com_name'];
        $user_id = $_SESSION['ep_id'];
        $phan_quyen_nk = 2;

        $curl = curl_init();
        $token = $_COOKIE['acc_token'];
        curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_my_partner.php?get_all=true');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
        $response = curl_exec($curl);
        curl_close($curl);

        $data_list = json_decode($response, true);
        $data_list_nv = $data_list['data']['items'];
        $count = count($data_list_nv);

        $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
        if (mysql_num_rows($kiem_tra_nv->result) > 0) {
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `don_hang` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $don_hang3 = explode(',', $item_nv['don_hang']);
            if (in_array(1, $don_hang3) == FALSE) {
                header('Location: /quan-ly-trang-chu.html');
            }
        } else {
            header('Location: /quan-ly-trang-chu.html');
        }
    }
};


$all_nv = [];
for ($i = 0; $i < $count; $i++) {
    $item = $data_list_nv[$i];
    $all_nv[$item['ep_id']] = $item;
};

if (isset($_GET['id']) && $_GET['id'] != "") {
    $id_dh = $_GET['id'];
    $ctiet_dh = mysql_fetch_assoc((new db_query("SELECT d.`id`, d.`id_nguoi_lh`, d.`id_hop_dong`, d.`id_du_an_ctrinh`, d.`ngay_ky`,
                                d.`thoi_han`, d.`don_vi_nhan_hang`, d.`phong_ban`, d.`nguoi_nhan_hang`, d.`dien_thoai_nn`, d.`giu_lai_bao_hanh`, d.`gia_tri_tuong_duong`,
                                d.`ghi_chu`, d.`gia_tri_don_hang`, d.`thue_vat`, d.`gia_tri_svat`, d.`bao_gom_vat`, d.`chiet_khau`, d.`chi_phi_vchuyen`,
                                d.`ghi_chu_vchuyen`, d.`phan_loai`, d.`hieu_luc`, d.`trang_thai`, n.`ten_nha_cc_kh`, n.`dia_chi_lh`, n.`so_dien_thoai`
                                FROM `don_hang` AS d
                                INNER JOIN `nha_cc_kh` AS n ON d.`id_nha_cc_kh` = n.`id`
                                WHERE d.`id` = $id_dh AND d.`id_cong_ty` = $com_id AND d.`phan_loai` = 2 "))->result);
    $thue_dh = $ctiet_dh['thue_vat'];

    $list_vt_dhb = new db_query("SELECT `id`, `id_don_hang`, `id_hd`, `id_vat_tu`, `so_luong_ky_nay`, `thoi_gian_giao_hang`,
                                    `don_gia`, `tong_tien_trvat`, `thue_vat`, `tong_tien_svat`, `dia_diem_giao_hang`
                                    FROM `vat_tu_dh_mua_ban` WHERE `id_don_hang` = $id_dh AND `id_cong_ty` = $com_id ");

    $curl = curl_init();
    $token = $_COOKIE['acc_token'];
    curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlycongtrinh.timviec365.vn/api/dscongtrinh.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
    $response = curl_exec($curl);
    curl_close($curl);
    $data_list = json_decode($response, true);
    $list_ctrinh = $data_list['data']['items'];
    $cou1 = count($list_ctrinh);


    $all_ctrinh = [];
    for ($k = 0; $k < $cou1; $k++) {
        $item2 = $list_ctrinh[$k];
        $all_ctrinh[$item2['ctr_id']] = $item2;
    };

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
    $list_vattu = $data_list['data']['items'];
    $cou1 = count($list_vattu);

    $all_vattu = [];
    for ($l = 0; $l < $cou1; $l++) {
        $item3 = $list_vattu[$l];
        $all_vattu[$item3['dsvt_id']] = $item3;
    };
} else {
    echo "";
};

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi ti???t h???p ?????ng b??n</title>
    <link href="https://timviec365.vn/favicon.ico" rel="shortcut icon" />

    <link rel="preload" href="../fonts/Roboto-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous" />

    <link rel="preload" as="style" rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" media="all" href="../css/app.css" media="all" onload="if (media != 'all')media='all'">
    <link rel="preload" as="style" rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" media="all" href="../css/style.css" media="all" onload="if (media != 'all')media='all'">

</head>

<body>
    <div class="main-container ql_ct_dh_ban">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>
            <div class="content">
                <div class="ctn_ctiet_hd w_100 float_l">
                    <div class="chi_tiet_hd mt_27 w_100 float_l">
                        <a class="prew_href share_fsize_one share_clr_one mb_26" href="quan-ly-don-hang.html">Quay
                            l???i</a>
                        <h4 class="tieu_de_ct w_100 float_l share_fsize_tow share_clr_four mb_25 cr_weight_bold">Chi
                            ti???t ????n h??ng b??n v???t t??</h4>
                        <div class="ctiet_dk_hp w_100 float_l" data="<?= $phan_quyen_nk ?>" data1="<?= $user_id ?>">
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">T??n kh??ch h??ng</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $ctiet_dh['ten_nha_cc_kh'] ?>
                                    </p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">?????a ch???</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $ctiet_dh['dia_chi_lh'] ?>
                                    </p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Ng?????i li??n h???</p>
                                        <p class="cr_weight share_fsize_tow share_clr_one">
                                            <?= $all_nv[$ctiet_dh['id_nguoi_lh']]['ep_name'] ?>
                                        </p>

                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">S??? ??i???n tho???i / Fax</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $ctiet_dh['so_dien_thoai'] ?>
                                    </p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">H???p ?????ng</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">H?? -
                                        <?= $ctiet_dh['id_hop_dong'] ?></p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">S??? ????n h??ng</p>
                                    <p class="cr_weight share_fsize_tow">??H - <?= $id_dh ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Ng??y k??</p>
                                    <? if ($ctiet_dh['ngay_ky'] != 0 && $ctiet_dh['ngay_ky'] != "") { ?>
                                        <p class="cr_weight share_fsize_tow share_clr_one">
                                            <?= date('d/m/Y', $ctiet_dh['ngay_ky']) ?></p>
                                    <? } else { ?>
                                        <p class="cr_weight share_fsize_tow share_clr_one"></p>
                                    <? } ?>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">D??? ??n / C??ng tr??nh</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">
                                        <?= $all_ctrinh[$ctiet_dh['id_du_an_ctrinh']]['ctr_name'] ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Th???i h???n ????n h??ng</p>
                                    <? if ($ctiet_dh['thoi_han'] != "" && $ctiet_dh['thoi_han'] != 0) { ?>
                                        <p class="cr_weight share_fsize_tow share_clr_one">
                                            <?= date('d/m/Y', $ctiet_dh['thoi_han']) ?></p>
                                    <? } else { ?>
                                        <p class="cr_weight share_fsize_tow share_clr_one"></p>
                                    <? } ?>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">????n v??? nh???n h??ng</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">
                                        <?= $ctiet_dh['don_vi_nhan_hang'] ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Ng?????i nh???n h??ng</p>
                                    <? if ($ctiet_dh['phan_loai'] == 1) { ?>
                                        <p class="cr_weight share_fsize_tow share_clr_one">
                                            <?= $all_nv[$ctiet_dh['nguoi_nhan_hang']]['ep_name'] ?></p>
                                    <? } else if ($ctiet_dh['phan_loai'] == 2) { ?>
                                        <p class="cr_weight share_fsize_tow share_clr_one">
                                            <?= $ctiet_dh['nguoi_nhan_hang'] ?></p>
                                    <? } ?>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Ph??ng ban</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $ctiet_dh['phong_ban'] ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">S??? ??i???n tho???i ng?????i nh???n</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $ctiet_dh['dien_thoai_nn'] ?>
                                    </p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Gi??? l???i b???o h??nh</p>
                                    <? if ($ctiet_dh['giu_lai_bao_hanh'] == 0) { ?>
                                        <p class="cr_weight share_fsize_tow share_clr_one"></p>
                                    <? } else if ($ctiet_dh['giu_lai_bao_hanh'] != 0 && $ctiet_dh['giu_lai_bao_hanh'] != "") { ?>
                                        <p class="cr_weight share_fsize_tow share_clr_one">
                                            <?= $ctiet_dh['giu_lai_bao_hanh'] ?>% t????ng ??????ng
                                            <?= number_format($ctiet_dh['gia_tri_tuong_duong']) ?></p>
                                    <? } ?>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Ghi ch??</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= $ctiet_dh['ghi_chu'] ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Gi?? tr??? tr?????c VAT</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">
                                        <?= number_format($ctiet_dh['gia_tri_don_hang']) ?></p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">????n gi?? ???? bao g???m VAT</p>
                                    <? if ($ctiet_dh['bao_gom_vat'] == 0) { ?>
                                        <p class="cr_weight share_fsize_tow cr_red">Kh??ng</p>
                                    <? } else if ($ctiet_dh['bao_gom_vat'] == 1) { ?>
                                        <p class="cr_weight share_fsize_tow cr_green">C??</p>
                                    <? } ?>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Thu??? su???t VAT</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one"><?= formatMoney($thue_dh) ?></p>
                                </div>
                                <div class="ctiet_hd_right pr-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Ti???n chi???t kh???u</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">
                                        <?= number_format($ctiet_dh['chiet_khau']) ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Gi?? tr??? sau VAT</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">
                                        <?= number_format($ctiet_dh['gia_tri_svat']) ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Chi ph?? v???n chuy???n</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">
                                        <?= $ctiet_dh['chi_phi_vchuyen'] ?></p>
                                </div>
                            </div>
                            <div class="chitiet_hd w_100 float_l">
                                <div class="ctiet_hd_left float_l pl-10">
                                    <p class="ten_ctiet share_fsize_tow share_clr_one">Ghi ch?? v???n chuy???n</p>
                                    <p class="cr_weight share_fsize_tow share_clr_one">
                                        <?= $ctiet_dh['ghi_chu_vchuyen'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="ctiet_hopd_vt w_100 float_l">
                            <div class="ctn_table_ct w_100 float_l">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="share_tb_one">STT</th>
                                            <th class="share_tb_two">M?? v???t t??</th>
                                            <th class="share_tb_two">T??n ?????y ????? v???t t?? thi???t b???</th>
                                            <th class="share_tb_one">????n v??? t??nh</th>
                                            <th class="share_tb_two">H??ng s???n xu???t</th>
                                            <th class="share_tb_one">S??? l?????ng</th>
                                            <th class="share_tb_two">Th???i gian giao h??ng</th>
                                            <th class="share_tb_two">????n gi?? (VN??)</th>
                                            <th class="share_tb_two">T???ng ti???n tr?????c VAT (VN??)</th>
                                            <th class="share_tb_one">Thu??? VAT (%)</th>
                                            <th class="share_tb_two">T???ng ti???n sau VAT (VN??)</th>
                                            <th class="share_tb_two">?????a ??i???m giao h??ng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <? while ($row1 = mysql_fetch_assoc($list_vt_dhb->result)) { ?>
                                            <tr>
                                                <td class="share_tb_one"><?= $stt++ ?></td>
                                                <td class="share_tb_two">VT - <?= $row1['id_vat_tu'] ?></td>
                                                <td class="share_tb_two"><?= $all_vattu[$row1['id_vat_tu']]['dsvt_name'] ?></td>
                                                <td class="share_tb_one"><?= $all_vattu[$row1['id_vat_tu']]['dvt_name'] ?></td>
                                                <td class="share_tb_two"><?= $all_vattu[$row1['id_vat_tu']]['hsx_name'] ?></td>
                                                <td class="share_tb_one"><?= $row1['so_luong_ky_nay'] ?></td>
                                                <td class="share_tb_two"><?= ($row1['thoi_gian_giao_hang'] != 0) ? date('d/m/Y', $row1['thoi_gian_giao_hang']) : "" ?></td>
                                                <td class="share_tb_two"><?= formatMoney($row1['don_gia']) ?></td>
                                                <td class="share_tb_two"><?= formatMoney($row1['tong_tien_trvat']) ?></td>
                                                <td class="share_tb_one"><?= formatMoney($row1['thue_vat']) ?></td>
                                                <td class="share_tb_two"><?= formatMoney($row1['tong_tien_svat']) ?></td>
                                                <td class="share_tb_two"><?= ($row1['dia_diem_giao_hang'] != '0') ? $row1['dia_diem_giao_hang'] : "" ?></td>
                                            </tr>
                                        <? } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="xuat_gmc w_100 float_l">
                            <div class="xuat_gmc_two share_xuat_gmc d_flex mb_10 right">
                                <? if($ctiet_dh['trang_thai'] == 1){
                                     if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) { ?>
                                    <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_tow cr_red remove_dh">
                                        X??a</p>
                                    <a href="chinh-sua-don-hang-ban-<?= $id_dh ?>.html" class="v-btn btn-blue ml_20">Ch???nh s???a</a>
                                <? } else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
                                    if (in_array(4, $don_hang3)) { ?>
                                        <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_bgr_tow cr_red remove_dh">
                                            X??a</p>
                                    <? }
                                    if (in_array(3, $don_hang3)) { ?>
                                        <a href="chinh-sua-don-hang-ban-<?= $id_dh ?>.html" class="v-btn btn-blue ml_20">Ch???nh s???a</a>
                                <? }
                                }}else if($ctiet_dh['trang_thai'] == 2){ echo ""; } ?>
                            </div>
                            <div class="xuat_gmc_one share_xuat_gmc d_flex left mb_10 mr_10">
                                <p class="share_w_148 share_h_36 share_fsize_tow share_clr_tow cr_weight xuat_excel" data=<?= $id_dh ?>>Xu???t Excel</p>
                                <p class="share_w_148 share_h_36 share_fsize_tow cr_weight share_clr_four ml_20 gui_mail" data1="<?= $id_dh ?>" data2="<?= $com_id ?>" data3="<?= $com_name ?>">G???i mail</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal_share modal_share_tow">
        <div class="modal-content">
            <div class="info_modal">
                <div class="modal-header">
                    <div class="header_ctn_share">
                        <h4 class="ctn_share_h share_clr_tow tex_center cr_weight_bold">X??A ????N H??NG</h4>
                        <span class="close_detl close_dectl">&times;</span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="ctn_body_modal">
                        <div class="madal_form">
                            <div class="ctiet_pop mt_20">
                                <p class="share_fsize_tow share_clr_one">B???n c?? ch???c ch???n mu???n x??a ????n h??ng n??y?</p>
                                <p class="share_fsize_tow share_clr_one">Thao t??c n??y s??? kh??ng th??? ho??n t??c.</p>
                            </div>
                            <div class="form_butt_ht mb_20">
                                <div class="tow_butt_flex d_flex">
                                    <button type="button" class="js_btn_huy mb_10 share_cursor btn_d share_w_148 share_clr_four share_bgr_tow share_h_36">H???y</button>
                                    <button type="button" class="share_w_148 mb_10 share_cursor share_clr_tow share_h_36 sh_bgr_six save_new_dp" data="<?= $com_id ?>" data-id="<?= $id_dh ?>">?????ng
                                        ??</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "../modals/modal_logout.php" ?>
    <? include("../modals/modal_menu.php") ?>


</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript">
    var remove_dh = $(".remove_dh");

    remove_dh.click(function() {
        modal_share.show();
    });

    $(".save_new_dp").click(function() {
        var id_dh = $(this).attr("data-id");
        var com_id = $(this).attr("data");
        var user_id = $(".ctiet_dk_hp").attr("data1");
        var phan_quyen_nk = $(".ctiet_dk_hp").attr("data");
        $.ajax({
            url: '../ajax/xoa_dh_ban.php',
            type: 'POST',
            data: {
                id_dh: id_dh,
                com_id: com_id,
                user_id: user_id,
                phan_quyen_nk: phan_quyen_nk,
            },
            success: function(data) {
                if (data == "") {
                    window.location.href = '/quan-ly-don-hang.html';
                } else {
                    alert(data);
                }
            }
        });
    });
    $(".gui_mail").click(function() {
        var id = $(this).attr("data1");
        var com_id = $(this).attr("data2");
        var com_name = $(this).attr("data3");
        var token = "<?= $_COOKIE['acc_token'] ?>";

        $.ajax({
            url: '../ajax/gui_mail_dhb.php',
            type: 'POST',
            data: {
                id: id,
                com_id: com_id,
                com_name: com_name,
                token: token,
            },
            success: function(data) {
                if (data == "") {
                    alert("G???i email th??nh c??ng.");
                    window.location.reload();
                } else {
                    alert(data);
                }
            }

        })
    });
    $(".xuat_excel").click(function() {
        var id = $(this).attr("data");
        window.location.href = '../excel/dh_ban_excel.php?id=' + id;
    });
</script>

</html>