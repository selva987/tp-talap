function login() {
    var mail = document.getElementById('mail');
    var pass = document.getElementById('password');

    $.ajax({
        url: 'ajax/login.php',
        method: 'post',
        data: {
            mail: mail.value,
            pass: pass.value
        },
        error: function () {
            alert('ocurrio un error');
        },
        success: function () {
            alert('ok');
        }
    });
}