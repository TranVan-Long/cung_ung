<?
include("config.php");
$category = $_POST['category'];
$search = $_POST['search'];
$page = $_POST['page'];
$display = $_POST['display'];

$url = '/quan-ly-hop-dong.html';
$start = ($page - 1) * $display;
$start = abs($start);

if ($category != "") {
    if ($search == "") {
        $list_hd = new db_query("SELECT `id`, `ngay_ky_hd`, `phan_loai`, `tg_bd_thuc_hien`, `tg_kt_thuc_hien`, `thoi_han_blanh`, `id_nha_cc_kh`, `id_du_an_ctrinh`, `noi_dung_hd`, `hd_nguyen_tac` FROM `hop_dong` WHERE `phan_loai` = $category LIMIT $start, $display");
        $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `hop_dong` WHERE `phan_loai` = $category");
        $num = mysql_fetch_assoc($counter->result)['numb'];
    } else {
        $list_hd = new db_query("SELECT `id`, `ngay_ky_hd`, `phan_loai`, `tg_bd_thuc_hien`, `tg_kt_thuc_hien`, `thoi_han_blanh`, `id_nha_cc_kh`, `id_du_an_ctrinh`, `noi_dung_hd`, `hd_nguyen_tac` FROM `hop_dong` WHERE `id` = '$search' LIMIT $start, $display");
        $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `hop_dong` WHERE `id` = '$search'");
        $num = mysql_fetch_assoc($counter->result)['numb'];
    }
} else {
    $list_hd = new db_query("SELECT `id`, `ngay_ky_hd`, `phan_loai`, `tg_bd_thuc_hien`, `tg_kt_thuc_hien`, `thoi_han_blanh`, `id_nha_cc_kh`, `id_du_an_ctrinh`, `noi_dung_hd`, `hd_nguyen_tac` FROM `hop_dong` LIMIT $start, $display");
    $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `hop_dong`");
    $num = mysql_fetch_assoc($counter->result)['numb'];
};
$page_numb = ceil($num / $display);

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
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlycongtrinh.timviec365.vn/api/congtrinh.php');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($curl);
curl_close($curl);
$list_cong_trinh = json_decode($response, true);
$cong_trinh_data = $list_cong_trinh['data']['items'];

$cong_trinh_detail = [];
for ($i = 0; $i < count($cong_trinh_data); $i++) {
    $items_ct = $cong_trinh_data[$i];
    $cong_trinh_detail[$items_ct['ctr_id']] = $items_ct;
}
// echo "<pre>";
// print_r($cong_trinh_data);
// echo "</pre>";
// die();
?>

