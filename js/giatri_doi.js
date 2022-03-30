function sl_doi(id) {
    var so_luong = Number($(id).val());
    var don_gia = Number($(id).parents('.item').find('.don_gia').val())
    var thue_vat = Number($(id).parents('.item').find('.thue_vat').val())
    var tongtien = 0
    var trong = ''
    var tongsvat = 0
    if (so_luong != '' && don_gia != '' && so_luong != 0) {
        tongtien = don_gia * so_luong
        $(id).parents('.item').find('.tong_trvat').val(tongtien)
        if (thue_vat != '' || thue_vat != 0) {
            tongsvat = tongtien + (tongtien * (thue_vat / 100))
            $(id).parents('.item').find('.tong_svat').val(tongsvat)
        } else {
            $(id).parents('.item').find('.tong_svat').val(tongtien)
        }
    }
    if (so_luong == '' || so_luong == 0) {
        $(id).parents('.item').find('.tong_trvat').val(trong)
        $(id).parents('.item').find('.tong_svat').val(trong)
    }

    hient_thi(id);
    tong_vt();
    baoHanh();
}

function dg_doi(id) {
    var don_gia = Number($(id).val())
    var so_luong = Number($(id).parents('.item').find('.so_luong').val())
    var thue_vat = Number($(id).parents('.item').find('.thue_vat').val())
    var tongtien = 0
    var trong = ''
    var tongsvat = 0
    if (don_gia != '' && so_luong != '' && don_gia != 0) {
        tongtien = don_gia * so_luong
        $(id).parents('.item').find('.tong_trvat').val(tongtien)
        if (thue_vat != '' || thue_vat != 0) {
            tongsvat = tongtien + (tongtien * (thue_vat / 100))
            $(id).parents('.item').find('.tong_svat').val(tongsvat)
        } else {
            $(id).parents('.item').find('.tong_svat').val(tongtien)
        }
    } else if (don_gia == '' || don_gia == 0) {
        $(id).parents('.item').find('.tong_trvat').val(trong)
        $(id).parents('.item').find('.tong_svat').val(trong)
    }

    hient_thi(id);
    tong_vt();
    baoHanh();
}

function thue_doi(id) {
    var thue_vat = Number($(id).val())
    var so_luong = Number($(id).parents('.item').find('.so_luong').val())
    var don_gia = Number($(id).parents('.item').find('.don_gia').val())
    var tongsvat = 0
    var trong = ''
    if (thue_vat != '' && thue_vat != 0) {
        if (don_gia != '' && so_luong != '') {
            tongsvat = (don_gia * so_luong) + (don_gia * so_luong * (thue_vat / 100))
            $(id).parents('.item').find('.tong_svat').val(tongsvat)
        } else if ((don_gia == '' && so_luong != '') || (don_gia != '' && so_luong == '')) {
            $(id).parents('.item').find('.tong_svat').val(trong)
        }
    };
    if (thue_vat == '' || thue_vat == 0) {
        if (don_gia != '' && so_luong != '') {
            tongsvat = don_gia * so_luong
            $(id).parents('.item').find('.tong_svat').val(tongsvat)
        } else if ((don_gia == '' && so_luong != '') || (don_gia != '' && so_luong == '')) {
            $(id).parents('.item').find('.tong_svat').val(trong)
        }
    };
    tong_vt();
    baoHanh();
}

function tong_vt() {
    var truoc_vat = $('.tong_svat')
    var tong_tien = 0
    for (var i = 0; i < truoc_vat.length; i++) {
        if (parseInt(truoc_vat[i].value))
            tong_tien += parseInt(truoc_vat[i].value)
    };
    // document.getElementById('tong_truoc_vat').value = tong_tien
    $('#tong_truoc_vat').val(tong_tien)
    var thue_vat = Number($('.thue_vat_tong').val())
    var tien_thue = (tong_tien * thue_vat) / 100
    thue_sau_vat = tong_tien + tien_thue
    $('#tong_sau_vat').val(thue_sau_vat);
    baoHanh();
}

