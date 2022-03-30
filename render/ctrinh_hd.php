<?
include("config.php");
$id_hd = getValue('id_hd', 'int', 'POST', '');
$com_id = getValue('com_id', 'int', 'POST', '');
if($id_hd != "" && $com_id != ""){
    $list_ctrinh = new db_query("SELECT `id_du_an_ctrinh` FROM `hop_dong` WHERE `id` = $id_hd AND `id_cong_ty` = $com_id AND `phan_loai` = 1 ");
    $id_ctrinh = mysql_fetch_assoc($list_ctrinh -> result)['id_du_an_ctrinh'];

    $curl = curl_init();
    $data = array(
        'id_com' => $com_id,
    );
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_URL, 'https://phanmemquanlycongtrinh.timviec365.vn/api/congtrinh.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $response = curl_exec($curl);
    curl_close($curl);
    $data_list = json_decode($response, true);
    $all_ctrinh = $data_list['data']['items'];
    $cou = count($all_ctrinh);

    $ds_ctr = [];
    for($i = 0; $i < $cou; $i++){
        $item = $all_ctrinh[$i];
        $ds_ctr[$item['ctr_id']] = $item;
    };

    $ten_ctrinh = $ds_ctr[$id_ctrinh]['ctr_name'];
}

?>
    <label>Dự án / Công trình</label>
    <input type="text" name="duan_ctrinh" value="<?= $ten_ctrinh ?>" class="form-control" placeholder="Dự án / Công trình" readonly>