function show_div_mess(){
    $('#div-mess').css('display','inline');
    $('#div-phone').css('display','none');
    $('nbmessages').change(hide_checkbox('#nbmessages','#div-format'));
}

function hide_and_seek(hide,seek){
    $(seek).css('display','inline');
    $(hide).css('display','none');
}

function hide_checkbox(checkbox,hide){
    if ($(checkbox).is(':checked'))
        $(hide).css('display','inline');
    else
        $(hide).css('display','none');
}