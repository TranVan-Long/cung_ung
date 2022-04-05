$(".all_nhacc, .all_da_ct, .all_hd").select2({
    width: '100%',
});

$(".all_nhacc").change(function () {
    var id_kh = $(this).val();
    var com_id = $(".form_add_hp_mua").attr("data");
    $.ajax({
        url: '../render/dh_hdongban.php',
        type: 'POST',
        data: {
            id_kh: id_kh,
            com_id: com_id,
        },
        success: function (data) {
            $(".all_hd").html(data);
        }
    });

    $.ajax({
        url: '../render/diachi_lh_dhb.php',
        type: 'POST',
        data: {
            id_kh: id_kh,
            com_id: com_id,
        },
        success: function (data) {
            $(".thay_doi_dc").html(data);
        }
    });

    $.ajax({
        url: '../render/ds_vattu_hdb.php',
        type: 'POST',
        data: {
            com_id: com_id,
            id_kh: id_kh
        },
        success: function (data) {
            $(".table tbody").html(data);
        }
    });

});

$(".all_hd").change(function () {
    var id_hd = $(this).val();
    var com_id = $(".form_add_hp_mua").attr("data");
    var id_kh = $(this).parents(".form_add_hp_mua").find(".all_nhacc").val();
    $.ajax({
        url: '../render/ds_vattu_hdb.php',
        type: 'POST',
        data: {
            id_hd: id_hd,
            com_id: com_id,
            id_kh: id_kh
        },
        success: function (data) {
            $(".table tbody").html(data);
        }
    });
});

var cancel_add = $(".cancel_add");

cancel_add.click(function () {
    modal_share.show();
});

