<?php
include "../includes/icon.php";
include("config.php");
if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $user_id = $_SESSION['com_id'];
        $com_id = $_SESSION['com_id'];
        $quyen = 1;

        $curl = curl_init();
        $token = $_COOKIE['acc_token'];
        curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_employee_of_company.php');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
        $response = curl_exec($curl);
        curl_close($curl);

        $data_list = json_decode($response, true);
        $list_nv = $data_list['data']['items'];
        $count = count($list_nv);
    } else if ($_COOKIE['role'] == 2) {
        $user_id = $_SESSION['ep_id'];
        $com_id = $_SESSION['user_com_id'];
        $quyen = 2;

        $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
        if (mysql_num_rows($kiem_tra_nv->result) > 0) {
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `don_hang` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $don_hang2 = explode(',', $item_nv['don_hang']);
            if (in_array(2, $don_hang2) == FALSE) {
                header('Location: /quan-ly-trang-chu.html');
            }
        } else {
            header('Location: /quan-ly-trang-chu.html');
        }

        $curl = curl_init();
        $token = $_COOKIE['acc_token'];
        curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_my_partner.php?get_all=true');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
        $response = curl_exec($curl);
        curl_close($curl);

        $data_list = json_decode($response, true);
        $list_nv = $data_list['data']['items'];
        $count = count($list_nv);
    }
};


