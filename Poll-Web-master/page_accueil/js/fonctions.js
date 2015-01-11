function modal_suppr(id, texte){
    var href = id;
		
    if (!$('#dataConfirmModal').length) {
        $('body').append('<div id="dataConfirmModal" class="modal fade" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true">'+
                         '<div class="modal-dialog"><div class="modal-content"><div class="modal-header">'+
                         '<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button><h3 id="dataConfirmLabel">Merci de confirmer</h3></div>'+
                         '<div class="modal-body"></div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>'+
                         '<a class="btn btn-danger" id="dataConfirmOK">Oui</a></div></div></div></div>');
    }
    $('#dataConfirmModal').find('.modal-body').text(texte);
    $('#dataConfirmModal').modal({show:true});
    $('#dataConfirmOK').click(function(){
        $.post(get_url_delete(href), function(data){ update_page() });
        $('#id_questionnaire_selected').text('aucun');
        $("#dataConfirmModal").modal('hide');
    });
}
function modal_close(id, texte){
    var href = id;
		
    if (!$('#dataConfirmModal').length) {
        $('body').append('<div id="dataConfirmModal" class="modal fade" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true">'+
                         '<div class="modal-dialog"><div class="modal-content"><div class="modal-header">'+
                         '<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button><h3 id="dataConfirmLabel">Merci de confirmer</h3></div>'+
                         '<div class="modal-body"></div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>'+
                         '<a class="btn btn-danger" id="dataConfirmOK">Oui</a></div></div></div></div>');
    }
    $('#dataConfirmModal').find('.modal-body').text(texte);
    $('#dataConfirmModal').modal({show:true});
    $('#dataConfirmOK').click(function(){
        $.post(close_quest(href), function(data){update_table()});
        $("#dataConfirmModal").modal('hide');
    });
}

function modal_open(id, texte){
    var href = id;
		
    if (!$('#dataConfirmModal').length) {
        $('body').append('<div id="dataConfirmModal" class="modal fade" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true">'+
                         '<div class="modal-dialog"><div class="modal-content"><div class="modal-header">'+
                         '<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button><h3 id="dataConfirmLabel">Merci de confirmer</h3></div>'+
                         '<div class="modal-body"></div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>'+
                         '<a class="btn btn-danger" id="dataConfirmOK">Oui</a></div></div></div></div>');
    }
    $('#dataConfirmModal').find('.modal-body').text(texte);
    $('#dataConfirmModal').modal({show:true});
    $('#dataConfirmOK').click(function(){
        $.post(open_quest(href), function(data){ update_table() });
        $("#dataConfirmModal").modal('hide');
    });
}
function modal_export(id, texte){
    var href = id;
		
    if (!$('#dataConfirmModal').length) {
        $('body').append('<div id="dataConfirmModal" class="modal fade" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true">'+
                         '<div class="modal-dialog"><div class="modal-content"><div class="modal-header">'+
                         '<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button><h3 id="dataConfirmLabel">Merci de confirmer</h3></div>'+
                         '<div class="modal-body"></div><div class="modal-footer"><button class="btn" data-dismiss="modal" aria-hidden="true">Non</button>'+
                         '<a class="btn btn-danger" id="dataConfirmOK">Oui</a></div></div></div></div>');
    }
    $('#dataConfirmModal').find('.modal-body').text(texte);
    $('#dataConfirmModal').modal({show:true});
    $('#dataConfirmOK').click(function(){
        $.post(get_url_export(href), function(data){ update_table() });
        $('#id_questionnaire_selected').text('aucun');
        $("#dataConfirmModal").modal('hide');
    });
}

function get_url_delete($texte){
    var sup = 'php/supprimer.php?ID=';
        sup = sup.concat($texte);
    return sup;
}

function get_url_import(){
    var sup = 'php/importer.php';
    return sup;
}

function get_url_nouveau($nom,$date){
    var sup = 'php/nouveau.php?nom=';
        sup = sup.concat($nom);
        sup = sup.concat('&date=');
        sup = sup.concat($date);
    
    return sup;
}
function get_url_export($nom){
    var  exp = 'php/exporter.php?id=';
         exp= exp.concat($nom);
    return exp;
}
function close_quest($id){
    var sup = 'php/fermer.php?ID=';
		sup = sup.concat($id);
    return sup;
}

function open_quest($id){
    var sup = 'php/ouvrir.php?ID=';
        sup = sup.concat($id);
    return sup;
}


function creation_quest(){
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
                    '<label class="col-md-5 control-label" for="awesomeness">Choisissez la date prévue </label> ' +
                    '<div class="col-md-5">' +
                    '<input id="date" name="date" type="text" placeholder="Date du questionnaire" class="form-control input-md"> ' +
                    '<span class="help-block">Entrez la date sous la forme aaaa-mm-jj</span>'+
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
                            $.post(get_url_nouveau(name,date), function(data){ update_page(); });             
                        }
                    }
                }
            });
    return false;
}

function import_quest(){
        bootbox.dialog({
            title: "Importer un questionnaire",
            message: '<div class="row">  ' +
                '<div class="col-md-12"> ' +
                '<form class="form-horizontal" method="post" enctype="multipart/form-data" action="../php/importer.php"> ' +
                '<div class="form-group"> ' +
                '<label class="col-md-5 control-label" for="awesomeness">Choisissez le questionnaire voulu</label> ' +
                '<div class="col-md-5">' +
                '<input id="import_field" name="import" type="file" > ' +
                '<span class="help-block">Questionnaire a importer</span>'+
                '</div> ' +
                '</div> </div>' +
                '</form> </div>  </div>',
                    buttons: {
                        success: {
                        label: "Sauvegarder",
                        className: "btn-success",
                        callback: function (){
                        $.post(get_url_import(), function(data){ update_page(); });  
                        }
                            
                    }
                }
            });
    return false;
}

$ajax_table = $('#ajax_tableau_questionnaire');
$ajax_page = $('#ajax_page_questionnaire');

function update_table(){
    $.post(get_url_table(), function(data){
        $ajax_table.html(data);
    }); 
}
function update_page(){
    $.post(get_url_page(), function(data){
        $ajax_page.html(data);
    }); 
}

function get_url_page(){
    return "ajax/ajax_page.php";
}

function get_url_table(){
    return "ajax/ajax_table.php";
}