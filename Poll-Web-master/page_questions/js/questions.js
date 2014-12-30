//------------------------------------------------------- Execution -------------------------------------------------------

var $question_button, $question_option, $robot_masse, $suppression_question,
    $robot_unitaire, $num_tel, $texte, $resultats, $ajax_bar, $ajax_table, $messages_categ,
    $tri_button, $pagination, $previous_page, $num_page, $next_page,
    $bot_refresh, $bar_refresh, $table_refresh,
    bot_actif, question_courante, categorie_courante, tri_courant, page_courante;

init_page();

$question_option.on('click', function () {
    //Mise à jour du texte du bouton de choix de question
    update_question_button($(this).text());

    //Stockage de la question en cours et reinitialisation de la page
    question_courante = $(this).val();
    categorie_courante = "Tout";
    tri_courant = "DESC";
    page_courante = 0;
    
    //Demarrage de l'affichage
    activer_affichage();
});

$robot_masse.on('click', function () {
    var info = '<br><em>Génération automatique</em>',
        inactif = 'Activation du robot'.concat(info),
        actif = 'Désactivation du robot'.concat(info);
    
    (bot_actif)
    ? $(this).html(inactif)
    : $(this).html(actif);
    
    launch_multi_bot();
});

$suppression_question.on('click', function () {
    suppr();
});

$robot_unitaire.on('click', function () {
    use_unit_bot();
});

$messages_categ.on('click', function () {
    categorie_courante = $(this).text();
    page_courante = 0;
    update_table();
});

$tri_button.on('click', function () {
    (tri_courant == 'DESC')
    ? tri_courant = 'ASC'  
    : tri_courant = 'DESC';
    
    update_table();
});

$previous_page.on('click', function () {
    page_courante = page_courante-1;
    if(page_courante == 0){
        document.getElementById("previous_page").setAttribute("disabled", "disabled");
    }
});

$next_page.on('click', function () {
    page_courante = page_courante+1;
    document.getElementById("previous_page").removeAttribute("disabled");
});

$pagination.on('click', function () {
    update_table();
});


//------------------------------------------------------- Fonctions -------------------------------------------------------

function init_page(){
    init_var();
    update_badge_page_courante();
    update_suppr_button();
}

function init_var(){
    //Variables jS
    $question_button = $('#btn-question');
    $question_option = $('.question');
    $messages_categ = $('.messages_categ');
    $resultats = $('#panel_resultats');
    $ajax_bar = $('#ajax_bar');
    $ajax_table = $('#ajax_table');
    $robot_masse = $('#robot_masse');
    $robot_unitaire = $('#robot_unitaire');
    $tri_button = $('#btn_reception');
    $suppression_question = $('#suppression_question');
    $previous_page = $('#previous_page');
    $next_page = $('#next_page');
    $pagination = $('.pagination_message');
    $num_page = $('#num_page');
    $num_tel = $('#num_tel');
    $texte = $('#texte');
    
    //Variables interval
    $bot_refresh = "";
    $bar_refresh = "";
    $table_refresh = "";
    
    //Variables classiques
    bot_actif = 0;
    question_courante = "";
    categorie_courante = "Tout";
    tri_courant = "DESC";
    page_courante = 0;   
}

function update_badge_page_courante(){
    (page_courante == 0)
    ? document.getElementById("previous_page").setAttribute("disabled", "disabled")
    : document.getElementById("previous_page").removeAttribute("disabled");
    
    $num_page.html(page_courante+1);
}

function update_suppr_button(){
    (question_courante == "")
    ? document.getElementById("suppression_question").setAttribute("disabled", "disabled")
    : document.getElementById("suppression_question").removeAttribute("disabled");
}

function update_question_button(text){
    var new_button = '<em>Choix de la question</em><br>Question '.concat(text);
        new_button = new_button.concat(' <span class="caret"></span>');
    
    $question_button.html(new_button);
}

function activer_affichage(){
    update_badge_page_courante();
    $resultats.css("visibility", "visible");
    update_suppr_button();
    update_bar();
    update_table();
    refresh_bar();
    refresh_table();
}

function update_bar(){
    $.post(get_url_bar(), function(data){
        $ajax_bar.html(data);
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
    return 'ajax/ajax_bar.php?question='.concat(question_courante);
}

function update_table(){
    update_badge_page_courante();
    $.post(get_url_table(), function(data){
        $ajax_table.html(data);
    }); 
}

function refresh_table(){
    try {
        clearInterval($table_refresh);
    }
    finally{
        $table_refresh = setInterval(
        function(){
            update_table();
        }, 1000);
    }
}

function get_url_table(){
     var url_table = 'ajax/ajax_table.php?question=';
        url_table = url_table.concat(question_courante);
        url_table = url_table.concat('&categorie=');
        url_table = url_table.concat(categorie_courante);
        url_table = url_table.concat('&tri=');
        url_table = url_table.concat(tri_courant);
        url_table = url_table.concat('&page=');
        url_table = url_table.concat(page_courante);
    
    return url_table;
}

function launch_multi_bot(){
    (bot_actif)
    ? bot_actif = 0
    : bot_actif = 1;
    
    try {
        clearInterval($bot_refresh);
    }
    finally{
        $bot_refresh = setInterval(
        function(){
            $.post(get_url_multi_bot(), function(data){ });
        }, 1000);
    }
}

function get_url_multi_bot(){
    return 'ajax/ajax_multi_bot.php?robot_actif='.concat(bot_actif);
}

function use_unit_bot(url_unit_bot){
    $.post(get_url_unit_bot(), function(data){ });
    document.getElementById('num_tel').value = '';
    document.getElementById('texte').value = '';
}

function get_url_unit_bot(){
    var url_unit_bot = 'ajax/ajax_unit_bot.php?num_tel=';
        url_unit_bot = url_unit_bot.concat($num_tel.val());
        url_unit_bot = url_unit_bot.concat('&texte=');
        url_unit_bot = url_unit_bot.concat($texte.val());
    
    return url_unit_bot;
}

function suppr(){
    var url_suppr = 'ajax/ajax_suppr.php?question=';
        url_suppr = url_suppr.concat(question_courante);
    
    $.post(url_suppr, function(data){ });
}