$list_ncc = new db_query("SELECT DISTINCT n.`id`, n.`ten_nha_cc_kh` FROM `nha_cc_kh` AS n
                        INNER JOIN `hop_dong` AS h ON n.`id` = h.`id_nha_cc_kh`
                        WHERE n.`phan_loai` = 1 AND n.`id_cong_ty` = $com_id AND h.`phan_loai` = 1 ");

$curl = curl_init();
$token = $_COOKIE['acc_token'];
curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlycongtrinh.timviec365.vn/api/dscongtrinh.php');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
$response = curl_exec($curl);
curl_close($curl);
$data_list = json_decode($response, true);
$all_ctrinh = $data_list['data']['items'];
$cou = count($all_ctrinh);

$all_ctr = [];
for ($i = 0; $i < $cou; $i++) {
    $item2 = $all_ctrinh[$i];
    $all_ctr[$item2['ctr_id']] = $item2;
};

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://chamcong.24hpay.vn/service/detail_company.php?id_com=" . $com_id);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($curl);
curl_close($curl);
$com0 = json_decode($response, true);
$dep = $com0['data']['list_department'];
$cou1 = count($dep);


?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Th??m ????n h??ng mua v???t t??</title>
    <link href="https://timviec365.vn/favicon.ico" rel="shortcut icon" />

    <link rel="preload" href="../fonts/Roboto-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous" />

    <link href="../css/select2.min.css" rel="stylesheet" />

    <link rel="preload" as="style" rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" media="all" href="../css/app.css" media="all" onload="if (media != 'all')media='all'">
    <link rel="preload" as="style" rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" media="all" href="../css/style.css" media="all" onload="if (media != 'all')media='all'">

</head>

<body>
    <div class="main-container ql_them_dh">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="ctn_ctiet_hd mt_20 w_100 float_l">
                    <div class="chi_tiet_hd w_100 float_l">
                        <a class="prew_href share_fsize_one share_clr_one" href="quan-ly-don-hang.html">
                            Quay l???i</a>
                        <h4 class="tieu_de_ct w_100 mt_25 mb_20 float_l share_fsize_tow share_clr_one cr_weight_bold">
                            Th??m ????n h??ng mua v???t t??</h4>
                        <div class="ctiet_dk_hp w_100 float_l" data="<?= $quyen ?>">
                            <form class="form_add_hp_mua share_distance w_100 float_l" data="<?= $com_id ?>" data1="<?= $user_id ?>">
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>T??n nh?? cung c???p <span class="cr_red">*</span></label>
                                        <select name="ten_nhacc" class="form-control all_nhacc" data="<?= $com_id ?>">
                                            <option value="">Nh???p t??n nh?? cung c???p</option>
                                            <? while ($item1 = mysql_fetch_assoc($list_ncc->result)) { ?>
                                                <option value="<?= $item1['id'] ?>"><?= $item1['ten_nha_cc_kh'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                    <div class="form-group diachi_doi">
                                        <label>?????a ch???</label>
                                        <input type="text" name="dia_chi" class="form-control" placeholder="?????a ch??? nh?? cung c???p" readonly>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l thay_doi">
                                    <div class="form-group share_form_select">
                                        <label>Ng?????i li??n h???</label>
                                        <select name="nguoi_lh" class="form-control share_select">
                                            <option value=""> -- Ch???n ng?????i li??n h??? --</option>
                                        </select>
                                    </div>
                                    <div class="form-group share_form_select">
                                        <label>S??? ??i???n tho???i / Fax</label>
                                        <input type="text" name="so_dthoai" class="form-control" placeholder="S??? ??i???n tho???i / Fax nh?? cung c???p" readonly>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>H???p ?????ng <span class="cr_red">*</span></label>
                                        <select name="hop_dong" class="form-control all_hd share_select" data="<?= $com_id ?>">
                                            <option value="">-- Ch???n h???p ?????ng --</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Ng??y k?? ????n h??ng</label>
                                        <input type="date" name="ngay_ky" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group cong_trinh">
                                        <label>D??? ??n / C??ng tr??nh</label>
                                        <input type="text" name="duan_ctrinh" class="form-control" placeholder="D??? ??n / C??ng tr??nh" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Th???i h???n ????n h??ng</label>
                                        <input type="date" name="thoi_han" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>????n v??? nh???n h??ng <span class="cr_red">*</span></label>
                                        <input type="text" name="donv_nh" class="form-control" placeholder="Nh???p ????n v??? nh???n h??ng">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Ph??ng ban</label>
                                        <select name="phong_ban" class="form-control phong_ban share_select" data="<?= $quyen ?>">
                                            <option value="">-- Ch???n ph??ng ban ng?????i nh???n --</option>
                                            <? for ($i = 0; $i < $cou1; $i++) { ?>
                                                <option value="<?= $dep[$i]['dep_id'] ?>"><?= $dep[$i]['dep_name'] ?></option>
                                            <? } ?>
                                        </select>
                                        <!-- <input type="text" name="phong_ban" class="form-control" placeholder="Nh???p ph??ng ban ng?????i nh???n"> -->
                                    </div>
                                    <div class="form-group share_form_select">
                                        <label>Ng?????i nh???n h??ng <span class="cr_red">*</span></label>
                                        <select name="nguoi_nh" class="form-comtrol nguoi_nh share_select">
                                            <option value="">-- Ch???n ng?????i nh???n h??ng --</option>
                                            <? for ($j = 0; $j < $count; $j++) { ?>
                                                <option value="<?= $list_nv[$j]['ep_id'] ?>">(<?= $list_nv[$j]['ep_id'] ?>) <?= $list_nv[$j]['ep_name'] ?></option>
                                            <? } ?>
                                        </select>
                                        <!-- <input type="text" name="nguoi_nh" class="form-control" placeholder="Nh???p ng?????i nh???n h??ng"> -->
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>S??? ??i???n tho???i ng?????i nh???n</label>
                                        <input type="text" name="dient_nnhan" oninput="<?= $oninput ?>" placeholder="Nh???p s??? ??i???n tho???i ng?????i nh???n" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Gi??? l???i b???o h??nh</label>
                                        <div class="bao_hanh w_100 float_l d_flex fl_agi">
                                            <div class="bef_ptram">
                                                <span class="phan_tram">%</span>
                                                <input type="text" name="baoh_hd" class="baoh_pt pt_bao_hanh pl-10 share_fsize_one" oninput="<?= $oninput ?>" onkeyup="baoHanh()">
                                            </div>
                                            <span>t????ng ??????ng</span>
                                            <input type="text" name="gia_tri" class="gia_tri gia_tri_bh pl-10 share_fsize_one" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Ghi ch??</label>
                                    <textarea name="yc_tiendo" rows="5" class="form-control" placeholder="Nh???p ghi ch??"></textarea>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Gi?? tr??? tr?????c VAT</label>
                                        <input type="text" name="giatr_vat" id="tong_truoc_vat" class="form-control h_border cr_weight" readonly>
                                    </div>
                                    <div class="form-group  d_flex fl_agi form_lb">
                                        <label for="lab_cli">????n gi?? ???? bao g???m VAT</label>
                                        <input type="checkbox" name="dgia_vat" id="lab_cli">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group share_form_select">
                                        <label>Thu??? su???t VAT</label>
                                        <input type="text" name="thue_vat_tong" class="form-control thue_vat_tong" placeholder="Nh???p thu??? su???t VAT" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Ti???n chi???t kh???u</label>
                                        <input type="text" name="tien_ckhau" class="form-control" oninput="<?= $oninput ?>" placeholder="Nh???p s??? ti???n chi???t kh???u">
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l">
                                    <div class="form-group">
                                        <label>Gi?? tr??? sau VAT</label>
                                        <input type="text" name="gias_vat" id="tong_sau_vat" class="form-control h_border cr_weight" readonly>
                                    </div>
                                </div>
                                <div class="form-row w_100 float_l chiphi_vc">
                                    <div class="form-group">
                                        <label>Chi ph?? v???n chuy???n</label>
                                        <input type="number" name="chi_phi_vc" class="form-control" placeholder="Nh???p chi ph?? v???n chuy???n">
                                    </div>
                                </div>
                                <div class="form-group w_100 float_l">
                                    <label>Ghi ch?? v???n chuy???n</label>
                                    <textarea name="ghic_vc" rows="5" class="form-control" placeholder="Nh???p ghi ch?? v???n chuy???n"></textarea>
                                </div>

                                <div class="them_moi_vt w_100 float_l mt_25">
                                    <div class="ctn_table w_100 float_l">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="share_tb_seven"></th>
                                                    <th class="share_tb_seven">STT</th>
                                                    <th class="share_tb_one">M?? v???t t??</th>
                                                    <th class="share_tb_two">T??n ?????y ????? v???t t?? thi???t b???</th>
                                                    <th class="share_tb_seven">????n v??? t??nh</th>
                                                    <th class="share_tb_two">H??ng s???n xu???t</th>
                                                    <th class="share_tb_eight">S??? l?????ng theo h???p ?????ng</th>
                                                    <th class="share_tb_eight">S??? l?????ng l??y k??? k??? tr?????c</th>
                                                    <th class="share_tb_one">S??? l?????ng k??? n??y</th>
                                                    <th class="share_tb_eight">Th???i gian giao h??ng</th>
                                                    <th class="share_tb_two">????n gi??</th>
                                                    <th class="share_tb_two">T???ng ti???n tr?????c VAT</th>
                                                    <th class="share_tb_seven">Thu??? VAT</th>
                                                    <th class="share_tb_eight">T???ng ti???n sau VAT</th>
                                                    <th class="share_tb_two">?????a ??i???m giao h??ng</th>
                                                </tr>
                                            </thead>
                                            <tbody class="danh_sach_vt">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-button w_100">
                                    <div class="form_button dh_button">
                                        <button type="button" class="cancel_add mt-10 share_cursor share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_four share_bgr_tow share_fsize_tow">H???y</button>
                                        <button type="button" class="save_add mt-10 share_cursor share_cursor share_w_148 share_h_36 cr_weight s_radius_two share_clr_tow share_bgr_one share_fsize_tow">Xong</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal_share modal_share_tow them_dh_mua">
        <div class="modal-content">
            <div class="info_modal">
                <div class="modal-header">
                    <div class="header_ctn_share">
                        <h4 class="ctn_share_h share_clr_tow tex_center cr_weight_bold">TH??NG B??O</h4>
                        <span class="close_detl close_dectl">&times;</span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="ctn_body_modal">
                        <div class="madal_form">
                            <div class="ctiet_pop mt_20">
                                <p class="share_fsize_tow share_clr_one">B???n c?? ch???c ch???n mu???n h???y vi???c th??m ????n h??ng?
                                </p>
                                <p class="share_fsize_tow share_clr_one">Thao t??c n??y s??? kh??ng th??? ho??n t??c.</p>
                            </div>
                            <div class="form_butt_ht mb_20">
                                <div class="tow_butt_flex d_flex dh_dy_pop">
                                    <button type="button" class="js_btn_huy mb_10 share_cursor btn_d share_w_148 share_clr_four share_bgr_tow share_h_36">H???y</button>
                                    <button type="button" class="share_w_148 mb_10 share_cursor share_clr_tow share_h_36 sh_bgr_six save_new_dp">?????ng
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
<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
<script type="text/javascript" src="../js/giatri_doi.js"></script>
<script>
    $(".all_nhacc, .all_da_ct, .ma_vatt").select2({
        width: '100%',
    });

    var cancel_add = $(".cancel_add");
    cancel_add.click(function() {
        modal_share.show();
    });

    $(".all_nhacc").change(function() {
        var id_ncc = $(this).val();
        var com_id = $(this).attr("data");

        $.ajax({
            url: '../render/diachi_lh_dhm.php',
            type: 'POST',
            data: {
                id_ncc: id_ncc,
                com_id: com_id,
            },
            success: function(data) {
                $(".diachi_doi").html(data);
            }
        });

        $.ajax({
            url: '../render/nguoi_lhe_ncc.php',
            type: 'POST',
            data: {
                id_ncc: id_ncc,
                com_id: com_id,
            },
            success: function(data) {
                $(".thay_doi").html(data);
                RefSelect2();
            }
        });

        $.ajax({
            url: '../render/ds_hdm.php',
            type: 'POST',
            data: {
                com_id: com_id,
                id_ncc: id_ncc,
            },
            success: function(data) {
                $(".all_hd").html(data);
            }
        });

        $.ajax({
            url: '../render/ds_vattu_hdm.php',
            type: 'POST',
            data: {
                com_id: com_id,
            },
            success: function(data) {
                $(".danh_sach_vt").html(data);
            }
        });
    });

    $(".all_hd").change(function() {
        var id_hd = $(this).val();
        var com_id = $(this).attr("data");
        var id_ncc = $(".all_nhacc").val();

        $.ajax({
            url: '../render/ctrinh_hd.php',
            type: 'POST',
            data: {
                id_hd: id_hd,
                com_id: com_id,
            },
            success: function(data) {
                $(".cong_trinh").html(data);
            }
        });

        $.ajax({
            url: '../render/ds_vattu_hdm.php',
            type: 'POST',
            data: {
                id_hd: id_hd,
                com_id: com_id,
                id_ncc: id_ncc,

            },
            success: function(data) {
                $(".danh_sach_vt").html(data);
            }
        });

        $.ajax({
            url: '../render/check_hdbg_vc.php',
            type: 'POST',
            data: {
                id_hd: id_hd,
                com_id: com_id,
            },
            success: function(data) {
                $(".chiphi_vc").html(data);
            }
        });
    });

    $(".phong_ban").change(function() {
        var dep_id = $(this).val();
        var quyen = $(this).attr("data");
        var com_id = $(".form_add_hp_mua").attr("data");
        var token = "<?= $_COOKIE['acc_token'] ?>";

        $.ajax({
            url: '../render/ds_pban_nhanvien.php',
            type: 'POST',
            data: {
                dep_id: dep_id,
                com_id: com_id,
                token: token,
                quyen: quyen,
            },
            success: function(data) {
                $(".nguoi_nh").html(data);
            }
        })
    });


    $('.save_add').click(function() {
        var form = $('.form_add_hp_mua');
        form.validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parent('.form-group'));
                error.wrap('<span class="error">');
            },
            rules: {
                ten_nhacc: {
                    required: true,
                },
                hop_dong: {
                    required: true,
                },
                donv_nh: {
                    required: true,
                },
                nguoi_nh: {
                    required: true,
                }
            },
            messages: {
                ten_nhacc: {
                    required: "Vui l??ng ch???n nh?? cung c???p.",
                },
                hop_dong: {
                    required: "Vui l??ng ch???n h???p ?????ng.",
                },
                donv_nh: {
                    required: "????n v??? nh???n h??ng kh??ng ???????c ????? tr???ng.",
                },
                nguoi_nh: {
                    required: "Ng?????i nh???n h??ng kh??ng ???????c ????? tr???ng."
                }
            }
        });
        if (form.valid() === true) {
            var com_id = $(".form_add_hp_mua").attr("data");
            var user_id = $(".form_add_hp_mua").attr("data1");
            var ten_ncc = $("select[name='ten_nhacc']").val();
            var nguoi_lh = $("select[name='nguoi_lh']").val();
            var hop_dong = $("select[name='hop_dong']").val();
            var ngay_ky_dh = $("input[name='ngay_ky']").val();
            var id_cong_trinh = "";
            var thoi_han = $("input[name='thoi_han']").val();
            var dv_nhan_hang = $("input[name='donv_nh']").val();
            var nguoi_nhan_hang = $("select[name='nguoi_nh']").val();
            var phong_ban = $("select[name='phong_ban']").val();
            var dient_nnhan = $("input[name='dient_nnhan']").val();
            var phan_tram_bh = $("input[name='baoh_hd']").val();
            var gia_tri_bh = $("input[name='gia_tri']").val();
            var ghi_chu = $("textarea[name='yc_tiendo']").val();
            var giatr_vat = $("input[name='giatr_vat']").val();
            var baogom_dg_vat = 0;
            if ($("input[name='dgia_vat']").is(":checked")) {
                baogom_dg_vat = 1;
            };
            var thue_vat = $("input[name='thue_vat_tong']").val();
            var tien_ckhau = $("input[name='tien_ckhau']").val();
            var gias_vat = $("input[name='gias_vat']").val();
            var chi_phi_vc = $("input[name='chi_phi_vc']").val();
            var ghic_vc = $("textarea[name='ghic_vc']").val();

            var ma_vt = [];
            $("input[name='ma_vattu']").each(function() {
                var id_vt = $(this).attr("data");
                if (id_vt != "") {
                    ma_vt.push(id_vt);
                }
            });

            var so_luong_hd = [];
            $("input[name='so_luong_hd']").each(function() {
                var sl_hd = $(this).val();
                if (sl_hd != "") {
                    so_luong_hd.push(sl_hd);
                }
            });

            var don_gia = [];
            $("input[name='don_gia']").each(function() {
                var dg_vt = $(this).val();
                if (dg_vt != "") {
                    don_gia.push(dg_vt);
                }
            });

            var sl_knay = [];
            $("input[name='sl_knay']").each(function() {
                var sl_kn = $(this).val();
                if (sl_kn == "") {
                    sl_kn = 0;
                    sl_knay.push(sl_kn);
                } else if (sl_kn != "") {
                    sl_knay.push(sl_kn);
                }
            });

            var thoig_ghang = [];
            $("input[name='thoig_ghang']").each(function() {
                var tg_gh = $(this).val();
                if (tg_gh == "") {
                    tg_gh = 0;
                    thoig_ghang.push(tg_gh);
                } else {
                    thoig_ghang.push(tg_gh);
                }
            });

            var ttr_vat = [];
            $("input[name='ttr_vat']").each(function() {
                var tien_tr = $(this).val();
                if (tien_tr == "") {
                    tien_tr = 0;
                    ttr_vat.push(tien_tr);
                } else {
                    ttr_vat.push(tien_tr);
                }
            });

            var thue_vat_vt = [];
            $("input[name='thue_vat']").each(function() {
                var thue_vt = $(this).val();
                if (thue_vt == "") {
                    thue_vt = 0;
                    thue_vat_vt.push(thue_vt);
                } else if (thue_vt != "") {
                    thue_vat_vt.push(thue_vt);
                }
            });

            var tts_vat = [];
            $("input[name='tts_vat']").each(function() {
                var tien_s = $(this).val();
                if (tien_s == "") {
                    tien_s = 0;
                    tts_vat.push(tien_s);
                } else if (tien_s != "") {
                    tts_vat.push(tien_s);
                }
            });

            var dia_chi_g = [];
            $("input[name='dia_chi_g']").each(function() {
                var dia_chi = $(this).val();
                if (dia_chi == "") {
                    dia_chi = 0;
                    dia_chi_g.push(dia_chi);
                } else {
                    dia_chi_g.push(dia_chi);
                }

            });

            var phan_loai_nk = $(".ctiet_dk_hp").attr("data");

            if (thoi_han != "" && ngay_ky_dh != "") {
                if (thoi_han < ngay_ky_dh) {
                    alert("Th???i h???n giao h??ng kh??ng nh??? h??n ng??y k?? ????n h??ng");
                } else {
                    $.ajax({
                        url: '../ajax/them_dh_mua.php',
                        type: 'POST',
                        data: {
                            com_id: com_id,
                            user_id: user_id,
                            ten_ncc: ten_ncc,
                            nguoi_lh: nguoi_lh,
                            hop_dong: hop_dong,
                            ngay_ky_dh: ngay_ky_dh,
                            id_cong_trinh: id_cong_trinh,
                            thoi_han: thoi_han,
                            dv_nhan_hang: dv_nhan_hang,
                            nguoi_nhan_hang: nguoi_nhan_hang,
                            phong_ban: phong_ban,
                            dient_nnhan: dient_nnhan,
                            phan_tram_bh: phan_tram_bh,
                            gia_tri_bh: gia_tri_bh,
                            ghi_chu: ghi_chu,
                            giatr_vat: giatr_vat,
                            baogom_dg_vat: baogom_dg_vat,
                            thue_vat: thue_vat,
                            tien_ckhau: tien_ckhau,
                            gias_vat: gias_vat,
                            chi_phi_vc: chi_phi_vc,
                            ghic_vc: ghic_vc,
                            phan_loai_nk: phan_loai_nk,

                            ma_vt: ma_vt,
                            don_gia: don_gia,
                            so_luong_hd: so_luong_hd,
                            sl_knay: sl_knay,
                            thoig_ghang: thoig_ghang,
                            ttr_vat: ttr_vat,
                            thue_vat_vt: thue_vat_vt,
                            dia_chi_g: dia_chi_g,
                            tts_vat: tts_vat,
                        },
                        success: function(data) {
                            if (data == "") {
                                alert("Th??m ????n h??ng mua th??nh c??ng");
                                window.location.href = '/quan-ly-don-hang.html';
                            } else if (data != "") {
                                alert(data);
                            }
                        }
                    });
                }
            } else {
                $.ajax({
                    url: '../ajax/them_dh_mua.php',
                    type: 'POST',
                    data: {
                        com_id: com_id,
                        user_id: user_id,
                        ten_ncc: ten_ncc,
                        nguoi_lh: nguoi_lh,
                        hop_dong: hop_dong,
                        ngay_ky_dh: ngay_ky_dh,
                        id_cong_trinh: id_cong_trinh,
                        thoi_han: thoi_han,
                        dv_nhan_hang: dv_nhan_hang,
                        nguoi_nhan_hang: nguoi_nhan_hang,
                        phong_ban: phong_ban,
                        dient_nnhan: dient_nnhan,
                        phan_tram_bh: phan_tram_bh,
                        gia_tri_bh: gia_tri_bh,
                        ghi_chu: ghi_chu,
                        giatr_vat: giatr_vat,
                        baogom_dg_vat: baogom_dg_vat,
                        thue_vat: thue_vat,
                        tien_ckhau: tien_ckhau,
                        gias_vat: gias_vat,
                        chi_phi_vc: chi_phi_vc,
                        ghic_vc: ghic_vc,
                        phan_loai_nk: phan_loai_nk,

                        ma_vt: ma_vt,
                        don_gia: don_gia,
                        so_luong_hd: so_luong_hd,
                        sl_knay: sl_knay,
                        thoig_ghang: thoig_ghang,
                        ttr_vat: ttr_vat,
                        thue_vat_vt: thue_vat_vt,
                        dia_chi_g: dia_chi_g,
                        tts_vat: tts_vat,
                    },
                    success: function(data) {
                        if (data == "") {
                            alert("Th??m ????n h??ng mua th??nh c??ng");
                            window.location.href = '/quan-ly-don-hang.html';
                        } else if (data != "") {
                            alert(data);
                        }
                    }
                });
            }


        } else {
            event.preventDefault();
            event.stopPropagation();
            var errorElements = document.querySelectorAll(".error");
            for (let index = 0; index < errorElements.length; index++) {
                const element = errorElements[index];
                $('html, body').animate({
                    scrollTop: $(errorElements[0]).focus().offset().top - 30
                }, 1000);
                return false;
            }
        }
    });
</script>

</html>