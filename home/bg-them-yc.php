<?php
include("../includes/icon.php");
include("config.php");
$date = date('Y-m-d', time());
$date1 = strtotime($date);

if(isset($_SESSION['quyen']) && $_SESSION['quyen'] = '2'){
    $user_id = $_SESSION['ep_id'];
    $user_name = $_SESSION['ep_name'];
    $com_id = $_SESSION['user_com_id'];
}

$list_nhacc = new db_query("SELECT `id`, `ten_nha_cc_kh` FROM `nha_cc_kh` WHERE `phan_loai` = 1 ");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm yêu cầu báo giá</title>
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
            <div class="mt-30 left">
                <a class="text-black" href="quan-ly-yeu-cau-bao-gia.html"><?php echo $ic_lt ?> Quay lại</a>
                <p class="page-title mt-20">Thêm yêu cầu báo giá</p>
            </div>
            <form action="" class="main-form">
                <div class="w-100 left mt-10">
                    <div class="form-control edit-form">
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <label>Người lập</label>
                                <input type="text" name="nguoi_lap" value="<?= $user_name ?>" data-id="<?= $user_id ?>" readonly>
                            </div>
                            <div class="form-col-50 no-border right mb_15">
                                <label>Ngày lập</label>
                                <input class="date-input" type="date" id="ngay-danh-gia" name="ngay_danh_gia" value="<?echo $date?>" data="<?= $date1 ?>" readonly>
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15 v-select2">
                                <label>Nhà cung cấp <span class="text-red">&ast;</span></label>
                                <select name="nha_cung_cap" id="nha_cung_cap" class="share_select">
                                    <option value="">-- Chọn nhà cung cấp --</option>
                                    <? while($row = mysql_fetch_assoc($list_nhacc -> result)) { ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['ten_nha_cc_kh'] ?></option>
                                    <? } ?>
                                </select>
                            </div>
                            <div class="form-col-50 no-border right mb_15 v-select2">
                                <label>Người tiếp nhận báo giá <span class="text-red">&ast;</span></label>
                                <select name="nguoi_tiep_nhan" id="nguoi-tiep-nhan" class="share_select">
                                    <option value="">-- Chọn người tiếp nhận báo giá --</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border mb_15 v-select2">
                                <label>Công trình</label>
                                <select name="cong_trinh" id="cong-trinh" class="share_select">
                                    <option value="">-- Chọn công trình --</option>
                                    <option value="1">Nâng cấp quốc lộ 999</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="w-100 left mb_15">
                                <label>Nội dung thư </label>
                                <textarea name="noi_dung_thu" placeholder="Nhập nội dung thư"></textarea>
                            </div>
                        </div>
                        <div class="form-row left spc-btw">
                            <div class="form-col-50 no-border left mb_15 mr-20">
                                <label>Mail nhận báo giá</label>
                                <input type="text" name="mail_nhan_bao_gia" placeholder="Nhập mail nhận báo giá">
                                <div class="d_flex align-items-center checkbox-lbs mt-15">
                                    <label for="mail_ngay" class="mb-0 mr-30">Gửi mail ngay</label>
                                    <input type="checkbox" name="mail_ngay" id="mail_ngay" value="1">
                                </div>
                            </div>
                            <div class="form-col-50 no-border right d-flex mb_15">
                                <div class="d_flex align-items-center checkbox-lbs mt-30">
                                    <label for="gia_VAT" class="mb-0 mr-30">Giá đã bao gồm VAT</label>
                                    <input type="checkbox" name="gia_VAT" id="gia_VAT" value="1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-30 left w-100">
                        <p class="text-blue link-text text-500" id="add-quote" data="<?= $com_id ?>">&plus; Thêm mới vật tư</p>
                        <div class="table-wrapper mt-10">
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

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="left w-100">
                    <div class="control-btn right">
                        <p class="v-btn btn-outline-blue modal-btn mr-20 mt-20" data-target="cancel">Hủy</p>
                        <button type="button" class="v-btn btn-blue mt-20 submit_btx submit-btn" data="<?= $com_id ?>">Xong</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal text-center" id="cancel">
        <div class="m-content huy-them">
            <div class="m-head ">
                Thông báo <span class="dismiss cancel">&times;</span>
            </div>
            <div class="m-body">
                <p>Bạn có chắc chắn muốn hủy việc thêm yêu cầu báo giá?</p>
                <p>Các thông tin bạn đã nhập sẽ không được lưu.</p>
            </div>
            <div class="m-foot d-inline-block">
                <div class="left mb_10">
                    <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                </div>
                <div class="right mb_10">
                    <a href="quan-ly-yeu-cau-bao-gia.html" class="v-btn sh_bgr_six share_clr_tow right">Đồng
                        ý</a>
                </div>
            </div>
        </div>
    </div>
    <?php include "../modals/modal_logout.php" ?>
    <? include("../modals/modal_menu.php") ?>
