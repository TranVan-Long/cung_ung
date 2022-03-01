<?php
include("../includes/icon.php");
include("config.php");

if(isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role'])){
    if($_COOKIE['role'] == 1){
        $com_id = $_SESSION['com_id'];
        $user_id = $_SESSION['com_id'];
    }else if($_COOKIE['role'] == 2){
        $com_id = $_SESSION['user_com_id'];
        $user_id = $_SESSION['ep_id'];
    }
};

if(isset($_GET['id']) && $_GET['id'] != ""){
    $id_bg = $_GET['id'];
    if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
        $curl = curl_init();
        $token = $_COOKIE['acc_token'];
        curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_employee_of_company.php');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token));
        $response = curl_exec($curl);
        curl_close($curl);

        $data_list = json_decode($response,true);
        $data_list_nv =$data_list['data']['items'];

    }elseif (isset($_SESSION['quyen']) && ($_SESSION['quyen'] == 2)) {
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

    };

    $list_nv = [];
    for($i = 0; $i < count($data_list_nv); $i++){
        $item1 = $data_list_nv[$i];
        $list_nv[$item1['ep_id']] = $item1;
    };

    $list_ct = new db_query("SELECT y.`id`, y.`id_nguoi_lap`, y.`nha_cc_kh`, y.`id_cong_trinh`, y.`id_nguoi_tiep_nhan`, y.`noi_dung_thu`,
                            y.`mail_nhan_bg`, y.`gui_mail`, y.`gia_bg_vat`, y.`phan_loai`, y.`ngay_tao`, y.`id_cong_ty`, n.`ten_nha_cc_kh`, l.`ten_nguoi_lh`
                            FROM `yeu_cau_bao_gia` AS y
                            INNER JOIN `nha_cc_kh` AS n ON y.`nha_cc_kh` = n.`id`
                            INNER JOIN `nguoi_lien_he` AS l ON n.`id` = l.`id_nha_cc`
                            WHERE y.`id_cong_ty` = $com_id AND y.`id` = $id_bg ");
    $item_ct = mysql_fetch_assoc($list_ct -> result);
    $id_nguoi_lap = $item_ct['id_nguoi_lap'];

    $ep_name = $list_nv[$id_nguoi_lap]['ep_name'];

    $vt_bg = new db_query("SELECT `id`, `id_vat_tu`, `so_luong_yc_bg` FROM `vat_tu_bao_gia` WHERE `id_yc_bg` = $id_bg ");

    $curl = curl_init();
    $data = array(
        'id_com' => $com_id,
    );
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlykho.timviec365.vn/api/api_get_dsvt.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $response1 = curl_exec($curl);
    curl_close($curl);

    $list_vttb = json_decode($response1,true);
    $data_vttb =$list_vttb['data']['items'];

    $vat_tu = [];
    for($j = 0; $j < count($data_vttb); $j++){
        $item2 = $data_vttb[$j];
        $vat_tu[$item2['dsvt_id']] = $item2;
    }
}




?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi tiết yêu cầu báo giá</title>
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

