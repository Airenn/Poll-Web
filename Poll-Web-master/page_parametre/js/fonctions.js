var question_courante, $bar_refresh;

question_courante = $('.bar').attr("value");
$bar_refresh = "";
$keydown_refresh="";
$("body").keydown(function(e) {
    if(e.keyCode == 39) { // right
        update_keydown();
    }
    refresh_keydown();
});
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

function update_keydown(){
        $.post(get_url_keydown(), function(data){
        $('#ajax_keydown').html(data); 
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
function refresh_keydown(){
    try {
        clearInterval($keydown_refresh);
    }
    finally{
        $keydown_refresh = setInterval(
        function(){
            update_keydown();
        }, 1000);
    }
}
function get_url_keydown(){
    var url_bar = 'ajax/ajax_keydown.php?question='; 
    url_bar = url_bar.concat(question_courante);
    return url_bar;
}
function get_url_bar(){
    var url_bar = 'ajax/ajax_bar.php?question='; 
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