<?
include("config.php");

$timkiem = $_POST['timkiem'];
$search_tt = $_POST['search_tt'];
$page = $_POST['page'];
$currentP = $_POST['ht'];

$start = ($page - 1) * $currentP;
$start = abs($start);

$url = '/danh-gia-nha-cung-cap.html';

if($timkiem != ""){
    if($search_tt != ""){
        $list_dg = new db_query("SELECT `id`, `ngay_danh_gia`, `id_nha_cc`, `danh_gia_khac` FROM `danh_gia` WHERE `id` = '$search_tt' LIMIT $start,$currentP ");
        $total = mysql_fetch_assoc((new db_query("SELECT count(id) FROM `danh_gia` AS total WHERE `id` = '$search_tt' ")) -> result)['total'];
    }else{
        $list_dg = new db_query("SELECT `id`, `ngay_danh_gia`, `id_nha_cc`, `danh_gia_khac` FROM `danh_gia` WHERE `id` LIMIT $start,$currentP ");
        $total = mysql_fetch_assoc((new db_query("SELECT count(id) FROM `danh_gia` AS total")) -> result)['total'];
    }
}else{
    $list_dg = new db_query("SELECT `id`, `ngay_danh_gia`, `id_nha_cc`, `danh_gia_khac` FROM `danh_gia` WHERE `id` LIMIT $start,$currentP ");
    $total = mysql_fetch_assoc((new db_query("SELECT count(id) FROM `danh_gia` AS total ")) -> result)['total'];
}
echo $total;

$totalP = ceil($total/$currentP);
?>
<div class="scr-wrapper mt-20">
    <div class="scr-btn scr-l-btn right"><i class="ic-chevron-left"></i></div>
    <div class="scr-btn scr-r-btn left"><i class="ic-chevron-right"></i></div>
    <div class="table-wrapper">
        <div class="table-container table-1074">
            <div class="tbl-header">
                <table>
                    <thead>
                        <tr>
                            <th class="w-5">STT</th>
                            <th class="w-15">Số phiếu</th>
                            <th class="w-10">Ngày đánh giá</th>
                            <th class="w-15">Nhà cung cấp</th>
                            <th class="w-5">Điểm</th>
                            <th class="w-20">Đánh giá khác</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content">
                <table>
                    <tbody>
                        <?
                        $counter = 1;
                        while ($danh_gia = mysql_fetch_assoc($list_dg->result)) {
                            $danh_gia_id = $danh_gia["id"];
                            $ncc_id = $danh_gia["id_nha_cc"];
                            $list_ncc = mysql_fetch_assoc((new db_query("SELECT `id`, `ten_nha_cc_kh` FROM `nha_cc_kh` WHERE `id` = '$ncc_id' "))->result);
                            $nha_cc = $list_ncc['ten_nha_cc_kh'];
                        ?>
                            <tr>
                                <td class="w-5"><?= $counter++ ?></td>
                                <td class="w-15">
                                    <a href="chi-tiet-danh-gia-nha-cung-cap-<?= $danh_gia_id ?>.html" class="text-500">PH-<?= $danh_gia['id'] ?></a>
                                </td>
                                <td class="w-10"><?= $danh_gia['ngay_danh_gia'] ?></td>
                                <td class="w-15"><?= $nha_cc ?></td>
                                <td class="w-5">10/10</td>
                                <td class="w-20"><?= $danh_gia['danh_gia_khac'] ?></td>
                            </tr>
                        <? } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="w-100 left mt-10 d-flex flex-wrap spc-btw">
    <!-- <div class="display mr-10">
        <label for="display">Hiển thị</label>
        <select name="display" id="display">
            <option value="10">10</option>
            <option value="20">20</option>
        </select>
    </div> -->
    <div class="pagination mt-10">
        <ul>
            <?= generatePageBar3('',$page,$currentP,$total,$url,'?','','active','preview','<','next','>','','<<<','','>>>'); ?>
        </ul>
    </div>
</div>