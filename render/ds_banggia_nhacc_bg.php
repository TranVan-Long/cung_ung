<?
include("config.php");
$id_vt = getValue("id_vt","int","POST","");
$com_id = getValue("com_id","int","POST","");
$id_ncc = getValue('id_ncc','int','POST','');
$sapxep = getValue('sapxep','int','POST','');

if($sapxep == 1){
    $sql_ss = " ORDER BY v.`don_gia` ASC";
}else if($sapxep == 2){
    $sql_ss = " ORDER BY v.`don_gia` DESC";
}

if($id_ncc != ""){
    $sql = "AND n.`id` = $id_ncc ";
}else{
    $sql = "";
}
$list_ncc = "SELECT b.`id`, b.`id_nha_cc`, n.`ten_nha_cc_kh`, v.`don_gia` FROM `bao_gia` AS b
            INNER JOIN `nha_cc_kh` AS n ON b.`id_nha_cc` = n.`id`
            INNER JOIN `vat_tu_da_bao_gia` AS v ON v.`id_bao_gia` = b.`id`
            WHERE b.`id_cong_ty` = $com_id AND v.`id_vat_tu` = $id_vt  ";
$list_ncc .= $sql;
$list_ncc .= $sql_ss;
$sql_ncc = new db_query($list_ncc);

while($item = mysql_fetch_assoc($sql_ncc -> result)){
?>
<tr>
    <td>(BG - <?= $item['id'] ?>) <?= $item['ten_nha_cc_kh'] ?></td>
    <td><?= $item['don_gia'] ?></td>
</tr>

<?}?>