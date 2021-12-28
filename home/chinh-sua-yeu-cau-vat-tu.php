<?
    include("../includes/icon.php");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chỉnh sửa yêu cầu vật tư </title>
    <link href="https://timviec365.vn/favicon.ico" rel="shortcut icon"/>

    <link rel="preload" href="../fonts/Roboto-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
    <link rel="preload" href="../fonts/Roboto-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous" />

    <link href="../css/select2.min.css" rel="stylesheet"/>

    <link rel="preload" as="style" rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" media="all" href="../css/app.css" media="all" onload="if (media != 'all')media='all'">
    <link rel="preload" as="style" rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" media="all" href="../css/style.css" media="all" onload="if (media != 'all')media='all'">

</head>

</head>
<body>
<div class="main-container ql_them_yc">
    <?php include("../includes/sidebar.php") ?>

    <div class="container">
        <div class="header-container">
            <?php include('../includes/ql_header_nv.php') ?>
        </div>
        <div class="content">
            <div class="mt-25 mb_25 w_100 float_l">
                <h4>Chỉnh sửa yêu cầu vật tư</h4>
            </div>
            <div class="c-body">
                <form action="" class="form-edit w_100 float_l">
                    <div class="form-control">
                        <div class="form-row left">
                            <div class="form-col-50 mb_15">
                                <label>Số phiếu yêu cầu<span class="text-red">*</span></label>
                                <input type="text" name="so-phieu" value="PH-000-99999" disabled>
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 left v-select2 mb_15">
                                <label>Phòng ban<span class="text-red">*</span></label>
                                <select name="phong_ban" id="chon-phong-ban" class="share_select">
                                    <option value="">Công trình</option>
                                </select>
                            </div>
                            <div class="form-col-50 right v-select2 mb_15">
                                <label>Người yêu cầu<span class="text-red">*</span></label>
                                <select name="nguoi_yeu_cau" id="nguoi-yeu-cau" class="share_select">
                                    <option value="">Nguyễn Văn A</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 left v-select2 mb_15">
                                <label>Công trình<span class="text-red">*</span></label>
                                <select name="cong_trinh" id="cong-trinh" class="share_select">
                                    <option value="">Nâng cấp quốc lộ 999</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 left mb_15">
                                <label>Ngày tạo yêu cầu</label>
                                <input type="date" id="ed-created-date" name="ngay-tao-yeu-cau"
                                    value="2021-01-11" disabled>
                            </div>
                            <div class="form-col-50 right mb_15">
                                <label>Ngày phải hoàn thành yêu cầu</label>
                                <input type="date" id="ed-deadline" name="deadline"
                                    value="2021-01-11">
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-100 left mb-5">
                                <label for="dien-giai">Diễn giải</label>
                                <textarea id="dien-giai" name="dien-giai">Không có</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mt-30 left w-100">
                        <p class="text-blue text-500 link-text d-inline pl-20" id="add-material">&plus; Thêm mới vật tư</p>
                        <div class="table-wrapper mt-10">
                            <div class="table-container table-988">
                                <div class="tbl-header">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th class="w-10"></th>
                                            <th class="w-15">Mã vật tư</th>
                                            <th class="w-25">Tên đầy đủ vật tư thiết bị</th>
                                            <th class="w-20">Đơn vị tính</th>
                                            <th class="w-25">Số lượng yêu cầu duyệt</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tbl-content table-2-row">
                                    <table>
                                        <tbody id="materials">
                                            <tr class="item">
                                                <td class="w-10">
                                                    <p><i class="ic-delete remove-item"></i></p>
                                                </td>
                                                <td class="w-15">
                                                    <div class="v-select2">
                                                        <select name="materials-id" class="share_select"></select>
                                                    </div>
                                                </td>
                                                <td class="w-25">
                                                    <div class="v-select2">
                                                        <select name="materials-name" class="share_select"></select>
                                                    </div>
                                                </td>
                                                <td class="w-20"><input type="text" disabled></td>
                                                <td class="w-25"><input type="text" name="so_luong"></td>
                                            </tr>
                                            <tr class="item">
                                                <td class="w-10">
                                                    <p><i class="ic-delete remove-item"></i></p>
                                                </td>
                                                <td class="w-15">
                                                    <div class="v-select2">
                                                        <select name="materials-id" class="share_select"></select>
                                                    </div>
                                                </td>
                                                <td class="w-25">
                                                    <div class="v-select2">
                                                        <select name="materials-name" class="share_select"></select>
                                                    </div>
                                                </td>
                                                <td class="w-20"><input type="text" disabled></td>
                                                <td class="w-25"><input type="text" name="so_luong"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="c-foot mt-30">
                        <div class="right huy_xong">
                            <p class="v-btn btn-outline-blue modal-btn" data-target="cancel">Hủy</p>
                            <button type="button" class="v-btn btn-blue ml-20 luu_sua">Xong</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--    modal-->
    <div class="modal text-center" id="cancel">
        <div class="m-content">
            <div class="m-head ">
                Thông báo <span class="dismiss cancel">&times;</span>
            </div>
            <div class="m-body">
                <p>Bạn có chắc chắn muốn hủy việc chỉnh sửa yêu cầu vật tư?</p>
                <p>Các thông tin bạn đã chỉnh sửa sẽ không được lưu.</p>
            </div>
            <div class="m-foot d-inline-block">
                <div class="left mr-5 mb_10">
                    <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                </div>
                <div class="right mb_10">
                    <a href="quan-ly-yeu-cau-vat-tu.html" class="v-btn sh_bgr_six share_clr_tow right">Đồng ý</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal_share modal_share_tow delete_vt">
    <div class="modal-content">
        <div class="info_modal">
            <div class="modal-header">
                <div class="header_ctn_share">
                    <h4 class="ctn_share_h share_clr_tow tex_center cr_weight_bold">THÔNG BÁO</h4>
                    <span class="close_detl close_dectl">&times;</span>
                </div>
            </div>
            <div class="modal-body">
                <div class="ctn_body_modal">
                    <div class="madal_form">
                        <div class="ctiet_pop">
                            <p class="share_fsize_tow share_clr_one">Bạn có chắc chắn muốn xóa vật tư này?</p>
                            <p class="share_fsize_tow share_clr_one">Thao tác này sẽ không thể hoàn tác.</p>
                        </div>
                        <div class="form_butt_ht">
                            <div class="tow_butt_flex d_flex">
                                <button type="button"
                                    class="js_btn_huy mb_10 share_cursor btn_d share_w_148 share_clr_four share_bgr_tow share_h_36">Hủy</button>
                                <button type="button"
                                    class="share_w_148 mb_10 share_cursor share_clr_tow share_h_36 sh_bgr_six save_new_dp">Đồng
                                    ý</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<? include "../modals/modal_logout.php"?>
<? include("../modals/modal_menu.php") ?>

</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
<script type="text/javascript">
    $(".remove-item").click(function(){
        $(".delete_vt").show();
    });

    $(".luu_sua").click(function(){
        var creart_ycvt = $(".form-edit");
        creart_ycvt.validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parents(".form-col-50"));
                error.wrap("<span class='error'>");
            },
            rules:{
                phong_ban:{
                    required: true,
                },
                nguoi_yeu_cau:{
                    required: true,
                },
                cong_trinh:{
                    required: true,
                },
            },
            messages:{
                 phong_ban:{
                    required: "Không được để trống",
                },
                nguoi_yeu_cau:{
                    required: "Không được để trống",
                },
                cong_trinh:{
                    required: "Không được để trống",
                },
            },
        });
        if(creart_ycvt.valid() === true){
            alert("oke");
        }
    })
</script>
</html>