</div>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
<script>

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
        var id_com = $(this).attr("data");
        $.ajax({
            url: '../ajax/them_bgvt_yc.php',
            type: 'POST',
            data:{
                id_com: id_com,
            },
            success: function(data){
                $("#quote-me").append(data);
            }
        });
    });

    function doi_vt() {
        $(".ten_vat_tu").change(function(){
            var id_vt = $(this).val();
            var _this = $(this);
            var id_com = "<?= $com_id ?>";
            $.ajax({
                url: '../render/vat_tu_yc_bg.php',
                type: 'POST',
                data:{
                    id_vt: id_vt,
                    id_com: id_com,
                },
                success: function(data){
                    _this.parents(".item").html(data);
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
            var user_id = $("input[name='nguoi_lap']").attr("data-id");
            var ngay_lap = $("input[name='ngay_danh_gia']").attr("data");
            var nhacc_id = $("select[name='nha_cung_cap']").val();
            var id_nguoi_lh = $("select[name='nguoi_tiep_nhan']").val();
            var id_ctrinh = $("select[name='cong_trinh']").val();
            var noi_dung = $("textarea[name='noi_dung_thu']").val();
            var mail_nhan_bg = $("input[name='mail_nhan_bao_gia']").val();
            var com_id = $(this).attr("data");

            var gui_mail = document.getElementsByName('mail_ngay');
            var gm = "";
            for(var j = 0; j < gui_mail.length; j++){
                if(gui_mail[j].checked === true) {
                    gm += gui_mail[j].value + '_';
                }
            }

            var gia_baog_vat = document.getElementsByName('gia_VAT');
            var mh = "";
            for (var i = 0; i < gia_baog_vat.length; i++) {
                if(gia_baog_vat[i].checked === true) {
                    mh += gia_baog_vat[i].value + '_';
                }
            }

            var ma_vt = new Array();
            $("select[name='ten_day_du']").each(function(){
                var ma_vatt = $(this).val();
                if(ma_vatt != ""){
                    ma_vt.push(ma_vatt);
                }
            });

            var so_luong = new Array();
            $("input[name='so_luong']").each(function(){
                var sol = $(this).val();
                if(sol != ""){
                    so_luong.push(sol);
                }
            });

            $.ajax({
                url: '../ajax/them_yc_bao_gia.php',
                type: 'POST',
                data:{
                    user_id: user_id,
                    com_id: com_id,
                    ngay_lap: ngay_lap,
                    nhacc_id: nhacc_id,
                    id_nguoi_lh: id_nguoi_lh,
                    id_ctrinh: id_ctrinh,
                    noi_dung: noi_dung,
                    mail_nhan_bg: mail_nhan_bg,
                    gui_mail: gm,
                    gia_baog_vat: mh,
                    ma_vt: ma_vt,
                    so_luong: so_luong,
                },
                success: function(data){
                    if(data == ""){
                        alert("Bạn đã thêm yêu cầu báo giá thành công");
                        window.location.href = '/quan-ly-yeu-cau-bao-gia.html';
                    }else{
                        alert(data);
                    }
                }
            })
        }
    });

</script>
</html>