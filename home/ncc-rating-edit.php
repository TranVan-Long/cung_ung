<?php

include("config.php");
include("../includes/icon.php");
$date = strtotime(date('Y-m-d', time()));

if(isset($_GET['id']) && $_GET['id'] != ""){
    $id = $_GET['id'];
    $list_dg = mysql_fetch_assoc((new db_query("SELECT `id`, `ngay_danh_gia`, `nguoi_danh_gia`, `phong_ban`, `id_nha_cc`, `danh_gia_khac`, `tong_diem` FROM `danh_gia` WHERE `id`='$id' ")) -> result);

    $id_ncc = $list_dg['id_nha_cc'];

    if(isset($_COOKIE['acc_token']) && isset($_COOKIE['rf_token']) && isset($_COOKIE['role']) && $_COOKIE['role'] == 2){
        $curl = curl_init();
        $token = $_COOKIE['acc_token'];
        curl_setopt($curl, CURLOPT_URL, 'https://chamcong.24hpay.vn/service/list_all_my_partner.php?get_all=true');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token));
        $response = curl_exec($curl);
        curl_close($curl);

        $data_list = json_decode($response,true);
        $data_list_nv =$data_list['data']['items'];
        $count = count($data_list_nv);

        $user = [];
        for ($i = 0; $i < $count; $i++){
            $item1 = $data_list_nv[$i];
            $user[$item1["ep_id"]] = $item1;
        }

        $ep_name = $user[$list_dg['nguoi_danh_gia']]['ep_name'];
        $phong_ban = $user[$list_dg['nguoi_danh_gia']]['dep_name'];
    }

   $list_nhacc = new db_query("SELECT `id`, `ten_nha_cc_kh`, `phan_loai` FROM `nha_cc_kh` WHERE `phan_loai` = 1 ");

   $list_ncc = mysql_fetch_assoc((new db_query("SELECT `id`, `ten_nha_cc_kh`, `dia_chi_lh`, `sp_cung_ung`, `phan_loai`
                                                FROM `nha_cc_kh` WHERE `phan_loai` = 1 AND `id` = '$id_ncc' ")) -> result);

    $list_ctiet_dg = new db_query(" SELECT c.`id`, c.`id_danh_gia`, c.`id_tieu_chi`, c.`diem_danh_gia`, c.`tong_diem_danh_gia`, c.`danh_gia_chi_tiet`, t.`he_so`, t.`kieu_gia_tri`
                                    FROM `chi_tiet_danh_gia` AS c
                                    INNER JOIN `tieu_chi_danh_gia` AS t ON c.`id_tieu_chi` = t.`id`
                                    WHERE c.`id_danh_gia` = $id ");
    $co = mysql_fetch_assoc((new db_query("SELECT count(`id`) AS cou FROM `chi_tiet_danh_gia` WHERE `id_danh_gia` = $id ")) -> result)['cou'];

}else{
    header('location: /danh-gia-nha-cung-cap.html');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chỉnh sửa phiếu đánh giá</title>
    <link href="https://timviec365.vn/favicon.ico" rel="shortcut icon"/>

    <link rel="preload" href="../fonts/Roboto-Bold.woff2" as="font" type="font/woff2" crossorigin="anonymous"/>
    <link rel="preload" href="../fonts/Roboto-Medium.woff2" as="font" type="font/woff2" crossorigin="anonymous"/>
    <link rel="preload" href="../fonts/Roboto-Regular.woff2" as="font" type="font/woff2" crossorigin="anonymous"/>

    <link href="../css/select2.min.css" rel="stylesheet"/>

    <link rel="preload" as="style" rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" media="all" href="../css/app.css" media="all" onload="if (media != 'all')media='all'">
    <link rel="preload" as="style" rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" media="all" href="../css/style.css" media="all" onload="if (media != 'all')media='all'">
</head>

<body>
<div class="main-container">
    <?php include("../includes/sidebar.php") ?>
    <div class="container">
        <div class="header-container">
            <?php include('../includes/ql_header_nv.php') ?>
        </div>
        <div class="content">
            <div class="left mt-25">
                <a class="text-black" href="danh-gia-nha-cung-cap.html"><?php echo $ic_lt ?> Quay lại</a>
                <p class="page-title mt_20 mb_10">Chỉnh sửa phiếu đánh giá nhà cung cấp</p>
            </div>
            <form action="" class="main-form">
                <div class="w-100 left mt-10">
                    <div class="form-control edit-form">
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <label>Số phiếu</label>
                                <input type="text" name="so_phieu" value="PH-<?= $list_dg['id'] ?>" readonly>
                            </div>
                            <div class="form-col-50 no-border right mb_15">
                                <label>Ngày đánh giá<span class="text-red">&ast;</span></label>
                                <input type="date" name="ngay_danh_gia" value="<?= date('Y-m-d', $list_dg['ngay_danh_gia']) ?>" readonly>
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <label>Người đánh giá<span class="text-red">&ast;</span></label>
                                <input type="text" name="nguoi_danh_gia" placeholder="Nhập người đánh giá"
                                       value="<?= $ep_name ?>" readonly>
                            </div>
                            <div class="form-col-50 no-border right mb_15">
                                <label>Phòng ban</label>
                                <input type="text" name="phong_ban" placeholder="Nhập phòng ban" value="<?= $phong_ban ?>" readonly>
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15 v-select2">
                                    <label for="nha-cung-cap">Nhà cung cấp<span class="text-red">&ast;</span></label>
                                    <select class="share_select" name="nha_cung_cap" id="nha-cung-cap">
                                        <? while($row = mysql_fetch_assoc($list_nhacc -> result)) { ?>
                                            <option value="<?= $row['id'] ?>" <?= ($row['id'] == $list_dg['id_nha_cc']) ? "selected" : "" ?>><?= $row['ten_nha_cc_kh'] ?></option>
                                        <?}?>
                                    </select>
                            </div>
                        </div>
                        <div class="detail_nhacc w_100 float_l">
                            <div class="form-row left">
                                <div class="form-col-50 no-border left mb_15">
                                    <p>Tên nhà cung cấp</p>
                                    <p class="cr_weight mt-10"><?= $list_ncc['ten_nha_cc_kh'] ?></p>
                                </div>
                                <div class="form-col-50 no-border right mb_15">
                                    <p>Địa chỉ</p>
                                    <p class="cr_weight mt-10"><?= $list_ncc['dia_chi_lh'] ?></p>
                                </div>
                            </div>
                            <div class="form-row left">
                                <div class="form-col-50 no-border left mb_15">
                                    <p>Sản phẩm cung ứng</p>
                                    <p class="cr_weight mt-10"><?= $list_ncc['sp_cung_ung'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-50 no-border left mb_15">
                                <p>Điểm đánh giá</p>
                                <p class="cr_weight mt-10 tong_diem_dg"><?= $list_ncc['tong_diem'] ?></p>
                            </div>
                        </div>
                        <div class="form-row left">
                            <div class="form-col-100 no-border left mb_15">
                                <label>Đánh giá khác</label>
                                <textarea name="danh_gia_khac" placeholder="Nhập đánh giá khác"><?= $list_dg['danh_gia_khac'] ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mt-50 left w-100">
                        <p class="text-blue link-text d-inline text-500" id="add-ratting-ruler">&plus; Thêm tiêu chí
                            đánh giá</p>
                        <div class="table-wrapper mt-10">
                            <div class="table-container table-1252">
                                <div class="tbl-header">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th class="w-5" rowspan="2"></th>
                                            <th class="w-10" rowspan="2">STT</th>
                                            <th class="w-20" rowspan="2">Tiêu chí đánh giá</th>
                                            <th class="w-10" rowspan="2">Hệ số</th>
                                            <th class="w-10" rowspan="2">Thang điểm</th>
                                            <th colspan="3" scope="colgroup" class="border-bottom-w">Đánh giá</th>
                                        </tr>
                                        <tr class="border-top-w">
                                            <th class="w-15" scope="colgroup">Điểm đánh giá</th>
                                            <th class="w-15" scope="colgroup">Điểm</th>
                                            <th class="w-15" scope="colgroup">Đánh giá chi tiết</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="tbl-content table-2-row">
                                    <table>
                                        <tbody id="ratting-ruler" data="<?= $co ?>">
                                            <? $stt = 1; $x0 = 1; $x1 = 1;
                                            while($row = mysql_fetch_assoc($list_ctiet_dg -> result)) {
                                                $a = $x1++;
                                                $id_tieu_chi = $row['kieu_gia_tri'];
                                                ?>
                                            <tr class="item" data="<?= $x0++ ?>" data1="<?= $row['id'] ?>" >
                                                <td class="w-5">
                                                    <p class="removeItem_tc"><i class="ic-delete remove_btn" data-id="<?= $row['id'] ?>"></i></p>
                                                    <input type="hidden" name="id_tc" value="<?= $row['id'] ?>">
                                                </td>
                                                <td class="w-10"><p class="one_stt"><?= $stt++ ?></p></td>
                                                <td class="w-20">
                                                    <div class="v-select2">
                                                        <select name="tieu_chi" class="share_select ten_tieuchi" onchange="thay_doi()">
                                                            <option value="">Chọn tiêu chí đánh giá</option>
                                                            <?  $id_tc = $row['id_tieu_chi'];
                                                                $list_tc = new db_query("SELECT `id`, `tieu_chi`, `he_so`, `kieu_gia_tri` FROM `tieu_chi_danh_gia`");
                                                                while($item_o = mysql_fetch_assoc($list_tc -> result)){
                                                            ?>
                                                                <option value="<?= $item_o['id'] ?>" <?= ($item_o['id'] == $id_tc) ? "selected" : "" ?>><?= $item_o['tieu_chi'] ?></option>
                                                            <?}?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td class="w-10">
                                                    <p class="he_so" data="<?= $row['he_so'] ?>">x<?= $row['he_so'] ?></p>
                                                </td>
                                                <td class="w-10">
                                                    <?  $id_tcd = $row['id_tieu_chi'];
                                                        $maxd = new db_query("SELECT MAX(`gia_tri`) AS maxd FROM `ds_gia_tri_dg` WHERE `id_tieu_chi` = $id_tcd ");
                                                        $maxo = mysql_fetch_assoc($maxd -> result)['maxd'];
                                                    ?>
                                                    <p><?= $maxo ?></p>
                                                </td>
                                                <td class="w-15">
                                                    <input type="text" name="diem_dgia" class="diem_dgia" data-id="<?= $row['id'] ?>" data="<?= $row['he_so'] ?>" value="<?= $row['diem_danh_gia'] ?>">
                                                </td>
                                                <td class="w-15">
                                                    <input type="text" name="tongdiem_dg" class="hidden_bd tongd_l" value="<?= $row['tong_diem_danh_gia'] ?>" readonly >
                                                </td>
                                                <td class="w-15">
                                                    <input type="text" name="dgia_ctiet" value="<?= $row['danh_gia_chi_tiet'] ?>">
                                                </td>
                                            </tr>
                                            <?}?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-100 left">
                    <div class="control-btn right">
                        <p class="v-btn btn-outline-blue modal-btn mr-20 mt-20" data-target="cancel">Hủy</p>
                        <button type="button" class="v-btn btn-blue mt-20 submit-btn" data-id="<?= $list_dg['id'] ?>">Xong</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal text-center" id="cancel">
        <div class="m-content">
            <div class="m-head ">
                Thông báo <span class="dismiss cancel">&times;</span>
            </div>
            <div class="m-body">
                <p>Bạn có chắc chắn muốn hủy việc chỉnh sửa phiếu đánh giá?</p>
                <p>Các thông tin bạn đã nhập sẽ không được lưu.</p>
            </div>
            <div class="m-foot d-inline-block">
                <div class="left mb_10">
                    <p class="v-btn btn-outline-blue left cancel">Hủy</p>
                </div>
                <div class="right mb_10">
                    <a href="danh-gia-nha-cung-cap.html" class="v-btn sh_bgr_six share_clr_tow right">Đồng ý</a>
                </div>
            </div>
        </div>
    </div>
    <?php include "../modals/modal_logout.php" ?>
    <? include("../modals/modal_menu.php") ?>
</div>
</body>
<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
<script src="../js/select2.min.js"></script>
<script type="text/javascript" src="../js/style.js"></script>
<script type="text/javascript" src="../js/app.js"></script>
<script>

    $("#add-ratting-ruler").click(function () {
        var x= 1;
        $('.one_stt').each( function() {
            $(this).text(x);
            x++;
        });

        $.ajax({
            url: '../ajax/them_tc_dg_ncc.php',
            type: 'POST',
            data:{
                x: x,
            },
            success: function(data){
                $("#ratting-ruler").append(data);
            }
        });
    });

    $('#nha-cung-cap').on('change',function (){
        var ncc = $(this).val();
        $.ajax({
            url: '../render/tt_nha_cc.php',
            type: 'POST',
            data:{
                id: ncc,
            },
            success: function(data){
                $('.detail_nhacc').html(data);
            }
        })
    });

    $(document).on('click', function(){
        $(".diem_dgia").change(function(){
            var diem_dg = Number($(this).val());
            var he_so = Number($(this).attr("data"));
            var _this = $(this);
            var c = 0;
            if(diem_dg != 0){
                c = diem_dg * he_so;
                var tong_diem = _this.parents(".item").find(".tongd_l").val(c);
            }else{
                var tong_diem = _this.parents(".item").find(".tongd_l").val(c);
            }
        });

        // var tong_one = document.getElementsByName("tongdiem_dg");
        // var t_one = "";
        // for(var o = 0; o < tong_one.length; o++){
        //     if(tong_one[o] != ""){
        //         t_one += tong_one[o].value + '_';
        //     }
        // }

        // var tong_two = document.getElementsByName("tdiem_dg");
        // var t_two = "";
        // for(var p = 0; p < tong_two.length; p++){
        //     if(tong_two[p] != ""){
        //         t_two += tong_two[p].value + '_';
        //     }
        // }

        // $.ajax({
        //     url: '../ajax/tong_diem_tieu_chi.php',
        //     type: 'POST',
        //     data:{
        //         tong_one: t_one,
        //         tong_two: t_two,
        //     },
        //     success: function(data){
        //         $(".tong_diem_dg").text(data);
        //     }
        // })
    });

    function thay_doi(){
        $('.ten_tieuchi').on('change', function(){
            var id_tc = $(this).val();
            var _this = $(this);
            var x=  _this.parent().parent().parent().attr("data");
            var id = _this.parent().parent().parent().attr("data1");
            $.ajax({
                url: '../render/dg_tieu_chi_ncc.php',
                type: 'POST',
                data:{
                    id_tc: id_tc,
                    x: x,
                },
                success: function(data){
                    _this.parent().parent().parent().html(data);
                }
            });
        });
    };

    $(".remove_btn").click(function(){
        var id = $(this).attr("data-id");
        $.ajax({
            url: '../ajax/xoa-tcdg-nhacc.php',
            type: 'POST',
            data: {
                id: id,
            },
            success: function(data){
                window.location.reload();
            }
        })
    })

    $('.submit-btn').click(function () {
        var form = $('.main-form');
        form.validate({
            errorPlacement: function (error, element) {
                error.appendTo(element.parent('.form-col-50'));
                error.wrap('<span class="error">');
            },
            rules: {
                ngay_lap_phieu: {
                    required: true,
                },
                ngay_danh_gia: {
                    required: true,
                },
                nguoi_danh_gia: {
                    required: true,
                },
                nha_cung_cap: {
                    required: true,
                }

            },
            messages: {
                ngay_lap_phieu: {
                    required: "Ngày lập phiếu không được để trống.",
                },
                ngay_danh_gia: {
                    required: "Ngày đánh giá không được để trống.",
                },
                nguoi_danh_gia: {
                    required: "Người đánh giá không được để trống.",
                },
                nha_cung_cap: {
                    required: "Vui lòng chọn nhà cung cấp.",
                }
            }
        });
        if (form.valid() === true) {
            var nha_cc = $("select[name='nha_cung_cap']").val();
            var dg_khac = $("textarea[name='danh_gia_khac']").val();
            var id_dg = $(this).attr("data-id");
            var user_id = "<?= $_COOKIE['user'] ?>";

            // danh gia cu
            var id_ct = document.getElementsByName("id_tc");
            var id = "";
            for(var t = 0; t < id_ct.length; t++){
                if(id_ct[t] != ""){
                    id += id_ct[t].value + '_';
                }
            }

            var tieu_chi = document.getElementsByName("tieu_chi");
            var tc = "";
            for(var i = 0; i < tieu_chi.length; i++){
                if(tieu_chi[i] != ""){
                    tc += tieu_chi[i].value + '_';
                }
            }

            var diem_dg = document.getElementsByName("diem_dgia");
            var dg = "";
            for(var j = 0; j < diem_dg.length; j++){
                if(diem_dg[j] != ""){
                    dg += diem_dg[j].value + '_';
                }
            }

            var tongdiem = document.getElementsByName("tongdiem_dg");
            var td = "";
            for(var k = 0; k < tongdiem.length; k++){
                if(tongdiem[k] != ""){
                    td += tongdiem[k].value + '_';
                }
            }

            var dg_ctiet = document.getElementsByName("dgia_ctiet");
            var ct = "";
            for(var l = 0; l < dg_ctiet.length; l++){
                ct += dg_ctiet[l].value + '_';
            }

            // them moi danh gia
            var new_tc = document.getElementsByName("ten_tchi_dg");
            var n_tc = "";
            for(var i = 0; i < new_tc.length; i++){
                if(new_tc[i] != ""){
                    n_tc += new_tc[i].value + '_';
                }
            }

            var new_diem_dg = document.getElementsByName("diem_danh_gia");
            var n_dg = "";
            for(var j = 0; j < new_diem_dg.length; j++){
                if(new_diem_dg[j] != ""){
                    n_dg += new_diem_dg[j].value + '_';
                }
            }

            var new_tongd = document.getElementsByName("tdiem_dg");
            var n_td = "";
            for(var k = 0; k < new_tongd.length; k++){
                if(new_tongd[k] != ""){
                    n_td += new_tongd[k].value + '_';
                }
            }

            var new_dg_ctiet = document.getElementsByName("dg_ctiet");
            var n_ct = "";
            for(var l = 0; l < new_dg_ctiet.length; l++){
                n_ct += new_dg_ctiet[l].value + '_';
            }

            $.ajax({
                url: '../ajax/sua_dg_nhacc.php',
                type: 'POST',
                data:{
                    id_dg: id_dg,
                    nha_cc: nha_cc,
                    dg_khac: dg_khac,
                    user_id: user_id,
                    id: id,
                    id_tc: tc,
                    diem_dg: dg,
                    tongdiem: td,
                    dg_ctiet: ct,
                    new_tc: n_tc,
                    new_dg: n_dg,
                    new_tongd: n_td,
                    new_dgct: n_ct,

                },
                success: function(data){
                    if(data == ""){
                        alert("Bạn sửa đánh giá thành công");
                        window.location.href = '/danh-gia-nha-cung-cap.html';
                    }else{
                        alert(data);
                    }
                }
            })
        }
    });


</script>
</html>