function baoLanh() {
    var phan_tram = Number($('.pt_bao_lanh').val())
    var hd_sau_vat = Number($('#tong_sau_vat').val())
    var tien_bl = hd_sau_vat * phan_tram / 100
    $('.gia_tri_bl').val(tien_bl)
}

function baoHanh() {
    var phan_tram = Number($('.pt_bao_hanh').val())
    var hd_sau_vat = Number($('#tong_sau_vat').val())
    var tien_bh = hd_sau_vat * phan_tram / 100
    $('.gia_tri_bh').val(tien_bh)
}

function phanTram(num1, num2) {
    return num1 / num2 * 100;
}

function hient_thi(id) {
    $(id).each(function () {
        var don_gia1 = $(id).parents('.item').find('.don_gia').val()
        var so_luong1 = $(id).parents('.item').find('.so_luong').val()
        if (don_gia1 != '' && so_luong1 != '') {
            $(id).parents('.item').find('.thue_vat').removeAttr('readonly')
        } else if ((don_gia1 == '' && so_luong1 != '') || (don_gia1 != '' && so_luong1 == '')) {
            $(id).parents('.item').find('.thue_vat').attr('readonly', true)
        }
    })
}

function so_tien_doi(id) {
    var so_tien = Number($(id).val());
    var ty_gia = Number($(".ty_gia").val());
    var gia_qdoi = 0;
    if (so_tien != "" && ty_gia != "") {
        gia_qdoi = so_tien * ty_gia;
        $(".gia_qdoi").val(gia_qdoi);
    }
}

function ty_gia_doi(id) {
    var so_tien = Number($(".so_tien").val());
    var ty_gia = Number($(id).val());
    var gia_qdoi = 0;
    if (so_tien != "" && ty_gia != "") {
        gia_qdoi = so_tien * ty_gia;
        $(".gia_qdoi").val(gia_qdoi);
    }
}

function hinhThucChange(id) {
    var hinh_thuc = $(id).val();
    if (hinh_thuc == 1) {
        $(id).parents('.item').find(".tb_don_vi_tinh").val("Giờ");
        $(id).parents('.item').find(".tb_khoi_luong").attr("readonly", true);
        $(id).parents('.item').find(".date1").attr("type", "time");
        $(id).parents('.item').find(".date2").attr("type", "time");
        $(id).parents('.item').find(".date1").attr("readonly", false);
        $(id).parents('.item').find(".date2").attr("readonly", false);

    } else if (hinh_thuc == 2) {
        $(id).parents('.item').find(".tb_don_vi_tinh").val("Ngày");
        $(id).parents('.item').find(".tb_khoi_luong").attr("readonly", true);
        $(id).parents('.item').find(".date1").attr("type", "date");
        $(id).parents('.item').find(".date2").attr("type", "date");
        $(id).parents('.item').find(".date1").attr("readonly", false);
        $(id).parents('.item').find(".date2").attr("readonly", false);

    } else if (hinh_thuc == 3) {
        $(id).parents('.item').find(".tb_don_vi_tinh").val("Tháng");
        $(id).parents('.item').find(".tb_khoi_luong").attr("readonly", true);
        $(id).parents('.item').find(".date1").attr("type", "month");
        $(id).parents('.item').find(".date2").attr("type", "month");
        $(id).parents('.item').find(".date1").attr("readonly", false);
        $(id).parents('.item').find(".date2").attr("readonly", false);

    } else if (hinh_thuc == 4) {
        $(id).parents('.item').find(".tb_don_vi_tinh").val("Ca");
        $(id).parents('.item').find(".tb_khoi_luong").attr("readonly", false);
        $(id).parents('.item').find(".date1").attr("readonly", true);
        $(id).parents('.item').find(".date2").attr("readonly", true);

    } else if (hinh_thuc == 5) {
        $(id).parents('.item').find(".tb_don_vi_tinh").val("Công việc");
        $(id).parents('.item').find(".tb_khoi_luong").attr("readonly", false);
        $(id).parents('.item').find(".date1").attr("readonly", true);
        $(id).parents('.item').find(".date2").attr("readonly", true);

    } else {
        $(id).parents('.item').find(".tb_don_vi_tinh").val("");
        $(id).parents('.item').find(".tb_khoi_luong").attr("readonly", true);
        $(id).parents('.item').find(".date1").attr("readonly", false);
        $(id).parents('.item').find(".date2").attr("readonly", false);

    }
};

