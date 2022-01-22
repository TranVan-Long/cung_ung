<?php

include("config.php");
include("../includes/icon.php");
$date = strtotime(date('Y-m-d', time()));

if(isset($_GET['id']) && $_GET['id'] != ""){
    $id = $_GET['id'];
    $list_dg = mysql_fetch_assoc((new db_query("SELECT `id`, `ngay_danh_gia`, `nguoi_danh_gia`, `phong_ban`, `id_nha_cc`, `danh_gia_khac` FROM `danh_gia` WHERE `id`='$id' ")) -> result);

    $id_ncc = $list_dg['id_nha_cc'];

    if(isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role']) && $_COOKIE['role'] == 2){
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
        $count = count($data_list_nv);

        $user = [];
        for ($i = 0; $i < $count; $i++){
            $item1 = $data_list_nv[$i];
            $user[$item1["ep_id"]] = $item1;
        }

        $ep_name = $user[$list_dg['nguoi_danh_gia']]['ep_name'];
        $phong_ban = $user[$list_dg['nguoi_danh_gia']]['dep_name'];
    }

   $list_nhacc = new db_query("SELECT `id`, `ten_nha_cc_kh`, `phan_loai` FROM `nha_cc_kh` WHERE `phan_loai` = 1 ");

   $list_ncc = mysql_fetch_assoc((new db_query("SELECT `id`, `ten_nha_cc_kh`, `dia_chi_lh`, `sp_cung_ung`, `phan_loai`
                                                FROM `nha_cc_kh` WHERE `phan_loai` = 1 AND `id` = '$id_ncc' ")) -> result);

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chỉnh sửa phiếu đánh giá</title>
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
                <a class="text-black" href="danh-gia-nha-cung-cap.html"><?php echo $ic_lt ?> Quay lại</a>
                <p class="page-title mt_20 mb_10">Chỉnh sửa phiếu đánh giá nhà cung cấp</p>
            </div>
            <form action="" class="main-form">
                <div class="w-100 left mt-10">
                    <div class="form-control edit-form">
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <label>Số phiếu</label>
                                <input type="text" name="so_phieu" value="PH-<?= $list_dg['id'] ?>" readonly>
                            </div>
                            <div class="form-col-50 no-border right mb_15">
                                <label>Ngày đánh giá<span class="text-red">&ast;</span></label>
                                <input type="date" name="ngay_danh_gia" value="<?= date('Y-m-d', $list_dg['ngay_danh_gia']) ?>">
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <label>Người đánh giá<span class="text-red">&ast;</span></label>
                                <input type="text" name="nguoi_danh_gia" placeholder="Nhập người đánh giá"
                                       value="<?= $ep_name ?>" data-id="<?= $list_dg['nguoi_danh_gia'] ?>">
                            </div>
                            <div class="form-col-50 no-border right mb_15">
                                <label>Phòng ban</label>
                                <input type="text" name="phong_ban" placeholder="Nhập phòng ban" value="<?= $phong_ban ?>" data-id="<?= $list_dg['phong_ban'] ?>">
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15 v-select2">
                                    <label for="nha-cung-cap">Nhà cung cấp<span class="text-red">&ast;</span></label>
                                    <select class="share_select" name="nha_cung_cap" id="nha-cung-cap">
                                        <option value="">-- Chọn nhà cung cấp --</option>
                                        <? while($row = mysql_fetch_assoc($list_nhacc -> result)) { ?>
                                            <option value="<?= $row['id'] ?>" <?= ($row['id'] == $list_dg['id_nha_cc']) ? "selected" : "" ?>><?= $row['ten_nha_cc_kh'] ?></option>
                                        <?}?>
                                    </select>
                            </div>
                        </div>
                        <div class="ctiet_nhacc w_100 float_l">
                            <div class="form-row left">
                                <div class="form-col-50 no-border left mb_15">
                                    <p>Tên nhà cung cấp</p>
                                    <p class="cr_weight mt-10"><?= $list_ncc['ten_nha_cc_kh'] ?></p>
                                </div>
                                <div class="form-col-50 no-border right mb_15">
                                    <p>Địa chỉ</p>
                                    <p class="cr_weight mt-10"><?= $list_ncc['dia_chi_lh'] ?></p>
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border left mb_15">
                                    <p>Sản phẩm cung ứng</p>
                                    <p class="cr_weight mt-10"><?= $list_ncc['sp_cung_ung'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <p>Điểm đánh giá</p>
                                <p class="cr_weight mt-10">40</p>
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-100 no-border left mb_15">
                                <label>Đánh giá khác</label>
                                <textarea name="danh_gia_khac" placeholder="Nhập đánh giá khác"><?= $list_dg['danh_gia_khac'] ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mt-50 left w-100">
                        <p class="text-blue link-text d-inline text-500" id="add-ratting-ruler">&plus; Thêm tiêu chí
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
                                        <tr class="item">
                                            <td class="w-5"><p class="removeItem"><i class="ic-delete remove-btn"></i>
                                                </p>
                                            </td>
                                            <td class="w-10">
                                                <p>1</p>
                                            </td>
                                            <td class="w-20">
                                                <div class="v-select2">
                                                    <select name="chi_nhanh_ngan_hang" class="share_select"></select>
                                                </div>
                                            </td>
                                            <td class="w-10">
                                                <p>x1</p>
                                            </td>
                                            <td class="w-10">
                                                <p>10</p>
                                            </td>
                                            <td class="w-15">
                                                <input type="text" name="diem_danh_gia">
                                            </td>
                                            <td class="w-15">
                                                <p>1</p>
                                            </td>
                                            <td class="w-15">
                                                <p>1</p>
                                            </td>
                                        </tr>
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
                <p>Bạn có chắc chắn muốn hủy việc chỉnh sửa phiếu đánh giá?</p>
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
<script>
    $('.submit-btn').click(function () {
        var form = $('.main-form');
        form.validate({
            errorPlacement: function (error, element) {
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
            alert("pass");
        }
    });
</script>
</html>