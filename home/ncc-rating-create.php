<?
include("config.php");
include("../includes/icon.php");
$date = date('Y-m-d', time());

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
    } else if ($_COOKIE['role'] == 2) {
        $com_id = $_SESSION['user_com_id'];
    }
};

$list_nhacc = new db_query("SELECT `id`, `ten_nha_cc_kh`, `sp_cung_ung`, `phan_loai` FROM `nha_cc_kh` WHERE `phan_loai` = 1 AND `id_cong_ty` = $com_id ");

$list_tchi = new db_query("SELECT `id`, `tieu_chi`, `he_so`, `kieu_gia_tri` FROM `tieu_chi_danh_gia` WHERE `id_cong_ty` = $com_id ");

if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
    $ep_name = $_SESSION['ep_name'];
    $ep_id = $_SESSION['ep_id'];
    $curl = curl_init();
    $token = $_SESSION['access_token'];
    curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_my_partner.php?get_all=true');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
    $response = curl_exec($curl);
    curl_close($curl);
    $data_list = json_decode($response, true);
    $data_list_nv = $data_list['data']['items'];
    $count = count($data_list_nv);

    $user = [];
    for ($i = 0; $i < $count; $i++) {
        $item1 = $data_list_nv[$i];
        $user[$item1["ep_id"]] = $item1;
    }

    $phong_ban = $user[$ep_id]['dep_name'];
    $dep_id = $user[$ep_id]['dep_id'];
}


