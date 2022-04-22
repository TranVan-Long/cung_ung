function sl_doi(id) {
    var don_gia_vat = $("#don_gia_vat");
    var so_luong = Number($(id).val());
    var don_gia = Number($(id).parents('.item').find('.don_gia').val())
    var tongtien = 0;
    var tien_thue = 0;
    var trong = '';
    var tongsvat = 0
    if (don_gia_vat.is(":checked") == false) {
        if (so_luong != '' && don_gia != '') {
            tongtien = don_gia * so_luong;
            $(id).parents('.item').find('.tong_trvat').val(tongtien);
            var thue_vat = Number($(id).parents('.item').find('.thue_vat').val())
            $(id).parents('.item').find('.thue_vat').attr('readonly', false);
            if (thue_vat != '' || thue_vat != 0) {
                tien_thue = tongtien * (thue_vat / 100);
                tongsvat = tongtien + (tongtien * (thue_vat / 100));
                $(id).parents('.item').find('.thue_vat').attr('data', tien_thue);
                $(id).parents('.item').find('.tong_svat').val(tongsvat);
            } else {
                $(id).parents('.item').find('.tong_svat').val(tongtien);
                $(id).parents('.item').find('.thue_vat').attr('data', tien_thue);
            }
        } else if (so_luong == '') {
            $(id).parents('.item').find('.tong_trvat').val(trong);
            $(id).parents('.item').find('.thue_vat').attr('data', tien_thue);
            $(id).parents('.item').find('.tong_svat').val(trong);
        }
        tong_vt();
        baoHanh();
    } else {
        if (so_luong != '' && don_gia != '') {
            tongtien = don_gia * so_luong;
            // console.log(tongtien);
            $(id).parents('.item').find('.tong_trvat').val(tongtien);
            if (thue_vat != '' || thue_vat != 0) {
                tien_thue = tongtien * (thue_vat / 100);
                tongsvat = tongtien + (tongtien * (thue_vat / 100));

                $(id).parents('.item').find('.thue_vat').attr('data', tien_thue);
                $(id).parents('.item').find('.tong_svat').val(tongsvat);
            } else {
                $(id).parents('.item').find('.tong_svat').val(tongtien);
                $(id).parents('.item').find('.thue_vat').attr('data', tien_thue);
            }
        }
        else if (so_luong == '') {
            $(id).parents('.item').find('.tong_trvat').val(trong);
            $(id).parents('.item').find('.thue_vat').attr('data', tien_thue);
            $(id).parents('.item').find('.tong_svat').val(trong);
        }

        tong_vt();
        baoHanh();
    }

}

function dg_doi(id) {
    var don_gia = Number($(id).val())
    var so_luong = Number($(id).parents('.item').find('.so_luong').val())
    var thue_vat = Number($(id).parents('.item').find('.thue_vat').val())
    var tongtien = 0
    var tien_thue = 0;
    var trong = ''
    var tongsvat = 0
    if (don_gia != '' && so_luong != '' && don_gia != 0) {
        tongtien = don_gia * so_luong
        $(id).parents('.item').find('.tong_trvat').val(tongtien)
        if (thue_vat != '' || thue_vat != 0) {
            tien_thue = tongtien * (thue_vat / 100);
            $(id).parents('.item').find('.thue_vat').attr('data', tien_thue);
            tongsvat = tongtien + (tongtien * (thue_vat / 100));
            $(id).parents('.item').find('.tong_svat').val(tongsvat)
        } else {
            $(id).parents('.item').find('.tong_svat').val(tongtien);
            $(id).parents('.item').find('.thue_vat').attr('data', tien_thue);
        }
    } else if (don_gia == '' || don_gia == 0) {
        $(id).parents('.item').find('.tong_trvat').val(trong);
        $(id).parents('.item').find('.thue_vat').attr('data', tien_thue);
        $(id).parents('.item').find('.tong_svat').val(trong)
    }

    // hient_thi(id);
    tong_vt();
    baoHanh();
    dongia_vat();
}

