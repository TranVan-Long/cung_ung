// $(".collapse").click(function (e){
//     e.preventDefault();
//     if ($(this).hasClass('active')){
//         $(this).removeClass('active');
//         $(this).children('ul').toggle(300);
//     }
//     else{
//         $('.menu li ul').slideUp();
//         $('.menu li').removeClass('active');
//         $(this).addClass('active');
//         $(this).children('ul').toggle(300);
//     }
// })
$(".collapse").click(function (){
    var id = $(this).attr("data-tab");

    // $(".collapse").removeClass("active");
    $(".collapse ul").removeClass("active");

    // $(this).addClass("active");
    $('#' + id).addClass("active");
})
