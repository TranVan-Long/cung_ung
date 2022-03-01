<?
include("config.php");
$id_p = $_POST['id_p'];
$id_ncc = $_POST['id_ncc'];
$com_id = $_POST['id_com'];

if(isset($id_p) && $id_p != "" && $id_ncc != ""){
    $list_vt_bg = new db_query("SELECT `id`, `id_yc_bg`, `id_vat_tu`, `so_luong_yc_bg` FROM `vat_tu_bao_gia` WHERE `id_yc_bg` = $id_p ");

    $curl = curl_init();
    $data = array(
        'id_com' => $com_id,
    );
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_URL, "https://phanmemquanlykho.timviec365.vn/api/api_get_dsvt.php");
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $response = curl_exec($curl);
    curl_close($curl);
    $emp0 = json_decode($response,true);
    $emp = $emp0['data']['items'];
    $cou = count($emp);

    $all_vt = [];
    for($i = 0; $i < $cou; $i++){
        $item1 = $emp[$i];
        $all_vt[$item1['dsvt_id']] = $item1;
    };

    $stt = 1;
    while($row = mysql_fetch_assoc($list_vt_bg -> result)){
        $a = $stt++;
?>
<tr class="item" data-id="<?= $row['id'] ?>">
    <td class="w-20">
        <input type="text" name="ma_vat_tu" value="VT - <?= $row['id_vat_tu'] ?>" data="<?= $row['id_vat_tu'] ?>" class="tex_center" readonly>
    </td>
    <td class="w-35">
        <input type="text" name="ten_day_du" value="<?= $all_vt[$row['id_vat_tu']]['dsvt_name'] ?>" class="tex_center" readonly>
    </td>
    <td class="w-15">
        <input type="text" name="don_vi_tinh" value="<?= $all_vt[$row['id_vat_tu']]['dvt_name'] ?>" class="tex_center" readonly>
    </td>
    <td class="w-40">
        <input type="text" name="hang_san_suat" value="<?= $all_vt[$row['id_vat_tu']]['hsx_name'] ?>" class="tex_center" readonly>
    </td>
    <td class="w-30">
        <input type="text" name="so_luong_yeu_cau" value="<?= $row['so_luong_yc_bg'] ?>" class="tex_center" readonly>
    </td>
    <td class="w-25">
        <input type="text" name="so_luong_bao_gia" class="tex_center so_luong" onchange="sl_doi(this)">
    </td>
    <td class="w-25">
        <input type="text" name="don_gia" class="tex_center don_gia" onchange="dg_doi(this)">
    </td>
    <td class="w-30">
        <input type="text" name="tong_truoc_vat" class="tex_center tong_trvat" readonly>
    </td>
    <td class="w-25">
        <input type="text" name="thue_vat" class="tex_center thue_vat" onchange="thue_doi(this)">
    </td>
    <td class="w-30">
        <input type="text" name="tong_sau_vat" class="tex_center tong_svat" readonly>
    </td>
    <td class="w-35">
        <input type="text" name="chinh_sach_khac" class="tex_center">
    </td>
    <td class="w-35">
        <input type="text" name="so_luong_da_dat" class="tex_center">
    </td>
</tr>
<?}}else if($id_ncc == ""){echo "";}?>