function thue_doi(id) {
    var don_gia_vat = $("#don_gia_vat");
    if (don_gia_vat.is(":checked") == false) {
        var thue_vat = Number($(id).val())
        var so_luong = Number($(id).parents('.item').find('.so_luong').val())
        var don_gia = Number($(id).parents('.item').find('.don_gia').val())
        var tongsvat = 0
        var tien_thue = 0;
        var trong = ''
        if (thue_vat != '') {
            if (don_gia != '' && so_luong != '') {
                tien_thue = don_gia * so_luong * (thue_vat / 100);
                tongsvat = (don_gia * so_luong) + tien_thue;
                $(id).attr("data", tien_thue);
                $(id).parents('.item').find('.tong_svat').val(tongsvat);
            } else if ((don_gia == '' && so_luong != '') || (don_gia != '' && so_luong == '')) {
                $(id).attr("data", tien_thue);
                $(id).parents('.item').find('.tong_svat').val(trong)
            }
        };
        if (thue_vat == '' ) {
            if (don_gia != '' && so_luong != '') {
                tongsvat = don_gia * so_luong;
                $(id).parents('.item').find('.tong_svat').val(tongsvat);
            } else if ((don_gia == '' && so_luong != '') || (don_gia != '' && so_luong == '')) {
                $(id).parents('.item').find('.tong_svat').val(trong);
            }
            $(id).attr("data", tien_thue);
        };
        tong_vt();
        baoHanh();
        dongia_vat();
    } else {
        $(id).attr("readonly", true);
    }
}

function tong_vt() {
    var tong_trvat = 0;
    var tong_tien_thue = 0;
    var tong_svat = 0;
    var don_gia_vat = $("#don_gia_vat");
    if (don_gia_vat.is(":checked")) {
        $('.thue_vat').attr('readonly', true);
        $(".thue_vat_tong").val(tong_tien_thue);
    } else {
        $('.thue_vat').attr('readonly', false);
        $(".thue_vat").each(function () {
            tien_thue = Number($(this).attr("data"));
            tong_tien_thue += tien_thue;
        });

        $(".thue_vat_tong").val(tong_tien_thue);
    }


    $(".tong_trvat").each(function () {
        tien_trvat = Number($(this).val());
        tong_trvat += tien_trvat;
    });
    $('#tong_truoc_vat').val(tong_trvat)

    $(".tong_svat").each(function () {
        tien_svat = Number($(this).val());
        tong_svat += tien_svat;
    });
    $('#tong_sau_vat').val(tong_svat);
    baoHanh();
    dongia_vat();
}

function dongia_vat(id) {
    if ($(id).is(":checked")) {
        var thue_vat = 0;
        var tong_trvat = 0;
        $(".tong_trvat").each(function () {
            var ttr = $(this).val();
            tong_trvat += Number(ttr);
            $(this).parents(".item").find(".tong_svat").val(ttr);
        })
        $('#tong_truoc_vat').val(tong_trvat);
        $('#tong_sau_vat').val(tong_trvat);

        $(".thue_vat").val(thue_vat);
        $(".thue_vat_tong").val(thue_vat);

        $(".thue_vat").attr('readonly', true);
    } else {
        $(".thue_vat").val();
        $(".thue_vat_tong").val();
        $(".thue_vat").attr('readonly', false);
    }

}

function baoLanh() {
    var phan_tram = Number($('.pt_bao_lanh').val())
    var hd_sau_vat = Number($('#tong_sau_vat').val())
    var tien_bl = hd_sau_vat * phan_tram / 100
    $('.gia_tri_bl').val(tien_bl)
    dongia_vat();
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

// function hient_thi(id) {
//     $(id).each(function () {
//         var don_gia1 = $(id).parents('.item').find('.don_gia').val()
//         var so_luong1 = $(id).parents('.item').find('.so_luong').val()
//         if (don_gia1 != '' && so_luong1 != '') {
//             $(id).parents('.item').find('.thue_vat').removeAttr('readonly')
//         } else if ((don_gia1 == '' && so_luong1 != '') || (don_gia1 != '' && so_luong1 == '')) {
//             $(id).parents('.item').find('.thue_vat').attr('readonly', true)
//         }
//     })
// }

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

    } else if (hinh_thuc == "") {
        $(id).parents('.item').find(".tb_don_vi_tinh").val("");
        $(id).parents('.item').find(".tb_khoi_luong").attr("readonly", true);
        $(id).parents('.item').find(".date1").attr("readonly", true);
        $(id).parents('.item').find(".date2").attr("readonly", true);

    }
};

