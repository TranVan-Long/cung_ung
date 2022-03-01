<?
include("../includes/icon.php");
include('config.php');
$date = date('Y-m-d', time());

if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
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
} elseif (isset($_SESSION['quyen']) && ($_SESSION['quyen'] == 2)) {
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
    $user_id = $_SESSION['ep_id'];
    $user_name = $_SESSION['ep_name'];
}
foreach ($data_list_nv as $key => $items) {
    if ($user_id == $items['ep_id']) {
        $dept_id    = $items['dep_id'];
        $dept_name  = $items['dep_name'];
        $comp_id = $items['com_id'];
    }
}

$curl = curl_init();
$data = array(
    'id_com' => $comp_id,
);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_URL, "https://phanmemquanlykho.timviec365.vn/api/api_get_dsvt.php");
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($curl);
curl_close($curl);
$list_vt = json_decode($response, true);
$vat_tu_data = $list_vt['data']['items'];


$vat_tu = [];
for ($i = 0; $i < count($vat_tu_data); $i++) {
    $items_vt = $vat_tu_data[$i];
    $vat_tu[$items_vt['dsvt_id']] = $items_vt;
}

$curl = curl_init();
$data = array(
    'id_com' => $comp_id,
);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlycongtrinh.timviec365.vn/api/congtrinh.php');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($curl);
curl_close($curl);
$list_cong_trinh = json_decode($response, true);
$cong_trinh_data = $list_cong_trinh['data']['items'];

// echo "<pre>";
// print_r($vat_tu_data);
// echo "</pre>";
// die();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm yêu cầu vật tư</title>
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

</head>

