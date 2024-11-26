$("#leftNavbar").on("mousemove", function(){
    $(this).find($(".mouseHid")).css("display", "flex");
    // $(this).find($("h2")).css("display", "flex");
    // $(this).find($("span")).css("display", "flex");
    $("#left_block").css("width","76vmax");
    $(".table").css("width","76vmax");
    $("#leftNavbar").css("width", "17vmax");
})
$("#leftNavbar").on("mouseleave", function(){
    // $(this).find($("h1")).css("display", "none");
    // $(this).find($("h2")).css("display", "none");
    $(this).find($(".mouseHid")).css("display", "none");
    $("#left_block").css("width","88vmax");
    $(".table").css("width","88vmax");
    $("#leftNavbar").css("width", "5vmax");
})

$(".create").on("click", function(){
    $(".back_modal").css("display","block");
})

$(".close_modal").on("click", function(){
    $(".back_modal").css("display", "none");
})

