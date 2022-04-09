<?
include("config.php");

$com_id = getValue('com_id', 'int', 'POST', '');
$user_id = getValue('user_id', 'int', 'POST', '');
$ngay_gui = strtotime($_POST['ngay_gui']);
$nha_cc = getValue('nha_cc', 'int', 'POST', '');
$phieu_yc = getValue('phieu_yc', 'int', 'POST', '');
$phan_quyen_nk = getValue('phan_quyen_nk', 'int', 'POST', '');

if ($_POST['tg_apdung'] != "") {
    $tg_apdung = strtotime($_POST['tg_apdung']);
} else {
    $tg_apdung = 0;
};

if ($_POST['tg_ketthuc'] != "") {
    $tg_ketthuc = strtotime($_POST['tg_ketthuc']);
} else {
    $tg_ketthuc = 0;
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
$so_luong_da_dat = getValue('so_luong_da_dat', 'int', 'POST', '');



$ngay_tao = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));


if ($phieu_yc != "" && $nha_cc != "" && $co1 == $co2 && $co2 == $co3 && $co3 == $co4 && $co4 == $co5) {

    $inser_bg = new db_query("INSERT INTO `bao_gia`(`id`, `id_yc_bg`, `id_nha_cc`, `id_nguoi_lap`, `quyen_nlap`, `ngay_gui`, `ngay_bd`, `ngay_kt`, `ngay_tao`,
                            `ngay_chinh_sua`, `id_cong_ty`) VALUES ('','$phieu_yc','$nha_cc','$user_id','$phan_quyen_nk','$ngay_gui','$tg_apdung','$tg_ketthuc','$ngay_tao','','$com_id')");

    $id_inser = new db_query("SELECT LAST_INSERT_ID() AS id_baog");
    $id_baog = mysql_fetch_assoc($id_inser->result)['id_baog'];

    for ($i = 0; $i < $co2; $i++) {
        $up_bgia_vt = new db_query("INSERT INTO `vat_tu_da_bao_gia`(`id`, `id_bao_gia`, `id_vat_tu`, `so_luong_bg`, `don_gia`,
                                    `tong_tien_trvat`, `thue_vat`, `tong_tien_svat`, `cs_kem_theo`, `sl_da_dat_hang`, `id_cong_ty`)
                                    VALUES ('','$id_baog','$id_vt[$i]','$sl_bg[$i]','$don_gia[$i]','$tongtr_vat[$i]','$thue[$i]','$tongs_vat[$i]',
                                    '$chinh_sach_khac[$i]','$so_luong_da_dat[$i]','$com_id')");
    };

    $noi_dung_nk = "Bạn đã thêm phiếu yêu cầu báo giá: BG - " . $id_baog;
    $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`,`role`, `ngay_tao`,`gio_tao`, `noi_dung`) VALUES('', '$user_id','$phan_quyen_nk', '$ngay_tao','$gio_tao', '$noi_dung_nk')");
} else {
    echo "Bạn thêm phiếu báo giá thất bại, vui lòng thử lại!";
}