<div class="c-content">
    <div class="ctn_table_share w_100 float_l">
        <span class="scroll_left share_cursor"><img src="../img/right_scroll.png" alt="scroll về bên trái"></span>
        <div class="share_tb_hd w_100 float_l">
            <table class="table w_100 float_l">
                <thead>
                    <tr>
                        <th class="share_tb_one">STT</th>
                        <th class="share_tb_two">Số hợp đồng</th>
                        <th class="share_tb_two">Ngày ký</th>
                        <th class="share_tb_two">Loại hợp đồng</th>
                        <th class="share_tb_three">Thời gian thực hiện</th>
                        <th class="share_tb_two">Thời hạn bảo lãnh</th>
                        <th class="share_tb_two">Nhà cung cấp / Khách hàng</th>
                        <th class="share_tb_two">Công trình</th>
                        <th class="share_tb_two">Tóm tắt nội dung</th>
                        <th class="share_tb_two">Hợp đồng nguyên tắc</th>
                    </tr>
                </thead>
                <tbody>
                    <?
                    $stt = 1;
                    while ($hd_row = mysql_fetch_assoc($list_hd->result)) {
                        $phan_loai = $hd_row['phan_loai'];
                        $ngay_ky = date('d/m/Y', $hd_row['ngay_ky_hd']);
                        $ngay_bd = date('d/m/Y', $hd_row['tg_bd_thuc_hien']);
                        $ngay_kt = date('d/m/Y', $hd_row['tg_kt_thuc_hien']);
                        if (!is_null($hd_row['thoi_han_blanh'])) {
                            $ngay_bao_lanh = date('d/m/Y', $hd_row['thoi_han_blanh']);
                        } else {
                            $ngay_bao_lanh = "Không có dữ liệu.";
                        }
                        if (!is_null($cong_trinh_detail[$hd_row['id_du_an_ctrinh']]['ctr_name'])) {
                            $cong_trinh = $cong_trinh_detail[$hd_row['id_du_an_ctrinh']]['ctr_name'];
                        } else {
                            $cong_trinh = "Không có dữ liệu.";
                        }
                        $ncc_id = $hd_row['id_nha_cc_kh'];
                        $ncc = mysql_fetch_assoc((new db_query("SELECT `ten_nha_cc_kh` FROM nha_cc_kh WHERE `id` = $ncc_id"))->result);
                    ?>
                        <tr>
                            <td><?= $stt++ ?></td>
                            <td>
                                <? if ($phan_loai == 1) { ?>
                                    <a href="quan-ly-chi-tiet-hop-dong-mua-<?= $hd_row['id'] ?>.html" class="share_clr_four cr_weight">
                                        HĐ - <?= $hd_row['id'] ?></a>
                                <? } elseif ($phan_loai == 2) { ?>
                                    <a href="quan-ly-chi-tiet-hop-dong-ban-<?= $hd_row['id'] ?>.html" class="share_clr_four cr_weight">
                                        HĐ - <?= $hd_row['id'] ?></a>
                                <? } elseif ($phan_loai == 3) { ?>
                                    <a href="quan-ly-chi-tiet-hop-dong-thue-thiet-bi-<?= $hd_row['id'] ?>.html" class="share_clr_four cr_weight">
                                        HĐ - <?= $hd_row['id'] ?></a>
                                <? } elseif ($phan_loai == 4) { ?>
                                    <a href="quan-ly-chi-tiet-hop-dong-van-chuyen-<?= $hd_row['id'] ?>.html" class="share_clr_four cr_weight">
                                        HĐ - <?= $hd_row['id'] ?></a>
                                <? } ?>

                            </td>
                            <td><?= $ngay_ky ?></td>
                            <td><? if ($phan_loai == 1) { ?>
                                    Hợp đồng mua vật tư
                                <? } elseif ($phan_loai == 2) { ?>
                                    Hợp đồng bán vật tư
                                <? } elseif ($phan_loai == 3) { ?>
                                    Hợp đồng Thuê thiết bị
                                <? } elseif ($phan_loai == 4) { ?>
                                    Hợp đồng thuê vận chuyển
                                <? } ?>
                            </td>
                            <td><? if ($hd_row['tg_bd_thuc_hien'] == 0 && $hd_row['tg_kt_thuc_hien'] == 0) { ?>
                                    Không có dữ liệu.
                                <? } else { ?>
                                    <?= $ngay_bd ?> - <?= $ngay_kt ?>
                                <? } ?>
                            </td>
                            <td><?= $ngay_bao_lanh ?></td>
                            <td><?= $ncc['ten_nha_cc_kh'] ?></td>
                            <td><?= $cong_trinh ?></td>
                            <td><? if ($hd_row['noi_dung_hd'] == "") { ?>
                                    Không có dữ liệu.
                                    <? } else {
                                    if (strlen($hd_row['noi_dung_hd']) > 80) { ?>
                                        <?= substr($hd_row['noi_dung_hd'], 0, 81) ?>...
                                    <? } else { ?>
                                        <?= $hd_row['noi_dung_hd'] ?>
                                    <? } ?>
                                <? } ?>
                            </td>
                            <td>
                                <?= ($hd_row['hd_nguyen_tac']) ? "Có" : "Không" ?>
                            </td>
                        </tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
        <span class="scroll_right share_cursor"><img src="../img/right_scroll.png" alt="scroll về bên phải"></span>
    </div>
</div>
<div class="w-100 left mt-10 d-flex flex-wrap spc-btw">
    <div class="display mr-10">
        <label for="display">Hiển thị</label>
        <select name="display" id="display">
            <option value="10" <?= ($display == 10) ? "selected" : "" ?>>10</option>
            <option value="20" <?= ($display == 20) ? "selected" : "" ?>>20</option>
        </select>
    </div>
    <div class="pagination mt-10">
        <ul>
            <?= generatePageBar3('', $page, $display, $num, $url, '?', '', 'active', 'preview', '<', 'next', '>', '', '<<<', '', '>>>'); ?>
        </ul>
    </div>
</div>
<script>
    $("#display").change(function() {
        var display = $(this).val();
        var page = "<?= $page ?>";
        var tt = display * page;
        var total = "<?= $num ?>";
        if (tt > total) {
            page--;
            if (page == "" && display != "") {
                window.location.href = 'quan-ly-hop-dong.html?ht=' + display;
            } else if (page != "" && display != "") {
                window.location.href = 'quan-ly-hop-dong.html?page=' + page + '&ht=' + display;
            }
        } else {
            if (page == "" && display != "") {
                window.location.href = 'quan-ly-hop-dong.html?ht=' + display;
            } else if (page != "" && display != "") {
                window.location.href = 'quan-ly-hop-dong.html?page=' + page + '&ht=' + display;
            }
        }
    });
    $('.scroll_right').click(function(e) {
        e.preventDefault();
        $('.share_tb_hd').animate({
            scrollLeft: "+=300px"
        }, "slow");
    });

    $('.scroll_left').click(function(e) {
        e.preventDefault();
        $('.share_tb_hd').animate({
            scrollLeft: "-=300px"
        }, "slow");
    });
</script>