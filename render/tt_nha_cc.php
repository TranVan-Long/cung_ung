<?

include("config.php");
$id = $_POST['id'];

if($id != ""){
    $item = mysql_fetch_assoc((new db_query("SELECT `id`, `ten_nha_cc_kh`, `dia_chi_lh`, `sp_cung_ung` FROM `nha_cc_kh` WHERE `id` = $id ")) -> result);
?>

<div class="form-row left">
    <div class="form-col-50 no-border mb_15 left">
        <p class="d-block w-100">Tên nhà cung cấp</p>
        <p class="d-block w-100 text-bold mt-10" id="ncc-ten"><?= $item['ten_nha_cc_kh'] ?></p>
    </div>
    <div class="form-col-50 no-border mb_15 right">
        <p class="d-block w-100">Địa chỉ</p>
        <p class="d-block w-100 text-bold mt-10" id="ncc-dia-chi"><?= $item['dia_chi_lh'] ?></p>
    </div>
</div>
<div class="form-row left">
    <div class="form-col-50 no-border mb_15 left">
        <p class="d-block w-100">Sản phẩm cung ứng</p>
        <p class="d-block w-100 text-bold mt-10" id="ncc-san-pham"><?= $item['sp_cung_ung'] ?></p>
    </div>
</div>

<?}else{?>

<div class="form-row left">
    <div class="form-col-50 no-border mb_15 left">
        <p class="d-block w-100">Tên nhà cung cấp</p>
        <p class="d-block w-100 text-bold mt-10" id="ncc-ten">&nbsp;</p>
    </div>
    <div class="form-col-50 no-border mb_15 right">
        <p class="d-block w-100">Địa chỉ</p>
        <p class="d-block w-100 text-bold mt-10" id="ncc-dia-chi">&nbsp;</p>
    </div>
</div>
<div class="form-row left">
    <div class="form-col-50 no-border mb_15 left">
        <p class="d-block w-100">Sản phẩm cung ứng</p>
        <p class="d-block w-100 text-bold mt-10" id="ncc-san-pham">&nbsp;</p>
    </div>
</div>
<?}?>
