function modal_suppr(id, texte){
    var href = id;
		
    if (!$('#modal_suprimmer').length) {
        $('body').append('<div id="modal_suprimmer" class="modal fade" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true">'+
                         '<div class="modal-dialog"><div class="modal-content"><div class="modal-header">'+
                         '<button type="button" class="close " data-dismiss="modal" aria-hidden="true"></button><h3 id="dataConfirmLabel">Merci de confirmer</h3></div>'+
                         '<div class="modal-body"></div><div class="modal-footer"><a class="btn btn-success" id="modal_suprimmerConfirmOK">Oui</a>'+
                         '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Non</button></div></div></div></div>');
    }
    $('#modal_suprimmer').find('.modal-body').text(texte);
    $('#modal_suprimmer').modal({show:true});
    $('#modal_suprimmerConfirmOK').click(function(){
        $.post(get_url_delete(href), function(data){ update_page() });
        $('#id_questionnaire_selected').text('aucun');
        $("#modal_suprimmer").modal('hide');
    });
}
function modal_close(id, texte){
    var href = id;
		
    if (!$('#modal_fermer').length) {
        $('body').append('<div id="modal_fermer" class="modal fade" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true">'+
                         '<div class="modal-dialog"><div class="modal-content"><div class="modal-header">'+
                         '<button type="button" class="close " data-dismiss="modal" aria-hidden="true"></button><h3 id="dataConfirmLabel">Merci de confirmer</h3></div>'+
                         '<div class="modal-body"></div><div class="modal-footer"><a class="btn btn-success" id="modal_fermerdataConfirmOK">Oui</a>'+
                         '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Non</button></div></div></div></div>');
    }
    $('#modal_fermer').find('.modal-body').text(texte);
    $('#modal_fermer').modal({show:true});
    $('#modal_fermerdataConfirmOK').click(function(){
        $.post(close_quest(href), function(data){location.reload();});
        $("#modal_fermer").modal('hide');
    });
}

function modal_open(id, texte){
    var href = id;
		
    if (!$('#modal_ouvrir').length) {
        $('body').append('<div id="modal_ouvrir" class="modal fade" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true">'+
                         '<div class="modal-dialog"><div class="modal-content"><div class="modal-header">'+
                         '<button type="button" class="close " data-dismiss="modal" aria-hidden="true"></button><h3 id="dataConfirmLabel">Merci de confirmer</h3></div>'+
                         '<div class="modal-body"></div><div class="modal-footer"><a class="btn btn-success" id="modal_ouvrirConfirmOK">Oui</a>'+
                         '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Non</button></div></div></div></div>');
    }
    $('#modal_ouvrir').find('.modal-body').text(texte);
    $('#modal_ouvrir').modal({show:true});
    $('#modal_ouvrirConfirmOK').click(function(){
        $.post(open_quest(href), function(data){location.reload();});
        $("#modal_ouvrir").modal('hide');
    });
}
function modal_export(id, texte){
    var href = id;
		
    if (!$('#modal_export').length) {
        $('body').append('<div id="modal_export" class="modal fade" role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true">'+
                         '<div class="modal-dialog"><div class="modal-content"><div class="modal-header">'+
                         '<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button><h3 id="dataConfirmLabel">Merci de confirmer</h3></div>'+
                         '<div class="modal-body"></div><div class="modal-footer"><a class="btn btn-success" id="modal_exportConfirmOK">Oui</a>'+
                         '<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Non</button></div></div></div></div>');
    }
    $('#modal_export').find('.modal-body').text(texte);
    $('#modal_export').modal({show:true});
    $('#modal_exportConfirmOK').click(function(){
        $.post(get_url_export(href), function(data){ update_table() });
        $('#id_questionnaire_selected').text('aucun');
        $("#modal_export").modal('hide');
    });
}

function get_url_delete($texte){
    var sup = 'php/supprimer.php?ID=';
        sup = sup.concat($texte);
    return sup;
}

function get_url_import($nom){
    var imp = 'php/importer.php?nom=';
        imp = imp.concat($nom);
    return imp;
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

function get_url_edit($id,$nom,$date){
    var sup = 'php/modifier.php?id=';
        sup = sup.concat($id);
        sup = sup.concat('&nom=');		
        sup = sup.concat($nom);
        sup = sup.concat('&date=');
        sup = sup.concat($date);
		console.log(sup);
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

function modal_edit(id){
        bootbox.dialog({
                title: "Modification d'un questionnaire",
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
                        label: "Modifier",
                        className: "btn-success",
                        callback: function (){
                            var name = $('#name').val();
                            var date = $('#date').val();
                            $.post(get_url_edit(id,name,date), function(data){ update_page(); });             
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
                        var file = $('#import_field').val();
                        $.post(get_url_import(file), function(data){ update_page(); });  
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