/**
 * Created by fred- on 18.04.2018.
 */
(function(){
    $('#submit').click(function(){
        $('.card').addClass('loader');
        $('#url').removeClass('is-invalid');
        $('.invalid-feedback').addClass('d-none');

        $.ajax({
            url: '/api/url',
            method: 'post',
            dataType: 'json',
            data: {
                url: $('#url').val(),
                short: $('#short').val(),
            }
        }).done(function(data){
            $('#response .short_url').text(data.short_url);
            $('#response').removeClass('d-none');
        }).error(function(xhr){
            var errors = xhr.responseJSON;
            for(k in errors){
                var el = $("#"+ k);
                if(el.length > 0){
                    el.addClass('is-invalid');
                    el.next('.invalid-feedback').text(errors[k].join(' | '));
                    el.next('.invalid-feedback').removeClass('d-none');
                }
            }
            console.log(errors);
        }).always(function(){
            $('.card').removeClass('loader');
        });
        return false;
    });
})(jQuery);
