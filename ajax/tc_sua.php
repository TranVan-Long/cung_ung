<?
include("config.php");
$tc_id              = getValue('tc_id', 'int', 'POST', '');
$tieu_chi_danh_gia  = $_POST['tieu_chi_danh_gia'];

$id_gia_tri_old         = $_POST['id_gia_tri_old'];
$ten_hien_thi_old       = $_POST['ten_hien_thi_old'];


$gia_tri            = $_POST['gia_tri'];
$ten_hien_thi       = $_POST['ten_hien_thi'];

$ep_id              = getValue('ep_id', 'int', 'POST', '');

$cap_nhat_tc = new db_query("UPDATE `tieu_chi_danh_gia` SET `tieu_chi` = '$tieu_chi_danh_gia' WHERE `id`= $tc_id");

//cap nhat gia tri da ton tai
for ($i = 0; $i < count($id_gia_tri_old); $i++) {
    $ds_gt = new db_query("UPDATE `ds_gia_tri_dg` SET `ten_gia_tri` = '$ten_hien_thi_old[$i]' WHERE `id` = $id_gia_tri_old[$i]");
}

//them gia tri moi
if ($gia_tri != "") {
    for ($i = 0; $i < count($gia_tri); $i++) {
        $gt_new = new db_query("INSERT INTO `ds_gia_tri_dg`(`id`, `id_tieu_chi`, `gia_tri`, `ten_gia_tri`) VALUES ('', '$tc_id', '$gia_tri[$i]', '$ten_hien_thi[$i]')");
    }
}

// save log
$noi_dung = 'Bạn đã sửa tiêu chí đánh giá: ' . $tieu_chi_danh_gia;
$ngay_tao = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));
$log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_tao`,`gio_tao`, `noi_dung`) VALUES('', '$ep_id', '$ngay_tao','$gio_tao', '$noi_dung')");



// if ($tieu_chi_danh_gia != "") {
//     if ($kieu_gia_tri == 1 && $count1 = 1) {

//         $cap_nhat_tc = new db_query("UPDATE `tieu_chi_danh_gia` SET `tieu_chi` = '$tieu_chi_danh_gia', `he_so` = '$he_so', `kieu_gia_tri` = '$kieu_gia_tri' WHERE `id`= $tc_id");
//         $ds_gt = new db_query("UPDATE `ds_gia_tri_dg` SET `gia_tri` = '$gia_tri[0]' WHERE `id_tieu_chi` = '$tc_id'");

//         //save log
//         $noi_dung = 'Bạn đã sửa tiêu chí đánh giá: ' . $tieu_chi_danh_gia;
//         $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_gio`, `noi_dung`)
//                          VALUES('', '$ep_id', '$ngay_sua', '$noi_dung')");
//     } elseif ($kieu_gia_tri == 2 && $count1 > 0) {
//         $cap_nhat_tc = new db_query("UPDATE `tieu_chi_danh_gia` SET `tieu_chi` = '$tieu_chi_danh_gia', `he_so` = '$he_so', `kieu_gia_tri` = '$kieu_gia_tri' WHERE `id`= $tc_id");
//         if ($gia_tri_old != "") {
//             //cap nhat gia tri da ton tai
//             for ($i = 0; $i < $count1; $i++) {
//                 $ds_gt = new db_query("UPDATE `ds_gia_tri_dg` SET `gia_tri`= '$gia_tri_old[$i]', `ten_gia_tri` = '$ten_hien_thi_old[$i]' WHERE `id_tieu_chi` = '$tc_id'");
//             }
//         }
//         if ($gia_tri != "") {
//             for ($i = 0; $i < $count2; $i++) {
//                 $gt_new = new db_query("INSERT INTO `ds_gia_tri_dg`(`id`, `id_tieu_chi`, `gia_tri`, `ten_gia_tri`) VALUES ('', '$tc_id[$i]', '$gia_tri[$i]', '$ten_hien_thi[$i]');");
//             }
//         }


//         //save log
//         $noi_dung = 'Bạn đã sửa tiêu chí đánh giá: ' . $tieu_chi_danh_gia;
//         $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_gio`, `noi_dung`)
//                          VALUES('', '$ep_id', '$ngay_sua', '$noi_dung')");
//     } else {
//         echo "Vui lòng thêm ít nhất một giá trị hoặc chọn kiểu nhập tay.";
//     }
// } else {
//     echo "";
// }
