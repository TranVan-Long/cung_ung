<?
include("config.php");

if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == 1) {
    $curl = curl_init();
    $token = $_COOKIE['acc_token'];
    curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_employee_of_company.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
    $response = curl_exec($curl);
    curl_close($curl);

    $data_list = json_decode($response, true);
    $data_list_nv = $data_list['data']['items'];
} elseif (isset($_SESSION['quyen']) && ($_SESSION['quyen'] == 2)) {
    $curl = curl_init();
    $token = $_COOKIE['acc_token'];
    curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_my_partner.php?get_all=true');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
    $response = curl_exec($curl);
    curl_close($curl);

    $data_list = json_decode($response, true);
    $data_list_nv = $data_list['data']['items'];
    $user_id = $_SESSION['ep_id'];
    $user_name = $_SESSION['ep_name'];
}
foreach ($data_list_nv as $key => $items) {
    if ($user_id == $items['ep_id']) {
        $dept_id    = $items['dep_id'];
        $dept_name  = $items['dep_name'];
        $comp_id = $items['com_id'];
    }
}


$curl = curl_init();
$data = array(
    'id_com' => $comp_id,
);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_URL, "https://phanmemquanlykhoxaydung.timviec365.vn/api/api_get_dsvt.php");
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($curl);
curl_close($curl);

$ql_kho = json_decode($response, true);
$kho_vt = $ql_kho['data']['items'];
$count = count($kho_vt);

?>
<tr class="item">
    <td class="w-10">
        <p class="removeItem"><i class="ic-delete remove-btn"></i></p>
    </td>
    <td class="w-25">
        <div class="v-select2">
            <select name="materials_name" class="share_select materials_name">
                <option value="">-- Chọn vật tư/thiết bị --</option>
                <? for ($i = 0; $i < $count; $i++) { ?>
                    <option value="<?= $kho_vt[$i]['dsvt_id'] ?>"><?= $kho_vt[$i]['dsvt_name'] ?></option>
                <? } ?>
            </select>
        </div>
    </td>
    <td class="w-20">
        <input type="text" name="dv_tinh" value="" readonly>
    </td>
    <td class="w-25">
        <input type="number" name="so_luong" readonly>
    </td>
</tr>
<script>
    change_vt();
    RefSelect2();
</script>