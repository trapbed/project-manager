

$(".oneProjSeeMore").on("click", function(e){
    if($(this).closest($(".oneProject")).find(".moreOneProj").css("display") == 'flex'){
        $(this).closest($(".oneProject")).find(".moreOneProj").css("display", "none");
        $(this).closest($(".oneProject")).find(".oneProjSeeMore").text("Подробнее");
    }
    else{
        $(this).closest($(".oneProject")).find(".moreOneProj").css("display", "flex");
        $(this).closest($(".oneProject")).find(".oneProjSeeMore").text("Скрыть");
    }
})

$(".descOneProjMore").on("click", function(){
    if($(this).closest($(".descOneProj")).find(".descOneProjHide").css("display") == 'flex'){
        $(this).closest($(".descOneProj")).find(".descOneProjHide").css("display", "none");
        $(this).css("display","block");
    }
    else{
        $(this).closest($(".descOneProj")).find(".descOneProjHide").css("display", "flex");
        $(this).css("display","none");
    }
})

$(".hideDescOneProj").on("click", function(){
    let parent = $(this).closest($(".descOneProj"));
    parent.find(".descOneProjMore").css("display","flex");
    parent.find(".descOneProjHide").css("display","none");
})

$(".seeTasks").on("click", function(){
    let parent = $(this).closest(".scheudleTasksOneProj");
    if(parent.find(".tasksOneProject").css("display") == "flex"){
        parent.find(".tasksOneProject").css("display","none");
        parent.find(".seeTasks").html("Смотреть задачи &#9650;");
    }
    else{
        parent.find(".tasksOneProject").css("display","flex");
        parent.find(".seeTasks").html("Скрыть задачи &#9660;");
    }
})