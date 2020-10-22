function valid_user(str_nom) {
    var regex = new RegExp(/[a-z]{6}[0-9]{2}/, 'i');

    return regex.test(str_nom);
}

function validar() {
    var usuario = document.getElementById('usuario');
    var span = document.getElementById('span');

    if(valid_user(usuario.value)) {
        span.classList.add('valido');
        span.classList.remove('invalido');
        span.innerHTML = 'EL usuario es valido';
    } else {
        span.classList.remove('valido');
        span.classList.add('invalido');
        span.innerHTML = 'EL usuario es invalido';
    }
}