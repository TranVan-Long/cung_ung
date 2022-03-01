function sl_doi(id) {
    var so_luong = Number($(id).val());
    var don_gia = Number($(id).parents(".item").find(".don_gia").val());
    var thue_vat = Number($(id).parents(".item").find(".thue_vat").val());
    var tongtien = 0;
    var trong = "";
    var tongsvat = 0;
    if (so_luong != "" && don_gia != "" && so_luong != 0) {
        tongtien = don_gia * so_luong;
        $(id).parents(".item").find(".tong_trvat").val(tongtien);
        if (thue_vat != "" || thue_vat != 0) {
            tongsvat = tongtien + (tongtien * (thue_vat / 100));
            $(id).parents(".item").find(".tong_svat").val(tongsvat);
        } else {
            $(id).parents(".item").find(".tong_svat").val(tongtien);
        }
    } if (so_luong == "" || so_luong == 0) {
        $(id).parents(".item").find(".tong_trvat").val(trong);
        $(id).parents(".item").find(".tong_svat").val(trong);
    }
};


function dg_doi(id) {
    var don_gia = Number($(id).val());
    var so_luong = Number($(id).parents(".item").find(".so_luong").val());
    var thue_vat = Number($(id).parents(".item").find(".thue_vat").val());
    var tongtien = 0;
    var trong = "";
    var tongsvat = 0;
    if (don_gia != "" && so_luong != "" && don_gia != 0) {
        tongtien = don_gia * so_luong;
        $(id).parents(".item").find(".tong_trvat").val(tongtien);
        if (thue_vat != "" || thue_vat != 0) {
            tongsvat = tongtien + (tongtien * (thue_vat / 100));
            $(id).parents(".item").find(".tong_svat").val(tongsvat);
        } else {
            $(id).parents(".item").find(".tong_svat").val(tongtien);
        }
    } else if (don_gia == "" || don_gia == 0) {
        $(id).parents(".item").find(".tong_trvat").val(trong);
        $(id).parents(".item").find(".tong_svat").val(trong);
    }
};

function thue_doi(id) {
    var thue_vat = Number($(id).val());
    var so_luong = Number($(id).parents(".item").find(".so_luong").val());
    var don_gia = Number($(id).parents(".item").find(".don_gia").val());
    var tongsvat = 0;
    var trong = "";
    if (thue_vat != "" && thue_vat != 0) {
        if (don_gia != "" && so_luong != "") {
            tongsvat = (don_gia * so_luong) + (don_gia * so_luong * (thue_vat / 100));
            $(id).parents(".item").find(".tong_svat").val(tongsvat);
        } else if ((don_gia == "" && so_luong != "") || (don_gia != "" && so_luong == "")) {
            $(id).parents(".item").find(".tong_svat").val(trong);
        }
    } if (thue_vat == "" || thue_vat == 0) {
        if (don_gia != "" && so_luong != "") {
            tongsvat = don_gia * so_luong;
            $(id).parents(".item").find(".tong_svat").val(tongsvat);
        } else if ((don_gia == "" && so_luong != "") || (don_gia != "" && so_luong == "")) {
            $(id).parents(".item").find(".tong_svat").val(trong);
        }
    }
};

function tong_vt() {
    var truoc_vat = $(".tong_svat");
    var tong_tien = 0;
    for (var i = 0; i < truoc_vat.length; i++) {
        if (parseInt(truoc_vat[i].value))
            tong_tien += parseInt(truoc_vat[i].value);
    }

    // document.getElementById('tong_truoc_vat').value = tong_tien;
    $("#tong_truoc_vat").val(tong_tien);
    var thue_vat = Number($('.thue_vat_tong').val())
    var tien_thue = (tong_tien * thue_vat) / 100;
    thue_sau_vat = tong_tien + tien_thue;
    $('#tong_sau_vat').val(thue_sau_vat);
};
function baoLanh(){
    var phan_tram = Number($(".pt_bao_lanh").val());
    var hd_sau_vat = Number($("#tong_sau_vat").val());
    var tien_bl = hd_sau_vat * phan_tram /100;
    $('.gia_tri_bl').val(tien_bl);
};
function baoHanh(){
    var phan_tram = Number($(".pt_bao_hanh").val());
    var hd_sau_vat = Number($("#tong_sau_vat").val());
    var tien_bh = hd_sau_vat * phan_tram /100;
    $('.gia_tri_bh').val(tien_bh);
};

// var formatter = new Intl.NumberFormat('vi-VN', {
//     style: 'currency',
//     currency: 'VND',
//   });
