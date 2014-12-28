var $question_button = $('#btn-question'),
    $question_option = $('.question'),
    $messages = $('.messages'),
    $ajax_panel = $('#ajax_panel'),
    $url,
    $auto_refresh;

$question_option.on('click', function () {
    //Mise à jour du texte du bouton de choix de question
    $question_button.html('Question '.concat(
                            $(this).text().concat(
                                ' <span class="caret"></span>')
                            )
    );
    
    //Affichage des données de la question sélectionnée
    $url = '../ajax/ajax_panel.php?question='.concat($(this).val());
    $.post($url, function(data){
                    $ajax_panel.html(data);
    });
    
    //Définition du rafraîchissement automatique
    $auto_refresh = setInterval(
    function(){
        $ajax_panel.hide().load($url).show();
    }, 1000);
});