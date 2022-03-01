<?
include("config.php");

$com_id = $_POST['com_id'];

$user_id = $_POST['user_id'];

$ngay_gui = strtotime($_POST['ngay_gui']);

$nha_cc = $_POST['nha_cc'];

$phieu_yc = $_POST['phieu_yc'];

if($_POST['tg_apdung'] != ""){
    $tg_apdung = strtotime($_POST['tg_apdung']);
}else{
    $tg_apdung = "";
};


if($_POST['tg_ketthuc'] != ""){
    $tg_ketthuc = strtotime($_POST['tg_ketthuc']);
}else{
    $tg_ketthuc = "";
};

$id_vt = $_POST['id_vt'];
$co1 = count($id_vt);

$sl_bg = $_POST['sl_bg'];
$co2 = count($sl_bg);


$don_gia = $_POST['don_gia'];
$co3 = count($don_gia);


$tongtr_vat = $_POST['tongtr_vat'];
$co4 = count($tongtr_vat);


$thue = $_POST['thue'];
$tongs_vat = $_POST['tongs_vat'];
$co5 = count($tongs_vat);

$chinh_sach_khac = $_POST['chinh_sach_khac'];
$so_luong_da_dat = $_POST['so_luong_da_dat'];


$thoi_gian = strtotime(date('Y-m-d H:i:s', time()));
$ngay_tao = strtotime(date('Y-m-d', time()));


if($phieu_yc != "" && $nha_cc != "" && $co2 == $co3 && $co2 == $co4 && $co3 == $co4 && $co4 == $co5){

    $inser_bg = new db_query("INSERT INTO `bao_gia`(`id`, `id_yc_bg`, `id_nha_cc`, `id_nguoi_lap`, `ngay_gui`, `ngay_bd`, `ngay_kt`, `ngay_tao`,
                            `ngay_chinh_sua`, `id_cong_ty`) VALUES ('','$phieu_yc','$nha_cc','$user_id','$ngay_gui','$tg_apdung','$tg_ketthuc','$ngay_tao','','$com_id')");

    $id_inser = new db_query("SELECT LAST_INSERT_ID() AS id_baog");
    $id_baog = mysql_fetch_assoc($id_inser -> result)['id_baog'];

    for($i = 0; $i < $co1; $i++){
        $up_bgia_vt = new db_query("INSERT INTO `vat_tu_da_bao_gia`(`id`, `id_bao_gia`, `id_vat_tu`, `so_luong_bg`, `don_gia`,
                                    `tong_tien_trvat`, `thue_vat`, `tong_tien_svat`, `cs_kem_theo`, `sl_da_dat_hang`)
                                    VALUES ('','$id_baog','$id_vt[$i]','$sl_bg[$i]','$don_gia[$i]','$tongtr_vat[$i]','$thue[$i]','$tongs_vat[$i]',
                                    '$chinh_sach_khac[$i]','$so_luong_da_dat[$i]')");
    };

    $noi_dung_nk = "Bạn đã thêm phiếu yêu cầu báo giá: BG - " .$id_baog;
    $inser_nk = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `ngay_gio`, `noi_dung`) VALUES ('','$user_id','$thoi_gian','$noi_dung_nk')");

}
else{
    echo "Bạn thêm phiếu báo giá thất bại, vui lòng thử lại!";
}

?>