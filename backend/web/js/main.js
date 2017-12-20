$(function(){

    $(document).on('click','.language_select',function(){ // on language changing
        var lang = $(this).attr('id');

        $.post(
            'index.php?r=site/language',
            {
                lang : lang
            },
            function(data){
                location.reload();
            });
    });

    $('#modalButton').click(function(){
        $('#modal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
    });

    $(document).on('click','.fc-day',function(){
       var date = $(this).attr('data-date');

       $.get(
           'index.php?r=event/create',
           {
               date : date
           },
           function(data){

               $('#modal').modal('show')
                   .find('#modalContent')
                   .html(data);
           });
    });
});