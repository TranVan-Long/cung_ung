$(".remove-item").click(function () {
    var id = $(this).attr("data-id");
    $("#delete-quote-me .confirm-delete").attr("data-id", id);
    $("#delete-quote-me").show();
});

function xoa_v() {
    $(".remove-item").click(function () {
        var id = $(this).attr("data-id");
        $("#delete-quote-me .confirm-delete").attr("data-id", id);
        $("#delete-quote-me").show();
    });
}

$("#nha_cung_cap").change(function () {
    var id_ncc = $(this).val();
    $.ajax({
        url: '../render/nguoi_lien_he.php',
        type: 'POST',
        data: {
            id_ncc: id_ncc,
        },
        success: function (data) {
            $("#nguoi-tiep-nhan").html(data);
        }
    })
});

$("#add-quote").click(function () {
    var com_id = $(this).attr("data");
    $.ajax({
        url: '../ajax/them_bgvt_yc.php',
        type: 'POST',
        data: {
            id_com: com_id,
        },
        success: function (data) {
            $("#quote-me").append(data);
            RefSelect2();
        },
    });
});

$(".confirm-delete").click(function () {
    var id = $(this).attr("data-id");
    $.ajax({
        url: '../ajax/xoa_vt_ycbg.php',
        type: 'POST',
        data: {
            id: id,
        },
        success: function (data) {
            window.location.reload();
        }
    })
});

function doi_vt(id) {
    var id_vt = $(id).val();
    var id_v = $(id).parents(".item").attr("data");
    var com_id = $("#quote-me").attr("data");
    $.ajax({
        url: '../render/vat_tu_yc_bg.php',
        type: 'POST',
        data: {
            id_vt: id_vt,
            id_v: id_v,
            id_com: com_id,
        },
        success: function (data) {
            $(id).parents(".item").html(data);
            RefSelect2();
        }
    })

};

$('.submit-btn').click(function () {
    var form = $('.main-form');
    form.validate({
        errorPlacement: function (error, element) {
            error.appendTo(element.parent('.form-col-50'));
            error.wrap('<span class="error">');
        },
        rules: {
            nha_cung_cap: {
                required: true,
            },
            nguoi_tiep_nhan: {
                required: true,
            }
        },
        messages: {
            nha_cung_cap: {
                required: "Vui lòng chọn nhà cung cấp.",
            },
            nguoi_tiep_nhan: {
                required: "Vui lòng chọn người tiếp nhận.",
            }
        }
    });
    if (form.valid() === true) {
        var user_id = $(this).attr("data1");
        var id_bg = $(this).attr("data-id");
        var id_nha_cc = $("select[name='nha_cung_cap']").val();
        var id_nguoi_lh = $("select[name='nguoi_tiep_nhan']").val();
        var id_ctrinh = $("select[name='cong_trinh']").val();
        var noi_dung_thu = $("textarea[name='noi_dung_thu']").val();
        var mail_nhan_bg = $("input[name='mail_nhan_bao_gia']").val();
        var com_id = $(".main-form").attr("data");
        var phan_quyen_nk = $(".main-form").attr("data1");
        var com_name = $(".edit-form").attr("data");

        var gui_mail = "";
        if ($("input[name='mail_ngay']").is(":checked")) {
            gui_mail = 1;
        } else {
            gui_mail = 0;
        };

        var gia_baog_vat = "";
        if ($("input[name='gia_vat']").is(":checked")) {
            gia_baog_vat = 1;
        } else {
            gia_baog_vat = 0;
        };

        var id_vatt = [];
        $("input[name='id_vat_tu']").each(function () {
            var id_vat_tu = $(this).val();
            if (id_vat_tu != "") {
                id_vatt.push(id_vat_tu);
            }
        });

        var ma_vt = [];
        $("select[name='ten_vat_tu']").each(function () {
            var ma_vatt = $(this).val();
            if (ma_vatt != "") {
                ma_vt.push(ma_vatt);
            }
        });

        var so_luong = [];
        $("input[name='so_luong_vt']").each(function () {
            var sol = $(this).val();
            if (sol != "" && sol != 0) {
                so_luong.push(sol);
            }
        });

        var new_ma_vt = [];
        $("select[name='ten_day_du']").each(function () {
            var new_ma_vatt = $(this).val();
            if (new_ma_vatt != "") {
                new_ma_vt.push(new_ma_vatt);
            }
        });

        var new_so_luong = [];
        $("input[name='so_luong']").each(function () {
            var new_sol = $(this).val();
            if (new_sol != "" && new_sol != 0) {
                new_so_luong.push(new_sol);
            }
        });

        $.ajax({
            url: '../ajax/sua_yc_bgvt.php',
            type: 'POST',
            data: {
                com_id: com_id,
                com_name: com_name,
                user_id: user_id,
                id_bg: id_bg,
                id_nha_cc: id_nha_cc,
                id_nguoi_lh: id_nguoi_lh,
                id_ctrinh: id_ctrinh,
                noi_dung_thu: noi_dung_thu,
                mail_nhan_bg: mail_nhan_bg,
                gui_mail: gui_mail,
                gia_baog_vat: gia_baog_vat,
                ma_vt: ma_vt,
                id_vatt: id_vatt,
                so_luong: so_luong,
                new_ma_vt: new_ma_vt,
                new_sl: new_so_luong,
                phan_quyen_nk: phan_quyen_nk,
            },
            success: function (data) {
                if (data == "") {
                    alert("Bạn đã sửa thành công yêu cầu báo giá vật tư");
                    window.location.href = "/quan-ly-yeu-cau-bao-gia.html";
                } else {
                    alert(data);
                }
            }
        })
    }
});