var question_courante, $bar_refresh;

question_courante = $('#salut').attr("value");
$bar_refresh = "";
activer_affichage();

function activer_affichage(){
    update_bar();
    refresh_bar();
}

function update_bar(){
    $.post(get_url_bar(), function(data){
        $('#ajax_bar').html(data);
    });
}

function refresh_bar(){
    try {
        clearInterval($bar_refresh);
    }
    finally{
        $bar_refresh = setInterval(
        function(){
            update_bar();
        }, 1000);
    }
}

function get_url_bar(){
    var url_bar = 'ajax.php?question=?'; 
    url_bar = url_bar.concat(question_courante);
    url_bar = url_bar.concat('&categorie=');
    url_bar = url_bar.concat('Valide');
    
    return url_bar;
}

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