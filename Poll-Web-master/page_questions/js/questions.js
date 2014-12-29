var $question_button = $('#btn-question'),
    $question_option = $('.question'),
    $messages = $('.messages'),
    $ajax_bar = $('#ajax_bar'),
    $ajax_table = $('#ajax_table'),
    $ajax_drop = $('#ajax_drop');
    $robot_masse = $('#robot_masse'),
    $robot_unitaire = $('#robot_unitaire'),
    $suppression_question = $('#suppression_question');

$question_option.on('click', function () {
    //Mise à jour du texte du bouton de choix de question
    $new_button = 'Question '.concat($(this).text());
    $new_button = $new_button.concat(' <span class="caret" value="');
    $new_button = $new_button.concat($(this).val());
    $new_button = $new_button.concat('" id="caret_question"></span>');
    
    $question_button.html($new_button);
    
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
    $info = '<br><em>Génération automatique</em>';
    $actif = 'Activation du robot'.concat($info);
    $inactif = 'Désactivation du robot'.concat($info);
    $url_multi_bot = '../ajax/ajax_multi_bot.php?robot_actif=';
    
    if($(this).html() == $actif){
        $url_multi_bot = $url_multi_bot.concat('1');
        $(this).html($inactif);
    }
    else{
        
        $url_multi_bot = $url_multi_bot.concat('0');
        $(this).html($actif);
    }
    
    $bot_refresh = setInterval(
    function(){
        $.post($url_multi_bot, function(data){
            $('#ajax_bot').hide().load($url_multi_bot).show()
        });
    }, 1000);
    
});

$robot_unitaire.on('click', function () {
    $url_unit_bot = '../ajax/ajax_unit_bot.php?num_tel=';
    $url_unit_bot = $url_unit_bot.concat($('#num_tel').val());
    $url_unit_bot = $url_unit_bot.concat('&texte=');
    $url_unit_bot = $url_unit_bot.concat($('#texte').val());
    
    
    $.post($url_unit_bot, function(data){ });
});

$messages.on('click', function () {
    $question = document.getElementById("caret_question").getAttribute("value");
    $url_table = '../ajax/ajax_table.php?question=';
    $url_table = $url_table.concat($question);
    $url_table = $url_table.concat('&categorie=');
    $url_table = $url_table.concat($(this).text());
    
    $.post($url_table, function(data){
        $ajax_table.html(data);
    });
});

$suppression_question.on('click', function () {
    $question = document.getElementById("caret_question").getAttribute("value");
    $url_suppr = '../ajax/ajax_suppr.php?question=';
    $url_suppr = $url_suppr.concat($question);
    
    $.post($url_suppr, function(data){ });
});