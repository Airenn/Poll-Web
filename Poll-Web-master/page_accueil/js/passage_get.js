jQuery(document).ready(function()
{
	$('.titre').click(function()
	{
		var $selected_id = $(this).html();
		var $id = '../page_questions/questions.php?operation=' + $(this).parent('tr').attr('id');
		//alert($id);
		//alert($selected_id);
		$('#questions').attr({href : $id});
		$('#id_questionnaire_selected').text($selected_id);
		//$('#selected_question').css({width : '33%'});
	});
});