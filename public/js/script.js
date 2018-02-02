$(function () {
	/*Define o maximo de materiais que podem ser cautelados*/
    $('#material').change(function () {
        $('#quantidade').load('/cautelamaterial/maximo/' + $.param({id: $('#material').val()}));
        /*$('#alerta').load('../model/informaQntCombustivel.php?' + $.param({combustivel: $('#combustivel').val(), tp: $('#tp').val(), qnt: $('#qnt').val()}));*/
    });
    /*Define o maximo de materiais que podem ser cautelados*/
});