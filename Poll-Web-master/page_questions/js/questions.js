//------------------------------------------------------- Execution -------------------------------------------------------

var $question_button, $question_option, $robot_masse, $ferme_question, $suppression_question,
    $robot_unitaire, $num_tel, $texte, $resultats, $ajax_bar, $ajax_table, $ajax_pagination, $messages_categ, $tri_button,
    $bot_refresh, $bar_refresh, $table_refresh, $pagination_refresh,
    bot_actif, question_courante, categorie_courante, tri_courant, page_courante, nb_resultats, question_ouverte;

init_page();

$question_option.on('click', function () {
    //Mise à jour du texte du bouton de choix de question
    update_question_button($(this).text());

    //Stockage de la question en cours et reinitialisation de la page
    question_courante = Number($(this).val());
    question_ouverte = Number($(this).attr("fermee"));
    categorie_courante = "Tout";
    tri_courant = "DESC";
    page_courante = 0;
    
    //Demarrage de l'affichage
    activer_affichage();
});

$robot_masse.on('click', function () {
    launch_multi_bot();
    update_multi_bot_text();
});

$ferme_question.on('click', function () {
    open_close_question();
    update_open_close_text();
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
    update_bar();
    update_table();
});

$tri_button.on('click', function () {
    (tri_courant == 'DESC')
    ? tri_courant = 'ASC'  
    : tri_courant = 'DESC';
    
    update_table();
});


//------------------------------------------------------- Fonctions -------------------------------------------------------

function init_page(){
    init_var();
    update_multi_bot_button();
    update_open_close_button();
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
    $ajax_pagination = $('#ajax_pagination');
    $robot_masse = $('#robot_masse');
    $robot_unitaire = $('#robot_unitaire');
    $tri_button = $('#btn_reception');
    $ferme_question = $('#ferme_question');
    $suppression_question = $('#suppression_question');
    $num_tel = $('#num_tel');
    $texte = $('#texte');
    
    //Variables interval
    $bot_refresh = "";
    $bar_refresh = "";
    $table_refresh = "";
    $pagination_refresh = "";
    
    //Variables classiques
    bot_actif = 0;
    question_courante = "";
    categorie_courante = "Tout";
    tri_courant = "DESC";
    page_courante = 0;
    nb_resultats = 6;
    question_ouverte = "";
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
    $resultats.css("visibility", "visible");
    update_multi_bot_button();
    update_open_close_button();
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
    var url_bar = 'ajax/ajax_bar.php?question=';
        url_bar = url_bar.concat(question_courante);
        url_bar = url_bar.concat('&categorie=');
        url_bar = url_bar.concat(categorie_courante);
    
    return url_bar;
}

function update_table(){
    $.post(get_url_table(), function(data){
        $ajax_table.html(data);
    }); 
    update_pagination();
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

function update_pagination(){
    $.post(get_url_pagination(), function(data){
        $ajax_pagination.html(data);
    }); 
}

function get_url_pagination(){
     var url_pagination = 'ajax/ajax_pagination.php?question=';
        url_pagination = url_pagination.concat(question_courante);
        url_pagination = url_pagination.concat('&page=');
        url_pagination = url_pagination.concat(page_courante);
        url_pagination = url_pagination.concat('&nb=');
        url_pagination = url_pagination.concat(nb_resultats);
        url_pagination = url_pagination.concat('&categorie=');
        url_pagination = url_pagination.concat(categorie_courante);
    
    return url_pagination;
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
    var url_multi_bot = 'ajax/ajax_multi_bot.php?question=';
        url_multi_bot = url_multi_bot.concat(question_courante);
        url_multi_bot = url_multi_bot.concat('&robot_actif=');
        url_multi_bot = url_multi_bot.concat(bot_actif);
    
    return url_multi_bot;
}

function use_unit_bot(){
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
    page_courante = 0;
}

function previous_page(){
    page_courante -= 1;
    update_table();
}

function next_page(){
    page_courante += 1;
    update_table();
}

function open_close_question(){
    (question_ouverte)
    ? question_ouverte = 0
    : question_ouverte = 1;
    
    $.post(get_url_open_close(), function(data){ });
}

function get_url_open_close(){
    var url_open_close = 'ajax/ajax_open_close.php?question=';
        url_open_close = url_open_close.concat(question_courante);
    
    return url_open_close;
}

function update_multi_bot_button(){
    (question_courante === "")
    ? document.getElementById("robot_masse").setAttribute("disabled", "disabled")
    : document.getElementById("robot_masse").removeAttribute("disabled");
    
    update_multi_bot_text();
}

function update_multi_bot_text(){
     var info = '<br><em>Génération automatique</em>',
        inactif = 'Activation du robot'.concat(info),
        actif = 'Désactivation du robot'.concat(info);
    
    (bot_actif)
    ? $robot_masse.html(actif)
    : $robot_masse.html(inactif);
}

function update_open_close_button(){
    (question_ouverte === "")
    ? document.getElementById("ferme_question").setAttribute("disabled", "disabled")
    : document.getElementById("ferme_question").removeAttribute("disabled");
    
    update_open_close_text();
}

function update_open_close_text(){
    var info = '<br><em>Votes entrants ',
        retard = 'en retard</em>',
        accepte = 'acceptés</em>',
        fermee = 'Ouvrir la question'.concat(info.concat(accepte)),
        ouverte = 'Clôturer la question'.concat(info.concat(retard));
    
    (question_ouverte)
    ? $ferme_question.html(fermee)
    : $ferme_question.html(ouverte);
}