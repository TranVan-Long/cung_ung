<?
include("config.php");

$id_dg = $_POST['id_dg'];
$id_nhacc = $_POST['nha_cc'];
$dg_khac = $_POST['dg_khac'];
$user_id = $_POST['user_id'];

// sua danh gia
$id = $_POST['id'];
if($id != ""){
    $id = str_replace('_', ',', $id);
    $id = rtrim($id, ',');
    $id = explode(',', $id);
    $co = count($id);
    // for($l = 0; $l < $co; $l++){
    //     $a += $id[$l];
    // }
    // echo $a;
    // die();
}


$id_tc = $_POST['id_tc'];
$id_tc = str_replace('_', ',', $id_tc);
$id_tc = rtrim($id_tc, ',');
$id_tc = explode(',', $id_tc);

$diem_dg = $_POST['diem_dg'];
$diem_dg = str_replace('_', ',', $diem_dg);
$diem_dg = rtrim($diem_dg, ',');
$diem_dg = explode(',', $diem_dg);

$tongdiem = $_POST['tongdiem'];
$tongdiem = str_replace('_', ',', $tongdiem);
$tongdiem = rtrim($tongdiem, ',');
$tongdiem = explode(',', $tongdiem);

$dg_ctiet = $_POST['dg_ctiet'];
$dg_ctiet = str_replace('_', ',', $dg_ctiet);
$dg_ctiet = rtrim($dg_ctiet, ',');
$dg_ctiet = explode(',', $dg_ctiet);

// them moi danh gia nha cung cap
$new_tc = $_POST['new_tc'];
if($new_tc != ""){
    $new_tc = str_replace('_', ',', $new_tc);
    $new_tc = rtrim($new_tc, ',');
    $new_tc = explode(',', $new_tc);
    $count = count($new_tc);
}

$new_dg = $_POST['new_dg'];
$new_dg = str_replace('_', ',', $new_dg);
$new_dg = rtrim($new_dg, ',');
$new_dg = explode(',', $new_dg);

$new_tongd = $_POST['new_tongd'];
$new_tongd = str_replace('_', ',', $new_tongd);
$new_tongd = rtrim($new_tongd, ',');
$new_tongd = explode(',', $new_tongd);

$new_dgct = $_POST['new_dgct'];
$new_dgct = str_replace('_', ',', $new_dgct);
$new_dgct = rtrim($new_dgct, ',');
$new_dgct = explode(',', $new_dgct);


if(isset($id_nhacc) && $id_nhacc != ""){
    $ten_nhacc = mysql_fetch_assoc((new db_query("SELECT `ten_nha_cc_kh` FROM `nha_cc_kh` WHERE `id` = $id_nhacc ")) -> result)['ten_nha_cc_kh'];
    $noi_dung = "Bạn đã chỉnh sửa đánh giá nhà cung cấp".$ten_nhacc;
    $time = strtotime(date('Y-m-d H:i:s', time()));

    $inser_nk = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_gio`, `noi_dung`) VALUES ('','$user_id','$time','$noi_dung')");

    $up_dg = new db_query("UPDATE `danh_gia` SET `id_nha_cc`='$id_nhacc',`danh_gia_khac`='$dg_khac' WHERE `id` = $id_dg ");
    if(isset($co) && $co > 0 && $count == ""){
        for($i = 0; $i < $co; $i++){
            $up_dg = new db_query("UPDATE `chi_tiet_danh_gia` SET `id_tieu_chi`='$id_tc[$i]',`diem_danh_gia`='$diem_dg[$i]',`tong_diem_danh_gia`='$tongdiem[$i]', `danh_gia_chi_tiet`='$dg_ctiet[$i]' WHERE `id` = $id[$i] ");
        }
    }else if($co == "" && isset($count) && $count > 0 ){
        for($j = 0; $j < $count; $j++){
            $inser_dg = new db_query("INSERT INTO `chi_tiet_danh_gia`(`id`, `id_danh_gia`, `id_tieu_chi`, `diem_danh_gia`, `tong_diem_danh_gia`,
            `danh_gia_chi_tiet`) VALUES ('','$id_dg','$new_tc[$j]','$new_dg[$j]','$new_tongd[$j]','$new_dgct[$j]')");
        }
    }else if($co > 0 && $count > 0){
        for($i = 0; $i < $co; $i++){
            $up_dg = new db_query("UPDATE `chi_tiet_danh_gia` SET `id_tieu_chi`='$id_tc[$i]',`diem_danh_gia`='$diem_dg[$i]',`tong_diem_danh_gia`='$tongdiem[$i]', `danh_gia_chi_tiet`='$dg_ctiet[$i]' WHERE `id` = $id[$i] ");
        }

        for($j = 0; $j < $count; $j++){
            $inser_dg = new db_query("INSERT INTO `chi_tiet_danh_gia`(`id`, `id_danh_gia`, `id_tieu_chi`, `diem_danh_gia`, `tong_diem_danh_gia`,
            `danh_gia_chi_tiet`) VALUES ('','$id_dg','$new_tc[$j]','$new_dg[$j]','$new_tongd[$j]','$new_dgct[$j]')");
        }
    }

}else{
    echo "Bạn sửa đánh giá nhà cung cấp không thành công, vui lòng thử lại!";
}



?>