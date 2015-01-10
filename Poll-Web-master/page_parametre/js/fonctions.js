var question_courante, question_texte_courante, $bar_refresh, $keydown_refresh;

question_courante = $('.bar').attr("value");
question_texte_courante = $('#question').attr("value");
$bar_refresh = "";
$keydown_refresh="";

activer_affichage();

$("#bouton-right").click(function() {
        update_keydown();
        activer_affichage();
});
function activer_affichage(){
    update_title();
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
        question_courante = Number(data);
    });
}

function update_title(){
        $.post("ajax/ajax_title.php", function(data){
        $('#ajax_title').html(data);
    });
}

function refresh_bar(){
    try {
        clearInterval($bar_refresh);
    }
    finally{
        $bar_refresh = setInterval(
        function(){
            update_bar(); update_title();
        }, 1000);
    }
}

function get_url_keydown(){
    var url_bar = 'ajax/ajax_keydown.php?question='; 
    url_bar = url_bar.concat(question_courante);
    url_bar = url_bar.concat('&openclose=true');
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
    $('#nbmessages').change(hide_checkbox('#nbmessages','#form_m'));
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

function maximize_screen(){
        var myWindow = window.open("page-public.php", "", "width=100%", "height=100%")
        myWindow.resizeTo(screen.availWidth, screen.availHeight);
}