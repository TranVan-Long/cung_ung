<?
    include("config.php");
    $search = $_POST['search'];
    $danh_muc = $_POST['danh_muc'];
    $page = $_POST['page'];

    $currentP = $_POST['hien_thi'];

    $stt = 1;

    $url = '/quan-ly-khach-hang.html';
    $start = ($page - 1)*$currentP;
    $start = abs($start);

    if($danh_muc != ""){
        if($search == ""){
            $ds_kh = new db_query("SELECT `id`, `ten_vt`, `ten_nha_cc_kh`, `ma_so_thue`, `dia_chi_lh`, `so_dien_thoai`, `email`, `phan_loai`
                            FROM `nha_cc_kh` WHERE `phan_loai` = 2 LIMIT $start,$currentP ");
            $count = new db_query("SELECT COUNT(`id`) AS co1 FROM `nha_cc_kh` WHERE `phan_loai` = 2 ");
            $co = mysql_fetch_assoc($count -> result)['co1'];
        }else{
            $ds_kh = new db_query("SELECT `id`, `ten_vt`, `ten_nha_cc_kh`, `ma_so_thue`, `dia_chi_lh`, `so_dien_thoai`, `email`, `phan_loai`
                            FROM `nha_cc_kh` WHERE `phan_loai` = 2  AND `id` = '$search' LIMIT $start,$currentP");
            $count = new db_query("SELECT COUNT(`id`) AS co1 FROM `nha_cc_kh` WHERE `phan_loai` = 2  AND `id` = '".$search."'");
            $co = mysql_fetch_assoc($count -> result)['co1'];
        }
    }else{
        $ds_kh = new db_query("SELECT `id`, `ten_vt`, `ten_nha_cc_kh`, `ma_so_thue`, `dia_chi_lh`, `so_dien_thoai`, `email`, `phan_loai`
                            FROM `nha_cc_kh` WHERE `phan_loai` = 2 LIMIT $start,$currentP");
        $count = new db_query("SELECT COUNT(`id`) AS co1 FROM `nha_cc_kh` WHERE `phan_loai` = 2 ");
        $co = mysql_fetch_assoc($count -> result)['co1'];
    };
    $total = $co;
    $totalP = ceil($total/$currentP);

?>
<div class="scr-wrapper mt-20">
    <div class="scr-btn scr-l-btn right" onclick="right()"><i class="ic-chevron-left"></i></div>
    <div class="scr-btn scr-r-btn left" onclick="left()"><i class="ic-chevron-right"></i></div>
    <div class="table-wrapper">
        <div class="table-container table_1457">
            <div class="tbl-header">
                <table>
                    <thead>
                    <tr>
                        <th class="w-5">STT</th>
                        <th class="w-10">Mã khách hàng</th>
                        <th class="w-10">Tên gọi tắt</th>
                        <th class="w-15">Tên khách hàng</th>
                        <th class="w-25">Địa chỉ liên hệ</th>
                        <th class="w-10">Mã số thuế</th>
                        <th class="w-10">Điện thoại</th>
                        <th class="w-15">Email</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content" >
                <table>
                    <tbody>
                        <? while($row = mysql_fetch_assoc($ds_kh -> result)) { ?>
                            <tr>
                                <td class="w-5"><?= $stt++ ?></td>
                                <td class="w-10">
                                    <a href="quan-ly-chi-tiet-khach-hang-<?= $row['id'] ?>.html" class="text-500">KH - <?= $row['id'] ?></a></td>
                                <td class="w-10"><?= $row['ten_vt'] ?></td>
                                <td class="w-15"><?= $row['ten_nha_cc_kh'] ?></td>
                                <td class="w-25"><?= $row['dia_chi_lh'] ?></td>
                                <td class="w-10"><?= $row['ma_so_thue'] ?></td>
                                <td class="w-10"><?= $row['so_dien_thoai'] ?></td>
                                <td class="w-15"><?= $row['email'] ?></td>
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
        <select name="display" id="display" >
            <option value="10" <?= ($currentP == 10) ? "selected":"" ?>>10</option>
            <option value="20" <?= ($currentP == 20) ? "selected":"" ?>>20</option>
        </select>
    </div>
    <div class="pagination mt-10">
        <ul>
            <?=generatePageBar3('',$page,$currentP,$total,$url,'?','','active','preview','<','next','>','','<<<','','>>>'); ?>
        </ul>
    </div>
</div>
<script>
    $("#display").change(function(){
        var ht = $(this).val();
        var page = "<?= $page ?>";
        var tt = ht * page;
        var total = "<?= $total ?>";
        if(tt > total){
            page--;
            if(page == "" && ht != ""){
                window.location.href = 'quan-ly-khach-hang.html?ht='+ht;
            }else if(page != "" && ht != ""){
                window.location.href = 'quan-ly-khach-hang.html?page='+page+'&ht='+ht;
            }
        }else{
            if(page == "" && ht != ""){
                window.location.href = 'quan-ly-khach-hang.html?ht='+ht;
            }else if(page != "" && ht != ""){
                window.location.href = 'quan-ly-khach-hang.html?page='+page+'&ht='+ht;
            }
        }
    })
</script>