<body>
    <div class="main-container ql_them_yc">
        <?php include("../includes/sidebar.php") ?>

        <div class="container">
            <div class="header-container">
                <?php include('../includes/ql_header_nv.php') ?>
            </div>
            <div class="content">
                <div class="mt_25 w_100 float_l">
                    <a class="prew_href share_fsize_one share_clr_one mb_20" href="quan-ly-yeu-cau-vat-tu.html">Quay lại</a>
                    <h4 class="mb_25 w_100 float_l">Thêm yêu cầu vật tư</h4>
                </div>
                <div class="c-body">
                    <div class="ctiet_them_vtu w_100 float_l">
                        <form class="form_save_add w_100 float_l">
                            <div class="form-control">
                                <div class="form-row left">
                                    <div class="form-col-50 left v-select2 mb_15">
                                        <label>Phòng ban <span class="text-red">*</span></label>
                                        <input type="text" name="phong_ban" value="<?= $dept_name ?>" readonly>
                                    </div>
                                    <div class="form-col-50 right v-select2 mb_15">
                                        <label>Người yêu cầu <span class="text-red">*</span></label>
                                        <input type="text" name="nguoi_yeu_cau" id="nguoi_yeu_cau" value="<?= $user_name ?>" readonly>

                                    </div>
                                </div>
                                <div class="form-row left">
                                    <div class="form-col-50 left v-select2 mb_15">
                                        <label>Công trình <span class="text-red">*</span></label>
                                        <select name="cong_trinh" class="share_select" id="cong_trinh">
                                            <option value="">-- Chọn công trình --</option>
                                            <? foreach ($cong_trinh_data as $key => $items) { ?>
                                                <option value="<?= $items['ctr_id'] ?>"><?= $items['ctr_name'] ?></option>
                                            <? } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row left">
                                    <div class="form-col-50 left mb_15">
                                        <label>Ngày tạo yêu cầu</label>
                                        <input type="date" id="ngay_tao_yeu_cau" value="<?php echo $date ?>" name="ngay_tao_yeu_cau" readonly>
                                    </div>
                                    <div class="form-col-50 right mb_15">
                                        <label>Ngày phải hoàn thành yêu cầu</label>
                                        <input type="date" name="ngay_phai_hoan_thanh" placeholder="Chọn ngày phải hoàn thành yêu cầu">
                                    </div>
                                </div>
                                <div class="form-row left">
                                    <div class="form-col-100 left mb_15">
                                        <label>Diễn giải</label>
                                        <textarea id="dien_giai" name="dien_giai" placeholder="Nhập diễn giải"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-30 left w-100">
                                <p class="text-blue link-text cr_weight" id="add-material">&plus; Thêm mới vật tư</p>
                                <div class="table-wrapper mt-5">
                                    <div class="table-container table-988">
                                        <div class="tbl-header">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th class="w-10"></th>
                                                        <th class="w-25">Vật tư thiết bị</th>
                                                        <th class="w-20">Đơn vị tính</th>
                                                        <th class="w-25">Số lượng yêu cầu duyệt</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class="tbl-content table-2-row">
                                            <table>
                                                <tbody id="materials">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="c-foot mt-30">
                                <div class="right huy_xong">
                                    <button type="button" class="v-btn btn-outline-blue modal-btn" data-target="cancel">Hủy</button>
                                    <p class="v-btn btn-blue ml-20 submit-btn">Xong</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal text-center" id="cancel">
        <div class="m-content">
            <div class="m-head ">
                Thông báo <span class="dismiss cancel">&times;</span>
            </div>
            <div class="m-body">
                <p>Bạn có chắc chắn muốn hủy việc thêm yêu cầu vật tư?</p>
                <p>Các thông tin bạn đã nhập sẽ không được lưu.</p>
            </div>
            <div class="m-foot d_flex flex_jct">
                <div class="left mb_10">
                    <button class="v-btn btn-outline-blue left cancel">Hủy</button>
                </div>
                <div class="right mb_10">
                    <a href="quan-ly-yeu-cau-vat-tu.html" class="v-btn sh_bgr_six share_clr_tow right">Đồng
                        ý</a>
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
<script type="text/javascript">
    jQuery.validator.addMethod("greaterThan",
        function(value, element, params) {

            if (!/Invalid|NaN/.test(new Date(value))) {
                return new Date(value) > new Date($(params).val());
            }

            return isNaN(value) && isNaN($(params).val()) ||
                (Number(value) > Number($(params).val()));
        }, 'Must be greater than {0}.');

    $("#add-material").click(function() {
        $.ajax({
            url: '../ajax/ycvt_them_vt.php',
            type: 'POST',
            success: function(data) {
                $("#materials").append(data);
            }
        });
    });

    function change_vt() {
        $(".materials_name").change(function() {
            var id_vt = $(this).val();
            var _this = $(this);
            var com_id = <?= $comp_id?>;
            $.ajax({
                url: '../render/ycvt_vat_tu.php',
                type: 'POST',
                data: {
                    id_vt: id_vt,
                    com_id:com_id,
                },
                success: function(data) {
                    _this.parents(".item").html(data);
                }
            })
        });
        RefSelect2();
    };


    $(".submit-btn").click(function() {
        var create_ycvt = $(".form_save_add");
        create_ycvt.validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parents(".form-col-50"));
                error.wrap("<span class='error'>");
            },
            rules: {
                phong_ban: {
                    required: true,
                },
                nguoi_yeu_cau: {
                    required: true,
                },
                cong_trinh: {
                    required: true,
                },
                ngay_phai_hoan_thanh: {
                    greaterThan: "#ngay_tao_yeu_cau"
                },
            },
            messages: {
                phong_ban: {
                    required: "Không được để trống!",
                },
                nguoi_yeu_cau: {
                    required: "Không được để trống!",
                },
                cong_trinh: {
                    required: "Không được để trống!",
                },
                ngay_phai_hoan_thanh: {
                    greaterThan: "Không được nhỏ hơn ngày tạo yêu cầu!"
                },
            },
        });
        if (create_ycvt.valid() === true) {
            var cong_trinh = $("#cong_trinh").val();
            var ngay_tao_yeu_cau = $("input[name='ngay_tao_yeu_cau']").val();
            var ngay_phai_hoan_thanh = $("input[name='ngay_phai_hoan_thanh']").val();
            var dien_giai = $("#dien_giai").val();

            var vat_tu = new Array();
            $("select[name='materials_name']").each(function() {
                var ten_vat_tu = $(this).val();
                if (ten_vat_tu != "") {
                    vat_tu.push(ten_vat_tu);
                }
            });
            var so_luong = new Array();
            $("input[name='so_luong']").each(function() {
                var sl = $(this).val();
                if (sl != "") {
                    so_luong.push(sl);
                }
            });

            //get user id
            var user_id = "<?= $user_id ?>";
            var comp_id = "<?= $comp_id ?>";

            $.ajax({
                url: '../ajax/ycvt_them.php',
                type: 'POST',
                data: {
                    cong_trinh: cong_trinh,
                    ngay_tao_yeu_cau: ngay_tao_yeu_cau,
                    ngay_phai_hoan_thanh: ngay_phai_hoan_thanh,
                    dien_giai: dien_giai,

                    vat_tu: vat_tu,
                    so_luong: so_luong,

                    user_id: user_id,
                    comp_id: comp_id,


                },
                success: function(data) {
                    if (data == "") {
                        alert("Thêm yêu cầu thành công!");
                        window.location.href = 'quan-ly-yeu-cau-vat-tu.html';
                    } else {
                        alert(data);
                    }
                }
            })
        }
    });
</script>

</html>