function khoiLuong(id) {
    var ngay1 = $(id).parents('.item').find('.date1').val();
    var ngay2 = $(id).parents('.item').find('.date2').val();
    var hinh_thuc_thue = $(id).parents('.item').find('.tb_hinh_thuc_thue').val();
    var kl_dukien = 0;
    var thanh_tien = 0;
    if (hinh_thuc_thue == 1) {
        var hours = parseInt(ngay2.split(':')[0], 10) - parseInt(ngay1.split(':')[0], 10);
        if (hours < 0) hours = 24 + hours;
        kl_dukien = hours / 8;
        $(id).parents('.item').find('.tb_khoi_luong').val(kl_dukien);
    } else if (hinh_thuc_thue == 2) {
        var startDate = new Date(ngay1);
        var endDate = new Date(ngay2);
        if (startDate > endDate) {
            alert("Ngày bắt đầu thuê không được lớn hơn ngày kết thúc.")
        } else if (startDate < endDate) {
            var sl = $(id).parents('.item').find(".tb_so_luong").val();
            var msPerDay = 1000 * 60 * 60 * 24;
            var millisBetween = endDate.getTime() - startDate.getTime();
            var days = millisBetween / msPerDay;
            var kl_dukien = (sl * (Math.floor(days)));
            $(id).parents('.item').find('.tb_khoi_luong').val(kl_dukien);
        } else if (startDate = endDate) {
            $(id).parents('.item').find('.tb_khoi_luong').val(1);
        }
    } else if (hinh_thuc_thue == 3) {
        var date1 = new Date(ngay1);
        var month = date1.getMonth();
        var year = date1.getFullYear();
        dayOfMonth1 = new Date(year, month, 0).getDate();

        var date2 = new Date(ngay2);
        var month2 = date2.getMonth();
        var year2 = date2.getFullYear();
        dayOfMonth2 = new Date(year2, month2, 0).getDate();
        if (ngay2 != "") {
            if (ngay1 > ngay2) {
                alert("Tháng bắt đầu không được lớn hơn tháng kết thúc.");
            } else if (ngay1 == ngay2) {
                kl_dukien = dayOfMonth1;
                $(id).parents('.item').find('.tb_khoi_luong').val(kl_dukien);
            } else if (ngay1 < ngay2) {
                kl_dukien = dayOfMonth1 + dayOfMonth2;
                $(id).parents('.item').find('.tb_khoi_luong').val(kl_dukien);
            }
        }
    } else if (hinh_thuc_thue == 4 || hinh_thuc_thue == 5) {
        kl_dukien = $(id).parents('.item').find('.tb_so_luong').val();
        $(id).parents('.item').find('.tb_khoi_luong').val(kl_dukien);

    }
    var han_muc = $(id).parents('.item').find(".tb_han_muc").val();
    var don_gia_thue = $(id).parents('.item').find(".tb_don_gia").val();
    var phu_troi = $(id).parents('.item').find(".tb_don_gia_ca_may").val();
    if (kl_dukien > han_muc) {
        var vuot_han_muc = kl_dukien - han_muc;
        thanh_tien = han_muc * don_gia_thue + vuot_han_muc * phu_troi;
        $(id).parents('.item').find(".tb_thanh_tien").val(thanh_tien);
    } else {
        thanh_tien = kl_dukien * don_gia_thue;
        $(id).parents('.item').find(".tb_thanh_tien").val(thanh_tien);
    }
};

