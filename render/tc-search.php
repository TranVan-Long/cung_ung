<?
include("config.php");
$category = $_POST['category'];
$search = $_POST['search'];
$page = $_POST['page'];
$display = $_POST['display'];
$url = '/tieu-chi-danh-gia.html';
$start = ($page - 1) * $display;
$start = abs($start);

$ep_id = $_SESSION['ep_id'];

if ($category == 1) {
    if ($search == "") {
        $list_tc = new db_query("SELECT * FROM `tieu_chi_danh_gia` LIMIT $start, $display");
        $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `tieu_chi_danh_gia`");
        $num = mysql_fetch_assoc($counter->result)['numb'];
    } else {
        $list_tc = new db_query("SELECT * FROM `tieu_chi_danh_gia` WHERE `id` = '$search' LIMIT $start, $display");
        $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `tieu_chi_danh_gia` WHERE `id` = '$search'");
        $num = mysql_fetch_assoc($counter->result)['numb'];
    }
} elseif ($category == 2) {
    if ($search == "") {
        $list_tc = new db_query("SELECT * FROM `tieu_chi_danh_gia` LIMIT $start, $display");
        $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `tieu_chi_danh_gia`");
        $num = mysql_fetch_assoc($counter->result)['numb'];
    } else {
        $list_tc = new db_query("SELECT * FROM `tieu_chi_danh_gia` WHERE `kieu_gia_tri` = '$search' LIMIT $start, $display");
        $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `tieu_chi_danh_gia` WHERE `kieu_gia_tri` = '$search'");
        $num = mysql_fetch_assoc($counter->result)['numb'];
    }
} elseif ($category == "") {
    $list_tc = new db_query("SELECT * FROM `tieu_chi_danh_gia` LIMIT $start, $display");
    $counter = new db_query("SELECT COUNT(`id`) AS numb FROM `tieu_chi_danh_gia`");
    $num = mysql_fetch_assoc($counter->result)['numb'];
};
$page_numb = ceil($num / $display);

?>
<div class="table-wrapper left w-100 mt-20">
    <div class="table-container table-988">
        <div class="tbl-header">
            <table>
                <thead>
                    <tr>
                        <th rowspan="2" class="w-10">STT</th>
                        <th rowspan="2">Tiêu chí đánh giá</th>
                        <th rowspan="2" class="w-10">Hệ số</th>
                        <th rowspan="2">Kiểu giá trị</th>
                        <th class="border-bottom-w" colspan="2" scope="colgroup">Danh sách giá trị</th>
                    </tr>
                    <tr>
                        <th scope="colgroup">Giá trị</th>
                        <th scope="colgroup">Tên hiển thị</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="tbl-content">
            <table>
                <tbody>
                    <?
                    $counter = 1;
                    while ($tieu_chi = mysql_fetch_assoc($list_tc->result)) {
                        $tieu_chi_id = $tieu_chi['id'];
                    ?>
                        <tr class="more">
                            <td class="w-10"><?= $counter++ ?></td>
                            <td><?= $tieu_chi['tieu_chi'] ?></td>
                            <td class="w-10"><?= $tieu_chi['he_so'] ?></td>
                            <td><? echo ($tieu_chi['kieu_gia_tri'] == 1) ? "Nhập tay" : "Danh sách"; ?></td>
                            <td>
                                <? $list_gt = new db_query("SELECT `id_tieu_chi`, `gia_tri` FROM `ds_gia_tri_dg` WHERE `id_tieu_chi` = $tieu_chi_id ");
                                while ($gia_tri_c = mysql_fetch_assoc($list_gt->result)) { ?>
                                    <p class="table-text"><?= $gia_tri_c['gia_tri'] ?></p>
                                <? } ?>
                            </td>
                            <td>
                                <? $list_gt_n = new db_query("SELECT `ten_gia_tri`, `id_tieu_chi` FROM `ds_gia_tri_dg` WHERE `id_tieu_chi` = $tieu_chi_id ");
                                while ($gia_tri = mysql_fetch_assoc($list_gt_n->result)) { ?>
                                    <p class="table-text"><?= $gia_tri['ten_gia_tri'] ?></p>
                                <? } ?>
                                <span class="tbl-menu" data-tab="<?= $tieu_chi_id ?>"></span>
                                <ul class="tbl-menu-content" id="<?= $tieu_chi_id ?>">
                                    <li class="mb-10"><a href="chinh-sua-tieu-chi-danh-gia-<?= $tieu_chi_id ?>.html" class="tbl-menu-text">Chỉnh sửa</a></li>
                                    <li class="border-top2">
                                        <p class="tbl-menu-text modal-btn mt-10" data-target="modal-<?= $tieu_chi_id ?>">Xóa</p>
                                    </li>
                                </ul>
                                <div class="modal text-center" id="modal-<?= $tieu_chi_id ?>">
                                    <div class="m-content huy-them">
                                        <div class="m-head ">
                                            Xóa tiêu chí <span class="dismiss cancel">&times;</span>
                                        </div>
                                        <div class="m-body">
                                            <p>Bạn có chắc chắn muốn xóa tiêu chí đánh giá này?</p>
                                            <p>Thao tác này sẽ không thể hoàn tác.</p>
                                        </div>
                                        <div class="m-foot d-inline-block">
                                            <div class="left">
                                                <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                                            </div>
                                            <div class="right">
                                                <button type="button" class="v-btn sh_bgr_six share_clr_tow right delete-tc" data-id="<?= $tieu_chi_id ?>">Đồng ý</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
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
    $(".modal-btn").click(function() {
        $('.modal').fadeOut();
        var id = $(this).attr("data-target");
        $('#' + id).fadeIn();
    })
    $('.cancel').click(function() {
        $('.modal').fadeOut();
    });

    var tblMenu = $('td .tbl-menu');
    var tblMenuContent = $('td .tbl-menu-content');
    var count = 0;

    $('.tbl-menu').click(function() {
        $(this).parents("td").find(".tbl-menu-content").toggleClass('active');
    });
    $(window).click(function(e) {
        if (!tblMenu.is(e.target) && !tblMenuContent.is(e.target) && tblMenuContent.has(e.target).length === 0) {
            tblMenuContent.removeClass('active');
        }
    })

    $('.tbl-menu').click(function() {
        var id = $(this).attr("data-tab");

        $(".tbl-menu-content").removeClass("active");

        $('#' + id).addClass("active");
    })

    $("#display").change(function() {
        var display = $(this).val();
        var page = "<?= $page ?>";
        var tt = display * page;
        var total = "<?= $num ?>";
        if (tt > total) {
            page--;
            if (page == "" && display != "") {
                window.location.href = 'tieu-chi-danh-gia.html?ht=' + display;
            } else if (page != "" && display != "") {
                window.location.href = 'tieu-chi-danh-gia.html?page=' + page + '&ht=' + display;
            }
        } else {
            if (page == "" && display != "") {
                window.location.href = 'tieu-chi-danh-gia.html?ht=' + display;
            } else if (page != "" && display != "") {
                window.location.href = 'tieu-chi-danh-gia.html?page=' + page + '&ht=' + display;
            }
        }
    })
    $(".delete-tc").click(function() {
        var id = $(this).attr("data-id");
        //get user id
        var ep_id = '<?= $ep_id ?>';
        $.ajax({
            url: '../ajax/tc_xoa.php',
            type: 'POST',
            data: {
                id: id,
                //user id
                ep_id: ep_id
            },
            success: function(data) {
                if (data == "") {
                    window.location.reload();
                } else {
                    alert("Bị lỗi");
                }
            }
        });
    })
</script>