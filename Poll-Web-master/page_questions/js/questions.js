var $question_button = $('#btn-question'),
    $question_option = $('.question'),
    $messages = $('.messages'),
    $ajax_bar = $('#ajax_bar'),
    $ajax_table = $('#ajax_table'),
    $robot_masse = $('#robot_masse'),
    $robot_unitaire = $('#robot_unitaire');

$question_option.on('click', function () {
    //Mise à jour du texte du bouton de choix de question
    $question_button.html('Question '.concat(
                            $(this).text().concat(
                                ' <span class="caret"></span>')
                            )
    );
    
    //Affichage des données de la question sélectionnée
    $url_bar = '../ajax/ajax_bar.php?question='.concat($(this).val());
    $url_table = '../ajax/ajax_table.php?question='.concat($(this).val());
    
    $.post($url_bar, function(data){
                    $ajax_bar.html(data);
    });
    $.post($url_table, function(data){
                    $ajax_table.html(data);
    });
    
    //Définition du rafraîchissement automatique
    $bar_refresh = setInterval(
    function(){
        $ajax_bar.hide().load($url_bar).show();
    }, 1000);
    $table_refresh = setInterval(
    function(){
        $ajax_table.hide().load($url_table).show();
    }, 1000);
});

$robot_masse.on('click', function () {
    if($(this).text() == 'Activer le robot'){
        $url_multi_bot = '../ajax/ajax_multi_bot.php?robot_actif=1';
        $(this).html('Désactiver le robot');
    }
    else{
        $url_multi_bot = '../ajax/ajax_multi_bot.php?robot_actif=0';
        $(this).html('Activer le robot');
    }
    
    $bot_refresh = setInterval(
    function(){
        $.post($url_multi_bot, function(data){ });
    }, 1000);
    
});

$robot_unitaire.on('click', function () {
    $url_unit_bot = '../ajax/ajax_unit_bot.php?num_tel=';
    $url_unit_bot = $url_unit_bot.concat($('#num_tel').val());
    $url_unit_bot = $url_unit_bot.concat('&texte=');
    $url_unit_bot = $url_unit_bot.concat($('#texte').val());
    
    
    $.post($url_unit_bot, function(data){ });
});