var $question_button = $('#btn-question'),
    $question_option = $('.question'),
    $messages = $('.messages'),
    $ajax_panel = $('#ajax_panel'),
    $reponses,
    $url;

$question_option.on('click', function () {
    $question_button.html('Question '.concat(
                            $(this).text().concat(
                                ' <span class="caret"></span>')
                            )
    );
    
    $url = 'ajax_panel.php?question='.concat($(this).val());
    $.post($url, function(data){
                    $ajax_panel.html(data);
    });
});

$messages.on('click', function () {
    $messages.removeClass("active");
    $(this).addClass("active");
});
