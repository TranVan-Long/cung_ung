<?
include("config.php");
$category = $_POST['category'];
$search = $_POST['search'];
$page = $_POST['page'];
$display = $_POST['display'];

$url = '/quan-ly-nha-cung-cap.html';
$start = ($page - 1) * $display;
$start = abs($start);

if ($category != "") {
    if ($search == "") {
        $list_ncc = new db_query("SELECT `id`, `ten_vt`, `ten_nha_cc_kh`, `dia_chi_lh`, `so_dkkd`, `sp_cung_ung`, `ma_so_thue` FROM `nha_cc_kh` WHERE `phan_loai` = 1 LIMIT $start, $display");
        $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `nha_cc_kh` WHERE `phan_loai` = 1");
        $num = mysql_fetch_assoc($counter->result)['numb'];
    } else {
        $list_ncc = new db_query("SELECT `id`, `ten_vt`, `ten_nha_cc_kh`, `dia_chi_lh`, `so_dkkd`, `sp_cung_ung`, `ma_so_thue` FROM `nha_cc_kh` WHERE `phan_loai` = 1 AND `id` = '$search' LIMIT $start, $display");
        $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `nha_cc_kh` WHERE `phan_loai` = 1 AND `id` = '$search'");
        $num = mysql_fetch_assoc($counter->result)['numb'];
    }
} else {
    $list_ncc = new db_query("SELECT `id`, `ten_vt`, `ten_nha_cc_kh`, `dia_chi_lh`, `so_dkkd`, `sp_cung_ung`, `ma_so_thue`
                                    FROM `nha_cc_kh` WHERE `phan_loai` = 1 LIMIT $start, $display");
    $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `nha_cc_kh` WHERE `phan_loai` = 1");
    $num = mysql_fetch_assoc($counter->result)['numb'];
};
$page_numb = ceil($num / $display);

?>
<div class="scr-wrapper mt-20">

    <? if ($num >= 5) { ?>
        <div class="scr-btn scr-l-btn right" onclick="right()"><i class="ic-chevron-left" title="Cuộn sang phải"></i></div>
        <div class="scr-btn scr-r-btn left" onclick="left()"><i class="ic-chevron-right" title="Cuộn sang trái"></i></div>
    <? } ?>
    <div class="table-wrapper">
        <div class="table-container table_1928">
            <div class="tbl-header">
                <table>
                    <thead>
                        <tr>
                            <th class="w-5">STT</th>
                            <th class="w-10">Mã nhà cung cấp</th>
                            <th class="w-10">Tên gọi tắt</th>
                            <th class="w-15">Tên nhà cung cấp</th>
                            <th class="w-20">Địa chỉ</th>
                            <th class="w-10">Số ĐKKD</th>
                            <th class="w-10">Sản phẩm cung ứng</th>
                            <th class="w-10">Mã số thuế</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content">
                <table>
                    <tbody>
                        <?
                        $stt = 1;
                        while ($ncc_row = mysql_fetch_assoc($list_ncc->result)) {
                        ?>
                            <tr>
                                <td class="w-5"><?= $stt++ ?></td>
                                <td class="w-10">
                                    <a href="quan-ly-chi-tiet-nha-cung-cap-<?= $ncc_row['id'] ?>.html" class="text-500">NCC - <?= $ncc_row['id'] ?></a>
                                </td>
                                <td class="w-10"><?= $ncc_row['ten_vt'] ?></td>
                                <td class="w-15"><?= $ncc_row['ten_nha_cc_kh'] ?></td>
                                <td class="w-20"><?= $ncc_row['dia_chi_lh'] ?></td>
                                <td class="w-10"><?= $ncc_row['so_dkkd'] ?></td>
                                <td class="w-10"><?= $ncc_row['sp_cung_ung'] ?></td>
                                <td class="w-10"><?= $ncc_row['ma_so_thue'] ?></td>
                            </tr>
                        <? } ?>

                    </tbody>
                </table>
            </div>
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
        var page = "<?= $page ?>";
        var tt = display * page;
        var total = "<?= $num ?>";
        if (tt > total) {
            page--;
            if (page == "" && display != "") {
                window.location.href = 'quan-ly-nha-cung-cap.html?ht=' + display;
            } else if (page != "" && display != "") {
                window.location.href = 'quan-ly-nha-cung-cap.html?page=' + page + '&ht=' + display;
            }
        } else {
            if (page == "" && display != "") {
                window.location.href = 'quan-ly-nha-cung-cap.html?ht=' + display;
            } else if (page != "" && display != "") {
                window.location.href = 'quan-ly-nha-cung-cap.html?page=' + page + '&ht=' + display;
            }
        }
    })
</script>