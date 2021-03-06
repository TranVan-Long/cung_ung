<?php
include("../includes/icon.php");
include("config.php");

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        $com_id = $_SESSION['com_id'];
        $user_id = $_SESSION['com_id'];
        $phan_quyen_nk = 1;
    } else if ($_COOKIE['role'] == 2) {
        $com_id = $_SESSION['user_com_id'];
        $user_id = $_SESSION['ep_id'];
        $phan_quyen_nk = 2;
        $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id ");
        if (mysql_num_rows($kiem_tra_nv->result) > 0) {
            $item_nv = mysql_fetch_assoc((new db_query("SELECT `bao_gia_kh` FROM `phan_quyen` WHERE `id_nhan_vien` = $user_id AND `id_cong_ty` = $com_id "))->result);
            $bao_gia_kh3 = explode(',', $item_nv['bao_gia']);
            if (in_array(3, $bao_gia_kh3) == FALSE) {
                header('Location: /quan-ly-trang-chu.html');
            }
        } else {
            header('Location: /quan-ly-trang-chu.html');
        }
    }
};
$id = getValue("id", "int", "GET", "");
if ($id != "") {
    $list_phieu = mysql_fetch_assoc((new db_query("SELECT y.`id`, y.`nha_cc_kh`, y.`noi_dung_thu`, y.`ngay_bd`, y.`ngay_kt`,
                                                y.`phan_loai`,  y.`ngay_tao`, y.`id_cong_ty`, n.`ten_nha_cc_kh`
                                                FROM `yeu_cau_bao_gia` AS y
                                                INNER JOIN `nha_cc_kh` AS n ON y.`nha_cc_kh` = n.`id`
                                                WHERE y.`id_cong_ty` = $com_id AND y.`id` = $id "))->result);

    $vt_phieu = new db_query("SELECT `id`, `id_yc_bg`, `id_vat_tu`, `so_luong_yc_bg` FROM `vat_tu_bao_gia` WHERE `id_yc_bg` = $id ");

    $list_kh = new db_query("SELECT `id`, `ten_nha_cc_kh` FROM `nha_cc_kh` WHERE `phan_loai` = 2 ");

    $curl = curl_init();
    $data = array(
        'id_com' => $com_id,
    );
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlykhoxaydung.timviec365.vn/api/api_get_dsvt.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $response1 = curl_exec($curl);
    curl_close($curl);

    $list_vttb = json_decode($response1, true);
    $data_vttb = $list_vttb['data']['items'];

    $list_vt = [];
    for ($i = 0; $i < count($data_vttb); $i++) {
        $item1 = $data_vttb[$i];
        $list_vt[$item1['dsvt_id']] = $item1;
    };
}
$date = date('m-d-Y', time());
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ch???nh s???a b??o gi?? cho kh??ch h??ng</title>
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
                    <a class="text-black" href="chi-tiet-bao-gia-cho-khach-hang-<?= $id ?>.html"><?php echo $ic_lt ?> Quay l???i</a>
                    <p class="page-title mt_20 mb_10">Ch???nh s???a b??o gi?? cho kh??ch h??ng</p>
                </div>
                <form action="" class="main-form" data="<?= $com_id ?>" data1="<?= $user_id ?>">
                    <div class="w-100 left mt-10">
                        <div class="form-control edit-form" data="<?= $phan_quyen_nk ?>">
                            <div class="form-row left">
                                <div class="form-col-50 no-border left mb_15">
                                    <label>S??? phi???u ph???n h???i<span class="text-red">&ast;</span></label>
                                    <input type="text" name="so_bao_gia" value="PH-<?= $list_phieu['id'] ?>" data_id="<?= $list_phieu['id'] ?>" readonly>
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border left mb_15 v-select2">
                                    <label>Kh??ch h??ng<span class="text-red">&ast;</span></label>
                                    <select id="khach-hang" name="khach_hang" class="share_select">
                                        <option value="">-- Ch???n kh??ch h??ng --</option>
                                        <? while ($row = mysql_fetch_assoc($list_kh->result)) { ?>
                                            <option value="<?= $row['id'] ?>" <?= ($row['id'] == $list_phieu['nha_cc_kh']) ? "selected" : "" ?>><?= $row['ten_nha_cc_kh'] ?></option>
                                        <? } ?>
                                    </select>
                                </div>
                                <div class="form-col-50 no-border right mb_15">
                                    <label>Th???i gian ??p d???ng <span class="text-red">&ast;</span></label>
                                    <div class="range-date-picker">
                                        <div class="date-input-sm">
                                            <input type="date" name="tu_ngay" value="<?= date('Y-m-d', $list_phieu['ngay_bd']) ?>" id="startDate">
                                        </div>
                                        <div class="range-date-text">
                                            <p id="hahaha">?????n</p>
                                        </div>
                                        <div class="date-input-sm">
                                            <input type="date" name="den_ngay" value="<?= date('Y-m-d', $list_phieu['ngay_kt']) ?>" id="endDate">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="w-100 no-border left">
                                    <label>N???i dung ph???n h???i</label>
                                    <textarea name="noi_dung_phan_hoi" cols="30" rows="10" placeholder="Nh???p n???i dung ph???n h???i"><?= $list_phieu['noi_dung_thu'] ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mt-50 left w-100">
                            <p class="text-blue link-text text-500" id="add_bgia" data="<?= $com_id ?>">&plus; Th??m m???i v???t t??</p>
                            <div class="table-wrapper mt-10">
                                <div class="table-container table-1532">
                                    <div class="tbl-header">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th class="w-5"></th>
                                                    <th class="w-20">T??n v???t t?? thi???t b???</th>
                                                    <th class="w-20">H??ng s???n xu???t</th>
                                                    <th class="w-15">S??? l?????ng b??o gi??</th>
                                                    <th class="w-15">????n v??? t??nh</th>
                                                    <th class="w-20">????n gi??</th>
                                                    <th class="w-20">Th??nh ti???n</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="tbl-content table-2-row">
                                        <table>
                                            <tbody id="rererences_bgia" data="<?= $id ?>">
                                                <? while ($row2 = mysql_fetch_assoc($vt_phieu->result)) { ?>
                                                    <tr class="item" data="<?= $row2['id'] ?>">
                                                        <td class="w-5">
                                                            <p class="removeItem_vtp" data="<?= $row2['id'] ?>"><i class="ic-delete remove-btn" data="<?= $row2['id'] ?>"></i></p>
                                                        </td>
                                                        <td class="w-20">
                                                            <div class="v-select2">
                                                                <select name="ten_vat_tu" class="share_select ten_vat_tu1" data="<?= $com_id ?>" onchange="change_vt(this)">
                                                                    <option value="">Ch???n v???t t?? thi???t b???</option>
                                                                    <? for ($j = 0; $j < count($data_vttb); $j++) { ?>
                                                                        <option value="<?= $data_vttb[$j]['dsvt_id'] ?>" <?= ($data_vttb[$j]['dsvt_id'] == $row2['id_vat_tu']) ? "selected" : "" ?>>(<?= $data_vttb[$j]['dsvt_id'] ?>) <?= $data_vttb[$j]['dsvt_name'] ?> </option>
                                                                    <? } ?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td class="w-20">
                                                            <div class="v-select2">
                                                                <input type="text" name="hang_sx" value="<?= $list_vt[$row2['id_vat_tu']]['hsx_name'] ?>" readonly>
                                                            </div>
                                                        </td>
                                                        <td class="w-15">
                                                            <input type="text" name="so_luong_bg" class="so_luong" oninput="<?= $oninput ?>" value="<?= $row2['so_luong_yc_bg'] ?>" onchange="sl_doi(this)">
                                                        </td>
                                                        <td class="w-15">
                                                            <input type="text" name="don_vi_tinh" value="<?= $list_vt[$row2['id_vat_tu']]['dvt_name'] ?>" readonly>
                                                        </td>
                                                        <td class="w-20">
                                                            <input type="text" name="don_gia_bg" class="don_gia" value="<?= $list_vt[$row2['id_vat_tu']]['dsvt_donGia'] ?>" readonly>
                                                        </td>
                                                        <td class="w-20">
                                                            <input type="text" name="thanh_tien" class="tong_trvat" value="<?= $row2['so_luong_yc_bg'] * $list_vt[$row2['id_vat_tu']]['dsvt_donGia'] ?>" readonly>
                                                        </td>
                                                    </tr>
                                                <? } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 left">
                        <div class="control-btn right">
                            <p class="v-btn btn-outline-blue modal-btn mr-20 mt-20" data-target="cancel">H???y</p>
                            <button type="button" class="v-btn btn-blue mt-20 submit-btn">Xong</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal text-center" id="cancel">
            <div class="m-content">
                <div class="m-head ">
                    Th??ng b??o <span class="dismiss cancel">&times;</span>
                </div>
                <div class="m-body">
                    <p>B???n c?? ch???c ch???n mu???n h???y vi???c ch???nh s???a ph???n h???i b??o gi???</p>
                    <p>C??c th??ng tin b???n ???? nh???p s??? kh??ng ???????c l??u.</p>
                </div>
                <div class="m-foot d-inline-block">
                    <div class="left mb_10">
                        <p class="v-btn btn-outline-blue left cancel">H???y</p>
                    </div>
                    <div class="right mb_10">
                        <a href="chi-tiet-bao-gia-cho-khach-hang-<?= $id ?>.html" class="v-btn sh_bgr_six share_clr_tow right">?????ng
                            ??</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal text-center" id="remove_vatt">
            <div class="m-content">
                <div class="m-head ">
                    Th??ng b??o <span class="dismiss cancel">&times;</span>
                </div>
                <div class="m-body">
                    <p>B???n c?? ch???c ch???n mu???n x??a v???t t?? trong phi???u b??o gi???</p>
                    <p>C??c th??ng tin b???n ???? nh???p s??? kh??ng ???????c l??u.</p>
                </div>
                <div class="m-foot d-inline-block">
                    <div class="left mb_10">
                        <p class="v-btn btn-outline-blue left cancel">H???y</p>
                    </div>
                    <div class="right mb_10">
                        <a class="v-btn sh_bgr_six share_clr_tow right remo_vattu" data="">?????ng
                            ??</a>
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
<script type="text/javascript" src="../js/giatri_doi.js"></script>
<script type="text/javascript">
    $("#add_bgia").click(function() {
        var com_id = $(this).attr("data");
        $.ajax({
            url: '../render/them_html_vtbg_kh.php',
            type: 'POST',
            data: {
                id_com: com_id,
            },
            success: function(data) {
                $("#rererences_bgia").append(data);
                RefSelect2();
            }
        })
    });

    function change_vt(id) {
        var id_vt = $(id).val();
        var com_id = $(id).attr("data");
        var id_p = $(id).parents(".item").attr("data");
        $.ajax({
            url: '../render/sua_html_vtbg_kh.php',
            type: 'POST',
            data: {
                id_vt: id_vt,
                id_com: com_id,
                id_p: id_p,
            },
            success: function(data) {
                $(id).parents(".item").html(data);
                RefSelect2();
            }
        });
    };

    $(document).on('click', '.removeItem_vtp', function() {
        var id_vt = $(this).find(".remove-btn").attr("data");
        $("#remove_vatt .remo_vattu").attr("data", id_vt);
        $("#remove_vatt").show();
    });

    $("#remove_vatt .remo_vattu").click(function() {
        var id_vt = $(this).attr("data");
        var id_p = $("#rererences_bgia").attr("data");
        $.ajax({
            url: '../ajax/xoa_vt_phieu_bgkh.php',
            type: 'POST',
            data: {
                id_vt: id_vt,
                id_p: id_p,
            },
            success: function(data) {
                window.location.reload();
            }
        })
    });

    $('.submit-btn').click(function() {
        var form = $('.main-form');
        form.validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parent('.form-col-50'));
                error.appendTo(element.parent('.date-input-sm'));
                error.wrap('<span class="error">');
            },
            rules: {
                so_bao_gia: {
                    required: true,
                },
                khach_hang: {
                    required: true,
                },
                tu_ngay: {
                    required: true,
                },
                den_ngay: {
                    required: true,
                    greaterThan: '#startDate'
                }
            },
            messages: {
                so_bao_gia: {
                    required: "S??? b??o gi?? kh??ng ???????c ????? tr???ng.",
                },
                khach_hang: {
                    required: "Vui l??ng ch???n kh??ch h??ng.",
                },
                tu_ngay: {
                    required: "Vui l??ng ch???n ng??y b???t ?????u.",
                },
                den_ngay: {
                    required: "Vui l??ng ch???n ng??y k???t th??c.",
                    greaterThan: 'Kh??ng ???????c l???n h??n ng??y b???t ?????u'
                }
            }
        });
        if (form.valid() === true) {
            var com_id = $(".main-form").attr("data");
            var user_id = $(".main-form").attr("data1");
            var id_bg = $("input[name='so_bao_gia']").attr("data_id");
            var id_kh = $("select[name='khach_hang']").val();
            var ngay_bd = $("input[name='tu_ngay']").val();
            var ngay_kt = $("input[name='den_ngay']").val();
            var noi_dung_ph = $("textarea[name='noi_dung_phan_hoi']").val();
            var phan_quyen_nk = $(".edit-form").attr("data");

            var id_v = new Array();
            $(".removeItem_vtp").each(function() {
                var ivt = $(this).attr("data");
                if (ivt != "") {
                    id_v.push(ivt);
                }
            });

            var id_vt = new Array();
            $("select[name='ten_vat_tu']").each(function() {
                var vt = $(this).val();
                if (vt != "") {
                    id_vt.push(vt);
                }
            });

            var so_luong = new Array();
            $("input[name='so_luong_bg']").each(function() {
                var sl = $(this).val();
                if (sl != "") {
                    so_luong.push(sl);
                }
            });

            var don_gia = [];
            $("input[name='don_gia_bg']").each(function() {
                var dgia = $(this).val();
                if (dgia != "") {
                    don_gia.push(dgia);
                }
            });

            var new_id_vt = new Array();
            $("select[name='ten_day_du']").each(function() {
                var niv = $(this).val();
                if (niv != "") {
                    new_id_vt.push(niv);
                }
            });

            var new_so_luong = new Array();
            $("input[name='so_luong_bao_gia']").each(function() {
                var new_sl = $(this).val();
                var n_id = $(this).parents(".item").find(".ten_vat_tu").val();
                if (new_sl != "" && n_id != "") {
                    new_so_luong.push(new_sl);
                }
            });

            var new_don_gia = [];
            $("input[name='don_gia']").each(function() {
                var new_dg = $(this).val();
                if (new_dg != "") {
                    new_don_gia.push(new_dg);
                }
            });

            $.ajax({
                url: '../ajax/sua_bgvt_kh.php',
                type: 'POST',
                data: {
                    com_id: com_id,
                    user_id: user_id,
                    id_bg: id_bg,
                    id_kh: id_kh,
                    ngay_bd: ngay_bd,
                    ngay_kt: ngay_kt,
                    noi_dung_ph: noi_dung_ph,
                    id_v: id_v,
                    id_vt: id_vt,
                    so_luong: so_luong,
                    don_gia: don_gia,
                    new_id_vt: new_id_vt,
                    new_so_luong: new_so_luong,
                    new_don_gia: new_don_gia,
                    phan_quyen_nk: phan_quyen_nk,
                },
                success: function(data) {
                    if (data == "") {
                        alert("B???n ???? s???a th??nh c??ng phi???u b??o gi?? kh??ch h??ng");
                        window.location.href = '/quan-ly-bao-gia-cho-khach-hang.html';
                    } else if (data != "") {
                        alert(data);
                    }
                }
            })
        }
    });
</script>

</html>