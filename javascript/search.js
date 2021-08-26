$(function(){
    $("#pesquisa").keyup(function(){
        var pesquisa = $(this).val();

        if(pesquisa != ''){
            var dados = {
                palavra : pesquisa
            }
            $.post('busca.php', dados, function(retorna){
                $(".resultado").html(retorna);
            });
        }
    });
});