//------------------------------------------------------- Execution -------------------------------------------------------

var $question_button, $robot_masse, $ferme_question, $suppression_question,
    $robot_unitaire, $num_tel, $texte, $resultats, $ajax_bar, $ajax_table, $ajax_pagination, $ajax_dropdown, $messages_categ, $tri_button,
    $bot_refresh, $bar_refresh, $table_refresh, $pagination_refresh, $dropdown_refresh,
    bot_actif, question_courante, categorie_courante, tri_courant, page_courante, nb_resultats, question_fermee, operation_courante;

init_page();

$robot_masse.on('click', function () {
    launch_multi_bot();
    update_multi_bot_text();
});

$ferme_question.on('click', function () {
    open_close_question();
    update_open_close_text();
    update_dropdown();
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

//------------------------------------------------------- Fonctions update -------------------------------------------------------

function init_page(){
    init_var();
    update_multi_bot_button();
    update_open_close_button();
    update_suppr_button();
}

function init_var(){
    //Variables jS
    $question_button = $('#btn-question');
    $messages_categ = $('.messages_categ');
    $resultats = $('#panel_resultats');
    $ajax_bar = $('#ajax_bar');
    $ajax_table = $('#ajax_table');
    $ajax_pagination = $('#ajax_pagination');
    $ajax_dropdown = $('#ajax_dropdown');
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
    $dropdown_refresh = "";
    
    //Variables classiques
    bot_actif = 0;
    question_courante = "";
    categorie_courante = "Tout";
    tri_courant = "DESC";
    page_courante = 0;
    nb_resultats = 6;
    question_fermee = "";
    operation_courante = "";
}

function affichage_question(operation, fermee, multi, ID, texte){
    update_question_button(texte);

    operation_courante = Number(operation);
    question_courante = Number(ID);
    question_fermee = Number(fermee);
    categorie_courante = "Tout";
    tri_courant = "DESC";
    page_courante = 0;
    
    activer_affichage();
}

function activer_affichage(){
    $resultats.css("visibility", "visible");
    update_multi_bot_button();
    update_open_close_button();
    update_suppr_button();
    update_dropdown();
    update_bar();
    update_table();
    refresh_dropdown();
    refresh_bar();
    refresh_table();
}

function update_question_button(text){
    var new_button = '<em>Choix de la question</em><br>Question '.concat(text);
        new_button = new_button.concat(' <span class="caret"></span>');
    
    $question_button.html(new_button);
}

function update_multi_bot_button(){
    (question_courante === "")
    ? document.getElementById("robot_masse").setAttribute("disabled", "disabled")
    : document.getElementById("robot_masse").removeAttribute("disabled");
    
    update_multi_bot_text();
}

function update_suppr_button(){
    (question_courante == "")
    ? document.getElementById("suppression_question").setAttribute("disabled", "disabled")
    : document.getElementById("suppression_question").removeAttribute("disabled");
}

function update_open_close_button(){
    (question_fermee === "")
    ? document.getElementById("ferme_question").setAttribute("disabled", "disabled")
    : document.getElementById("ferme_question").removeAttribute("disabled");
    
    update_open_close_text();
}

function update_multi_bot_text(){
    var info = '<br><em>Génération automatique</em>',
        inactif = 'Activation du robot'.concat(info),
        actif = 'Désactivation du robot'.concat(info);
    
    (bot_actif)
    ? $robot_masse.html(actif)
    : $robot_masse.html(inactif);
}

function update_open_close_text(){
    var info = '<br><em>Votes entrants ',
        retard = 'en retard</em>',
        accepte = 'acceptés</em>',
        a_ouvrir = 'Ouvrir la question'.concat(info.concat(accepte)),
        a_fermer = 'Clôturer la question'.concat(info.concat(retard));
    
    (question_fermee === 1)
    ? $ferme_question.html(a_ouvrir)
    : $ferme_question.html(a_fermer);
}

function update_dropdown(){
    $.post(get_url_dropdown(), function(data){
        $ajax_dropdown.html(data);
    });
}

function update_bar(){
    $.post(get_url_bar(), function(data){
        $ajax_bar.html(data);
    });
}

function update_table(){
    $.post(get_url_table(), function(data){
        $ajax_table.html(data);
    }); 
    update_pagination();
}

function update_pagination(){
    $.post(get_url_pagination(), function(data){
        $ajax_pagination.html(data);
    }); 
}

function refresh_dropdown(){
    try {
        clearInterval($dropdown_refresh);
    }
    finally{
        $dropdown_refresh = setInterval(
        function(){
            update_dropdown();
        }, 1000);
    }
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

function use_unit_bot(){
    $.post(get_url_unit_bot(), function(data){ });
    document.getElementById('num_tel').value = '';
    document.getElementById('texte').value = '';
}

function suppr(){
    $.post(get_url_suppr(), function(data){ });
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
    (question_fermee)
    ? question_fermee = 0
    : question_fermee = 1;
    
    $.post(get_url_open_close(), function(data){ });
}

//------------------------------------------------------- Fonctions url -------------------------------------------------------

function get_url_dropdown(){
    var url_dropdown = 'ajax/ajax_dropdown.php?operation=';
        url_dropdown = url_dropdown.concat(operation_courante);
        url_dropdown = url_dropdown.concat('&question=');
        url_dropdown = url_dropdown.concat(question_courante);
        url_dropdown = url_dropdown.concat('&fermee=');
        url_dropdown = url_dropdown.concat(question_fermee);
    
    return url_dropdown;
}

function get_url_multi_bot(){
    var url_multi_bot = 'ajax/ajax_multi_bot.php?question=';
        url_multi_bot = url_multi_bot.concat(question_courante);
        url_multi_bot = url_multi_bot.concat('&robot_actif=');
        url_multi_bot = url_multi_bot.concat(bot_actif);
    
    return url_multi_bot;
}

function get_url_open_close(){
    var url_open_close = 'ajax/ajax_open_close.php?question=';
        url_open_close = url_open_close.concat(question_courante);
    
    return url_open_close;
}

function get_url_suppr(){
    var url_suppr = 'ajax/ajax_suppr.php?question=';
        url_suppr = url_suppr.concat(question_courante);
    
    return url_suppr;
}

function get_url_unit_bot(){
    var url_unit_bot = 'ajax/ajax_unit_bot.php?num_tel=';
        url_unit_bot = url_unit_bot.concat($num_tel.val());
        url_unit_bot = url_unit_bot.concat('&texte=');
        url_unit_bot = url_unit_bot.concat($texte.val());
    
    return url_unit_bot;
}

function get_url_bar(){
    var url_bar = 'ajax/ajax_bar.php?question=';
        url_bar = url_bar.concat(question_courante);
        url_bar = url_bar.concat('&categorie=');
        url_bar = url_bar.concat(categorie_courante);
    
    return url_bar;
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