function khoiLuong(id) {
    var ngay_ky = $("#ngay_ky_hd").val();
    const ngay_k = new Date(ngay_ky);
    var ngay1 = $(id).parents('.item').find('.date1').val();
    const date1 = new Date(ngay1);
    var ngay2 = $(id).parents('.item').find('.date2').val();
    const date2 = new Date(ngay2);
    var hinh_thuc_thue = $(id).parents('.item').find('.tb_hinh_thuc_thue').val();
    var sl = $(id).parents('.item').find(".tb_so_luong").val();
    var kl_dukien = 0;
    var thanh_tien = 0;
    var rong = '';
    if (hinh_thuc_thue == 1) {
        var hours = parseInt(ngay2.split(':')[0], 10) - parseInt(ngay1.split(':')[0], 10);
        if (hours < 0) hours = 12 + hours;
        kl_dukien = (hours / 8) * sl;
        // console.log(hours);
        $(id).parents('.item').find('.tb_khoi_luong').val(kl_dukien);
    } else if (hinh_thuc_thue == 2) {
        if (ngay_ky != "") {
            if (ngay_k > date1) {
                alert("Ngày bắt đầu phải lớn hơn ngày ký hợp đồng");
                $(id).val(rong);
            } else if (date1 > date2) {
                alert("Ngày bắt đầu thuê không được lớn hơn ngày kết thúc.");
                $(id).val(rong);
            } else if (date1 < date2) {
                var msPerDay = 1000 * 60 * 60 * 24;
                var millisBetween = date2.getTime() - date1.getTime();
                var days = millisBetween / msPerDay;
                var kl_dukien = (sl * (Math.floor(days)));
                $(id).parents('.item').find('.tb_khoi_luong').val(kl_dukien);
            } else if (date1 == date2) {
                $(id).parents('.item').find('.tb_khoi_luong').val(1);
            }
        } else if (ngay_ky == "") {
            alert("Nhập ngày ký hợp đồng");
            $(id).val(rong);
            $('html, body').animate({
                scrollTop: $("#ngay_ky_hd").focus().offset().top - 30
            }, 1000);
            return false;
        }
    } else if (hinh_thuc_thue == 3) {
        if (ngay2 != "") {
            if (ngay1 > ngay2) {
                alert("Tháng bắt đầu không được lớn hơn tháng kết thúc.");
            } else if (ngay1 == ngay2) {
                var month = date1.getMonth();
                var year = date1.getFullYear();
                dayOfMonth1 = new Date(year, month, 0).getDate();
                kl_dukien = dayOfMonth1 * sl;
                $(id).parents('.item').find('.tb_khoi_luong').val(kl_dukien);
            } else if (ngay1 < ngay2) {
                const oneDay = 1000 * 60 * 60 * 24;
                const diffInTime = date2.getTime() - date1.getTime();
                const diffInDays = Math.round(diffInTime / oneDay);
                kl_dukien = diffInDays * sl;
                $(id).parents('.item').find('.tb_khoi_luong').val(kl_dukien);
            }
        }

    } else if (hinh_thuc_thue == 4 || hinh_thuc_thue == 5 || hinh_thuc_thue == "") {
        kl_dukien = $(id).parents('.item').find('.tb_khoi_luong').val();
    }


    var han_muc = $(id).parents('.item').find(".tb_han_muc").val();
    var don_gia_thue = $(id).parents('.item').find(".tb_don_gia").val();
    var phu_troi = $(id).parents('.item').find(".tb_don_gia_ca_may").val();
    if (don_gia_thue > 0) {
        if (kl_dukien > han_muc) {
            thanh_tien = (han_muc * don_gia_thue) + ((kl_dukien - han_muc) * phu_troi);
            $(id).parents('.item').find(".tb_thanh_tien").val(thanh_tien);
        } else if (kl_dukien <= han_muc) {
            thanh_tien = kl_dukien * don_gia_thue;
            $(id).parents('.item').find(".tb_thanh_tien").val(thanh_tien);
        }
    }
};

