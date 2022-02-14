<?
include("config.php");

$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_URL, "https://phanmemquanlykho.timviec365.vn/api/api_get_dsvt.php");
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
$response = curl_exec($curl);
curl_close($curl);

$ql_kho = json_decode($response, true);
$kho_vt = $ql_kho['data']['items'];
$count = count($kho_vt);
$dvt = "";
?>
<tr class="item">
    <td class="w-10">
        <p class="removeItem"><i class="ic-delete remove-btn"></i>
        </p>
    </td>
    <td class="w-25">
        <div class="v-select2">

            <select name="materials_name" id="materials_name" class="share_select">
                <?
                for ($i = 0; $i < $count; $i++) {
                ?>
                    <option value="<?= $kho_vt[$i]['dsvt_id'] ?>"><?= $kho_vt[$i]['dsvt_name'] ?></option>
                <? } ?>
            </select>
        </div>
    </td>
    <td class="w-20">
        <input type="text" name="dv_tinh" value="<?= $dvt?>" readonly>
    </td>
    <td class="w-25">
        <input type="text" name="so_luong">
    </td>
</tr>
<script>
    change_vt();
    RefSelect2();
</script>