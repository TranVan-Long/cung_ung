<?
include("../includes/icon.php");
include("config.php");

if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $com_id = $_SESSION['com_id'];
    $user_id = $_SESSION['com_id'];
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
    $cou = count($data_list_nv);
} elseif (isset($_SESSION['quyen']) && ($_SESSION['quyen'] == 2)) {
    $com_id = $_SESSION['user_com_id'];
    $user_id = $_SESSION['ep_id'];
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
    $cou = count($data_list_nv);

    $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
    if (mysql_num_rows($kiem_tra_nv->result) > 0) {
        $item_nv = mysql_fetch_assoc((new db_query("SELECT `yeu_cau_vat_tu` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
        $ycvt3 = explode(',', $item_nv['yeu_cau_vat_tu']);
        if (in_array(3, $ycvt3) == FALSE) {
            header('Location: /quan-ly-trang-chu.html');
        }
    } else {
        header('Location: /quan-ly-trang-chu.html');
    }
};

$all_user = [];
for ($i = 0; $i < $cou; $i++) {
    $user_o = $data_list_nv[$i];
    $all_user[$user_o['ep_id']] = $user_o;
}

if (isset($_GET['id']) && $_GET['id'] != "") {
    $ycvt_id = $_GET['id'];
    $get_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE `id` = $ycvt_id ");

    $item = mysql_fetch_assoc($get_ycvt->result);
    $id_nyc = $item['id_nguoi_yc'];
    $ngay_tao = date('Y-m-d', $item['ngay_tao']);
    $ngay_ht = date('Y-m-d', $item['ngay_ht_yc']);
    $cong_trinh = $item['id_cong_trinh'];
    $dien_giai = $item['dien_giai'];
    $trang_thai = $item['trang_thai'];
    $ngay_duyet = date('Y-m-d', $item['ngay_duyet']);
    $nguoi_duyet = $item['id_nguoi_duyet'];
    $ly_do_tu_choi = $item['ly_do_tu_choi'];


    $get_vtyc = new db_query("SELECT * FROM `chi_tiet_yc_vt` WHERE `id_yc_vt` = $ycvt_id");

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
    $data = array(
        'id_com' => $com_id,
    );
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_URL, "https://phanmemquanlykhoxaydung.timviec365.vn/api/api_get_kho.php");
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $response1 = curl_exec($curl);
    curl_close($curl);
    $list_kho = json_decode($response1, true);
    $kho_data = $list_kho['data']['items'];

    $curl = curl_init();
    $data = array(
        'id_com' => $com_id,
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
}

if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $cp_id = $_SESSION['com_id'];
    if ($id_nyc == $cp_id) {
        $user_name = $_SESSION['com_name'];
        $dept_name  = "";
    } else {
        $user_name = $all_user[$id_nyc]['ep_name'];
        $dept_name  = $all_user[$id_nyc]['dep_name'];
    };

    if ($cp_id == $nguoi_duyet) {
        $ten_nguoi_duyet = $_SESSION['com_name'];
    } else {
        $ten_nguoi_duyet = $all_user[$nguoi_duyet]['ep_name'];
    };
} else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) {
    $user_name = $all_user[$id_nyc]['ep_name'];
    $dept_name  = $all_user[$id_nyc]['dep_name'];
    $ten_nguoi_duyet = $all_user[$nguoi_duyet]['ep_name'];
}

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chỉnh sửa yêu cầu vật tư </title>
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
                <div class="mt-25 mb_25 w_100 float_l">
                    <a class="prew_href share_fsize_one share_clr_one mb_20" href="quan-ly-yeu-cau-vat-tu.html">Quay lại</a>
                    <h4 class="w_100 float_l">Chỉnh sửa yêu cầu vật tư</h4>
                </div>
                <div class="c-body">
                    <form action="" class="form-edit w_100 float_l">
                        <div class="form-control">
                            <div class="form-row left">
                                <div class="form-col-50 mb_15">
                                    <label>Số phiếu yêu cầu</label>
                                    <input type="text" name="so-phieu" value="YC-<?= $ycvt_id ?>" readonly>
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 left v-select2 mb_15">
                                    <label>Phòng ban<span class="text-red">*</span></label>
                                    <input type="text" name="phong_ban" value="<?= $dept_name ?>" readonly>
                                </div>
                                <div class="form-col-50 right v-select2 mb_15">
                                    <label>Người yêu cầu <span class="text-red">*</span></label>
                                    <input type="text" name="nguoi_yeu_cau" id="nguoi_yeu_cau" data="<?= $role ?>" data1="<?= $com_id?>" data2="<?= $user_id?>" value="<?= $user_name ?>" readonly>
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 left v-select2 mb_15">
                                    <label>Công trình <span class="text-red">*</span></label>
                                    <select name="cong_trinh" id="cong-trinh" class="share_select">
                                        <option value="">-- Chọn công trình --</option>
                                        <? foreach ($cong_trinh_data as $key => $items) { ?>
                                            <option value="<?= $items['ctr_id'] ?>" <?= ($items['ctr_id'] == $cong_trinh) ? "selected" : "" ?>><?= $items['ctr_name'] ?></option>
                                        <? } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 left mb_15">
                                    <label>Ngày tạo yêu cầu</label>
                                    <input type="date" id="ngay_tao_yeu_cau" name="ngay_tao_yeu_cau" value="<?= $ngay_tao ?>" readonly>
                                </div>
                                <div class="form-col-50 right mb_15">
                                    <label>Ngày phải hoàn thành yêu cầu</label>
                                    <input type="date" id="ngay_phai_hoan_thanh" name="ngay_phai_hoan_thanh" value="<?= $ngay_ht ?>">
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-100 left mb-5">
                                    <label for="dien-giai">Diễn giải</label>
                                    <textarea id="dien-giai" name="dien_giai"><?= $dien_giai ?></textarea>
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
                                                <?
                                                $get_vtyc2 = new db_query("SELECT * FROM `chi_tiet_yc_vt` WHERE `id_yc_vt` = $ycvt_id");
                                                while ($row1 = mysql_fetch_assoc($get_vtyc2->result)) {
                                                ?>
                                                    <tr class="item">
                                                        <td class="w-10">
                                                            <p class="modal-btn" data-target="remove-<?= $row1['id'] ?>"><i class="ic-delete remove-item"></i></p>
                                                            <input type="hidden" name="id_vat_tu_old" class="d-none" value="<?= $row1['id'] ?>">
                                                        </td>
                                                        <td class="w-25">
                                                            <div class="v-select2">
                                                                <select name="vat_tu_old" class="share_select materials_name">
                                                                    <option value="">-- Chọn vật tư/thiết bị --</option>
                                                                    <? for ($i = 0; $i < count($vat_tu_data); $i++) { ?>
                                                                        <option value="<?= $vat_tu_data[$i]['dsvt_id'] ?>" <?= ($vat_tu_data[$i]['dsvt_id'] == $row1['id_vat_tu']) ? "selected" : "" ?>><?= $vat_tu_data[$i]['dsvt_name'] ?></option>
                                                                    <? } ?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="w-20"><input type="text" name="don_vi_tinh_old" value="<?= $vat_tu[$row1['id_vat_tu']]['dvt_name'] ?>" readonly></td>
                                                        <td class="w-25">
                                                            <? if ($row1['so_luong_yc_duyet'] != "" && $row1['so_luong_yc_duyet'] != 0) { ?>
                                                                <input type="number" name="so_luong_old" value="<?= $row1['so_luong_yc_duyet'] ?>">
                                                            <? } else { ?>
                                                                <input type="text" name="so_luong_old" value="" disabled>
                                                            <? } ?>
                                                        </td>
                                                    </tr>
                                                    <div class="modal text-center" id="remove-<?= $row1['id'] ?>">
                                                        <div class="m-content">
                                                            <div class="m-head ">
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
                                                                    <button type="button" class="v-btn sh_bgr_six share_clr_tow right remove_vat_tu" data-id="<?= $row1['id'] ?>">Đồng ý</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <? } ?>
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

    <? include "../modals/modal_logout.php" ?>
    <? include("../modals/modal_menu.php") ?>

</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
<script type="text/javascript">
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
            var com_id = <?= $com_id ?>;
            $.ajax({
                url: '../render/ycvt_vat_tu.php',
                type: 'POST',
                data: {
                    id_vt: id_vt,
                    com_id: com_id,
                },
                success: function(data) {
                    _this.parents(".item").html(data);
                }
            })
        });
        RefSelect2();
    };

    $(".remove_vat_tu").click(function() {
        var id = $(this).attr("data-id");

        $.ajax({
            url: '../ajax/ycvt_xoa_vt.php',
            type: 'POST',
            data: {
                id: id,
            },
            success: function(data) {
                if (data == "") {
                    window.location.reload();
                } else {
                    alert(data);
                }
            }
        });
    });

    $(".luu_sua").click(function() {
        var create_ycvt = $(".form-edit");
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
            },
            messages: {
                phong_ban: {
                    required: "Không được để trống",
                },
                nguoi_yeu_cau: {
                    required: "Không được để trống",
                },
                cong_trinh: {
                    required: "Không được để trống",
                },
            },
        });
        if (create_ycvt.valid() === true) {
            var id_ycvt = "<?= $ycvt_id ?>";
            var ngay_ht = $("input[name='ngay_phai_hoan_thanh']").val();
            var dien_giai = $("textarea[name='dien_giai']").val();

            var id_vat_tu_old = new Array();
            $("input[name='id_vat_tu_old']").each(function() {
                var id_vt_old = $(this).val();
                if (id_vt_old != "") {
                    id_vat_tu_old.push(id_vt_old);
                }
            });
            var vat_tu_old = new Array();
            $("select[name='vat_tu_old']").each(function() {
                var vt_old = $(this).val();
                if (vt_old != "") {
                    vat_tu_old.push(vt_old);
                }
            });
            var so_luong_old = new Array();
            $("input[name='so_luong_old']").each(function() {
                var sl_old = $(this).val();
                var vt_old = $(this).parents(".item").find("select[name='vat_tu_old']").val();
                if (sl_old != "" && vt_old != "") {
                    so_luong_old.push(sl_old);
                }
            });

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
                var vatt = $(this).parents(".item").find("select[name='materials_name']").val();
                if (sl != "" && vatt != "") {
                    so_luong.push(sl);
                }
            });

            var user_id = $("#nguoi_yeu_cau").attr('data2');
            var com_id = $("#nguoi_yeu_cau").attr('data1');
            var role = $("#nguoi_yeu_cau").attr('data');
            var ngay_tao = $("input[name='ngay_tao_yeu_cau']").val();

            if (ngay_ht < ngay_tao || ngay_ht == "") {
                alert("Ngày phải hoàn thành không được nhỏ hơn ngày tạo yêu cầu.");
            } else {
                $.ajax({
                    url: '../ajax/ycvt_sua.php',
                    type: 'POST',
                    data: {
                        id_ycvt: id_ycvt,
                        ngay_ht: ngay_ht,
                        dien_giai: dien_giai,
                        com_id: com_id,
                        id_vat_tu_old: id_vat_tu_old,
                        vat_tu_old: vat_tu_old,
                        so_luong_old: so_luong_old,
                        vat_tu: vat_tu,
                        so_luong: so_luong,

                        user_id: user_id,
                        com_id:role,
                        role:role,
                    },
                    success: function(data) {
                        if (data == "") {
                            alert('"Cập nhật phiếu yêu cầu vật tư thành công!"');
                            window.location.href = 'quan-ly-chi-tiet-yeu-cau-vat-tu-' + id_ycvt + '.html';
                        } else {
                            alert(data);
                        }
                    }
                });
            }
        }
    });
</script>

</html>