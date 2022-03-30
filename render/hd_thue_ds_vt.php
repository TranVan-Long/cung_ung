<?
include("config.php");

$com_id = getValue('com_id', 'int', 'POST', '');
$id_kho = getValue('id_kho', 'int', 'POST', '');

$curl = curl_init();
$data = array(
    'id_com' => $com_id,
);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_URL, "https://phanmemquanlykhoxaydung.timviec365.vn/api/api_get_dsvt.php");
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($curl);
curl_close($curl);
$list_vt = json_decode($response, true);
$vat_tu_data = $list_vt['data']['items'];


$vat_tu = [];
for ($i = 0; $i < count($vat_tu_data); $i++) {
    $items_vt = $vat_tu_data[$i];
    $vat_tu[$items_vt['dsvt_id']] = $items_vt;
}
?>
<option value="">-- Chọn vật tư/thiết bị --</option>
<? foreach ($vat_tu_data as $key => $items) {
    if ($items['dsvt_kho'] == $id_kho) { ?>
        <option value="<?= $items['dsvt_id'] ?>"><?= $items['dsvt_name'] ?></option>
<? }
} ?>