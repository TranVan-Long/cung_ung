<?
include("config.php");
$category = $_POST['category'];
$search = $_POST['search'];
$filter2 = $_POST['filter2'];
$filter3 = $_POST['filter3'];
$page = $_POST['page'];
$display = $_POST['display'];

$url = '/quan-ly-yeu-cau-vat-tu.html';
$start = ($page - 1) * $display;
$start = abs($start);
$date = strtotime(date('d-m-Y', time()));


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

// echo "<pre>";
// print_r($list_cong_trinh);
// echo "</pre>";
// die();



if ($category == 1) {
    if ($search == "") {
        if ($filter2 == "") {
            if ($filter3 == 1) {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE ngay_ht_yc >= $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE ngay_ht_yc >= $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            } else {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE ngay_ht_yc < $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE ngay_ht_yc < $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            }
        } else {
            if ($filter3 == 1) {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE `trang_thai` = $filter2 AND ngay_ht_yc >= $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE `trang_thai` = $filter2 AND ngay_ht_yc >= $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            } else {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE `trang_thai` = $filter2 AND ngay_ht_yc < $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE `trang_thai` = $filter2 AND ngay_ht_yc < $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            }
        }
    } else {
        if ($filter2 == "") {
            if ($filter3 == 1) {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE `id` = '$search' AND ngay_ht_yc >= $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE `id` = '$search' AND ngay_ht_yc >= $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            } else {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE `id` = '$search' AND ngay_ht_yc < $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE `id` = '$search' AND ngay_ht_yc < $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            }
        } else {
            if ($filter3 == 1) {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE `id` = '$search' AND `trang_thai` = $filter2 AND ngay_ht_yc >= $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE `id` = '$search' AND ngay_ht_yc >= $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            } else {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE `id` = '$search' AND `trang_thai` = $filter2 AND ngay_ht_yc < $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE `id` = '$search' AND ngay_ht_yc < $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            }
        }
    }
} elseif ($category == 2) {
    if ($search == "") {
        if ($filter2 == "") {
            if ($filter3 == 1) {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE ngay_ht_yc >= $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE ngay_ht_yc >= $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            } else {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE ngay_ht_yc < $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu`  WHERE ngay_ht_yc < $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            }
        } else {
            if ($filter3 == 1) {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE `trang_thai` = $filter2 AND ngay_ht_yc >= $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE `trang_thai` = $filter2 AND ngay_ht_yc >= $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            } else {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE `trang_thai` = $filter2 AND ngay_ht_yc < $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE `trang_thai` = $filter2 AND ngay_ht_yc < $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            }
        }
    } else {
        if ($filter2 == "") {
            if ($filter3 == 1) {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE `ngay_tao` = '$search' AND ngay_ht_yc >= $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE `ngay_tao` = '$search' AND ngay_ht_yc >= $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            } else {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE `ngay_tao` = '$search' AND ngay_ht_yc < $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE `ngay_tao` = '$search' AND ngay_ht_yc < $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            }
        } else {
            if ($filter3 == 1) {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE `ngay_tao` = '$search' AND `trang_thai` = $filter2 AND ngay_ht_yc >= $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE `ngay_tao` = '$search' AND `trang_thai` = $filter2 AND ngay_ht_yc >= $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            } else {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE `ngay_tao` = '$search' AND `trang_thai` = $filter2 AND ngay_ht_yc < $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE `ngay_tao` = '$search' AND `trang_thai` = $filter2 AND ngay_ht_yc < $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            }
        }
    }
} elseif ($category == 3) {
    if ($search == "") {
        if ($filter2 == "") {
            if ($filter3 == 1) {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE ngay_ht_yc >= $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE ngay_ht_yc >= $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            } else {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE ngay_ht_yc < $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE ngay_ht_yc < $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            }
        } else {
            if ($filter3 == 1) {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE `trang_thai` = $filter2 AND ngay_ht_yc >= $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE `trang_thai` = $filter2 AND ngay_ht_yc >= $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            } else {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE `trang_thai` = $filter2 AND ngay_ht_yc < $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE `trang_thai` = $filter2 AND ngay_ht_yc < $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            }
        }
    } else {
        if ($filter2 == "") {
            if ($filter3 == 1) {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE `id_cong_trinh` = '$search'  AND ngay_ht_yc >= $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE `id_cong_trinh` = '$search'  AND ngay_ht_yc >= $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            } else {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE `id_cong_trinh` = '$search'  AND ngay_ht_yc < $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE `id_cong_trinh` = '$search'  AND ngay_ht_yc < $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            }
        } else {
            if ($filter3 == 1) {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE `id_cong_trinh` = '$search' AND `trang_thai` = $filter2  AND ngay_ht_yc >= $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE `id_cong_trinh` = '$search' AND `trang_thai` = $filter2  AND ngay_ht_yc >= $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            } else {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE `id_cong_trinh` = '$search' AND `trang_thai` = $filter2  AND ngay_ht_yc < $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE `id_cong_trinh` = '$search' AND `trang_thai` = $filter2  AND ngay_ht_yc < $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            }
        }
    }
} elseif ($category == 4) {
    if ($search == "") {
        if ($filter2 == "") {
            if ($filter3 == 1) {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE ngay_ht_yc >= $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE ngay_ht_yc >= $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            } else {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE ngay_ht_yc < $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE ngay_ht_yc < $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            }
        } else {
            if ($filter3 == 1) {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE `trang_thai` = $filter2 AND ngay_ht_yc >= $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE `trang_thai` = $filter2 AND ngay_ht_yc >= $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            } else {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE `trang_thai` = $filter2 AND ngay_ht_yc < $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE `trang_thai` = $filter2 AND ngay_ht_yc < $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            }
        }
    } else {
        if ($filter2 == "") {
            if ($filter3 == 1) {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE `ngay_ht_yc` = '$search' AND ngay_ht_yc >= $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE `ngay_ht_yc` = '$search' AND ngay_ht_yc >= $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            } else {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE `ngay_ht_yc` = '$search' AND ngay_ht_yc < $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE `ngay_ht_yc` = '$search' AND ngay_ht_yc < $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            }
        } else {
            if ($filter3 == 1) {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE `ngay_ht_yc` = '$search' AND `trang_thai` = $filter2 AND ngay_ht_yc >= $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE `ngay_ht_yc` = '$search' AND `trang_thai` = $filter2 AND ngay_ht_yc >= $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            } else {
                $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE `ngay_ht_yc` = '$search' AND `trang_thai` = $filter2 AND ngay_ht_yc < $date LIMIT $start, $display");
                $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE `ngay_ht_yc` = '$search' AND `trang_thai` = $filter2 AND ngay_ht_yc < $date");
                $num = mysql_fetch_assoc($counter->result)['numb'];
            }
        }
    }
} else
if ($category == "" && $search == "") {
    if ($filter2 == "") {
        if ($filter3 == 1) {
            $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE ngay_ht_yc >= $date LIMIT $start,$display ");
            $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu`");
            $num = mysql_fetch_assoc($counter->result)['numb'];
        } else {
            $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE ngay_ht_yc < $date LIMIT $start,$display ");
            $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu`");
            $num = mysql_fetch_assoc($counter->result)['numb'];
        }
    } else {
        if ($filter3 == 1) {
            $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE `trang_thai` = $filter2 AND ngay_ht_yc >= $date LIMIT $start,$display ");
            $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE `trang_thai` = $filter2");
            $num = mysql_fetch_assoc($counter->result)['numb'];
        } else {
            $list_ycvt = new db_query("SELECT * FROM `yeu_cau_vat_tu` WHERE `trang_thai` = $filter2 AND ngay_ht_yc < $date LIMIT $start,$display ");
            $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `yeu_cau_vat_tu` WHERE `trang_thai` = $filter2");
            $num = mysql_fetch_assoc($counter->result)['numb'];
        }
    }
};

$page_numb = ceil($num / $display);

?>
<div class="table-wrapper">
    <div class="table-container">
        <div class="tbl-header">
            <table>
                <thead>
                    <tr>
                        <th class="w-5">STT</th>
                        <th class="w-15">Số phiếu yêu cầu</th>
                        <th class="w-10">Ngày gửi</th>
                        <th class="w-20">Công trình</th>
                        <th class="w-15">Ngày phải hoàn thành</th>
                        <th class="w-15">Trạng thái duyệt</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="tbl-content">
            <table>
                <tbody>
                    <?
                    $stt = 1;
                    while ($item = mysql_fetch_assoc($list_ycvt->result)) {
                    ?>
                        <tr>
                            <td class="w-5"><?= $stt++ ?></td>
                            <td class="w-15">
                                <a href="quan-ly-chi-tiet-yeu-cau-vat-tu-<?= $item['id'] ?>.html" class="text-500">YC-<?= $item['id'] ?></a>
                            </td>
                            <td class="w-10"><?= date("d/m/Y", $item['ngay_tao']); ?></td>
                            <td class="w-20"><?= $cong_trinh_data[$item['id_cong_trinh']]['ctr_name'] ?></td>
                            <td class="w-15"><?= date("d/m/Y", $item['ngay_ht_yc']); ?></td>
                            <? if ($item['trang_thai'] == 1) { ?>
                                <td class="w-15 text-yellow">Chưa duyệt</td>
                            <? } elseif ($item['trang_thai'] == 2) { ?>
                                <td class="w-15 text-green">Đã duyệt</td>
                            <? } elseif ($item['trang_thai'] == 3) { ?>
                                <td class="w-15 text-red">Từ chối</td>
                            <? } ?>

                        </tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
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
        var page = 1;
        var tt = display * page;
        var total = "<?= $num ?>";
        if (tt > total) {
            page--;
            if (page == "" && display != "") {
                window.location.href = 'quan-ly-yeu-cau-vat-tu.html?ht=' + display;
            } else if (page != "" && display != "") {
                window.location.href = 'quan-ly-yeu-cau-vat-tu.html?page=' + page + '&ht=' + display;
            }
        } else {
            if (page == "" && display != "") {
                window.location.href = 'quan-ly-yeu-cau-vat-tu.html?ht=' + display;
            } else if (page != "" && display != "") {
                window.location.href = 'quan-ly-yeu-cau-vat-tu.html?page=' + page + '&ht=' + display;
            }
        }
    })
</script>