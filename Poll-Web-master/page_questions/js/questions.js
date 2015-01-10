//------------------------------------------------------- Execution -------------------------------------------------------

var $question_button, $robot_masse, $ferme_question, $suppression_question, $resultats, $multi_question, $new_num, $messages_categ, $tri_button, $robot_unitaire, $num_tel, $texte,
    $changement_nom,
    $ajax_bar, $ajax_table, $ajax_pagination, $ajax_dropdown, $ajax_modif_nom, $ajax_suppr_quest, $ajax_modif_num, $ajax_multi_quest, $ajax_num_btn,
    $bot_refresh, $bar_refresh, $table_refresh, $pagination_refresh, $dropdown_refresh, $nb_sms_refresh,
    bot_actif, question_courante, categorie_courante, tri_courant, page_courante, nb_resultats, question_fermee, operation_courante, multi_rep, num_question_courante, texte_courant, modif_enabled;

init_page();

$robot_masse.on('click', function () {
    launch_multi_bot();
    update_multi_bot_text();
});

$ferme_question.on('click', function () {
    open_close_question();
    update_dropdown();
});

$multi_question.on('click', function () {
    multi_rep_quest();
    update_multi_quest_input();
    update_dropdown();
});

$changement_nom.on('click', function () {
    update_question_name();
});

$('#valid_effacer_question').on('click', function () {
    var op = operation_courante;
    suppr_question();
    init_page();
    operation_courante = op;
});

$('#conservation_nom').on('click', function () {
     document.getElementById('question_texte').value = texte_courant;
});

$('#valid_change_num_question').on('click', function () {
    update_question_num();
    update_question_button(num_question_courante);
    document.getElementById('input_num_question').value = num_question_courante;
});

$('#conservation_num').on('click', function () {
    document.getElementById('input_num_question').value = num_question_courante;
});

$('#btn-ajouter-question').on('click', function () {
    add_question();
});

$suppression_question.on('click', function () {
    suppr();
    update_modif();
});

$robot_unitaire.on('click', function () {
    use_unit_bot();
});