function thanhTien() {
    var tong_thanh_tien = 0;
    var all_thanh_tien = new Array();
    $(".tb_thanh_tien").each(function() {
        var thanh_tien = $(this).val();
        if (thanh_tien != "") {
            all_thanh_tien.push(thanh_tien);
        }
    });
    for (var i = 0; i < all_thanh_tien.length; i++) {
        tong_thanh_tien += parseInt(all_thanh_tien[i]);
    }
    $(".tong_tien").val(tong_thanh_tien);
}

// ho so thanh toan
function sl_hs_doi(id) {
    var kl_ky_nay = Number($(id).val());
    var tong_sluong = Number($(id).parents("tr").find(".tong_sluong").text());
    var don_gia = Number($(id).parents("tr").find(".don_gia").text());
    var tong_tienvt = Number($(id).parents("tr").find(".tong_tienvt").text());
    var thue_vt = Number($(id).parents("tr").find("input[name='kl_luy_ke_ky_truoc']").attr("data"));
    var kl_luy_ke_ky_truoc = Number($(id).parents("tr").find("input[name='kl_luy_ke_ky_truoc']").val());
    var kl_luy_ke_den_nay = Number($(id).parents("tr").find("input[name='kl_luy_ke_den_nay']").val());
    var tien_thue = Number($(id).parents("tr").find("input[name='kl_luy_ke_den_nay']").attr("data"));
    var gt_luy_ke_ky_truoc = Number($(id).parents("tr").find("input[name='gt_luy_ke_ky_truoc']").val());
    var gt_luy_ke_ky_nay = Number($(id).parents("tr").find("input[name='gt_luy_ke_ky_nay']").val());
    var gt_luy_ke_den_nay = Number($(id).parents("tr").find("input[name='gt_luy_ke_den_nay']").val());
    var tien_sthue = Number($(id).parents("tr").find("input[name='gt_luy_ke_den_nay']").attr("data"));
    var phan_tram_thuc_hien = Number($(id).parents("tr").find("input[name='phan_tram_thuc_hien']").val());
    var con_lai_so_luong = Number($(id).parents("tr").find("input[name='con_lai_so_luong']").val());
    var con_lai_gia_tri = Number($(id).parents("tr").find("input[name='con_lai_gia_tri']").val());

    if (kl_ky_nay != "") {
        kl_luy_ke_den_nay = kl_ky_nay + kl_luy_ke_ky_truoc;
        gt_luy_ke_ky_nay = kl_ky_nay * don_gia;
        gt_luy_ke_den_nay = gt_luy_ke_ky_truoc + gt_luy_ke_ky_nay;
        tien_thue = (gt_luy_ke_ky_nay * thue_vt) / 100;
        tien_sthue = gt_luy_ke_ky_nay + tien_thue;
        phan_tram_thuc_hien = (gt_luy_ke_den_nay / tong_tienvt) * 100;
        con_lai_so_luong = tong_sluong - kl_luy_ke_den_nay;
        con_lai_gia_tri = tong_tienvt - gt_luy_ke_den_nay;

        $(id).parents("tr").find("input[name='kl_luy_ke_den_nay']").val(kl_luy_ke_den_nay);
        $(id).parents("tr").find("input[name='gt_luy_ke_ky_nay']").val(gt_luy_ke_ky_nay);
        $(id).parents("tr").find("input[name='gt_luy_ke_den_nay']").val(gt_luy_ke_den_nay);
        $(id).parents("tr").find("input[name='kl_luy_ke_den_nay']").attr("data", tien_thue);
        $(id).parents("tr").find("input[name='gt_luy_ke_den_nay']").attr("data", tien_sthue);
        $(id).parents("tr").find("input[name='phan_tram_thuc_hien']").val(phan_tram_thuc_hien);
        $(id).parents("tr").find("input[name='con_lai_so_luong']").val(con_lai_so_luong);
        $(id).parents("tr").find("input[name='con_lai_gia_tri']").val(con_lai_gia_tri);
    } else {
        kl_ky_nay = 0;
        kl_luy_ke_den_nay = kl_ky_nay + kl_luy_ke_ky_truoc;
        gt_luy_ke_ky_nay = kl_ky_nay * don_gia;
        gt_luy_ke_den_nay = gt_luy_ke_ky_truoc + gt_luy_ke_ky_nay;
        tien_thue = (gt_luy_ke_ky_nay * thue_vt) / 100;
        tien_sthue = gt_luy_ke_ky_nay + tien_thue;
        phan_tram_thuc_hien = (gt_luy_ke_den_nay / tong_tienvt) * 100;
        con_lai_so_luong = tong_sluong - kl_luy_ke_den_nay;
        con_lai_gia_tri = tong_tienvt - gt_luy_ke_den_nay;

        $(id).parents("tr").find("input[name='kl_luy_ke_den_nay']").val(kl_luy_ke_den_nay);
        $(id).parents("tr").find("input[name='gt_luy_ke_ky_nay']").val(gt_luy_ke_ky_nay);
        $(id).parents("tr").find("input[name='gt_luy_ke_den_nay']").val(gt_luy_ke_den_nay);
        $(id).parents("tr").find("input[name='kl_luy_ke_den_nay']").attr("data", tien_thue);
        $(id).parents("tr").find("input[name='gt_luy_ke_den_nay']").attr("data", tien_sthue);
        $(id).parents("tr").find("input[name='phan_tram_thuc_hien']").val(phan_tram_thuc_hien);
        $(id).parents("tr").find("input[name='con_lai_so_luong']").val(con_lai_so_luong);
        $(id).parents("tr").find("input[name='con_lai_gia_tri']").val(con_lai_gia_tri);
    };

    tong_tatca();
}

