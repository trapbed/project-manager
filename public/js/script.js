$("#leftNavbar").on("mousemove", function(){
    $(this).find($(".mouseHid")).css("display", "flex");
    // $(this).find($("h2")).css("display", "flex");
    // $(this).find($("span")).css("display", "flex");
    $("#leftNavbar").css("width", "17vmax");
})
$("#leftNavbar").on("mouseleave", function(){
    // $(this).find($("h1")).css("display", "none");
    // $(this).find($("h2")).css("display", "none");
    $(this).find($(".mouseHid")).css("display", "none");
    $("#leftNavbar").css("width", "5vmax");
})