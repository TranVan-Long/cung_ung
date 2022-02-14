<?
include("config.php");

$timkiem = $_POST['timkiem'];
$search_tt = $_POST['search_tt'];
$page = $_POST['page'];
$currentP = $_POST['ht'];

$url = '/danh-gia-nha-cung-cap.html?ht='.$currentP;


$start = ($page - 1) * $currentP;
$start = abs($start);


if($timkiem != ""){
    if($search_tt != ""){
        if($timkiem == 1){
            $list_dg = new db_query("SELECT `id`, `ngay_danh_gia`, `id_nha_cc`, `danh_gia_khac` FROM `danh_gia` WHERE `id` = '$search_tt' LIMIT $start,$currentP ");
            $total = mysql_fetch_assoc((new db_query("SELECT count(id) AS tol FROM `danh_gia` WHERE `id` = '$search_tt' ")) -> result)['tol'];
        }else if($timkiem == 2){
            $list_dg = new db_query("SELECT `id`, `ngay_danh_gia`, `id_nha_cc`, `danh_gia_khac` FROM `danh_gia` WHERE `id_nha_cc` = '$search_tt' LIMIT $start,$currentP ");
            $total = mysql_fetch_assoc((new db_query("SELECT count(id) AS tol FROM `danh_gia` WHERE `id_nha_cc` = '$search_tt' ")) -> result)['tol'];
        }
    }else{
        $list_dg = new db_query("SELECT `id`, `ngay_danh_gia`, `id_nha_cc`, `danh_gia_khac` FROM `danh_gia` WHERE `id` LIMIT $start,$currentP ");
        $total = mysql_fetch_assoc((new db_query("SELECT count(id) AS tol FROM `danh_gia` ")) -> result)['tol'];
    }
}else if($timkiem == ""){
    $list_dg = new db_query("SELECT `id`, `ngay_danh_gia`, `id_nha_cc`, `danh_gia_khac` FROM `danh_gia` WHERE `id` LIMIT $start,$currentP ");
    $total = mysql_fetch_assoc((new db_query("SELECT count(id) AS tol FROM `danh_gia` ")) -> result)['tol'];
}

$totalP = ceil($tol/$currentP);

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
                            $tong_diem = mysql_fetch_assoc((new db_query("SELECT SUM(`diem_danh_gia`) AS sumt, SUM(`thang_diem`) AS sum_td FROM `chi_tiet_danh_gia` WHERE `id_danh_gia` = $danh_gia_id ")) -> result);
                            $diem_one = $tong_diem['sumt'];
                            $diemt_two = $tong_diem['sum_td'];
                            $nha_cc = $list_ncc['ten_nha_cc_kh'];
                        ?>
                            <tr>
                                <td class="w-5"><?= $counter++ ?></td>
                                <td class="w-15">
                                    <a href="chi-tiet-danh-gia-nha-cung-cap-<?= $danh_gia_id ?>.html" class="text-500">PH-<?= $danh_gia['id'] ?></a>
                                </td>
                                <td class="w-10"><?= date('d-m-Y', $danh_gia['ngay_danh_gia']) ?></td>
                                <td class="w-15"><?= $nha_cc ?></td>
                                <td class="w-5"><?= $diem_one ?>/<?= $diemt_two ?></td>
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
<!-- <div class="w-100 left mt-10 spc-btw"> -->
    <div class="display mr-10">
        <label for="display">Hiển thị</label>
        <select name="display" id="display" data1="<?= $total ?>" onchange="hien_thi_doi()">
            <option value="10" <?= ($currentP == 10) ? "selected":"" ?>>10</option>
            <option value="20" <?= ($currentP == 20) ? "selected":"" ?>>20</option>
        </select>
    </div>
    <div class="pagination right mt-10">
        <ul>
            <?= generatePageBar3('',$page,$currentP,$total,$url,'&','','active','preview','<','next','>','','<<<','','>>>'); ?>
        </ul>
    </div>
</div>