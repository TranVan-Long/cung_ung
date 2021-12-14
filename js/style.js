$(".hd_button .cancel_add").click(function () {
    window.location.href = "quan-ly-hop-dong.html";
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
})