function thanhTien() {
    var tong_thanh_tien = 0;
    var all_thanh_tien = new Array();
    $(".tb_thanh_tien").each(function () {
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
        if (kl_luy_ke_den_nay > tong_sluong) {
            kl_ky_nay = 0;
            kl_luy_ke_den_nay = kl_ky_nay + kl_luy_ke_ky_truoc;
            gt_luy_ke_ky_nay = kl_ky_nay * don_gia;
            gt_luy_ke_den_nay = gt_luy_ke_ky_truoc + gt_luy_ke_ky_nay;
            tien_thue = (gt_luy_ke_ky_nay * thue_vt) / 100;
            tien_sthue = gt_luy_ke_ky_nay + tien_thue;
            phan_tram_thuc_hien = (gt_luy_ke_den_nay / tong_tienvt) * 100;
            con_lai_so_luong = tong_sluong - kl_luy_ke_den_nay;
            con_lai_gia_tri = tong_tienvt - gt_luy_ke_den_nay;
            $(id).val(0);
            $(id).parents("tr").find("input[name='kl_luy_ke_den_nay']").val(kl_luy_ke_den_nay);
            $(id).parents("tr").find("input[name='gt_luy_ke_ky_nay']").val(gt_luy_ke_ky_nay);
            $(id).parents("tr").find("input[name='gt_luy_ke_den_nay']").val(gt_luy_ke_den_nay);
            $(id).parents("tr").find("input[name='kl_luy_ke_den_nay']").attr("data", tien_thue);
            $(id).parents("tr").find("input[name='gt_luy_ke_den_nay']").attr("data", tien_sthue);
            $(id).parents("tr").find("input[name='phan_tram_thuc_hien']").val(phan_tram_thuc_hien);
            $(id).parents("tr").find("input[name='con_lai_so_luong']").val(con_lai_so_luong);
            $(id).parents("tr").find("input[name='con_lai_gia_tri']").val(con_lai_gia_tri);
            alert("Tổng khối lượng đến nay phai nhỏ hơn tổng số lượng");
        } else {
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
        }
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

// ho so van chuyen
function kl_hs_doi(id) {
    var kl_ky_nay = Number($(id).val());
    var tong_sluong = Number($(id).parents("tr").find(".tong_sluong").text());
    var don_gia = Number($(id).parents("tr").find(".don_gia").text());
    var tong_tienvt = Number($(id).parents("tr").find(".tong_tienvt").text());
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
        if (kl_luy_ke_den_nay > tong_sluong) {
            kl_ky_nay = 0;
            kl_luy_ke_den_nay = kl_ky_nay + kl_luy_ke_ky_truoc;
            gt_luy_ke_ky_nay = kl_ky_nay * don_gia;
            gt_luy_ke_den_nay = gt_luy_ke_ky_truoc + gt_luy_ke_ky_nay;
            tien_thue = gt_luy_ke_ky_nay;
            tien_sthue = gt_luy_ke_ky_nay;
            phan_tram_thuc_hien = (gt_luy_ke_den_nay / tong_tienvt) * 100;
            con_lai_so_luong = tong_sluong - kl_luy_ke_den_nay;
            con_lai_gia_tri = tong_tienvt - gt_luy_ke_den_nay;
            $(id).val(kl_ky_nay);
            $(id).parents("tr").find("input[name='kl_luy_ke_den_nay']").val(kl_luy_ke_den_nay);
            $(id).parents("tr").find("input[name='gt_luy_ke_ky_nay']").val(gt_luy_ke_ky_nay);
            $(id).parents("tr").find("input[name='gt_luy_ke_den_nay']").val(gt_luy_ke_den_nay);
            $(id).parents("tr").find("input[name='kl_luy_ke_den_nay']").attr("data", tien_thue);
            $(id).parents("tr").find("input[name='gt_luy_ke_den_nay']").attr("data", tien_sthue);
            $(id).parents("tr").find("input[name='phan_tram_thuc_hien']").val(phan_tram_thuc_hien);
            $(id).parents("tr").find("input[name='con_lai_so_luong']").val(con_lai_so_luong);
            $(id).parents("tr").find("input[name='con_lai_gia_tri']").val(con_lai_gia_tri);
            alert("Tổng khối lượng đến nay phai nhỏ hơn tổng số lượng");
        } else {
            gt_luy_ke_ky_nay = kl_ky_nay * don_gia;
            gt_luy_ke_den_nay = gt_luy_ke_ky_truoc + gt_luy_ke_ky_nay;
            tien_thue = gt_luy_ke_ky_nay;
            tien_sthue = gt_luy_ke_ky_nay;
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
        }

    } else {
        kl_ky_nay = 0;
        kl_luy_ke_den_nay = kl_ky_nay + kl_luy_ke_ky_truoc;
        gt_luy_ke_ky_nay = kl_ky_nay * don_gia;
        gt_luy_ke_den_nay = gt_luy_ke_ky_truoc + gt_luy_ke_ky_nay;
        tien_thue = gt_luy_ke_ky_nay;
        tien_sthue = gt_luy_ke_ky_nay;
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


    tong_tatca_vc();
}

function chiphi_khac_vc(id) {
    var chi_phi_khac = Number($(id).val());
    var tong_tien = 0;
    var tong_svat = 0;
    var tong_trvat = 0;
    var thue_vt = Number($(".thue_vat").attr("data"));

    $("input[name='gt_luy_ke_den_nay']").each(function () {
        var tiensvat = Number($(this).attr("data"));
        if (tiensvat != "") {
            tong_trvat += tiensvat;
        } else {
            tiensvat = 0;
            tong_trvat += tiensvat;
        }
    });

    tong_svat = tong_trvat + ((tong_trvat * thue_vt) / 100);

    if (chi_phi_khac != "") {
        tong_tien = tong_svat + chi_phi_khac;
    } else {
        chi_phi_khac = 0;
        tong_tien = tong_svat + chi_phi_khac;
    }

    $(".tong_tatca").text(tong_tien);

}

function tong_tatca_vc() {
    var chi_phi_khac = Number($("input[name='chi_phi_khac']").val());
    var tong_tatca = 0;
    var tien_trvat = 0;
    var tong_thue = 0;
    var tien_svat = 0;
    var thue_ky_nay = 0;
    var thue_vt = Number($(".thue_vat").attr("data"));

    $("input[name='kl_luy_ke_den_nay']").each(function () {
        var thuevat = Number($(this).attr("data"));
        if (thuevat != "") {
            tong_thue += thuevat;
        } else {
            thuevat = 0;
            tong_thue += thuevat;
        }
    });
    thue_ky_nay = (tong_thue * thue_vt) / 100;
    $(".thue_ky_nay").text(thue_ky_nay);

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
        tong_tatca = tien_svat + ((tien_svat * thue_vt) / 100) + chi_phi_khac;
    } else {
        chi_phi_khac = 0;
        tong_tatca = tien_svat + ((tien_svat * thue_vt) / 100) + chi_phi_khac;
    }

    $(".tong_tatca").text(tong_tatca);
}
// ho so thue thiet bi
function klt_hs_doi(id) {
    var kl_ky_nay = Number($(id).val());
    var tong_sluong = Number($(id).parents("tr").find(".tong_sluong").text());
    var tong_tienvt = Number($(id).parents("tr").find(".tong_tienvt").text());
    var kl_luy_ke_ky_truoc = Number($(id).parents("tr").find("input[name='kl_luy_ke_ky_truoc']").val());
    var kl_luy_ke_den_nay = Number($(id).parents("tr").find("input[name='kl_luy_ke_den_nay']").val());
    var gt_luy_ke_ky_truoc = Number($(id).parents("tr").find("input[name='gt_luy_ke_ky_truoc']").val());
    var gt_luy_ke_ky_nay = Number($(id).parents("tr").find("input[name='gt_luy_ke_ky_nay']").val());
    var gt_luy_ke_den_nay = Number($(id).parents("tr").find("input[name='gt_luy_ke_den_nay']").val());
    var phan_tram_thuc_hien = Number($(id).parents("tr").find("input[name='phan_tram_thuc_hien']").val());
    var con_lai_so_luong = Number($(id).parents("tr").find("input[name='con_lai_so_luong']").val());
    var con_lai_gia_tri = Number($(id).parents("tr").find("input[name='con_lai_gia_tri']").val());

    if (kl_ky_nay != "") {
        kl_luy_ke_den_nay = kl_ky_nay + kl_luy_ke_ky_truoc;
        if (kl_luy_ke_den_nay > tong_sluong) {
            kl_ky_nay = 0;
            kl_luy_ke_den_nay = kl_ky_nay + kl_luy_ke_ky_truoc;
            gt_luy_ke_ky_nay = tong_tienvt / (tong_sluong / kl_ky_nay);
            gt_luy_ke_den_nay = gt_luy_ke_ky_truoc + gt_luy_ke_ky_nay;
            phan_tram_thuc_hien = (gt_luy_ke_den_nay / tong_tienvt) * 100;
            con_lai_so_luong = tong_sluong - kl_luy_ke_den_nay;
            con_lai_gia_tri = tong_tienvt - gt_luy_ke_den_nay;
            $(id).val(kl_ky_nay);
            $(id).parents("tr").find("input[name='kl_luy_ke_den_nay']").val(kl_luy_ke_den_nay);
            $(id).parents("tr").find("input[name='gt_luy_ke_ky_nay']").val(gt_luy_ke_ky_nay);
            $(id).parents("tr").find("input[name='gt_luy_ke_den_nay']").val(gt_luy_ke_den_nay);
            $(id).parents("tr").find("input[name='phan_tram_thuc_hien']").val(phan_tram_thuc_hien);
            $(id).parents("tr").find("input[name='con_lai_so_luong']").val(con_lai_so_luong);
            $(id).parents("tr").find("input[name='con_lai_gia_tri']").val(con_lai_gia_tri);
            alert("Tổng khối lượng đến nay phai nhỏ hơn tổng số lượng");
        } else {
            gt_luy_ke_ky_nay = tong_tienvt / (tong_sluong / kl_ky_nay);
            gt_luy_ke_den_nay = gt_luy_ke_ky_truoc + gt_luy_ke_ky_nay;
            phan_tram_thuc_hien = (gt_luy_ke_den_nay / tong_tienvt) * 100;
            con_lai_so_luong = tong_sluong - kl_luy_ke_den_nay;
            con_lai_gia_tri = tong_tienvt - gt_luy_ke_den_nay;
            $(id).parents("tr").find("input[name='kl_luy_ke_den_nay']").val(kl_luy_ke_den_nay);
            $(id).parents("tr").find("input[name='gt_luy_ke_ky_nay']").val(gt_luy_ke_ky_nay);
            $(id).parents("tr").find("input[name='gt_luy_ke_den_nay']").val(gt_luy_ke_den_nay);
            $(id).parents("tr").find("input[name='phan_tram_thuc_hien']").val(phan_tram_thuc_hien);
            $(id).parents("tr").find("input[name='con_lai_so_luong']").val(con_lai_so_luong);
            $(id).parents("tr").find("input[name='con_lai_gia_tri']").val(con_lai_gia_tri);
        }

    } else {
        kl_ky_nay = 0;
        kl_luy_ke_den_nay = kl_ky_nay + kl_luy_ke_ky_truoc;
        gt_luy_ke_ky_nay = tong_tienvt / (tong_sluong / kl_ky_nay);
        gt_luy_ke_den_nay = gt_luy_ke_ky_truoc + gt_luy_ke_ky_nay;
        phan_tram_thuc_hien = (gt_luy_ke_den_nay / tong_tienvt) * 100;
        con_lai_so_luong = tong_sluong - kl_luy_ke_den_nay;
        con_lai_gia_tri = tong_tienvt - gt_luy_ke_den_nay;
        $(id).parents("tr").find("input[name='kl_luy_ke_den_nay']").val(kl_luy_ke_den_nay);
        $(id).parents("tr").find("input[name='gt_luy_ke_ky_nay']").val(gt_luy_ke_ky_nay);
        $(id).parents("tr").find("input[name='gt_luy_ke_den_nay']").val(gt_luy_ke_den_nay);
        $(id).parents("tr").find("input[name='phan_tram_thuc_hien']").val(phan_tram_thuc_hien);
        $(id).parents("tr").find("input[name='con_lai_so_luong']").val(con_lai_so_luong);
        $(id).parents("tr").find("input[name='con_lai_gia_tri']").val(con_lai_gia_tri);
    };


    tong_tatca_thue();
}

function chiphi_khac_thue(id) {
    var chi_phi_khac = Number($(id).val());
    var tong_tien = 0;
    var tong_trvat = 0;

    $("input[name='gt_luy_ke_ky_nay']").each(function () {
        var tiensvat = Number($(this).val());
        if (tiensvat != "") {
            tong_trvat += tiensvat;
        } else {
            tiensvat = 0;
            tong_trvat += tiensvat;
        }
    });

    if (chi_phi_khac != "") {
        tong_tien = tong_trvat + chi_phi_khac;
    } else {
        chi_phi_khac = 0;
        tong_tien = tong_trvat + chi_phi_khac;
    }

    $(".tong_tatca").text(tong_tien);

}

function tong_tatca_thue() {
    var chi_phi_khac = Number($("input[name='chi_phi_khac']").val());
    var tong_tatca = 0;
    var tien_trvat = 0;

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

    if (chi_phi_khac != "") {
        tong_tatca = tien_trvat + chi_phi_khac;
    } else {
        chi_phi_khac = 0;
        tong_tatca = tien_trvat + chi_phi_khac;
    }

    $(".tong_tatca").text(tong_tatca);
}

// hồ sơ thanh toán
function change_tien(id) {
    var so_tien = $(id).val();
    $(id).attr("data", so_tien);
    tong_tatc();
}

function tong_tatc() {
    var tong_ca = 0;
    $("input[name='so_tien_ctra']").each(function () {
        var tien_detong = Number($(this).val());
        if (tien_detong != "") {
            tong_ca += tien_detong;
        } else if (tien_detong == "") {
            tien_detong = 0;
            tong_ca += tien_detong;
        }
    });

    $(".sum_tatca").text(tong_ca);
}

// hop dong van chuyen
function sl_vc_doi(id) {
    var sl_vc = Number($(id).val());
    var dg_vc = Number($(id).parents(".item").find(".don_gia").val());
    var tien_vc = 0;

    if (dg_vc != "" && sl_vc != "") {
        tien_vc = sl_vc * dg_vc;
        $(id).parents(".item").find(".tong_trvat").val(tien_vc);
    } else if (dg_vc == "" || sl_vc == "") {
        tien_vc = 0;
        $(id).parents(".item").find(".tong_trvat").val(tien_vc);
    }
    tong_tien_vc();
}

function dg_vc_doi(id) {
    var sl_vc = Number($(id).parents(".item").find(".so_luong").val());
    var dg_vc = Number($(id).val());
    var tien_vc = 0;

    if (dg_vc != "" && sl_vc != "") {
        tien_vc = sl_vc * dg_vc;
        $(id).parents(".item").find(".tong_trvat").val(tien_vc);
    } else if (dg_vc == "" || sl_vc == "") {
        tien_vc = 0;
        $(id).parents(".item").find(".tong_trvat").val(tien_vc);
    }
    tong_tien_vc();
}

function thue_vc_doi(id) {
    var thue_vat = Number($(id).val());
    var tien_trvat = Number($("#tong_truoc_vat").val());
    var tien_svat = 0;

    if (thue_vat != "") {
        tien_svat = tien_trvat + ((tien_trvat * thue_vat) / 100);
    } else {
        tien_svat = tien_trvat;
    }
    $("#tong_sau_vat").val(tien_svat);
    tong_tien_vc();
    baoHanh();
}

function tong_tien_vc() {
    var tong_trvat = 0;
    var tong_svat = 0;
    var thue_vat = Number($(".thue_vat_tong").val());

    $(".tong_trvat").each(function () {
        var tien_don = Number($(this).val());
        if (tien_don != "" && tien_don != 0) {
            tong_trvat += tien_don;
        } else if (tien_don == "" || tien_don == 0) {
            tien_don = 0;
            tong_trvat += tien_don;
        }
    });
    $('#tong_truoc_vat').val(tong_trvat);

    if (thue_vat != "") {
        tong_svat = tong_trvat + ((tong_trvat * thue_vat) / 100);
    } else {
        tong_svat = tong_trvat;
    }
    $('#tong_sau_vat').val(tong_svat);
    baoHanh();
}

function check_nbhanh(id) {
    var phantram = $(id).val();
    if (phantram < 0) {
        var rong = '';
        $(id).val(rong);
        $(id).parents(".bao_hanh").find(".gia_tri_bh").val(0);

    }
}

function check_nblanh(id) {
    var phantram = $(id).val();
    if (phantram < 0) {
        var rong = '';
        $(id).val(rong);
        $(id).parents(".bao_hanh").find(".gia_tri_bl").val(0);
    }
}

function dongiavat_vc(id) {
    if ($(id).is(":checked")) {
        var thue_vat = 0;
        var tong_trvat = 0;
        $(".tong_trvat").each(function () {
            var ttr = $(this).val();
            tong_trvat += Number(ttr);
        })
        $('#tong_truoc_vat').val(tong_trvat);
        $('#tong_sau_vat').val(tong_trvat);

        $(".thue_vat_tong").val(thue_vat);

        $(".thue_vat_tong").attr('readonly', true);
    } else {
        $(".thue_vat_tong").attr('readonly', false);
    }
}

function check_tgian(id) {
    var thoi_gian = $(id).val();
    var ngay_ky = $(".ngay_ky").val();
    var thoi_han = $(".thoi_han").val();
    var rong = '';
    if (thoi_gian != "" && ngay_ky != "" && thoi_han != "") {
        thoi_gian = new Date(thoi_gian);
        ngay_ky = new Date(ngay_ky);
        thoi_han = new Date(thoi_han);
        if (thoi_gian < ngay_ky) {
            $('html, body').animate({
                scrollTop: $(id).focus().offset().top - 30
            }, 1000);
            alert("Thời gian giao hàng lớn hơn ngày ký đơn hàng");
            $(id).val(rong);
        } else if (thoi_gian > thoi_han) {
            $('html, body').animate({
                scrollTop: $(id).focus().offset().top - 30
            }, 1000);
            $(id).val(rong);
            alert("Thời gian giao hàng nhỏ hơn thời hạn giao hàng");

        }
    }
}
// check ngay thanh toan
function check_ngaytt(id) {
    var ngay_tt = $(id).val();
    var id_hd_dh = $(".all_hd_dh").val();
    var loai_phieu = $(".loai_phieu").val();
    var ngay_ky_hd = $(".ngay_tt").attr("data");
    var rong = "";

    if (id_hd_dh != "" && loai_phieu != "") {
        if (ngay_tt < ngay_ky_hd) {
            alert("Ngày thanh toán phải lớn hơn ngày ký hợp đồng");
            $(id).val(rong);
            $('html, body').animate({
                scrollTop: $(id).focus().offset().top - 30
            }, 1000);
        }
    } else if (id_hd_dh == "" && loai_phieu != "") {
        alert("Chọn hợp đồng / đơn hàng");
        $(id).val(rong);
        $('html, body').animate({
            scrollTop: $(".all_hd_dh").focus().offset().top - 30
        }, 1000);
    } else if (loai_phieu == "") {
        alert("Chọn loại phiếu thanh toán");
        $(id).val(rong);
        $('html, body').animate({
            scrollTop: $(".loai_phieu").focus().offset().top - 30
        }, 1000);
    }
}

function tong_hd_vc() {
    var truoc_vat = $('.tong_trvat_hd')
    var tong_tien = 0
    for (var i = 0; i < truoc_vat.length; i++) {
        if (parseInt(truoc_vat[i].value))
            tong_tien += parseInt(truoc_vat[i].value)
    };
    $('#tong_truoc_vat').val(tong_tien)
    var thue_vat = Number($('.thue_vat_tong').val())
    var tien_thue = (tong_tien * thue_vat) / 100
    thue_sau_vat = tong_tien + tien_thue
    $('#tong_sau_vat').val(thue_sau_vat);
    baoHanh();
    baoLanh();
}