$(document).ready(function() {
    /* VALIDAR CONTRASEÑAS */
    $('#pass').keyup(function(e) {
        var strongRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
        var mediumRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
        var enoughRegex = new RegExp("(?=.{6,}).*", "g");
        if (false == enoughRegex.test($(this).val())) {
            $('#passstrength').removeClass();
            $('#passstrength').addClass('generic');
            $('#passstrength').html('Más caracteres.');
        } else if (strongRegex.test($(this).val())) {
            $('#passstrength').className = 'ok';
            $('#passstrength').removeClass();
            $('#passstrength').addClass('ok');
            $('#passstrength').html('FUNSHIONA');
        } else if (mediumRegex.test($(this).val())) {
            $('#passstrength').className = 'alert';
            $('#passstrength').removeClass();
            $('#passstrength').addClass('alert');
            $('#passstrength').html('FALTA FALTA');
        } else {
            $('#passstrength').className = 'error';
            $('#passstrength').removeClass();
            $('#passstrength').addClass('error');
            $('#passstrength').html('HELL TO THE NO');
        }
        return true;
    });
})