<body>
<div class="main-container">
    <?php include("../includes/sidebar.php") ?>
    <div class="container">
        <div class="header-container">
            <?php include('../includes/ql_header_nv.php') ?>
        </div>
        <div class="content">
            <div class="mt-30 left">
                <a class="text-black" href="quan-ly-yeu-cau-bao-gia.html"><?php echo $ic_lt ?> Quay lại</a>
                <p class="text-blue mt-20 page-title">Chi tiết yêu cầu báo giá</p>
            </div>
            <div class="w-100 left mt-10">
                <div class="form-control detail-form">
                    <div class="form-row left">
                        <div class="form-col-50 left p-10 no-border">
                            <p class="detail-title">Số phiếu yêu cầu</p>
                            <p class="text-500 detail-data">BG-<?= $item_ct['id'] ?></p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left p-10">
                            <p class="detail-title"> Ngày lập</p>
                            <p class="text-500 detail-data"><?= date('d-m-Y', $item_ct['ngay_tao']) ?></p>
                        </div>
                        <div class="form-col-50 right p-10">
                            <p class="detail-title">Người lập</p>
                            <p class="text-500 detail-data"><?= $ep_name ?></p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left p-10">
                            <p class="detail-title"> Nhà cung cấp</p>
                            <p class="text-500 detail-data"><?= $item_ct['ten_nha_cc_kh'] ?></p>
                        </div>
                        <div class="form-col-50 right p-10">
                            <p class="detail-title">Người tiếp nhận báo giá</p>
                            <p class="text-500 detail-data"><?= $item_ct['ten_nguoi_lh'] ?></p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left p-10">
                            <p class="detail-title">Công trình</p>
                            <p class="text-500 detail-data"></p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left p-10">
                            <p class="detail-title">Nội dung thư</p>
                            <p class="text-500 detail-data"><?= $item_ct['noi_dung_thu'] ?></p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left p-10">
                            <p class="detail-title">Mail nhận báo giá</p>
                            <p class="text-500 detail-data"><?= $item_ct['mail_nhan_bg'] ?></p>
                        </div>
                        <div class="form-col-50 right p-10">
                            <p class="detail-title">Giá đã bao gồm VAT</p>
                            <p class="text-500 detail-data <?= ($item_ct['gia_bg_vat'] == 1) ? "text-green" : "text-red" ?>"><?= ($item_ct['gia_bg_vat'] == 1) ? "Có" : "Chưa có" ?></p>
                        </div>
                    </div>
                    <div class="form-row left border-top2">
                        <div class="form-col-50 left p-10">
                            <p class="detail-title">Đã gửi mail</p>
                            <p class="text-500 detail-data <?= ($item_ct['gui_mail'] == 1) ? "text-green" : "text-red" ?>"><?= ($item_ct['gui_mail'] == 1) ? "Đã gửi" : "Chưa gửi" ?></p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="left w-100 mt-50">
                <div class="table-wrapper mt-40">
                    <div class="table-container table-1252">
                        <div class="tbl-header">
                            <table>
                                <thead>
                                <tr>
                                    <th class="w-10">STT</th>
                                    <th class="w-15">Mã vật tư</th>
                                    <th class="w-35">Tên đầy đủ vật tư thiết bị</th>
                                    <th class="w-25">Hãng sản xuất</th>
                                    <th class="w-20">Đơn vị tính</th>
                                    <th class="w-20">Số lượng</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="tbl-content table-2-row">
                            <table>
                                <tbody id="materials">
                                    <? $stt = 1;
                                    while($row1 = mysql_fetch_assoc($vt_bg -> result)) {?>
                                    <tr>
                                        <td class="w-10"><?= $stt++ ?></td>
                                        <td class="w-15"><?= $vat_tu[$row1['id_vat_tu']]['dsvt_maVatTuThietBi'] ?> - <?= $vat_tu[$row1['id_vat_tu']]['dsvt_id'] ?></td>
                                        <td class="w-35"><?= $vat_tu[$row1['id_vat_tu']]['dsvt_name'] ?></td>
                                        <td class="w-25"><?= $vat_tu[$row1['id_vat_tu']]['hsx_name'] ?></td>
                                        <td class="w-20"><?= $vat_tu[$row1['id_vat_tu']]['dvt_name'] ?></td>
                                        <td class="w-20"><?= $row1['so_luong_yc_bg'] ?></td>
                                    </tr>
                                    <?}?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="control-btn right">
                    <button class="v-btn btn-outline-red modal-btn mr-20 mt-30" data-id="<?= $id_bg ?>">Xóa</button>
                    <a href="chinh-sua-yeu-cau-bao-gia-<?= $id_bg ?>.html" class="v-btn btn-blue mt-30">Chỉnh sửa</a>
                </div>
                <div class="control-btn left mr-10">
                    <button class="v-btn btn-gray mr-20 mt-30">Gửi mail</button>
                    <button class="v-btn btn-green mt-30">Xuất exel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal text-center" id="delete-vt">
        <div class="m-content">
            <div class="m-head ">
                Xóa yêu cầu báo giá<span class="dismiss cancel">&times;</span>
            </div>
            <div class="m-body">
                <p>Bạn có chắc chắn muốn xóa yêu cầu báo giá này?</p>
                <p>Thao tác này sẽ không thể hoàn tác.</p>
            </div>
            <div class="m-foot d-flex spc-btw">
                <div class="left mb-10">
                    <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                </div>
                <div class="right mb-10">
                    <button class="v-btn sh_bgr_six share_clr_tow right dongy_xoa" data="">Đồng ý</button>
                </div>
            </div>
        </div>
    </div>
    <?php include "../modals/modal_logout.php"?>
    <? include("../modals/modal_menu.php") ?>
</div>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
<script type="text/javascript">
    $(".modal-btn").click(function(){
        var id = $(this).attr("data-id");
        $("#delete-vt .dongy_xoa").attr("data", id);
        $("#delete-vt").show();
    });

    $("#delete-vt .dongy_xoa").click(function(){
        var id = $(this).attr("data");
        var user_id = "<?= $user_id ?>";
        $.ajax({
            url: '../ajax/xoa_ycbg_vt.php',
            type: 'POST',
            data: {
                id: id,
                user_id: user_id,
            },
            success: function(data){
                window.location.href = '/quan-ly-yeu-cau-bao-gia.html';
            }
        })
    })
</script>
</html>