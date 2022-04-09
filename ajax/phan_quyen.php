<?
include("config.php");

$com_id = getValue('com_id', 'int', 'POST', '');
$id_nv = getValue('id_nv', 'int', 'POST', '');

$yc_vt = $_POST['yc_vt'];
$yc_vt = str_replace('_', ',', $yc_vt);
$yc_vt = rtrim($yc_vt, ',');

$hop_dong = $_POST['hop_dong'];
$hop_dong = str_replace('_', ',', $hop_dong);
$hop_dong = rtrim($hop_dong, ',');

$don_hang = $_POST['don_hang'];
$don_hang = str_replace('_', ',', $don_hang);
$don_hang = rtrim($don_hang, ',');

$hs_tt = $_POST['hs_tt'];
$hs_tt = str_replace('_', ',', $hs_tt);
$hs_tt = rtrim($hs_tt, ',');

$phieu_tt = $_POST['phieu_tt'];
$phieu_tt = str_replace('_', ',', $phieu_tt);
$phieu_tt = rtrim($phieu_tt, ',');

$bang_gia = $_POST['bang_gia'];
$bang_gia = str_replace('_', ',', $bang_gia);
$bang_gia = rtrim($bang_gia, ',');

$yc_baogia = $_POST['yc_baogia'];
$yc_baogia = str_replace('_', ',', $yc_baogia);
$yc_baogia = rtrim($yc_baogia, ',');

$bao_gia = $_POST['bao_gia'];
$bao_gia = str_replace('_', ',', $bao_gia);
$bao_gia = rtrim($bao_gia, ',');

$bao_gia_kh = $_POST['bao_gia_kh'];
$bao_gia_kh = str_replace('_', ',', $bao_gia_kh);
$bao_gia_kh = rtrim($bao_gia_kh, ',');

$nha_cc = $_POST['nha_cc'];
$nha_cc = str_replace('_', ',', $nha_cc);
$nha_cc = rtrim($nha_cc, ',');

$danhgia_ncc = $_POST['danhgia_ncc'];
$danhgia_ncc = str_replace('_', ',', $danhgia_ncc);
$danhgia_ncc = rtrim($danhgia_ncc, ',');

$tc_danhgia = $_POST['tc_danhgia'];
$tc_danhgia = str_replace('_', ',', $tc_danhgia);
$tc_danhgia = rtrim($tc_danhgia, ',');

$khach_hang = $_POST['khach_hang'];
$khach_hang = str_replace('_', ',', $khach_hang);
$khach_hang = rtrim($khach_hang, ',');

$dso_bhang = $_POST['dso_bhang'];
$dso_bhang = str_replace('_', ',', $dso_bhang);
$dso_bhang = rtrim($dso_bhang, ',');

$congno_pthu = $_POST['congno_pthu'];
$congno_pthu = str_replace('_', ',', $congno_pthu);
$congno_pthu = rtrim($congno_pthu, ',');

$congno_ptra = $_POST['congno_ptra'];
$congno_ptra = str_replace('_', ',', $congno_ptra);
$congno_ptra = rtrim($congno_ptra, ',');

$ngay_tao = strtotime(date('Y-m-d', time()));
$gio_tao = strtotime(date('H:i:s', time()));

if ($id_nv == "") {
    echo "Chọn nhân viên phân quyền";
} else if ($com_id != "" && $id_nv != "") {
    $kiem_tra_nv = new db_query("SELECT `id` FROM `phan_quyen` WHERE `id_nhan_vien` = $id_nv AND `id_cong_ty` = $com_id ");
    if (mysql_num_rows($kiem_tra_nv->result) > 0) {
        $dele_nv = new db_query("DELETE FROM `phan_quyen` WHERE `id_nhan_vien` = $id_nv AND `id_cong_ty` = $com_id ");

        $inser_pq = new db_query("INSERT INTO `phan_quyen`(`id`, `yeu_cau_vat_tu`, `hop_dong`, `don_hang`, `ho_so_tt`, `phieu_tt`, `bang_gia`, `yeu_cau_bao_gia`,
                            `bao_gia`, `bao_gia_kh`, `nha_cung_cap`, `danh_gia_ncc`, `tieu_chi_danh_gia`, `khach_hang`, `bc_doanh_so`, `cog_no_thu`, `cong_no_tra`,
                            `id_nhan_vien`, `id_cong_ty`) VALUES ('','$yc_vt','$hop_dong','$don_hang','$hs_tt','$phieu_tt','$bang_gia','$yc_baogia',
                            '$bao_gia','$bao_gia_kh','$nha_cc','$danhgia_ncc','$tc_danhgia','$khach_hang','$dso_bhang','$congno_pthu','$congno_ptra',
                            '$id_nv','$com_id')");
        $id_quyen = mysql_fetch_assoc((new db_query("SELECT LAST_INSERT_ID() AS id_quyen")) -> result)['id_quyen'];
        $noi_dung_nk = "Bạn đã phân quyền cho nhân viên: ID - ". $id_nv . "Mã phân quyền: ".$id_quyen;
        $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                            VALUES('', '$com_id', '1', '$ngay_tao','$gio_tao', '$noi_dung_nk',`$com_id`)");

    } else {
        $inser_pq = new db_query("INSERT INTO `phan_quyen`(`id`, `yeu_cau_vat_tu`, `hop_dong`, `don_hang`, `ho_so_tt`, `phieu_tt`, `bang_gia`, `yeu_cau_bao_gia`,
                            `bao_gia`, `bao_gia_kh`, `nha_cung_cap`, `danh_gia_ncc`, `tieu_chi_danh_gia`, `khach_hang`, `bc_doanh_so`, `cog_no_thu`, `cong_no_tra`,
                            `id_nhan_vien`, `id_cong_ty`) VALUES ('','$yc_vt','$hop_dong','$don_hang','$hs_tt','$phieu_tt','$bang_gia','$yc_baogia',
                            '$bao_gia','$bao_gia_kh','$nha_cc','$danhgia_ncc','$tc_danhgia','$khach_hang','$dso_bhang','$congno_pthu','$congno_ptra',
                            '$id_nv','$com_id')");
        $id_quyen = mysql_fetch_assoc((new db_query("SELECT LAST_INSERT_ID() AS id_quyen"))->result)['id_quyen'];
        $noi_dung_nk = "Bạn đã phân quyền cho nhân viên: ID - " . $id_nv . "Mã phân quyền: " . $id_quyen;
        $log = new db_query("INSERT INTO `nhat_ky_hd`(`id`, `id_nguoi_dung`, `role`, `ngay_tao`,`gio_tao`, `noi_dung`,`id_cong_ty`)
                            VALUES('', '$com_id', '1', '$ngay_tao','$gio_tao', '$noi_dung_nk',`$com_id`)");
    }
} else {
    echo "Phân quyền thất bại, vui lòng thử lại!";
}