?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm phiếu đánh giá</title>
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
    <div class="main-container">
        <?php include("../includes/sidebar.php") ?>

        <div class="container">
            <div class="header-container">
                <?php include('../includes/ql_header_nv.php') ?>
            </div>
            <div class="content">
                <div class="left mt-25">
                    <a class="text-black" href="danh-gia-nha-cung-cap.html"><?php echo $ic_lt ?> Quay lại</a>
                    <p class="page-title mt-20">Thêm phiếu đánh giá nhà cung cấp</p>
                </div>
                <form class="main-form" data="<?= $com_id ?>">
                    <div class="w-100 left mt-10">
                        <div class="form-control edit-form">
                            <div class="form-row left">
                                <div class="form-col-50 no-border mb_15 left">
                                    <label>Ngày đánh giá<span class="text-red">&ast;</span></label>
                                    <input type="date" name="ngay_danh_gia" value="<?= $date ?>" readonly>
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border mb_15 left">
                                    <label>Người lập<span class="text-red">&ast;</span></label>
                                    <input type="text" name="nguoi_danh_gia" placeholder="Nhập người đánh giá" id="nguoi_dg" value="<?= $ep_name ?>" data-id="<?= $ep_id ?>" readonly>
                                </div>
                                <div class="form-col-50 no-border mb_15 right">
                                    <label>Phòng ban</label>
                                    <input type="text" name="phong_ban" id="phong_ban" placeholder="Nhập phòng ban" value="<?= $phong_ban ?>" data-id="<?= $dep_id ?>" readonly>
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 left mb_15 v-select2">
                                    <label for="nha-cung-cap">Nhà cung cấp<span class="text-red">&ast;</span></label>
                                    <select class="share_select" name="nha_cung_cap" id="nha-cung-cap">
                                        <option value="">-- Chọn nhà cung cấp --</option>
                                        <? while ($row = mysql_fetch_assoc($list_nhacc->result)) { ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['ten_nha_cc_kh'] ?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="detail_nhacc w_100 float_l">
                                <div class="form-row left">
                                    <div class="form-col-50 no-border mb_15 left">
                                        <p class="d-block w-100">Tên nhà cung cấp</p>
                                        <p class="d-block w-100 text-bold mt-10" id="ncc-ten">&nbsp;</p>
                                    </div>
                                    <div class="form-col-50 no-border mb_15 right">
                                        <p class="d-block w-100">Địa chỉ</p>
                                        <p class="d-block w-100 text-bold mt-10" id="ncc-dia-chi">&nbsp;</p>
                                    </div>
                                </div>
                                <div class="form-row left">
                                    <div class="form-col-50 no-border mb_15 left">
                                        <p class="d-block w-100">Sản phẩm cung ứng</p>
                                        <p class="d-block w-100 text-bold mt-10" id="ncc-san-pham">&nbsp;</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border mb_15 left">
                                    <p class="d-block w-100">Điểm đánh giá</p>
                                    <!-- <p class="d-block w-100 text-bold mt-10" id="ncc-diem-danh-gia"></p> -->
                                    <input type="text" name="tongd_dg" id="tongd_dg" class="hidden_bd" readonly>
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-100 no-border mb_15 left">
                                    <label>Đánh giá khác</label>
                                    <textarea name="danh_gia_khac" placeholder="Nhập đánh giá khác"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mt-30 left w-100">
                            <p class="text-blue link-text d-inline cr_weight" id="add-ratting-ruler">&plus; Thêm tiêu chí
                                đánh giá</p>
                            <div class="table-wrapper mt-10">
                                <div class="table-container table-1252">
                                    <div class="tbl-header">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="w-5" rowspan="2"></th>
                                                    <th class="w-10" rowspan="2">STT</th>
                                                    <th class="w-20" rowspan="2">Tiêu chí đánh giá</th>
                                                    <th class="w-10" rowspan="2">Hệ số</th>
                                                    <th class="w-10" rowspan="2">Thang điểm</th>
                                                    <th colspan="3" scope="colgroup" class="border-bottom-w">Đánh giá</th>
                                                </tr>
                                                <tr class="border-top-w">
                                                    <th class="w-15" scope="colgroup">Điểm đánh giá</th>
                                                    <th class="w-15" scope="colgroup">Điểm</th>
                                                    <th class="w-15" scope="colgroup">Đánh giá chi tiết</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="tbl-content table-2-row">
                                        <table>
                                            <tbody id="ratting-ruler">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 left">
                        <div class="control-btn right">
                            <p class="v-btn btn-outline-blue modal-btn mr-20 mt-20" data-target="cancel">Hủy</p>
                            <button type="button" class="v-btn btn-blue mt-20 submit-btn">Xong</button>
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
                    <p>Bạn có chắc chắn muốn hủy việc thêm phiếu đánh giá?</p>
                    <p>Các thông tin bạn đã nhập sẽ không được lưu.</p>
                </div>
                <div class="m-foot d-inline-block">
                    <div class="left mb_10">
                        <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                    </div>
                    <div class="right mb_10">
                        <a href="danh-gia-nha-cung-cap.html" class="v-btn sh_bgr_six share_clr_tow right">Đồng ý</a>
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
<script type="text/javascript" src="../js/giatri_doi.js"></script>
<script>
    $('#nha-cung-cap').on('change', function() {
        var ncc = $(this).val();
        $.ajax({
            url: '../render/tt_nha_cc.php',
            type: 'POST',
            data: {
                id: ncc,
            },
            success: function(data) {
                $('.detail_nhacc').html(data);
            }
        })
    });

    $("#add-ratting-ruler").click(function() {
        var x = 1;
        $('.one_stt').each(function() {
            $(this).text(x);
            x++;
        });
        $.ajax({
            url: '../ajax/them_tc_dg_ncc.php',
            type: 'POST',
            data: {
                x: x,
            },
            success: function(data) {
                $("#ratting-ruler").append(data);
                RefSelect2();
            }
        });
    });

    function thay_doi(id) {
        var id_tc = $(id).val();
        var x = $(id).parents(".item").find(".one_stt").text();
        $.ajax({
            url: '../render/dg_tieu_chi_ncc.php',
            type: 'POST',
            data: {
                id_tc: id_tc,
                x: x,
            },
            success: function(data) {
                $(id).parents(".item").html(data);
                RefSelect2();
            }
        });
    };

    function dien_dgia(id) {
        var dien_danh_gia = Number($(id).parents(".item").find(".diem_danh_gia").val());
        var he_so = Number($(id).parents(".item").find(".he_so").attr("data"));
        var tong_diem = 0;
        var trong = "";
        if (dien_danh_gia != "" && he_so != "") {
            tong_diem = dien_danh_gia * he_so;
            $(id).parents(".item").find(".tdiem_dg").val(tong_diem);
        } else if (dien_danh_gia != "" || he_so != "") {
            $(id).parents(".item").find(".tdiem_dg").val(trong);
        }

        tong_dien_danhgia();
    };

    function tong_dien_danhgia() {
        var tdiem = 0;
        $(".tdiem_dg").each(function() {
            var tong_diem = $(this).val();
            if (tong_diem != "") {
                tdiem += parseInt(tong_diem);
            }
        });

        $("#tongd_dg").val(tdiem);
    }

    $('.submit-btn').click(function() {
        var form = $('.main-form');
        form.validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parent('.form-col-50'));
                error.wrap('<span class="error">');
            },
            rules: {
                ngay_lap_phieu: {
                    required: true,
                },
                ngay_danh_gia: {
                    required: true,
                },
                nguoi_danh_gia: {
                    required: true,
                },
                nha_cung_cap: {
                    required: true,
                }
            },
            messages: {
                ngay_lap_phieu: {
                    required: "Ngày lập phiếu không được để trống.",
                },
                ngay_danh_gia: {
                    required: "Ngày đánh giá không được để trống.",
                },
                nguoi_danh_gia: {
                    required: "Người đánh giá không được để trống.",
                },
                nha_cung_cap: {
                    required: "Vui lòng chọn nhà cung cấp.",
                }
            }
        });
        if (form.valid() === true) {
            var ngay_dg = $("input[name='ngay_danh_gia']").val();
            var user_id = $("#nguoi_dg").attr("data-id");
            var dep_id = $("#phong_ban").attr("data-id");
            var id_nhacc = $("select[name='nha_cung_cap']").val();
            var dg_khac = $("textarea[name='danh_gia_khac']").val();
            var com_id = $(".main-form").attr("data");
            var tong_diem_dg = $("input[name='tongd_dg']").val();

            var idt = [];
            $("select[name='ten_tchi_dg']").each(function() {
                var id_tc = $(this).val();
                if (id_tc != "") {
                    idt.push(id_tc);
                }
            });

            var dd = [];
            $(".diem_danh_gia").each(function() {
                var diem_danhg = $(this).val();
                if (diem_danhg != "") {
                    dd.push(diem_danhg);
                }
            });

            var sm = [];
            $("input[name='tdiem_dg']").each(function() {
                var sum_dg = $(this).val();
                if (sum_dg != "") {
                    sm.push(sum_dg);
                }
            });

            var dg_ct = [];
            $("input[name='dg_ctiet']").each(function() {
                var dg_ctiet = $(this).val();
                if (dg_ctiet == "") {
                    dg_ctiet = "NUll";
                    dg_ct.push(dg_ctiet);
                } else {
                    dg_ct.push(dg_ctiet);
                }
            });

            var tgd = [];
            $("input[name='thang_diem_m']").each(function() {
                var thang_diem = $(this).val();
                if (thang_diem != "") {
                    tgd.push(thang_diem);
                }
            });

            $.ajax({
                url: '../ajax/them_dg_nhacc.php',
                type: 'POST',
                data: {
                    ngay_dg: ngay_dg,
                    com_id: com_id,
                    dep_id: dep_id,
                    id_nhacc: id_nhacc,
                    dg_khac: dg_khac,
                    user_id: user_id,
                    id_tc: idt,
                    diem_dg: dd,
                    tong_diem: sm,
                    dg_ctiet: dg_ct,
                    thang_diem: tgd,
                    tong_diem_dg: tong_diem_dg,
                },
                success: function(data) {
                    if (data == "") {
                        alert("Bạn đã đánh giá nhà cung cấp thành công");
                        window.location.href = '/danh-gia-nha-cung-cap.html';
                    } else {
                        alert(data);
                    }
                }
            });
        }
    });
</script>

</html>