$messages_categ.on('click', function () {
    categorie_courante = $(this).text();
    update_categ_color();
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
    update_question_texte("");
    update_question_button("");
    update_multi_bot_button();
    update_suppr_button();
    update_modif();
    refresh_dropdown();
    document.getElementById('input_num_question').value = '';
    $resultats.css("visibility", "hidden");
}

function init_var(){
    //Variables jS
    $question_button = $('#btn-question');
    $messages_categ = $('.messages_categ');
    $ajax_bar = $('#ajax_bar');
    $ajax_table = $('#ajax_table');
    $ajax_pagination = $('#ajax_pagination');
    $ajax_dropdown = $('#ajax_dropdown');
    $ajax_modif_nom = $('#ajax_modif_nom');
    $ajax_suppr_quest = $('#ajax_suppr_quest');
    $ajax_modif_num = $('#ajax_modif_num');
    $ajax_num_btn = $('#ajax_num_btn');
    $ajax_multi_quest = $('#ajax_multi_quest');
    $robot_masse = $('#robot_masse');
    $robot_unitaire = $('#robot_unitaire');
    $tri_button = $('#btn_reception');
    $ferme_question = $('#input_close_question');
    $multi_question = $('#input_multi_question');
    $suppression_question = $('#suppression_question');
    $num_tel = $('#num_tel');
    $texte = $('#texte');
    $resultats = $('#panel_resultats');
    $new_num = $('#input_num_question');
    $changement_nom =$('#changement_nom');
    
    //Variables interval
    $bot_refresh = "";
    $bar_refresh = "";
    $table_refresh = "";
    $pagination_refresh = "";
    $dropdown_refresh = "";
    $nb_sms_refresh = "";
    
    //Variables classiques
    bot_actif = 0;
    question_courante = "";
    categorie_courante = "Tout";
    tri_courant = "DESC";
    page_courante = 0;
    nb_resultats = 6;
    question_fermee = "";
    operation_courante = document.getElementById('operation_id').getAttribute('id_op');
    multi_rep = "";
    num_question_courante = "";
    texte_courant = "";
    modif_enabled = 1;
}

function affichage_question(operation, fermee, multi, ID, num_question, texte){
    update_question_button(num_question);
    update_question_texte(texte);

    operation_courante = Number(operation);
    question_courante = Number(ID);
    question_fermee = Number(fermee);
    multi_rep = Number(multi);
    texte_courant = texte;
    num_question_courante = Number(num_question);
    categorie_courante = "Tout";
    tri_courant = "DESC";
    page_courante = 0;
    
    activer_affichage();
}

function activer_affichage(){
    $resultats.css("visibility", "visible");
    update_categ_color()
    update_multi_bot_button();
    update_suppr_button();
    update_dropdown();
    update_bar();
    update_table();
    update_modif();
    refresh_bar();
    refresh_table();
    refresh_nb_sms();
}

function update_question_button(num_question){
    var new_button = "".concat(num_question);
        new_button = new_button.concat(' <span class="caret"></span>');
    
    $question_button.html(new_button);
}

function update_question_name(){
    texte_courant = document.getElementById('question_texte').value;
    
    $.post(get_url_quest_name(), function(data){ });
}

function update_question_num(){
    new_num = Number(document.getElementById('input_num_question').value);
    
    if(new_num>0){
        num_question_courante = new_num;
    }
    
    $.post(get_url_quest_num(), function(data){ });
}

function update_question_texte(texte){
    document.getElementById('question_texte').value = texte;
}

function update_delete_quest_button(){
    if(question_courante === ""){
        document.getElementById("effacer_question").setAttribute("disabled", "disabled")
    }
    else{
        document.getElementById("effacer_question").removeAttribute("disabled");

        $.post(get_url_delete_quest_button(), function(data){
            $ajax_suppr_quest.html(data);
        });
    }
}

function update_modify_quest_button(){
    if(question_courante === ""){
        document.getElementById("validation_modification").setAttribute("disabled", "disabled");
    }
    else{
        document.getElementById("validation_modification").removeAttribute("disabled");
    
        $.post(get_url_modify_quest_button(), function(data){
            $ajax_modif_nom.html(data);
        });
    }
}

function update_num_quest_input(){
    if(question_courante === ""){
        document.getElementById("input_num_question").setAttribute("disabled", "disabled");
    }
    else{
        document.getElementById("input_num_question").removeAttribute("disabled");

        $.post(get_url_num_quest_input(), function(data){
            $ajax_modif_num.html(data);
        });
    }
}

function update_num_quest_btn(){
    if(question_courante === ""){
        document.getElementById("validation_numero").setAttribute("disabled", "disabled");
    }
    else{
        document.getElementById("validation_numero").removeAttribute("disabled");

        $.post(get_url_num_quest_btn(), function(data){
            $ajax_num_btn.html(data);
        });
    }
}

function update_close_quest_input(){
    if(question_courante === ""){
        document.getElementById("input_close_question").setAttribute("disabled", "disabled");
    }
    else{
        document.getElementById("input_close_question").removeAttribute("disabled");
    }
    
    (question_fermee)
    ? $ferme_question.prop("checked", 1)
    : $ferme_question.prop("checked", 0);
}

function update_multi_quest_input(){
    (question_courante === "")
    ? document.getElementById("input_multi_question").setAttribute("disabled", "disabled")
    : document.getElementById("input_multi_question").removeAttribute("disabled");
    
    if(modif_enabled){
        $multi_question.css("visibility", "visible");
        $('#input_multi_question_hidden').css("visibility", "hidden");
    }
    else{
        $multi_question.css("visibility", "hidden");
        $('#input_multi_question_hidden').css("visibility", "visible");
    }
    
    if(multi_rep){
        $multi_question.prop("checked", 1);
        $('#input_multi_question_hidden').prop("checked", 1);
    }
    else{
        $multi_question.prop("checked", 0);
        $('#input_multi_question_hidden').prop("checked", 0);
    }
}

function update_multi_bot_button(){
    (question_courante === "")
    ? document.getElementById("robot_masse").setAttribute("disabled", "disabled")
    : document.getElementById("robot_masse").removeAttribute("disabled");
    
    update_multi_bot_text();
}

function update_suppr_button(){
    (question_courante == "")
    ? document.getElementById("reinit_quest").setAttribute("disabled", "disabled")
    : document.getElementById("reinit_quest").removeAttribute("disabled");
}

function update_multi_bot_text(){
    var info = '<br><em>Génération automatique</em>',
        inactif = 'Activation du robot'.concat(info),
        actif = 'Désactivation du robot'.concat(info);
    
    (bot_actif)
    ? $robot_masse.html(actif)
    : $robot_masse.html(inactif);
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

function refresh_nb_sms(){
    try {
        clearInterval($nb_sms_refresh);
    }
    finally{
        $nb_sms_refresh = setInterval(
        function(){
            update_nb_sms();
        }, 300);
    }
}

function update_nb_sms(){
    $.post(get_url_nb_sms(), function(data){
        if(Number(data)>0 && modif_enabled==1){
            modif_enabled=0;
            update_modif();
        }
        else if(Number(data)==0 && modif_enabled==0){
            modif_enabled=1;
            update_modif();
        }
    }); 
}

function update_modif(){
    update_delete_quest_button();
    update_modify_quest_button();
    update_num_quest_btn();
    update_num_quest_input();
    update_close_quest_input();
    update_multi_quest_input();
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

function multi_rep_quest(){
    (multi_rep)
    ? multi_rep = 0
    : multi_rep = 1;
    
    $.post(get_url_multi_rep(), function(data){ });
}

function suppr_question(){
    $.post(get_url_suppr_quest(), function(data){ location.reload(); });
}

function update_categ_color(){
    var valide_focus = "#5CB85C",
        erreur_focus = "#D9534F",
        doublon_focus = "#337AB7",
        retard_focus = "#F0AD4E",
        tout_focus = "#333",
        ecriture_focus = "#FFF",
        ecriture_no_focus = "#333",
        tout_no_focus = "#F2F2F2",
        valide_no_focus = "#CEF6D8",
        erreur_no_focus = "#F6CECE",
        doublon_no_focus = "#CED8F6",
        retard_no_focus = "#FFFCB7",
        tout_categ = "Tout",
        valide_categ = "Valide",
        erreur_categ = "Erreur",
        doublon_categ = "Doublon",
        retard_categ = "Retard",
        $tout = $('#Tout'),
        $valide = $('#Valide'),
        $erreur = $('#Erreur'),
        $doublon = $('#Doublon'),
        $retard = $('#Retard');
    
    $tout.css("background-color", tout_no_focus);
    $tout.css("border-color", tout_no_focus);
    $tout.css("color", ecriture_no_focus);
    $tout.css("box-shadow", "none");
    
    $valide.css("background-color", valide_no_focus);
    $valide.css("border-color", valide_no_focus);
    $valide.css("color", ecriture_no_focus);
    $valide.css("box-shadow", "none");
    
    $erreur.css("background-color", erreur_no_focus);
    $erreur.css("border-color", erreur_no_focus);
    $erreur.css("color", ecriture_no_focus);
    $erreur.css("box-shadow", "none");
    
    $doublon.css("background-color", doublon_no_focus);
    $doublon.css("border-color", doublon_no_focus);
    $doublon.css("color", ecriture_no_focus);
    $doublon.css("box-shadow", "none");
    
    $retard.css("background-color", retard_no_focus);
    $retard.css("border-color", retard_no_focus);
    $retard.css("color", ecriture_no_focus);
    $retard.css("box-shadow", "none");
    
    if(categorie_courante == valide_categ){
        $valide.css("background-color", valide_focus);
        $valide.css("border-color", valide_focus);
        $valide.css("color", ecriture_focus);
        $valide.css("box-shadow", "0 0 0 5px "+valide_no_focus);
    }
    else if(categorie_courante == erreur_categ){
        $erreur.css("background-color", erreur_focus);
        $erreur.css("border-color", erreur_focus);
        $erreur.css("color", ecriture_focus);
        $erreur.css("box-shadow", "0 0 0 5px "+erreur_no_focus);
    }
    else if(categorie_courante == doublon_categ){
        $doublon.css("background-color", doublon_focus);
        $doublon.css("border-color", doublon_focus);
        $doublon.css("color", ecriture_focus);
        $doublon.css("box-shadow", "0 0 0 5px "+doublon_no_focus);
    }
    else if(categorie_courante == retard_categ){
        $retard.css("background-color", retard_focus);
        $retard.css("border-color", retard_focus);
        $retard.css("color", ecriture_focus);
        $retard.css("box-shadow", "0 0 0 5px "+retard_no_focus);
    }
    else if(categorie_courante == tout_categ){
        $tout.css("background-color", tout_focus);
        $tout.css("border-color", tout_focus);
        $tout.css("color", ecriture_focus);
        $tout.css("box-shadow", "0 0 0 5px "+tout_no_focus);
    }     
}

function add_question(){
    var champs_question =   '<div class="row">  ' +
                                '<div class="col-md-12"> ' +
                                    '<form class="form-horizontal"> ' +
        
                                        '<div class="form-group"> ' +
                                            '<label class="col-md-5 control-label" for="new_numero">Numéro de la question</label> ' +
                                            '<div class="col-md-5"> ' +
                                                '<input id="new_numero" name="new_numero" type="text" placeholder="1" class="form-control input-md"> ' +
                                            '</div> ' +
                                        '</div> ' +
        
                                        '<div class="form-group"> ' +
                                            '<label class="col-md-5 control-label" for="new_texte">Texte de la question</label> ' +
                                            '<div class="col-md-5">' +
                                                '<input id="new_texte" name="new_texte" type="text" placeholder="Où est Charlie?" class="form-control input-md"> ' +
                                            '</div> ' +
                                        '</div>' +
        
                                        '<div class="checkbox" style="text-align: center;">' +
                                            '<label>' +
                                                '<input type="checkbox" id="new_multi"> Question à choix multiples?' +
                                            '</label>' +
                                        '</div>' +
        
                                    '</form>' + 
                                '</div>' +
                            '</div>';

    bootbox.dialog({
                title: "Ajout d'une question",
                message: champs_question,
                buttons: {
                    success: {
                        label: "Ajouter",
                        className: "btn-success",
                        callback: function (){
                            var url_add_quest = 'ajax/ajax_add_quest.php?num_question='
                                                +$('#new_numero').val()
                                                +'&texte='
                                                +$('#new_texte').val()
                                                +'&multi_rep='
                                                +Number($('#new_multi').prop("checked"))
                                                +'&ID_operation='
                                                +operation_courante;
                            
                            if($('#new_numero').val()>0 && $('#new_texte').val()!=""){
                                $.post(url_add_quest, function(data){ location.reload(); });
                            }
                        }
                    }
                }
    });

}

//------------------------------------------------------- Fonctions url -------------------------------------------------------

function get_url_dropdown(){
    var url_dropdown = 'ajax/ajax_dropdown.php?operation=';
        url_dropdown = url_dropdown.concat(operation_courante);
    
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

function get_url_multi_rep(){
    var url_multi_rep = 'ajax/ajax_multi_rep.php?question=';
        url_multi_rep = url_multi_rep.concat(question_courante);
    
    return url_multi_rep;
}

function get_url_delete_quest_button(){
    var url_delete_quest_button = 'ajax/ajax_modify_quest.php?type=button&id=effacer_question&modal_id=modal_suppr_question&question='.concat(question_courante);
    
    return url_delete_quest_button;
}

function get_url_modify_quest_button(){
    var url_modify_quest_button = 'ajax/ajax_modify_quest.php?type=button&id=validation_modification&modal_id=modal_nom_question&question='.concat(question_courante);
    
    return url_modify_quest_button;
}

function get_url_num_quest_input(){
    var url_num_quest_input = 'ajax/ajax_modify_quest.php?type=input&id=input_num_question&question='.concat(question_courante);
    
    return url_num_quest_input;
}

function get_url_num_quest_btn(){
    var url_num_quest_btn = 'ajax/ajax_modify_quest.php?type=button&id=validation_numero&modal_id=modal_num_question&question='.concat(question_courante);
    
    return url_num_quest_btn;
}

function get_url_multi_quest(){
    var url_multi_quest = 'ajax/ajax_modify_quest.php?type=input&id=input_multi_question&question='.concat(question_courante);
    
    return url_multi_quest;
}

function get_url_quest_name(){
    var url_quest_name = 'ajax/ajax_new_name.php?question=';
        url_quest_name = url_quest_name.concat(question_courante);
        url_quest_name = url_quest_name.concat('&texte=');
        url_quest_name = url_quest_name.concat(texte_courant);
    
    return url_quest_name;
}

function get_url_quest_num(){
    var url_quest_num = 'ajax/ajax_new_num.php?question=';
        url_quest_num = url_quest_num.concat(question_courante);
        url_quest_num = url_quest_num.concat('&num_question=');
        url_quest_num = url_quest_num.concat(num_question_courante);
    
    return url_quest_num;
}

function get_url_suppr_quest(){
    var url_suppr_quest = 'ajax/ajax_suppr_quest.php?question='.concat(question_courante);
    
    return url_suppr_quest;
}

function get_url_nb_sms(){
    var url_nb_sms = 'ajax/ajax_nb_sms.php?question='.concat(question_courante);
    
    return url_nb_sms;
}