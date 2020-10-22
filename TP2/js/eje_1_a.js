function concat_replace(str_ini, str_fin, str_needle, str_to) {
    var retorno = str_ini + str_fin;

    if(str_needle != '') {
        retorno = retorno.replace(str_needle, str_to);
    }

    return retorno;
}