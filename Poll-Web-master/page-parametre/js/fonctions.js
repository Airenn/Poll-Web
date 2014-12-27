function show_div_mess(){
    $('#div-mess').css('display','inline');
    hide_div_format().onchange;
}
function show_and_hide_div(){
    $('#div-mess').css('display','none');
    $('#div-format').css('display','inline');
} 
function hide_div_format(){
    if ($("#nbmessages").is(':checked'))
        $('#div-format').css('display','inline');
    else
        $('#div-format').css('display','none');
}
function hide_barre_prog(){
    $("#arriere-plan").css('display','inline');
    $("#barre-progressive").css('display','none');
}
function hide_arriere_plan(){
    $("#barre-progressive").css('display','inline');
    $("#arriere-plan").css('display','none');
}