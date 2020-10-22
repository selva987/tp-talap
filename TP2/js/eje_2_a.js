$(document).ready(function() {
    var cols = $('#tabla_usuarios tr th');
    $('#tabla_usuarios .row_usuario').each(function() {
        $('td', this).each(function(i) {
            alert(cols[i].innerHTML + ': ' + this.innerHTML);
        })
    })
});