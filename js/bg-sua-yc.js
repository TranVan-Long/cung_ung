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
        },
    });
});

$(".ten_vat_tu").change(function () {
    var id_vt = $(this).val();
    var _this = $(this);
    var id_v = _this.parents(".item").attr("data");
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
            _this.parents(".item").html(data);
        }
    })
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

function doi_vt() {
    $(".ten_vat_tu").change(function () {
        var id_vt = $(this).val();
        var _this = $(this);
        var id_v = _this.parents(".item").attr("data");
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
                _this.parents(".item").html(data);
            }
        })
    });
    RefSelect2();
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

        var gui_mail = document.getElementsByName('mail_ngay');
        var gm = "";
        for (var j = 0; j < gui_mail.length; j++) {
            if (gui_mail[j].checked === true) {
                gm += gui_mail[j].value + '_';
            }
        };

        var gia_baog_vat = document.getElementsByName('gia_VAT');
        var mh = "";
        for (var i = 0; i < gia_baog_vat.length; i++) {
            if (gia_baog_vat[i].checked === true) {
                mh += gia_baog_vat[i].value + '_';
            }
        };

        var id_vatt = new Array();
        $("input[name='id_vat_tu']").each(function () {
            var id_vat_tu = $(this).val();
            if (id_vat_tu != "") {
                id_vatt.push(id_vat_tu);
            }
        });

        var ma_vt = new Array();
        $("select[name='ten_vat_tu']").each(function () {
            var ma_vatt = $(this).val();
            if (ma_vatt != "") {
                ma_vt.push(ma_vatt);
            }
        });

        var so_luong = new Array();
        $("input[name='so_luong_vt']").each(function () {
            var sol = $(this).val();
            if (sol != "") {
                so_luong.push(sol);
            }
        });

        var new_ma_vt = new Array();
        $("select[name='ten_day_du']").each(function () {
            var new_ma_vatt = $(this).val();
            if (new_ma_vatt != "") {
                new_ma_vt.push(new_ma_vatt);
            }
        });

        var new_so_luong = new Array();
        $("input[name='so_luong']").each(function () {
            var new_sol = $(this).val();
            if (new_sol != "") {
                new_so_luong.push(new_sol);
            }
        });

        $.ajax({
            url: '../ajax/sua_yc_bgvt.php',
            type: 'POST',
            data: {
                user_id: user_id,
                id_bg: id_bg,
                id_nha_cc: id_nha_cc,
                id_nguoi_lh: id_nguoi_lh,
                id_ctrinh: id_ctrinh,
                noi_dung_thu: noi_dung_thu,
                mail_nhan_bg: mail_nhan_bg,
                gui_mail: gm,
                gia_baog_vat: mh,
                ma_vt: ma_vt,
                id_vatt: id_vatt,
                so_luong: so_luong,
                new_ma_vt: new_ma_vt,
                new_sl: new_so_luong,
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