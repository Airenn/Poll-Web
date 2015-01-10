function questionnaire_selected(id, name){
    var $id = '../page_questions/questions.php?operation=' + id;
    $('#questions').attr({href : $id});
    $('#id_questionnaire_selected').text(name);
}