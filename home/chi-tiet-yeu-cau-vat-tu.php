<?
include("../includes/icon.php");
include("config.php");

if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $com_id = $_SESSION['com_id'];
    $user_id = $_SESSION['com_id'];
    $com_name = $_SESSION['com_name'];
    $phan_quyen_nduyet = 1;

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
    $com_name = $_SESSION['com_name'];
    $phan_quyen_nduyet = 2;

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
        if (in_array(1, $ycvt3) == FALSE) {
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
    $ngay_tao = date('d/m/Y', $item['ngay_tao']);
    $ngay_ht = $item['ngay_ht_yc'];
    $cong_trinh = $item['id_cong_trinh'];
    $dien_giai = $item['dien_giai'];
    $trang_thai = $item['trang_thai'];
    $ngay_duyet = date('d/m/Y', $item['ngay_duyet']);
    $nguoi_duyet = $item['id_nguoi_duyet'];
    $ly_do_tu_choi = $item['ly_do_tu_choi'];
    $phan_quyen_nk = $item['role'];


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
    $response = curl_exec($curl);
    curl_close($curl);
    $list_kho = json_decode($response, true);
    $kho_data = $list_kho['data']['items'];

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


    $all_ctr = [];
    for ($l = 0; $l < count($cong_trinh_data); $l++) {
        $ctr_item = $cong_trinh_data[$l];
        $all_ctr[$ctr_item['ctr_id']] = $ctr_item;
    }
}


