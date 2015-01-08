jQuery(document).ready(function()
{
	$('.titre').click(function()
	{
		var $selected_id = $(this).parent('tr').attr('id');
		var $id = '../page_questions/questions.php?operation=' + $(this).parent('tr').attr('id');
		//alert($id);
		//alert($selected_id);
		$('#questions').attr({href : $id});
		$('#id_questionnaire_selected').text($selected_id);
		$('#selected_quesiton').css({width : '33%'});
	});
});