$('.save_add').click(function () {
    var form_validate = $('.form_add_hp_mua');
    form_validate.validate({
        errorPlacement: function (error, element) {
            error.appendTo(element.parents(".form-group"));
            error.wrap("<span class='error'>");
        },
        rules: {
            ten_khach_hang: {
                required: true,
            },
            hop_dong: {
                required: true,
            },
            donv_nh: {
                required: true,
            },
            nguoi_nh: {
                required: true,
            }
        },
        messages: {
            ten_khach_hang: {
                required: "Vui lòng chọn khách hàng.",
            },
            hop_dong: {
                required: "Vui lòng chọn hợp đồng.",
            },
            donv_nh: {
                required: "Đơn vị nhận hàng không được để trống.",
            },
            nguoi_nh: {
                required: "Người nhận hàng không được để trống."
            }
        }
    });
    if (form_validate.valid() === true) {
        var com_id = $(".form_add_hp_mua").attr("data");
        var id_kh = $("select[name='ten_khach_hang']").val();
        var user_id = $("input[name='nguoi_lh']").attr("data-id");
        var id_hd = $("select[name='hop_dong']").val();
        var ngayky_dh = $("input[name='hop_dong']").val();
        var id_ctrinh = $("select[name='duan_ctrinh']").val();
        var thoi_han_dh = $("input[name='thoi_han']").val();
        var dv_nha_hang = $("input[name='donv_nh']").val();
        var pb_nguoi_nhan = $("input[name='phong_ban']").val();
        var nguoi_nhan = $("input[name='nguoi_nh']").val();
        var dt_nguoi_nhan = $("input[name='dient_nnhan']").val();
        var baoh_hd = $("input[name='baoh_hd']").val();
        var gia_tri_bh = $("input[name='gia_tri']").val();
        var ghi_chu = $("textarea[name='yc_tiendo']").val();
        var giatr_vat = $("input[name='giatr_vat']").val();
        var dgia_vat = 0;
        if ($("input[name='dgia_vat']").is(":checked")) {
            dgia_vat = 1;
        };
        var thue_vat = $("input[name='tong_thue_vat']").val();
        var tien_chkhau = $("input[name='tien_ckhau']").val();
        var gias_vat = $("input[name='gias_vat']").val();
        var chi_phi_vc = $("input[name='chi_phi_vc']").val();
        var ghic_vc = $("input[name='ghic_vc']").val();
        var phan_loai_nk = $(".form_add_hp_mua").attr("data1");

        var id_vt = [];
        $("input[name='ma_vattu']").each(function () {
            var vt = $(this).attr("data");
            id_vt.push(vt);
        });

        var so_luong = [];
        $("input[name='sl_knay']").each(function () {
            var sl = $(this).val();
            if (sl == "") {
                sl = 0;
                so_luong.push(sl);
            } else if (sl != "") {
                so_luong.push(sl);
            }
        });

        var so_luong_hd = [];
        $("input[name='so_luong_hd']").each(function () {
            var sl1 = $(this).val();
            so_luong_hd.push(sl1);
        });

        var thoi_han_gh = [];
        $("input[name='thoig_ghang']").each(function () {
            var tgian = $(this).val();
            if (tgian == "") {
                tgian = 0;
                thoi_han_gh.push(tgian);
            } else {
                thoi_han_gh.push(tgian);
            }
        });

        var don_gia = [];
        $("input[name='don_gia']").each(function () {
            var dgia = $(this).val();
            don_gia.push(dgia);
        });

        var ttien_tr = [];
        $("input[name='ttr_vat']").each(function () {
            var ttr = $(this).val();
            if (ttr == "") {
                ttr = 0;
                ttien_tr.push(ttr);
            } else if (ttr != "") {
                ttien_tr.push(ttr);
            }
        });

        var thuevat = [];
        $("input[name='thue_vat']").each(function () {
            var thue = $(this).val();
            if (thue == "") {
                thue = 0;
                thuevat.push(thue);
            } else if (thue != "") {
                thuevat.push(thue);
            }
        });

        var ttien_s = [];
        $("input[name='tts_vat']").each(function () {
            var tts = $(this).val();
            if (tts == "") {
                tts = 0;
                ttien_s.push(tts);
            } else if (tts != "") {
                ttien_s.push(tts);
            }
        });

        var dia_chi_g = [];
        $("input[name='dia_chi_g']").each(function () {
            var dchi = $(this).val();
            if (dchi == "") {
                dchi = 0;
                dia_chi_g.push(dchi);
            } else if (dchi != "") {
                dia_chi_g.push(dchi);
            }
        });

        $.ajax({
            url: '../ajax/them_dh_ban.php',
            type: 'POST',
            data: {
                com_id: com_id,
                user_id: user_id,
                id_kh: id_kh,
                id_hd: id_hd,
                ngayky_dh: ngayky_dh,
                id_ctrinh: id_ctrinh,
                thoi_han_dh: thoi_han_dh,
                dv_nha_hang: dv_nha_hang,
                pb_nguoi_nhan: pb_nguoi_nhan,
                nguoi_nhan: nguoi_nhan,
                dt_nguoi_nhan: dt_nguoi_nhan,
                baoh_hd: baoh_hd,
                gia_tri_bh: gia_tri_bh,
                ghi_chu: ghi_chu,
                giatr_vat: giatr_vat,
                dgia_vat: dgia_vat,
                thue_vat: thue_vat,
                tien_chkhau: tien_chkhau,
                gias_vat: gias_vat,
                chi_phi_vc: chi_phi_vc,
                ghic_vc: ghic_vc,
                id_vt: id_vt,
                so_luong: so_luong,
                thoi_han_gh: thoi_han_gh,
                don_gia: don_gia,
                ttien_tr: ttien_tr,
                thuevat: thuevat,
                ttien_s: ttien_s,
                dia_chi_g: dia_chi_g,
                so_luong_hd: so_luong_hd,
                phan_loai_nk: phan_loai_nk,
            },
            success: function (data) {
                if (data == "") {
                    alert("Bạn đã thêm đơn hàng bán thành công");
                    window.location.href = '/quan-ly-don-hang.html';
                } else if (data != "") {
                    alert(data);
                }
            }
        });
    };
});