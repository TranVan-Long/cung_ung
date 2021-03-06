<?
include("../includes/icon.php");
include('config.php');
$date = date('Y-m-d', time());

if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $user_id = $_SESSION['com_id'];
    $com_id = $_SESSION['com_id'];
    $user_name = $_SESSION['com_name'];
    $role = 1;

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
    $user_id = $_SESSION['ep_id'];
    $com_id = $_SESSION['user_com_id'];
    $user_name = $_SESSION['ep_name'];
    $role = 2;
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


    $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
    if (mysql_num_rows($kiem_tra_nv->result) > 0) {
        $item_nv = mysql_fetch_assoc((new db_query("SELECT `yeu_cau_vat_tu` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
        $ycvt3 = explode(',', $item_nv['yeu_cau_vat_tu']);
        if (in_array(2, $ycvt3) == FALSE) {
            header('Location: /quan-ly-trang-chu.html');
        }
    } else {
        header('Location: /quan-ly-trang-chu.html');
    }
}
foreach ($data_list_nv as $key => $items) {
    if ($user_id == $items['ep_id']) {
        $dept_id    = $items['dep_id'];
        $dept_name  = $items['dep_name'];
    }
}

$curl = curl_init();
$data = array(
    'id_com' => $com_id,
);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_URL, "https://phanmemquanlykhoxaydung.timviec365.vn/api/api_get_dsvt.php");
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
$token = $_COOKIE['acc_token'];
curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlycongtrinh.timviec365.vn/api/dscongtrinh.php');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
$response = curl_exec($curl);
curl_close($curl);
$list_cong_trinh = json_decode($response, true);
$cong_trinh_data = $list_cong_trinh['data']['items'];


?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Th??m y??u c???u v???t t??</title>
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
                    <a class="prew_href share_fsize_one share_clr_one mb_20" href="quan-ly-yeu-cau-vat-tu.html">Quay l???i</a>
                    <h4 class="mb_25 w_100 float_l">Th??m y??u c???u v???t t??</h4>
                </div>
                <div class="c-body">
                    <div class="ctiet_them_vtu w_100 float_l">
                        <form class="form_save_add w_100 float_l">
                            <div class="form-control">
                                <div class="form-row left">
                                    <div class="form-col-50 left v-select2 mb_15">
                                        <label>Ph??ng ban</label>
                                        <? if ($role == 1) { ?>
                                            <input type="text" name="phong_ban" value="" readonly>
                                        <? } else if ($role == 2) { ?>
                                            <input type="text" name="phong_ban" value="<?= $dept_name ?>" readonly>
                                        <? } ?>
                                    </div>
                                    <div class="form-col-50 right v-select2 mb_15">
                                        <label>Ng?????i y??u c???u <span class="text-red">*</span></label>
                                        <input type="text" name="nguoi_yeu_cau" data="<?= $role ?>" data1="<?= $com_id ?>" data2="<?= $user_id ?>" id="nguoi_yeu_cau" value="<?= $user_name ?>" readonly>

                                    </div>
                                </div>
                                <div class="form-row left">
                                    <div class="form-col-50 left v-select2 mb_15">
                                        <label>C??ng tr??nh <span class="text-red">*</span></label>
                                        <select name="cong_trinh" class="share_select" id="cong_trinh">
                                            <option value="">-- Ch???n c??ng tr??nh --</option>
                                            <? foreach ($cong_trinh_data as $key => $items) {
                                                if ($items['ctr_trangthai'] == 0 || $items['ctr_trangthai'] == 1) { ?>
                                                    <option value="<?= $items['ctr_id'] ?>"><?= $items['ctr_name'] ?></option>
                                            <? }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row left">
                                    <div class="form-col-50 left mb_15">
                                        <label>Ng??y t???o y??u c???u</label>
                                        <input type="date" id="ngay_tao_yeu_cau" value="<?php echo $date ?>" name="ngay_tao_yeu_cau" readonly>
                                    </div>
                                    <div class="form-col-50 right mb_15">
                                        <label>Ng??y ph???i ho??n th??nh y??u c???u <span class="text-red">*</span></label>
                                        <input type="date" name="ngay_phai_hoan_thanh" placeholder="Ch???n ng??y ph???i ho??n th??nh y??u c???u">
                                    </div>
                                </div>
                                <div class="form-row left">
                                    <div class="form-col-100 left mb_15">
                                        <label>Di???n gi???i</label>
                                        <textarea id="dien_giai" name="dien_giai" placeholder="Nh???p di???n gi???i"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-30 left w-100">
                                <p class="text-blue link-text cr_weight" id="add-material">&plus; Th??m m???i v???t t??</p>
                                <div class="table-wrapper mt-5">
                                    <div class="table-container table-988">
                                        <div class="tbl-header">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th class="w-10"></th>
                                                        <th class="w-25">V???t t?? thi???t b???</th>
                                                        <th class="w-20">????n v??? t??nh</th>
                                                        <th class="w-25">S??? l?????ng y??u c???u duy???t</th>
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
                                    <button type="button" class="v-btn btn-outline-blue modal-btn" data-target="cancel">H???y</button>
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
                Th??ng b??o <span class="dismiss cancel">&times;</span>
            </div>
            <div class="m-body">
                <p>B???n c?? ch???c ch???n mu???n h???y vi???c th??m y??u c???u v???t t???</p>
                <p>C??c th??ng tin b???n ???? nh???p s??? kh??ng ???????c l??u.</p>
            </div>
            <div class="m-foot d_flex flex_jct">
                <div class="left mb_10">
                    <button class="v-btn btn-outline-blue left cancel">H???y</button>
                </div>
                <div class="right mb_10">
                    <a href="quan-ly-yeu-cau-vat-tu.html" class="v-btn sh_bgr_six share_clr_tow right">?????ng
                        ??</a>
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
    $("#add-material").click(function() {
        var com_id = $("#nguoi_yeu_cau").attr('data1');
        var vattu_chon = [];
        $(".materials_name").each(function() {
            var idvt = $(this).val();
            if (idvt != "") {
                vattu_chon.push(idvt);
            }
        });

        $.ajax({
            url: '../ajax/ycvt_them_vt.php',
            type: 'POST',
            data: {
                com_id: com_id,
                vattu_chon: vattu_chon,
            },
            success: function(data) {
                $("#materials").append(data);
                RefSelect2();
            }
        });
    });

    function change_vt(id) {
        var id_vt = $(id).val();
        var com_id = $("#nguoi_yeu_cau").attr('data1');
        var vattu_chon1 = [];
        $(".materials_name").each(function() {
            var idvt1 = $(this).val();
            if (idvt1 != "" && idvt1 != id_vt) {
                vattu_chon1.push(idvt1);
            }
        });
        $.ajax({
            url: '../render/ycvt_vat_tu.php',
            type: 'POST',
            data: {
                id_vt: id_vt,
                com_id: com_id,
                vattu_chon1: vattu_chon1,
            },
            success: function(data) {
                $(id).parents(".item").html(data);
                RefSelect2();
            }
        });

    };



    $(".submit-btn").click(function() {
        var create_ycvt = $(".form_save_add");
        $.validator.addMethod("dateRange",
            function() {
                var date1 = $("input[name='ngay_tao_yeu_cau']").val();
                var date2 = $("input[name='ngay_phai_hoan_thanh']").val();
                return (date1 <= date2);
            });
        create_ycvt.validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parents(".form-col-50"));
                error.wrap("<span class='error'>");
            },
            rules: {
                nguoi_yeu_cau: {
                    required: true,
                },
                cong_trinh: {
                    required: true,
                },
                ngay_phai_hoan_thanh: {
                    required: true,
                    dateRange: true,
                },
            },
            messages: {
                nguoi_yeu_cau: {
                    required: "Kh??ng ???????c ????? tr???ng!",
                },
                cong_trinh: {
                    required: "Kh??ng ???????c ????? tr???ng!",
                },
                ngay_phai_hoan_thanh: {
                    required: "Kh??ng ???????c ????? tr???ng!",
                    dateRange: "Ng??y ho??n th??nh y??u c???u ph???i l???n h??n ng??y t???o y??u c???u",
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
                if (sl != "" && sl != 0) {
                    so_luong.push(sl);
                }
            });

            //get user id
            var user_id = $("#nguoi_yeu_cau").attr('data2');
            var com_id = $("#nguoi_yeu_cau").attr('data1');
            var role = $("#nguoi_yeu_cau").attr('data');

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
                    com_id: com_id,
                    role: role,
                },
                success: function(data) {
                    if (data == "") {
                        alert("Th??m y??u c???u th??nh c??ng!");
                        window.location.href = 'quan-ly-yeu-cau-vat-tu.html';
                    } else {
                        alert(data);
                    }
                }
            });
        }
    });
</script>

</html>