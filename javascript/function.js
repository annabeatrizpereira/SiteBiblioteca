$(function(){
    $(".reserve").click(function(){
        $(this).prop('type', '#');
        $(this).html('RESERVADO!');
        $(this).css('border', '2px solid rgb(79, 192, 79)');
        $(this).css('color', 'rgb(79, 192, 79)');
    });

    $(".renew").click(function(){
        $(this).prop('type', '#');
        $(this).html('RENOVADO!');
        $(this).css('background-color', '#c9c9c9');
    });
});