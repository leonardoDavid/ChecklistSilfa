// jquery extend function
$.extend({
    redirectWithPost: function(location, args){
        var form = '';
        $.each( args, function( key, value ) {
            form += '<input type="hidden" name="'+key+'" value="'+value+'">';
        });
        log = $('<form action="' + location + '" method="POST">' + form + '</form>');
        log.submit(); 
    }
});