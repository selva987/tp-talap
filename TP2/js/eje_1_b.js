var str = '';
function concatenar() {
    var texto = document.getElementById('texto');
    var delimitador = document.getElementById('delimitador');

    if(str != '') {
        str = concat_replace(str, delimitador.value, '','');
    }
    str = concat_replace(str, texto.value)

    texto.value = '';
    delimitador.disabled = true;
    texto.focus();
}

function finalizar() {
    var delimitador = document.getElementById('delimitador');
    var array = str.split(delimitador.value);

    array.forEach(function (e) {
        alert(e);
    });

    delimitador.disabled = false;
}