?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi tiết yêu cầu vật tư</title>
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
    <div class="main-container share_res_ct ql_ctiet_vtu">
        <?php include("../includes/sidebar.php") ?>

        <div class="container">
            <div class="header-container">
                <?php include('../includes/ql_header_nv.php') ?>
            </div>
            <div class="content">
                <div class="mt-20 left">
                    <a class="text-black" href="quan-ly-yeu-cau-vat-tu.html"><?php echo $ic_lt ?> Quay lại</a>
                    <h4 class="text-blue mt-20 mb_25">Chi tiết yêu cầu vật tư</h4>
                </div>
                <div class="c-body">
                    <div class="form-control">
                        <div class="form-row left">
                            <div class="form-col-50 left pl-10 mb_12">
                                <p class="left text-left w-50">Số phiếu yêu cầu</p>
                                <p class="right text-right w-50 cr_weight">YC-<?= $ycvt_id ?></p>
                            </div>
                        </div>
                        <div class="form-row left border-top">
                            <div class="form-col-50 left pl-10 pt-10 mb_12">
                                <p class="left text-left w-50"> Người yêu cầu</p>
                                <? if ($phan_quyen_nk == 1) { ?>
                                    <p class="right text-right w-50 cr_weight"><?= $com_name ?></p>
                                <? } else if ($phan_quyen_nk == 2) { ?>
                                    <p class="right text-right w-50 cr_weight"><?= $all_user[$id_nyc]['ep_name'] ?></p>
                                <? } ?>
                            </div>
                            <div class="form-col-50 right pr-10 pt-10 mb_12">
                                <p class="left text-left w-50">Phòng ban</p>
                                <? if ($phan_quyen_nk == 1) { ?>
                                    <p class="right text-right w-50 cr_weight"></p>
                                <? } else if ($phan_quyen_nk == 2) { ?>
                                    <p class="right text-right w-50 cr_weight"><?= $all_user[$id_nyc]['dep_name'] ?></p>
                                <? } ?>
                            </div>
                        </div>
                        <div class="form-row left border-top">
                            <div class="form-col-50 left pl-10  pt-10 mb_12">
                                <p class="left text-left w-50"> Ngày tạo yêu cầu</p>
                                <p class="right text-right w-50 cr_weight"><?= $ngay_tao ?></p>
                            </div>
                            <div class="form-col-50 right pr-10 pt-10 mb_12">
                                <p class="left text-left w-50">Ngày phải hoàn thành yêu cầu</p>
                                <p class="right text-right w-50 cr_weight"><?= ($ngay_ht != 0) ? date('d/m/Y', $ngay_ht) : "" ?></p>
                            </div>
                        </div>
                        <div class="form-row left border-top">
                            <div class="form-col-50 left pt-10 mb_12 pl-10">
                                <p class="left text-left w-50">Công trình</p>
                                <p class="right text-right w-50 cr_weight"><?= $all_ctr[$cong_trinh]['ctr_name'] ?></p>
                            </div>
                        </div>
                        <div class="form-row left border-top">
                            <div class="form-col-50 left pl-10 pt-10 mb_12">
                                <p class="left text-left w-50">Diễn giải</p>
                                <p class="right text-right w-50 cr_weight"><?= $dien_giai ?></p>
                            </div>
                            <div class="form-col-50 right pr-10 pt-10 mb_12">
                                <p class="left text-left w-50">Trạng thái</p>
                                <? if ($trang_thai == 1) { ?>
                                    <p class="right text-right w-50 cr_weight text-yellow">Chưa duyệt</p>
                                <? } elseif ($trang_thai == 2) { ?>
                                    <p class="right text-right w-50 cr_weight text-green">Đã duyệt</p>
                                <? } elseif ($trang_thai == 3) { ?>
                                    <p class="right text-right w-50 cr_weight text-red">Đã bị từ chối</p>
                                <? } ?>



                            </div>
                        </div>
                        <? if ($trang_thai == 2) { ?>
                            <!-- khi duyệt -->
                            <div class="form-row left border-top">
                                <div class="form-col-50 left pl-10 pt-10 mb_12">
                                    <p class="left text-left w-50">Người duyệt</p>
                                    <? if ($item['phan_quyen_nduyet'] == 1) { ?>
                                        <p class="right text-right w-50 cr_weight"><?= $com_name ?></p>
                                    <? } else if ($item['phan_quyen_nduyet'] == 2) { ?>
                                        <p class="right text-right w-50 cr_weight"><?= $all_user[$item['phan_quyen_nduyet']]['ep_name'] ?></p>
                                    <? } ?>
                                </div>
                                <div class="form-col-50 right pr-10 pt-10 mb_12">
                                    <p class="left text-left w-50">Ngày duyệt</p>
                                    <p class="right text-right w-50 cr_weight"><?= $ngay_duyet ?></p>
                                </div>
                            </div>
                        <? } elseif ($trang_thai == 3) { ?>
                            <!-- không duyệt -->
                            <div class="form-row left border-top">
                                <div class="form-col-50 pl-10 pt-10 mb_12">
                                    <p class="left text-left w-50">Lý do từ chối</p>
                                    <p class="right text-right w-50 cr_weight"><?= $ly_do_tu_choi ?></p>
                                </div>
                            </div>
                        <? } else {
                        } ?>
                    </div>

                </div>
                <div class="left w-100 mt-30">
                    <div class="table-wrapper mt-5">
                        <div class="table-container table-988">
                            <div class="tbl-header">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="w-10">STT</th>
                                            <th class="w-15">Mã vật tư</th>
                                            <th class="w-30">Tên đầy đủ vật tư thiết bị</th>
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
                                        $stt = 1;
                                        while ($row = mysql_fetch_assoc($get_vtyc->result)) {
                                        ?>
                                            <tr>
                                                <td class="w-10"><?= $stt++ ?></td>
                                                <td class="w-15"><?= $vat_tu[$row['id_vat_tu']]['dsvt_maVatTuThietBi'] ?> - <?= $vat_tu[$row['id_vat_tu']]['dsvt_id'] ?></td>
                                                <td class="w-30"><?= $vat_tu[$row['id_vat_tu']]['dsvt_name'] ?></td>
                                                <td class="w-20"><?= $vat_tu[$row['id_vat_tu']]['dvt_name'] ?></td>
                                                <td class="w-25"><?= $row['so_luong_yc_duyet'] ?></td>
                                            </tr>
                                        <? } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <? if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) { ?>
                        <div class="right mt-20 xoa_csua">
                            <? if ($trang_thai == 1 || $trang_thai == 3) { ?>
                                <button class="v-btn btn-outline-red modal-btn ml-20" data-target="delete">Xóa</button>
                            <? }
                            if ($trang_thai == 1) { ?>
                                <a href="chinh-sua-yeu-cau-vat-tu-<?= $ycvt_id ?>.html" class="v-btn btn-blue ml-20">Chỉnh sửa</a>
                            <? } ?>
                        </div>
                        <? if ($trang_thai == 1) { ?>
                            <div class="right mt-20 xoa_csua">
                                <button class="v-btn mb_10 btn-outline-red modal-btn ml-20" data-target="rejection">Từ chối</button>
                                <button class="v-btn mb_10 btn-blue modal-btn ml-20" data-target="acceptance">Duyệt</button>
                            </div>
                        <? } ?>
                    <? } else if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 2) { ?>
                        <div class="right mt-20 xoa_csua">
                            <? if (in_array(4, $ycvt3)) {
                                if ($trang_thai == 1 || $trang_thai == 3) { ?>
                                    <button class="v-btn btn-outline-red modal-btn ml-20" data-target="delete">Xóa</button>
                                <? }
                            }
                            if (in_array(3, $ycvt3)) {
                                if ($trang_thai == 1) { ?>
                                    <a href="chinh-sua-yeu-cau-vat-tu-<?= $ycvt_id ?>.html" class="v-btn btn-blue ml-20">Chỉnh sửa</a>
                            <? }
                            } ?>
                        </div>
                        <? if (in_array(5, $ycvt3)) {
                            if ($trang_thai == 1) { ?>
                                <div class="right mt-20 xoa_csua">
                                    <button class="v-btn mb_10 btn-outline-red modal-btn ml-20" data-target="rejection">Từ chối</button>
                                    <button class="v-btn mb_10 btn-blue modal-btn ml-20" data-target="acceptance">Duyệt</button>
                                </div>
                    <? }
                        }
                    } ?>
                    <div class="left mt-20 xuatc_gm">
                        <p class="v-btn btn-green xuat_excel" data=<?= $ycvt_id ?>>Xuất excel</p>
                        <!-- <p class="share_w_148"></p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal xoa ycvt -->
    <div class="modal text-center" id="delete" data="<?= $user_id ?>" data1="<?= $com_id ?>">
        <div class="m-content">
            <div class="m-head ">
                Xóa yêu cầu vật tư <span class="dismiss cancel">&times;</span>
            </div>
            <div class="m-body">
                <p>Bạn có chắc chắn muốn xóa yêu cầu vật tư này?</p>
                <p>Thao tác này sẽ không thể hoàn tác.</p>
            </div>
            <div class="m-foot d_flex flex_jct">
                <div class="left mb_10">
                    <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                </div>
                <div class="right mb_10">
                    <p class="v-btn sh_bgr_six share_clr_tow right delete-ycvt" data-id="<?= $ycvt_id ?>" data2="<?= $phan_quyen_nk ?>">Đồng ý</p>
                </div>
            </div>
        </div>
    </div>
    <!-- modal ly do tu choi -->
    <form class="form_tu_choi">
        <div class="modal" id="rejection" data="<?= $ycvt_id ?>" data1="<?= $user_id ?>">
            <div class="m-content rejection-modal">
                <div class="m-head text-center">Từ chối yêu cầu vật tư
                    <span class="dismiss cancel">&times;</span>
                </div>
                <div class="m-body form-control">
                    <p>Lý do từ chối yêu cầu</p>
                    <textarea name="ly_do" id="" cols="30" rows="10" placeholder="Nhập lý do từ chối yêu cầu"></textarea>
                </div>
                <div class="m-foot d_flex flex_jct">
                    <div class="left mb_10">
                        <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                    </div>
                    <div class="right mb_10">
                        <button type="button" class="v-btn share_clr_tow sh_bgr_six right tc_submit" data="<?= $com_id ?>">Đồng ý</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- modal duyet-->
    <form class="form_duyet">
        <div class="modal" id="acceptance">
            <div class="m-content d-flex justify-content-center flex-wrap acceptance-modal">
                <div class="m-head w-100 text-center">
                    Duyệt yêu cầu vật tư <span class="dismiss cancel">&times;</span>
                </div>
                <div class="m-body left w-100 form-control">
                    <div class="v-select2 w-60">
                        <label for="kho-vat-tu">Lựa chọn kho vật tư <span class="text-red">*</span></label>
                        <select name="kho_vat_tu" id="kho-vat-tu" class="share_select">
                            <option value="">-- Chọn kho vật tư --</option>
                            <? foreach ($kho_data as $key => $items) { ?>
                                <option value="<?= $items['kho_id'] ?>"><?= $items['kho_name'] ?></option>
                            <? } ?>
                        </select>
                        <span class="error_kho cr_red share_dnone">Chọn kho vật tư</span>
                    </div>
                    <p class="text-500 mt-40">Số lượng duyệt</p>
                    <div class="w-100">
                        <div class="table-wrapper mt-15">
                            <div class="table-container table_duyet" data="<?= $ycvt_id ?>" data1="<?= $user_id ?>">
                                <div class="tbl-header">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="w-20">Mã vật tư</th>
                                                <th class="w-35">Tên vật tư</th>
                                                <th class="w-15">ĐVT</th>
                                                <th class="w-20">Số lượng yêu cầu</th>
                                                <th class="w-20">Số lượng duyệt</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tbl-content table-2-row">
                                    <table>
                                        <tbody>
                                            <?
                                            $get_vtyc2 = new db_query("SELECT * FROM `chi_tiet_yc_vt` WHERE `id_yc_vt` = $ycvt_id");
                                            while ($row1 = mysql_fetch_assoc($get_vtyc2->result)) {
                                            ?>
                                                <tr class="item">
                                                    <td class="w-20">VT - <?= $vat_tu[$row1['id_vat_tu']]['dsvt_id'] ?></td>
                                                    <td class="w-35"><?= $vat_tu[$row1['id_vat_tu']]['dsvt_name'] ?></td>
                                                    <td class="w-15"><?= $vat_tu[$row1['id_vat_tu']]['dvt_name'] ?></td>
                                                    <td class="w-20"><?= $row1['so_luong_yc_duyet'] ?></td>
                                                    <td class="w-20">
                                                        <input type="hidden" name="id_vat_tu" type="text" class="d-none" value="<?= $row1['id'] ?>">
                                                        <input name="so_luong_duyet" class="text-center" type="text" oninput="<?= $oninput ?>">
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
                <div class="m-foot">
                    <div class="right huy_xong">
                        <p class="v-btn btn-outline-blue right cancel mr-20">Hủy</p>
                        <button type="button" class="v-btn share_clr_tow sh_bgr_six right duyet_submit" data="<?= $com_id ?>" data1="<?= $phan_quyen_nduyet ?>">Đồng ý</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <? include("../modals/modal_logout.php") ?>
    <? include("../modals/modal_menu.php") ?>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
<script type="text/javascript">
    $(".delete-ycvt").click(function() {
        var id = $(this).attr("data-id");
        var com_id = $("#delete").attr("data1");
        var user_id = $("#delete").attr("data");
        var phan_quyen_nk = $(this).attr("data2");
        $.ajax({
            url: '../ajax/ycvt_xoa.php',
            type: 'POST',
            data: {
                id: id,
                user_id: user_id,
                com_id: com_id,
                phan_quyen_nk: phan_quyen_nk,
            },
            success: function(data) {
                if (data == "") {
                    window.location.href = '/quan-ly-yeu-cau-vat-tu.html';
                } else {
                    alert(data);
                }
            }
        });
    });

    $("#kho-vat-tu").change(function() {
        $(".error_kho").hide();
    });

    $(".duyet_submit").click(function() {
        var ycvt_id = $(".table_duyet").attr("data");
        var id_kho = $("select[name='kho_vat_tu']").val();
        var nguoi_duyet = $(".table_duyet").attr("data1");
        var com_id = $(this).attr("data");
        var phan_quyen_nduyet = $(this).attr("data1");

        var id_vat_tu = [];
        $("input[name='id_vat_tu']").each(function() {
            var id_vt = $(this).val();
            if (id_vt != "") {
                id_vat_tu.push(id_vt);
            }
        });

        var so_luong_duyet = [];
        $("input[name='so_luong_duyet']").each(function() {
            var sl_duyet = $(this).val();
            if (sl_duyet != "") {
                so_luong_duyet.push(sl_duyet);
            }
        });

        if (id_kho == "") {
            $(".error_kho").show();
        } else if (id_kho != "") {
            $.ajax({
                url: '../ajax/ycvt_duyet.php',
                type: 'POST',
                data: {
                    ycvt_id: ycvt_id,
                    id_kho: id_kho,
                    so_luong_duyet: so_luong_duyet,
                    nguoi_duyet: nguoi_duyet,
                    id_vat_tu: id_vat_tu,
                    so_luong_duyet: so_luong_duyet,
                    com_id: com_id,
                    phan_quyen_nduyet: phan_quyen_nduyet,
                },
                success: function(data) {
                    if (data == "") {
                        alert("Duyệt yêu cầu thành công!");
                        window.location.href = 'quan-ly-yeu-cau-vat-tu.html';
                    } else {
                        alert(data);
                    }
                }
            });
        }
    });

    $(".tc_submit").click(function() {
        var ycvt_id = $("#rejection").attr("data");
        var ly_do_tu_choi = $("textarea[name='ly_do']").val();
        var com_id = $(this).attr("data");
        //log record
        var ep_id = $("#rejection").attr("data1");
        $.ajax({
            url: '../ajax/ycvt_tu_choi.php',
            type: 'POST',
            data: {
                ycvt_id: ycvt_id,
                ly_do_tu_choi: ly_do_tu_choi,
                ep_id: ep_id,
                com_id: com_id,
            },
            success: function(data) {
                if (data == "") {
                    alert("Từ chối yêu cầu thành công!");
                    window.location.href = 'quan-ly-yeu-cau-vat-tu.html';
                } else {
                    alert(data);
                }
            }
        })
    });

    $(".xuat_excel").click(function() {
        var id = $(this).attr("data");
        window.location.href = '../excel/ycvt_excel.php?id=' + id;
    });
</script>

</html>