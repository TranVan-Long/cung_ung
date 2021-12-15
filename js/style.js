$(".hd_button .cancel_add").click(function () {
    window.location.href = "quan-ly-hop-dong.html";
});

$(".dh_button .cancel_add").click(function () {
    window.location.href = "quan-ly-don-hang.html";
});

$(".hs_button .cancel_add").click(function () {
    window.location.href = "quan-ly-ho-so-thanh-toan.html";
});

$(".phieu_button .cancel_add").click(function () {
    window.location.href = "quan-ly-phieu-thanh-toan.html";
});

function widthSelect() {
    $(".ma_vatt, .ten_vatt").select2({
        width: '100%',
    });
}

$(document).on('click', '.remo_cot_ngang', function () {
    $(this).parents(".ctn_table .table tbody tr").remove();

    if ($(".ctn_table .table tbody").height() > 105.5) {
        $(".ctn_table .table thead tr").css('width', 'calc(100% - 10px)');
    } else {
        $(".ctn_table .table thead tr").css('width', '100%');
    }
});


$('.user-name').click(function () {
    $(this).parents('ul').find('.dropdown-content').toggleClass("active");
});

var dropd = $(".user-name");
var dropc = $(".dropdown-content");

$(window).click(function (e) {
    if (!dropd.is(e.target) && !dropc.is(e.target) && dropc.has(e.target).length == 0) {
        dropc.removeClass("active");
    }
});

$(document).ready(function () {
    if ($(".ctn_table_ct .table tbody").height() > 159.5) {
        $(".ctn_table_ct .table thead tr").css("width", "calc(100% - 10px)");
    }
})