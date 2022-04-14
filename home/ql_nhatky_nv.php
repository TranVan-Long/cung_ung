<?php
include "../includes/icon.php";
include("config.php");
$date_now = strtotime(date('Y-m-d'));

if (isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])) {
    if ($_COOKIE['role'] == 1) {
        header("Location: /quan-ly-trang-chu.html");
    } else if ($_COOKIE['role'] == 2) {
        $user_id = $_SESSION['ep_id'];
        $com_id = $_SESSION['user_com_id'];
        $list_hnay = new db_query("SELECT `id`, `id_nguoi_dung`, `ngay_tao`, `gio_tao`, `noi_dung` FROM `nhat_ky_hd`
                                    WHERE `id_nguoi_dung` = $user_id AND `ngay_tao` = $date_now AND `role` = 2
                                    AND `id_cong_ty` = $com_id ORDER BY `gio_tao` DESC");
        $list_cu = new db_query("SELECT `id`, `id_nguoi_dung`, `ngay_tao`, `gio_tao`, `noi_dung` FROM `nhat_ky_hd` WHERE `id_nguoi_dung` = $user_id
                                AND `ngay_tao` < $date_now AND `role` = 2 AND `id_cong_ty` = $com_id ORDER BY `ngay_tao` DESC");
    }
}


?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nhật ký hoạt động</title>
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
    <div class="main-container ql_nhatk">
        <? include('../includes/sidebar.php') ?>
        <div class="container">
            <div class="header-container">
                <? include('../includes/ql_header_nv.php') ?>
            </div>

            <div class="content">
                <div class="ctn_ctiet_hd w_100 float_l">
                    <div class="chi_tiet_cd mt_25 w_100 float_l">
                        <div class="top_sett w_100 float_l">
                            <div class="ctn_top_sett w_100 float_l">
                                <p class="caidc_ql"><a href="quan-ly-cai-dat.html" class="cai_dtl">Cài đặt chung</a></p>
                                <p class="his_ql active"><a href="nhat-ky-hoat-dong.html" class="cai_dtl">Nhật ký hoạt
                                        động</a></p>
                            </div>
                        </div>
                        <div class="ctn_sett w_100 float_l">
                            <div class="ctn_ctiet_nk_nd  w_100 float_l">
                                <div class="nhat_ky_nd w_100 float_l">
                                    <div class="thead_nhatk float_l w_100 d_flex share_bgr_one">
                                        <p class="share_tb_four share_clr_tow share_fsize_tow cr_weight">Ngày/tháng/năm
                                        </p>
                                        <p class="share_tb_nine share_clr_tow share_fsize_tow cr_weight">Công việc</p>
                                        <p class="share_tb_four share_clr_tow share_fsize_tow cr_weight">Thời gian</p>
                                        <p class="share_tb_four share_clr_tow share_fsize_tow cr_weight">Chức năng</p>
                                    </div>
                                </div>
                                <div class="ctiet_nhatk share_bgr_tow w_100 float_l">

                                    <div class="ctn_ctiet_nky">
                                        <p class="dropd_ctiet w_100 float_l share_cursor"><span class="mr_10">Hôm
                                                nay</span>
                                            <img src="../img/exp.png" alt="" class="avt_dropd share_cursor">
                                        </p>
                                        <?
                                        while ($item = mysql_fetch_assoc($list_hnay->result)) {
                                        ?>
                                            <div class="ctiet_nd_nhatk w_100 float_l">
                                                <div class="ctiet_noid_nk w_100 float_l d_flex">
                                                    <p class="share_tb_four"></p>
                                                    <p class="share_tb_nine share_fsize_tow"><?= $item['noi_dung'] ?></p>
                                                    <p class="share_tb_four cr_weight share_fsize_tow"><?= date("H:i", $item['gio_tao']); ?></p>
                                                    <p class="share_tb_four d_flex share_cursor xoa_popup" data="<?= $item['id'] ?>"><img src="../img/remove.png" alt="xóa nhật ký" class="xoa_nhat_ky"><span class="xoa_nhat_ky ml_5 padd_t cr_red">Xóa</span></p>
                                                </div>
                                            </div>
                                        <? } ?>
                                    </div>

                                    <div class="ctn_ctiet_nky">
                                        <p class="dropd_ctiet share_cursor"><span class="mr_10">Cũ hơn</span> <img src="../img/exp.png" alt="" class="avt_dropd share_cursor"></p>
                                        <?
                                        while ($item = mysql_fetch_assoc($list_cu->result)) {
                                        ?>
                                            <div class="ctiet_nd_nhatk w_100 float_l">
                                                <div class="ctiet_noid_nk w_100 float_l d_flex">
                                                    <p class="share_tb_four"></p>
                                                    <p class="share_tb_nine share_fsize_tow"><span class="cr_weight"><?= $item['noi_dung'] ?></p>
                                                    <p class="share_tb_four cr_weight share_fsize_tow"><?= date("H:i", $item['gio_tao']); ?> - <?= date("d/m/Y", $item['ngay_tao']) ?></p>
                                                    <p class="share_tb_four d_flex share_cursor xoa_popup" data="<?= $item['id'] ?>"><img src="../img/remove.png" alt="xóa nhật ký" class="xoa_nhat_ky"> <span class="xoa_nhat_ky ml_5 padd_t cr_red">Xóa</span></p>
                                                </div>
                                            </div>
                                        <? } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "../modals/modal_logout.php" ?>
    <? include("../modals/modal_menu.php") ?>

    <div class="modal text-center" id="xoa_log">
        <div class="m-content">
            <div class="m-head">
                Thông báo <span class="dismiss cancel">&times;</span>
            </div>
            <div class="m-body">
                <p>Bạn có chắc chắn muốn xóa hoạt động này?</p>
                <p>Thao tác này sẽ không thể hoàn tác.</p>
            </div>
            <div class="m-foot d-inline-block">
                <div class="left mb_10">
                    <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                </div>
                <div class="right mb_10">
                    <button class="v-btn btn-green right confirm-delete" data-id="">Đồng ý</button>
                </div>
            </div>
        </div>
    </div>

</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>

<script type="text/javascript">
    $(".dropd_ctiet").click(function() {
        $(this).parents(".ctn_ctiet_nky").toggleClass("active");
    })

    $(".xoa_nhat_ky").click(function() {
        var idnk = $(this).parents(".xoa_popup").attr("data");
        $("#xoa_log .confirm-delete").attr("data-id", idnk);
        $("#xoa_log").fadeIn();
    });

    $("#xoa_log .confirm-delete").click(function() {
        var id = $(this).attr('data-id');
        $.ajax({
            url: '../ajax/nhat_ky_xoa.php',
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
        })
    });
</script>

</html>