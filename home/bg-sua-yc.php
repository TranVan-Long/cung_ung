<?php
include("../includes/icon.php");
include("config.php");
$com_id = $_SESSION['user_com_id'];

if(isset($_GET['id']) && $_GET['id'] != ""){
    $id_bg = $_GET['id'];
    $list_ct = new db_query("SELECT y.`id`, y.`id_nguoi_lap`, y.`nha_cc_kh`, y.`id_cong_trinh`, y.`id_nguoi_tiep_nhan`, y.`noi_dung_thu`,
                            y.`mail_nhan_bg`, y.`gui_mail`, y.`gia_bg_vat`, y.`phan_loai`, y.`ngay_tao`, y.`id_cong_ty`, n.`ten_nha_cc_kh`, l.`ten_nguoi_lh`
                            FROM `yeu_cau_bao_gia` AS y
                            INNER JOIN `nha_cc_kh` AS n ON y.`nha_cc_kh` = n.`id`
                            INNER JOIN `nguoi_lien_he` AS l ON n.`id` = l.`id_nha_cc`
                            WHERE y.`id_cong_ty` = $com_id AND y.`id` = $id_bg ");
    $item_ct = mysql_fetch_assoc($list_ct -> result);
    $id_nguoi_lap = $item_ct['id_nguoi_lap'];
    $id_nhacc = $item_ct['nha_cc_kh'];

    if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
        $curl = curl_init();
        $token = $_COOKIE['acc_token'];
        curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_employee_of_company.php');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token));
        $response = curl_exec($curl);
        curl_close($curl);

        $data_list = json_decode($response,true);
        $data_list_nv =$data_list['data']['items'];

    }elseif (isset($_SESSION['quyen']) && ($_SESSION['quyen'] == 2)) {
        $curl = curl_init();
        $token = $_COOKIE['acc_token'];
        curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_my_partner.php?get_all=true');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token));
        $response = curl_exec($curl);
        curl_close($curl);

        $data_list = json_decode($response,true);
        $data_list_nv =$data_list['data']['items'];
    }

    $list_nv = [];
    for($i = 0; $i < count($data_list_nv); $i++){
        $item1 = $data_list_nv[$i];
        $list_nv[$item1['ep_id']] = $item1;
    }
    $ep_name = $list_nv[$id_nguoi_lap]['ep_name'];

    $vt_bg = new db_query("SELECT `id`, `id_vat_tu`, `so_luong_yc_bg` FROM `vat_tu_bao_gia` WHERE `id_yc_bg` = $id_bg ");

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlykho.timviec365.vn/api/api_get_dsvt.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $response1 = curl_exec($curl);
    curl_close($curl);

    $list_vttb = json_decode($response1,true);
    $data_vttb =$list_vttb['data']['items'];

    $vat_tu = [];
    for($j = 0; $j < count($data_vttb); $j++){
        $item2 = $data_vttb[$j];
        $vat_tu[$item2['dsvt_id']] = $item2;
    };

    $list_ncc = new db_query("SELECT `id`, `ten_nha_cc_kh`, `phan_loai`, `id_cong_ty` FROM `nha_cc_kh` WHERE `phan_loai` = 1 AND `id_cong_ty` = $com_id ");
    $nguoi_lh = new db_query("SELECT `id`, `id_nha_cc`, `ten_nguoi_lh` FROM `nguoi_lien_he` WHERE `id_nha_cc` = $id_nhacc ");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cỉnh sửa yêu cầu báo giá</title>
    <link href="https://timviec365.vn/favicon.ico" rel="shortcut icon"/>

    <link rel="preload" href="../fonts/Roboto-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous"/>
    <link rel="preload" href="../fonts/Roboto-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous"/>
    <link rel="preload" href="../fonts/Roboto-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous"/>

    <link href="../css/select2.min.css" rel="stylesheet"/>

    <link rel="preload" as="style" rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" media="all" href="../css/app.css" media="all" onload="if (media != 'all')media='all'">
    <link rel="preload" as="style" rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" media="all" href="../css/style.css" media="all" onload="if (media != 'all')media='all'">
</head>

<body>
<div class="main-container bg_them_yc">
    <?php include("../includes/sidebar.php") ?>
    <div class="container">
        <div class="header-container">
            <?php include('../includes/ql_header_nv.php') ?>
        </div>
        <div class="content">
            <div class="left mt-25">
                <a class="prew_href share_fsize_one share_clr_one mb_26" href="quan-ly-yeu-cau-bao-gia.html">Quay lại</a>
                <p class="share_fsize_tow cr_weight_bold mb_10 w_100 float_l">Chỉnh sửa yêu cầu báo giá</p>
            </div>
            <form action="" class="main-form">
                <div class="w-100 left mt-10">
                    <div class="form-control edit-form">
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <label>Số phiếu yêu cầu</label>
                                <input type="text" name="so_phieu" value="BG-<?= $id_bg ?>" data="<?= $id_bg ?>" readonly>
                            </div>
                            <div class="form-col-50 no-border right mb_15">
                                <label>Ngày lập</label>
                                <input class="date-input" type="date" name="ngay_danh_gia"
                                       value="<?= date('Y-m-d', $item_ct['ngay_tao']) ?>" readonly>
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <label>Người lập</label>
                                <input type="text" name="nguoi_lap" value="<?= $ep_name ?>" data-id="<?= $item_ct['id_nguoi_lap'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15 v-select2">
                                <label>Nhà cung cấp<span class="text-red">&ast;</span></label>
                                <select name="nha_cung_cap" id="nha_cung_cap" class="share_select">
                                    <option value="">-- Chọn nhà cung cấp --</option>
                                    <? while($row_o = mysql_fetch_assoc($list_ncc -> result)) {?>
                                    <option value="<?= $row_o['id'] ?>" <?= ($row_o['id'] == $item_ct['nha_cc_kh']) ? "selected" : "" ?>><?= $row_o['ten_nha_cc_kh'] ?></option>
                                    <?}?>
                                </select>
                            </div>
                            <div class="form-col-50 no-border right mb_15 v-select2">
                                <label>Người tiếp nhận báo giá<span class="text-red">&ast;</span></label>
                                <select name="nguoi_tiep_nhan" id="nguoi-tiep-nhan" class="share_select">
                                    <? while($row2 = mysql_fetch_assoc($nguoi_lh -> result)) {?>
                                        <option value="<?= $row2['id'] ?>" <?= ($row2['id'] == $item_ct['id_nguoi_lh']) ? "selected" : "" ?>><?= $row2['ten_nguoi_lh'] ?></option>
                                    <?}?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border mb_15 v-select2">
                                <label>Chọn công trình</label>
                                <select name="cong_trinh" id="cong-trinh" class="share_select">
                                    <option value="">-- Chọn công trình --</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="w-100 left mb_15">
                                <label>Nội dung thư </label>
                                <textarea name="noi_dung_thu" placeholder="Nhập nội dung thư"><?= $item_ct['noi_dung_thu'] ?></textarea>
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <label>Mail nhận báo giá</label>
                                <input type="text" name="mail_nhan_bao_gia" placeholder="Nhập mail nhận báo giá" value="<?= $item_ct['mail_nhan_bg'] ?>">
                                <div class="d_flex align-items-center checkbox-lbs mt-15">
                                    <label for="mail_ngay" class="mb-0 mr-30">Gửi email</label>
                                    <input type="checkbox" name="mail_ngay" id="mail_ngay" value="1" <?= ($item_ct['gui_mail'] == 1) ? "checked" : "" ?> >
                                </div>
                            </div>
                            <div class="form-col-50 no-border right d-flex mb_15">
                                <div class="d_flex align-items-center checkbox-lbs mt-30">
                                    <label for="gia-VAT" class="mb-0 mr-30">Giá đã bao gồm VAT</label>
                                    <input type="checkbox" name="gia_VAT" id="gia-VAT" value="1" <?= ($item_ct['gia_bg_vat'] == 1) ? "checked" : "" ?>>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-30 left w-100">
                        <p class="text-blue link-text text-500" id="add-quote">&plus; Thêm mới vật tư</p>
                        <div class="table-wrapper mt-5">
                            <div class="table-container table-1252">
                                <div class="tbl-header">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th class="w-5"></th>
                                            <th class="w-15">Vật tư thiết bị</th>
                                            <th class="w-15">Hãng sản xuất</th>
                                            <th class="w-10">Đơn vị tính</th>
                                            <th class="w-15">Số lượng</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tbl-content table-2-row">
                                    <table>
                                        <tbody id="quote-me">
                                        <? while($row3 = mysql_fetch_assoc($vt_bg -> result)) {?>
                                            <tr class="item" data="<?= $row3['id'] ?>">
                                                <td class="w-5">
                                                    <p><i class="ic-delete remove-item" data-id="<?= $row3['id'] ?>"></i></p>
                                                    <input type="hidden" name="id_vat_tu" value="<?= $row3['id'] ?>">
                                                </td>
                                                <td class="w-15">
                                                    <div class="v-select2">
                                                        <select name="ten_vat_tu"  class="share_select ten_vat_tu">
                                                            <option value="">Chọn vật tư thiết bị</option>
                                                        <? for($l = 0; $l < count($data_vttb); $l++) {?>
                                                            <option value="<?= $data_vttb[$l]['dsvt_id'] ?>" <?= ($data_vttb[$l]['dsvt_id'] == $row3['id_vat_tu']) ? "selected" : "" ?>>(<?= $data_vttb[$l]['dsvt_id'] ?>) <?= $data_vttb[$l]['dsvt_name'] ?></option>
                                                        <?}?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td class="w-15">
                                                    <input type="text" name="hang_sx" value="<?= $vat_tu[$row3['id_vat_tu']]['hsx_name'] ?>" readonly>
                                                </td>
                                                <td class="w-10">
                                                    <input type="text" name="don_vt" value="<?= $vat_tu[$row3['id_vat_tu']]['dvt_name'] ?>" readonly>
                                                </td>
                                                <td class="w-15">
                                                    <? if($row3['so_luong_yc_bg'] != "" && $row3['so_luong_yc_bg'] != 0) {?>
                                                        <input type="text" name="so_luong_vt" value="<?= $row3['so_luong_yc_bg'] ?>">
                                                    <?}else{?>
                                                        <input type="text" name="so_luong_vt" value="" disabled>
                                                    <?}?>
                                                </td>
                                            </tr>
                                        <?}?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-100 left">
                    <div class="control-btn right">
                        <p class="v-btn btn-outline-blue modal-btn mt-30 mr-20" data-target="cancel">Hủy</p>
                        <button type="button" class="v-btn btn-blue mt-30 submit-btn" data-id="<?= $id_bg ?>">Xong</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal text-center" id="cancel">
        <div class="m-content">
            <div class="m-head ">
                Thông báo <span class="dismiss cancel">&times;</span>
            </div>
            <div class="m-body">
                <p>Bạn có chắc chắn muốn hủy việc chỉnh sửa yêu cầu báo giá?</p>
                <p>Các thông tin bạn đã nhập sẽ không được lưu.</p>
            </div>
            <div class="m-foot d-inline-block">
                <div class="left mb_10">
                    <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                </div>
                <div class="right mb_10">
                    <a href="chi-tiet-yeu-cau-bao-gia.html" class="v-btn sh_bgr_six share_clr_tow right">Đồng
                        ý</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal text-center" id="delete-quote-me">
        <div class="m-content">
            <div class="m-head">
                Thông báo <span class="dismiss cancel">&times;</span>
            </div>
            <div class="m-body">
                <p>Bạn có chắc chắn muốn xóa vật tư này?</p>
                <p>Thao tác này sẽ không thể hoàn tác.</p>
            </div>
            <div class="m-foot d-inline-block">
                <div class="left mb_10">
                    <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                </div>
                <div class="right mb_10">
                    <button class="v-btn btn-green right confirm-delete" data-id="">Đồng ý</button>
                </div>
            </div>
        </div>
    </div>

    <? include "../modals/modal_logout.php" ?>
    <? include("../modals/modal_menu.php") ?>
</div>

</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
<script>

    $(".remove-item").click(function(){
        var id = $(this).attr("data-id");
        $("#delete-quote-me .confirm-delete").attr("data-id", id);
        $("#delete-quote-me").show();
    });

    function xoa_v(){
        $(".remove-item").click(function(){
            var id = $(this).attr("data-id");
            $("#delete-quote-me .confirm-delete").attr("data-id", id);
            $("#delete-quote-me").show();
        });
    }

    $("#nha_cung_cap").change(function(){
        var id_ncc = $(this).val();
        $.ajax({
            url: '../render/nguoi_lien_he.php',
            type: 'POST',
            data:{
                id_ncc: id_ncc,
            },
            success: function(data){
                $("#nguoi-tiep-nhan").html(data);
            }
        })
    });

    $("#add-quote").click(function(){
        $.ajax({
            url: '../ajax/them_bgvt_yc.php',
            type: 'POST',
            success: function(data){
                $("#quote-me").append(data);
            },
        });
    });

    $(".ten_vat_tu").change(function(){
        var id_vt = $(this).val();
        var _this = $(this);
        var id_v = _this.parents(".item").attr("data");
        $.ajax({
            url: '../render/vat_tu_yc_bg.php',
            type: 'POST',
            data:{
                id_vt: id_vt,
                id_v: id_v,
            },
            success: function(data){
                _this.parents(".item").html(data);
            }
        })
    });

    $(".confirm-delete").click(function(){
        var id = $(this).attr("data-id");
        $.ajax({
            url: '../ajax/xoa_vt_ycbg.php',
            type: 'POST',
            data:{
                id: id,
            },
            success: function(data){
                window.location.reload();
            }
        })
    });

    function doi_vt() {
        $(".ten_vat_tu").change(function(){
            var id_vt = $(this).val();
            var _this = $(this);
            var id_v = _this.parents(".item").attr("data");

            $.ajax({
                url: '../render/vat_tu_yc_bg.php',
                type: 'POST',
                data:{
                    id_vt: id_vt,
                    id_v: id_v,
                },
                success: function(data){
                    _this.parents(".item").html(data);
                    // alert(id_v);
                }
            })
        });
        RefSelect2();
    };

    $('.submit-btn').click(function () {
        var form = $('.main-form');
        form.validate({
            errorPlacement: function (error, element) {
                error.appendTo(element.parent('.form-col-50'));
                error.wrap('<span class="error">');
            },
            rules: {
                nha_cung_cap: {
                    required: true,
                },
                nguoi_tiep_nhan: {
                    required: true,
                }
            },
            messages: {
                nha_cung_cap: {
                    required: "Vui lòng chọn nhà cung cấp.",
                },
                nguoi_tiep_nhan: {
                    required: "Vui lòng chọn người tiếp nhận.",
                }
            }
        });
        if (form.valid() === true) {
            var id_bg = $(this).attr("data-id");
            var id_nha_cc = $("select[name='nha_cung_cap']").val();
            var id_nguoi_lh = $("select[name='nguoi_tiep_nhan']").val();
            var id_ctrinh = $("select[name='cong_trinh']").val();
            var noi_dung_thu = $("textarea[name='noi_dung_thu']").val();
            var mail_nhan_bg = $("input[name='mail_nhan_bao_gia']").val();

            var gui_mail = document.getElementsByName('mail_ngay');
            var gm = "";
            for(var j = 0; j < gui_mail.length; j++){
                if(gui_mail[j].checked === true) {
                    gm += gui_mail[j].value + '_';
                }
            };

            var gia_baog_vat = document.getElementsByName('gia_VAT');
            var mh = "";
            for (var i = 0; i < gia_baog_vat.length; i++) {
                if(gia_baog_vat[i].checked === true) {
                    mh += gia_baog_vat[i].value + '_';
                }
            };

            var id_vatt = new Array();
            $("input[name='id_vat_tu']").each(function(){
                var id_vat_tu = $(this).val();
                if(id_vat_tu != ""){
                    id_vatt.push(id_vat_tu);
                }
            });

            var ma_vt = new Array();
            $("select[name='ten_vat_tu']").each(function(){
                var ma_vatt = $(this).val();
                if(ma_vatt != ""){
                    ma_vt.push(ma_vatt);
                }
            });

            var so_luong = new Array();
            $("input[name='so_luong_vt']").each(function(){
                var sol = $(this).val();
                if(sol != ""){
                    so_luong.push(sol);
                }
            });

            var new_ma_vt = new Array();
            $("select[name='ten_day_du']").each(function(){
                var new_ma_vatt = $(this).val();
                if(new_ma_vatt != ""){
                    new_ma_vt.push(new_ma_vatt);
                }
            });

            var new_so_luong = new Array();
            $("input[name='so_luong']").each(function(){
                var new_sol = $(this).val();
                if(new_sol != ""){
                    new_so_luong.push(new_sol);
                }
            });

            $.ajax({
                url: '../ajax/sua_yc_bgvt.php',
                type: 'POST',
                data:{
                    id_bg: id_bg,
                    id_nha_cc: id_nha_cc,
                    id_nguoi_lh: id_nguoi_lh,
                    id_ctrinh: id_ctrinh,
                    noi_dung_thu: noi_dung_thu,
                    mail_nhan_bg: mail_nhan_bg,
                    gui_mail: gm,
                    gia_baog_vat: mh,
                    ma_vt: ma_vt,
                    id_vatt: id_vatt,
                    so_luong: so_luong,
                    new_ma_vt: new_ma_vt,
                    new_sl: new_so_luong,
                },
                success: function(data){
                    if(data == ""){
                        alert("Bạn đã sửa thành công yêu cầu báo giá vật tư");
                        window.location.href = "/quan-ly-yeu-cau-bao-gia.html";
                    }else{
                        alert(data);
                    }
                }
            })
        }
    });

</script>
</html>