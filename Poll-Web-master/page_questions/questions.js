var $question_button = $('#btn-question'),
    $question_option = $('.question'),
    $messages = $('.messages'),
    $stats = $('#stats'),
    $reponses,
    $url;

$question_option.on('click', function () {
    $url = 'ajax_progress.php?question='.concat($(this).val());
    $question_button.html('Question '.concat(
                            $(this).text().concat(
                                ' <span class="caret"></span>')
                            )
    );
    $.post($url, function(data){
                    $stats.html(data);
    });
});