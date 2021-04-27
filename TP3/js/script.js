function validarMail() {
    let mail = document.getElementById('mail');
    if(mail.value != '') {
        $.getJSON('validar_email', {mail: mail.value}, function(data){
            if(data.success) {
                $('#registrar').prop('disabled', false);
                mail.setCustomValidity('');
            } else {
                $('#registrar').prop('disabled', true);
                alert('El mail ya se encuentra en uso');
                mail.setCustomValidity("El mail ingresado ya esta en uso");
            }
        })
    }
}