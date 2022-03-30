<?
include("config.php");

$com_id = getValue('com_id', 'int', 'POST', '');
$dep_id = getValue('dep_id', 'int', 'POST', '');
$token = $_POST['token'];
$quyen = getValue('quyen', 'int', 'POST', '');

if ($quyen == 1) {

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_employee_of_company.php');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
    $response = curl_exec($curl);
    curl_close($curl);

    $data_list = json_decode($response, true);
    $list_nv = $data_list['data']['items'];
    $count = count($list_nv);
} else if ($quyen == 2) {

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_my_partner.php?get_all=true');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
    $response = curl_exec($curl);
    curl_close($curl);

    $data_list = json_decode($response, true);
    $list_nv = $data_list['data']['items'];
    $count = count($list_nv);
} ?>
<option value="">-- Chọn người nhận hàng --</option>

<? if ($com_id != "" && $quyen != "") {
    if ($dep_id != "") {
        for ($i = 0; $i < $count; $i++) {
            if ($list_nv[$i]['dep_id'] == $dep_id) { ?>
                <option value="<?= $list_nv[$i]['ep_id'] ?>">(<?= $list_nv[$i]['ep_id'] ?>) <?= $list_nv[$i]['ep_name'] ?></option>
            <? }
        }
    } else if ($dep_id == "") {
        for ($j = 0; $j < $count; $j++) {
            ?>
            <option value="<?= $list_nv[$j]['ep_id'] ?>">(<?= $list_nv[$j]['ep_id'] ?>) <?= $list_nv[$j]['ep_name'] ?></option>
<?      }
    }
}

?>