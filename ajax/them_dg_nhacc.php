<?
include("config.php");
$ngay_dg = strtotime($_POST['ngay_dg']);
$ep_id = $_POST['ep_id'];
$dep_id = $_POST['dep_id'];
$id_nhacc = $_POST['id_nhacc'];
$dg_khac = $_POST['dg_khac'];

if($ngay_dg != "" && $id_nhacc != ""){
    $them_dg = new db_query("INSERT INTO `danh_gia`(`id`, `ngay_danh_gia`, `nguoi_danh_gia`, `phong_ban`,
                        `id_nha_cc`, `danh_gia_khac`) VALUES ('','$ngay_dg','$ep_id','$dep_id','$id_nhacc','$dg_khac')");
}else{
    echo "Đánh giá nhà cung cấp không thành công";
}

?>