function chiphi_khac(id) {
    var chi_phi_khac = Number($(id).val());
    var tong_tien = 0;
    var tong_svat = 0;

    $("input[name='gt_luy_ke_den_nay']").each(function () {
        var tiensvat = Number($(this).attr("data"));
        if (tiensvat != "") {
            tong_svat += tiensvat;
        } else {
            tiensvat = 0;
            tong_svat += tiensvat;
        }
    });

    if (chi_phi_khac != "") {
        tong_tien = tong_svat + chi_phi_khac;
    } else {
        chi_phi_khac = 0;
        tong_tien = tong_svat + chi_phi_khac;
    }

    $(".tong_tatca").text(tong_tien);


}

function tong_tatca() {
    var chi_phi_khac = Number($("input[name='chi_phi_khac']").val());
    var tong_tatca = 0;
    var tien_trvat = 0;
    var tong_thue = 0;
    var tien_svat = 0;

    $("input[name='kl_luy_ke_den_nay']").each(function () {
        var thuevat = Number($(this).attr("data"));
        if (thuevat != "") {
            tong_thue += thuevat;
        } else {
            thuevat = 0;
            tong_thue += thuevat;
        }
    });

    $(".thue_ky_nay").text(tong_thue);

    $("input[name='gt_luy_ke_ky_nay']").each(function () {
        var tientrvat = Number($(this).val());
        if (tientrvat != "") {
            tien_trvat += tientrvat;
        } else {
            tientrvat = 0;
            tien_trvat += tientrvat;
        }
    });

    $(".tong_tien_ky_nay").text(tien_trvat);

    $("input[name='gt_luy_ke_den_nay']").each(function () {
        var tientatca = Number($(this).attr("data"));
        if (tientatca != "") {
            tien_svat += tientatca;
        } else {
            tientatca = 0;
            tien_svat += tientatca;
        }
    });

    if (chi_phi_khac != "") {
        tong_tatca = tien_svat + chi_phi_khac;
    } else {
        chi_phi_khac = 0;
        tong_tatca = tien_svat + chi_phi_khac;
    }

    $(".tong_tatca").text(tong_tatca);
}