<?php

include("config.php");
include("../includes/icon.php");

if (isset($_GET['id']) && $_GET['id'] != "") {
    $ratting_id = $_GET['id'];
    $rat_get = new db_query("SELECT d.`id`, d.`ngay_danh_gia`, d.`nguoi_danh_gia`, d.`phong_ban`, d.`id_nha_cc`, d.`danh_gia_khac`,
                            n.`ten_nha_cc_kh`, n.`ten_vt`, n.`dia_chi_lh`, n.`sp_cung_ung`
                            FROM `danh_gia` AS d
                            INNER JOIN `nha_cc_kh` AS n ON d.`id_nha_cc` = n.`id`
                            WHERE d.`id` = $ratting_id ");
    $item = mysql_fetch_assoc($rat_get->result);

    $id_dg = $item['id'];

    $list_gtri = new db_query("SELECT s.`id`, s.`id_danh_gia`, s.`id_tieu_chi`, s.`diem_danh_gia`, s.`tong_diem_danh_gia`, s.`danh_gia_chi_tiet`, t.`id`, t.`he_so`,
                                t.`tieu_chi`, g.`id`
                                FROM `chi_tiet_danh_gia` AS s
                                INNER JOIN `tieu_chi_danh_gia` AS t ON s.`id_tieu_chi` = t.`id`
                                INNER JOIN `danh_gia` AS g ON s.`id_danh_gia` = g.`id`
                                WHERE s.`id_danh_gia` = $ratting_id ");

    $user_id = $item['nguoi_danh_gia'];

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

        $ep_name = $user[$user_id]['ep_name'];
        $phong_ban = $user[$user_id]['dep_name'];
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi tiết phiếu đánh giá</title>
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
                <div class="mt-20 left">
                    <a class="text-black" href="danh-gia-nha-cung-cap.html"><?php echo $ic_lt ?> Quay lại</a>
                    <p class="page-title text-blue mt-20">Chi tiết phiếu đánh giá</p>
                </div>
                <div class="w-100 left mt-10">
                    <div class="form-control detail-form" data="<?= $nha_cc ?>">
                        <div class="form-row left">
                            <div class="form-col-50 left p-10 no-border">
                                <p class="detail-title">Số phiếu</p>
                                <p class="detail-data text-500">PH-<?= $item['id'] ?></p>
                            </div>
                        </div>
                        <div class="form-row left border-top2">
                            <div class="form-col-50 left p-10">
                                <p class="detail-title">Ngày đánh giá</p>
                                <p class="detail-data text-500"><?= date("d-m-Y", $item['ngay_danh_gia']) ?></p>
                            </div>
                            <div class="form-col-50 right p-10 pt-10">
                                <p class="detail-title">Người đánh giá</p>
                                <p class="detail-data text-500"><?= $ep_name ?></p>
                            </div>
                        </div>
                        <div class="form-row left border-top2">
                            <div class="form-col-50 left p-10">
                                <p class="detail-title">Phòng ban</p>
                                <p class="detail-data text-500"><?= $phong_ban ?></p>
                            </div>
                        </div>
                        <div class="form-row left border-top2">
                            <div class="form-col-50 left p-10">
                                <p class="detail-title">Nhà cung cấp</p>
                                <p class="detail-data text-500"><?= $item['ten_vt'] ?></p>
                            </div>
                            <div class="form-col-50 right p-10 pt-10">
                                <p class="detail-title">Tên nhà cung cấp</p>
                                <p class="detail-data text-500"><?= $item['ten_nha_cc_kh'] ?></p>
                            </div>
                        </div>
                        <div class="form-row left border-top2">
                            <div class="form-col-50 left p-10">
                                <p class="detail-title">Địa chỉ</p>
                                <p class="detail-data text-500"><?= $item['dia_chi_lh'] ?></p>
                            </div>
                            <div class="form-col-50 right p-10 pt-10">
                                <p class="detail-title">Sản phẩm cung ứng</p>
                                <p class="detail-data text-500"><?= $item['sp_cung_ung'] ?></p>
                            </div>
                        </div>
                        <div class="form-row left border-top2">
                            <div class="form-col-50 left p-10">
                                <p class="detail-title">Điểm đánh giá</p>
                                <p class="detail-data text-500"><?= $tong_diem ?></p>
                            </div>
                             <div class="form-col-50 right p-10 pt-10">
                                <p class="detail-title">Đánh giá khác</p>
                                <p class="detail-data text-500"><?= $item['danh_gia_khac'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-100 left mt-30">
                    <div class="table-wrapper">
                        <div class="table-container table-1252">
                            <div class="tbl-header">
                                <table>
                                    <thead>
                                        <tr>
                                            <th scope="col" rowspan="2" class="w-5">STT</th>
                                            <th scope="col" rowspan="2" class="w-20">Tiêu chí đánh giá</th>
                                            <th scope="col" rowspan="2" class="w-10">Hệ số</th>
                                            <th colspan="3" scope="colgroup" class="border-bottom-w">Đánh giá</th>
                                        </tr>
                                        <tr class="border-top-w">
                                            <th scope="colgroup" class="">Điểm đánh giá</th>
                                            <th scope="colgroup" class="">Điểm</th>
                                            <th scope="colgroup" class="">Đánh giá chi tiết</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tbl-content table-2-row">
                                <table>
                                    <tbody>
                                        <?  $stt = 1;
                                            while($row = mysql_fetch_assoc($list_gtri -> result)) {?>
                                        <tr>
                                            <td class="w-5"><?= $stt++ ?></td>
                                            <td class="w-20"><?= $row['tieu_chi'] ?></td>
                                            <td class="w-10"><?= $row['he_so'] ?></td>
                                            <td class=""><?= $row['diem_danh_gia'] ?></td>
                                            <td class=""><?= $row['tong_diem_danh_gia'] ?></td>
                                            <td><?= $row['danh_gia_chi_tiet'] ?></td>
                                        </tr>
                                        <?}?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="control-btn right">
                        <p class="v-btn btn-outline-red modal-btn show_btn_modal mr-20 mt-15" data-target="delete">Xóa</p>
                        <? if($user_id == $_COOKIE['user']) {?>
                            <a href="chinh-sua-danh-gia-nha-cung-cap-<?= $item['id'] ?>.html" class="v-btn btn-blue mt-15">Chỉnh sửa</a>
                        <?}?>

                    </div>
                    <div class="control-btn left mr-10">
                        <button class="v-btn btn-green mr-20 mt-15">Xuất excel</button>
                        <p class="v-btn"></p>
                    </div>
                </div>
            </div>
            <div class="modal text-center" id="delete">
                <div class="m-content huy-them">
                    <div class="m-head ">
                        Xóa phiếu đánh giá <span class="dismiss cancel">&times;</span>
                    </div>
                    <div class="m-body">
                        <p>Bạn có chắc chắn muốn xóa phiếu đánh giá này?</p>
                        <p>Thao tác này sẽ không thể hoàn tác.</p>
                    </div>
                    <div class="m-foot d-inline-block">
                        <div class="left">
                            <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                        </div>
                        <div class="right">
                            <button type="button" class="v-btn sh_bgr_six share_clr_tow right remove_dg" data-id="<?= $id_dg ?>">Đồng ý</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "../modals/modal_logout.php" ?>
    <? include("../modals/modal_menu.php") ?>

</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
<script>
    $(".show_btn_modal").click(function() {
        $(".modal").show();
    });

    $(".remove_dg").click(function(){
        var id = $(this).attr("data-id");
        var user_id = "<?= $_COOKIE['user'] ?>";
        $.ajax({
            url: '../ajax/xoa_danh_gia.php',
            type: 'POST',
            data:{
                id: id,
                user_id: user_id,
            },
            success: function(data){
                if(data == ""){
                    window.location.href = '/danh-gia-nha-cung-cap.html';
                }else{
                    alert(data);
                }
            }
        })
    })

</script>

</html>