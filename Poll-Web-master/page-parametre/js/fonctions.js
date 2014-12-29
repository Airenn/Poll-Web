function show_div_mess(){
    $('#div-mess').css('display','inline');
    $('#div-phone').css('display','none');
    $('nbmessages').change(hide_checkbox('#nbmessages','#div-format'));
}

function hide_hide_and_seek(hide,hide2,seek){
    $(seek).css('display','inline');
    $(hide).css('display','none');
    $(hide2).css('display','none');
}

function hide_seek_and_seek(hide,seek,seek2){
    $(seek).css('display','inline');
    $(seek2).css('display', 'inline');
    $(hide).css('display','none');
}

function hide_checkbox(checkbox,hide){
    if ($(checkbox).is(':checked'))
        $(hide).css('display','inline');
    else
        $(hide).css('display','none');
}