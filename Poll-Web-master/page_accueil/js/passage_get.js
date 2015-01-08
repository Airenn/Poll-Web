jQuery(document).ready(function()
{
	$('.titre').click(function()
	{
		var $id = '../page_questions/questions.php?operation=' + $(this).parent('tr').attr('id');
		alert($id);
		$('#questions').attr({href : $id});
	});
});