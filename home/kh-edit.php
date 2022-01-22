<?php
include("config.php");
include("../includes/icon.php");
$date = strtotime(date('Y-m-d H:i', time()));

if(isset($_GET['id']) && $_GET['id'] !=""){
    $id = $_GET['id'];
    $list_kh = new db_query("SELECT `id`, `ten_vt`, `ten_nha_cc_kh`, `ma_so_thue`, `ten_giao_dich`, `dia_chi_dkkd`, `so_dkkd`, `dia_chi_lh`,
                        `fax`, `so_dien_thoai`, `website`, `email`, `phan_loai` FROM `nha_cc_kh` WHERE `id` = '$id' AND `phan_loai` = 2 ");
    $row = mysql_fetch_assoc($list_kh -> result);

    $list_nh = new db_query("SELECT * FROM `tai_khoan` WHERE `id_nha_cc_kh` = '$id' ");
}

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chỉnh sửa khách hàng</title>
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
<div class="main-container">
    <?php include("../includes/sidebar.php") ?>
    <div class="container">
        <div class="header-container">
            <?php include('../includes/ql_header_nv.php') ?>
        </div>
        <div class="content">
            <div class="left mt-25">
                <a class="text-black" href="quan-ly-khach-hang.html"><?php echo $ic_lt ?> Quay lại</a>
                <p class="page-title mt_20 mb_10">Chỉnh sửa khách hàng</p>
            </div>
            <form action="" class="main-form">
                <div class="w-100 left mt-10">
                    <div class="form-control edit-form">
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <label>Mã khách hàng<span class="text-red">&ast;</span></label>
                                <input type="text" name="ma_khach_hang" value="KH - <?= $row['id'] ?>"
                                       readonly>
                            </div>
                            <div class="form-col-50 no-border right mb_15">
                                <label>Mã số thuế</label>
                                <input type="text" name="ma_so_thue" placeholder="Nhập mã số thuế"
                                       value="<?= $row['ma_so_thue'] ?>">
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <label>Tên khách hàng<span class="text-red">&ast;</span></label>
                                <input type="text" name="ten_khach_hang"
                                       placeholder="Nhập tên khách hàng" value="<?= $row['ten_nha_cc_kh'] ?>">
                            </div>
                            <div class="form-col-50 no-border right mb_15">
                                <label>Tên giao dịch<span class="text-red">&ast;</span></label>
                                <input type="text" name="ten_giao_dich"
                                       placeholder="Nhập tên giao dịch" value="<?= $row['ten_giao_dich'] ?>">
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <label>Tên gọi tắt</label>
                                <input type="text" name="ten_goi_tat" placeholder="Nhập tên gọi tắt" value="<?= $row['ten_vt'] ?>">
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <label>Địa chỉ ĐKKD</label>
                                <input type="text" name="dia_chi_dkkd"
                                       placeholder="Nhập địa chỉ ĐKKD" value="<?= $row['dia_chi_dkkd'] ?>">
                            </div>
                            <div class="form-col-50 no-border right mb_15">
                                <label>Số ĐKKD</label>
                                <input type="text" name="so_dkkd" placeholder="Nhập số ĐKKD" value="<?= $row['so_dkkd'] ?>">
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <label>Địa chỉ liên hệ</label>
                                <input type="text" name="dia_chi_lien_he"
                                       placeholder="Nhập địa chỉ liên hệ" value="<?= $row['dia_chi_lh'] ?>">
                            </div>
                            <div class="form-col-50 no-border right mb_15">
                                <label>Fax</label>
                                <input type="text" name="fax" placeholder="Nhập Fax" value="<?= $row['fax'] ?>">
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <label>Điện thoại</label>
                                <input type="text" name="dien_thoai" placeholder="Nhập điện thoại" value="<?= $row['so_dien_thoai'] ?>">
                            </div>
                            <div class="form-col-50 no-border right mb_15">
                                <label>Website</label>
                                <input type="text" name="website" placeholder="Nhập Website" value="<?= $row['website'] ?>">
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <label>E-mail</label>
                                <input type="text" name="email" placeholder="Nhập E-mail" value="<?= $row['email'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-control edit-form mt-30 left w-100">
                        <div class="border-bottom pb-10">
                            <p class="d-inline-block text-bold mr-20 mt-15">Danh sách tài khoản ngân hàng</p>
                            <p class="d-inline-block text-500 text-blue link-text mt-15" id="add-bank-acc">&plus; Thêm
                                mới tài khoản ngân
                                hàng</p>
                        </div>
                        <div id="bank-list">
                            <? while($item = mysql_fetch_assoc($list_nh -> result)) {?>
                            <div class="bank border-bottom left w-100 pb-10 d-flex spc-btw">
                                <div class="bank-form">
                                    <input type="hidden" name="id_tk" value="<?= $item['id'] ?>">
                                    <div class="form-row left">
                                        <div class="form-col-50 left mb_15">
                                            <label for="ten-ngan-hang">Tên ngân hàng<span
                                                        class="text-red">&ast;</span></label>
                                            <input type="text" name="ten_nh" placeholder="Nhập tên ngân hàng" value="<?= $item['ten_ngan_hang'] ?>">
                                        </div>
                                        <div class="form-col-50 right mb_15">
                                            <label for="chi-nhanh-ngan-hang">Chi nhánh<span
                                                        class="text-red">&ast;</span></label>
                                            <input type="text" name="chi_nhanh_nh" placeholder="Nhập tên chi nhánh ngân hàng" value="<?= $item['ten_chi_nhanh'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-row left">
                                        <div class="form-col-50 left mb_15">
                                            <label>Số tài khoản<span
                                                        class="text-red">&ast;</span></label>
                                            <input type="text" name="so_tai_khoan"
                                                   placeholder="Nhập số tài khoản" value="<?= $item['so_tk'] ?>">
                                        </div>
                                        <div class="form-col-50 right mb_15">
                                            <label>Chủ tài khoản</label>
                                            <input type="text" name="chu_tai_khoan"
                                                   placeholder="Nhập tên chủ tài khoản" value="<?= $item['chu_tk'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="xoa_tk_nh" data-id="<?= $item['id'] ?>">
                                    <i class="ic-delete2"></i>
                                </div>
                            </div>
                            <?}?>
                        </div>
                    </div>
                </div>
                <div class="w-100 left">
                    <div class="control-btn right">
                        <p class="v-btn btn-outline-blue modal-btn mr-20 mt-20" data-target="cancel">Hủy</p>
                        <button type="button" class="v-btn btn-blue mt-20 submit-btn" data-id="<?= $row['id'] ?>">Xong</button>
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
                <p>Bạn có chắc chắn muốn hủy việc chỉnh sửa khách hàng?</p>
                <p>Các thông tin bạn đã nhập sẽ không được lưu.</p>
            </div>
            <div class="m-foot d-inline-block">
                <div class="left mb_10">
                    <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                </div>
                <div class="right mb_10">
                    <a href="quan-ly-chi-tiet-khach-hang.html" class="v-btn sh_bgr_six share_clr_tow right">Đồng ý</a>
                </div>
            </div>
        </div>
    </div>
    <? include("../modals/modal_logout.php") ?>
    <? include("../modals/modal_menu.php") ?>
</div>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
<script>
    $('.submit-btn').click(function () {
        var form = $('.main-form');
        form.validate({
            errorPlacement: function (error, element) {
                error.appendTo(element.parent('.form-col-50'));
                error.wrap('<span class="error">');
            },
            rules: {
                ma_khach_hang: {
                    required: true,
                },
                ten_khach_hang: {
                    required: true,
                },
                ten_giao_dich: {
                    required: true,
                },
                ten_ngan_hang:{
                    required: true,
                },
                chi_nhanh_ngan_hang:{
                    required: true,
                },
                so_tai_khoan:{
                    required: true,
                    number:true,
                }

            },
            messages: {
                ma_khach_hang: {
                    required: "Mã khách hàng không được để trống.",
                },
                ten_khach_hang: {
                    required: "Tên khách hàng không được để trống.",
                },
                ten_giao_dich: {
                    required: "Tên giao dịch không được để trống.",
                },
                ten_ngan_hang:{
                    required: "Vui lòng chọn ngân hàng.",
                },
                chi_nhanh_ngan_hang:{
                    required: "Vui lòng chọn chi nhánh.",
                },
                so_tai_khoan:{
                    required: "Số tài khoản không được để trống.",
                    number: "Số tài khoản không đúng định dạng.",
                }
            }
        });
        if (form.valid() === true) {
            var id = $(this).attr("data-id");
            var ten_kh = $("input[name='ten_khach_hang']").val();
            var ma_so_thue = $("input[name='ma_so_thue']").val();
            var ten_giao_dich = $("input[name='ten_giao_dich']").val();
            var ten_vt = $("input[name='ten_goi_tat']").val();
            var dia_chi_dkkd = $("input[name='dia_chi_dkkd']").val();
            var so_dkkd = $("input[name='so_skkd']").val();
            var dia_chi_lh = $("input[name='dia_chi_lien_he']").val();
            var fax = $("input[name='fax']").val();
            var so_dien_thoai = $("input[name='dien_thoai']").val();
            var website = $("input[name='website']").val();
            var email = $("input[name='email']").val();
            var date = "<?= $date ?>";

            var id_tk = document.getElementsByName('id_tk');
            var itk = "";
            for(var t = 0; t < id_tk.length; t++){
                if(id_tk[t] != ""){
                    itk += id_tk[t].value + '_';
                }
            };

            var ten_nh = document.getElementsByName('ten_nh');
            var nh = "";
            for(var i = 0; i < ten_nh.length; i++){
                if(ten_nh[i] != ""){
                    nh += ten_nh[i].value + '_';
                }
            };

            var ten_ch_nh = document.getElementsByName('chi_nhanh_nh');
            var ch = "";
            for(var j = 0; j < ten_ch_nh.length; j++){
                if(ten_ch_nh[j] != ""){
                    ch += ten_ch_nh[j].value + '_';
                }
            };

            var so_tai_khoan = document.getElementsByName('so_tai_khoan');
            var stk = "";
            for(var k = 0; k < so_tai_khoan.length; k++){
                if(so_tai_khoan[k] != ""){
                    stk += so_tai_khoan[k].value + '_';
                }
            };

            var chu_tk = document.getElementsByName('chu_tai_khoan');
            var ctk = "";
            for(var l = 0; l < chu_tk.length; l++){
                ctk += chu_tk[l].value + '_';
            };

            // them ngan hang
            var ten_ngan_hang = document.getElementsByName('ten_ngan_hang');
            var ngan_hang = "";
            for(var b = 0; b < ten_ngan_hang.length; b++){
                if(ten_ngan_hang[b] != ""){
                    ngan_hang += ten_ngan_hang[b].value + '_';
                }
            };

            var ten_ch = document.getElementsByName('ten_chi_nhanh');
            var ch_nh = "";
            for(var c = 0; c < ten_ch.length; c++){
                if(ten_ch[c] != ""){
                    ch_nh += ten_ch[c].value + '_';
                }
            };

            var so_tk = document.getElementsByName('so_tk');
            var tk = "";
            for(var d = 0; d < so_tk.length; d++){
                if(so_tk[d] != ""){
                    tk += so_tk[d].value + '_';
                }
            };

            var chu_tai_khoan = document.getElementsByName('chu_tk');
            var chu_tk = "";
            for(var r = 0; r < chu_tai_khoan.length; r++){
                chu_tk += chu_tai_khoan[r].value + '_';
            };

            $.ajax({
                url: '../ajax/sua_tt_kh.php',
                data:{
                    id: id,
                    ten_kh: ten_kh,
                    ma_so_thue: ma_so_thue,
                    ten_giao_dich: ten_giao_dich,
                    ten_vt: ten_vt,
                    dia_chi_dkkd: dia_chi_dkkd,
                    so_dkkd: so_dkkd,
                    dia_chi_lh: dia_chi_lh,
                    fax: fax,
                    so_dien_thoai: so_dien_thoai,
                    website: website,
                    email: email,
                    date: date,

                    id_tk: itk,
                    ten_nh: nh,
                    chi_nhanh: ch,
                    so_tk: stk,
                    chu_tk: ctk,

                    ten_nh_moi: ngan_hang,
                    ten_ch_moi: ch_nh,
                    so_tk_moi: tk,
                    chu_tk_moi: chu_tk,

                },
                type: 'POST',

                success: function(data){
                    if(data == ""){
                        alert("Cập nhật thông tin khách hàng thành công");
                        window.location.href = '/quan-ly-khach-hang.html';
                    }else{
                        alert(data);
                    }
                }
            });
        }
    });

    $(".xoa_tk_nh").click(function(){
        var id = $(this).attr("data-id");

        $.ajax({
            url: '../ajax/xoa_tk_nh.php',
            type: 'POST',
            data:{
                id: id,
            },
            success: function(data){
                if(data == ""){
                    alert("Bạn đã xóa ngân hàng thành công");
                    window.location.reload();
                }else{
                    alert(data);
                }
            }
        });
    });
</script>
</html>