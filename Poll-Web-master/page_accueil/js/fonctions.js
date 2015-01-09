
$(function() {
	$('a[data-confirm]').click(function(ev) {
		var href = $(this).attr('href');
		
		if (!$('#dataConfirmModal').length) {
			$('body').append('<div id="dataConfirmModal" class="modal fade" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true">'+
                             '<div class="modal-dialog"><div class="modal-content"><div class="modal-header">'+
                             '<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button><h3 id="dataConfirmLabel">Merci de confirmer</h3></div>'+
                             '<div class="modal-body"></div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>'+
                             '<a class="btn btn-danger" id="dataConfirmOK">Oui</a></div></div></div></div>');
		}
		$('#dataConfirmModal').find('.modal-body').text($(this).attr('data-confirm'));
		$('#dataConfirmModal').modal({show:true});
        $('#dataConfirmOK').click(function(){
        $.post(get_url_delete(href), function(data){ }).done(update_table());
        $("#dataConfirmModal").modal('hide');
        });
		return false;
	});
});

function get_url_delete($texte){
    var sup = 'php/supprimer.php?ID=';
        sup = sup.concat($texte);
    return sup;
}

function get_url_nouveau($nom,$date){
    var sup = 'php/nouveau.php?nom=';
        sup = sup.concat($nom);
        sup = sup.concat('&date=');
        sup = sup.concat($date);
    
    return sup;
}

$(function() {
	$('#create').click(function(ev) {
        bootbox.dialog({
                title: "Création d'un questionnaire",
                message: '<div class="row">  ' +
                    '<div class="col-md-12"> ' +
                    '<form class="form-horizontal"> ' +
                    '<div class="form-group"> ' +
                    '<label class="col-md-5 control-label" for="name">Nom</label> ' +
                    '<div class="col-md-5"> ' +
                    '<input id="name" name="name" type="text" placeholder="Nom du questionnaire" class="form-control input-md"> ' +
                    '</div> ' +
                    '</div> ' +
                    '<div class="form-group"> ' +
                    '<label class="col-md-5 control-label" for="awesomeness">Choisissez la date prevu </label> ' +
                    '<div class="col-md-5">' +
                    '<input id="date" name="date" type="text" placeholder="Date du questionnaire" class="form-control input-md"> ' +
                    '<span class="help-block">Entrée la date sous la forme aaaa-mm-jj</span>'+
                    '</div> ' +
                    '</div> </div>' +
                    '</form> </div>  </div>',
                    buttons: {
                        success: {
                        label: "Sauvegarder",
                        className: "btn-success",
                        callback: function (){
                            var name = $('#name').val();
                            var date = $('#date').val();
                            $.post(get_url_nouveau(name,date), function(data){ });             
                        }
                    }
                }
            });
    return false;
	});
});

$ajax_table = $('#ajax_tableau_questionnaire');

function update_table(){
    $.post(get_url_table(), function(data){
        $ajax_table.html(data);
    }); 
}

function get_url_table(){
    return "ajax/ajax_table.php";
}