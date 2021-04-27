<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>VideoTrends</title>

    <link rel="stylesheet" href="<?= auto_link('css/style.css') ?>">
    <link rel="stylesheet" href="<?= auto_link('css/bootstrap.min.css') ?>" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="<?= auto_link('js/bootstrap.min.js') ?>"></script>
    <script type="text/javascript" src="<?= auto_link('js/script.js') ?>"></script>
    <link rel="shortcut icon" href="favicon.ico">
</head>
<body class="container">
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="<?= auto_link('img/logo.png') ?>" width="30" height="30" class="d-inline-block align-top">
            VideoTrend
        </a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item dropdown">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= $userdata['nombre'] ?>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <a href="<?= auto_link('usuarios/modificar') ?>" class="dropdown-item">Modificar datos</a>
                            <a href="<?= auto_link('usuarios/cerrar_sesion') ?>" class="dropdown-item" type="button">Salir</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
<main>
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Nueva búsqueda</h5>
                </div>
                <div class="card-body">
                    <form id="formBusqueda">
                        <div class="form-group row">
                            <label for="titulo" class="col-sm-2 col-form-label">Título</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="titulo" id="titulo">
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-secondary" onclick="crearLista();">Crear lista</button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="terminos" class="col-sm-2 col-form-label">Términos de búsqueda</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="terminos" onkeyup="enter(event);">
                            </div>
                            <div class="col-sm-2">
                                <button type="button" onclick="buscarVideos();" class="btn btn-danger">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body ">
                    <div class="d-flex flex-wrap justify-content-center" id="resultados">
                    </div>
                    <div class="row">
                        <div class="col">
                            <button id="buscarMas" disabled type="button" class="btn btn-primary" data-token="" onclick="buscarMas();">Buscar más</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="accordion" id="listas">
            </div>
        </div>
    </div>
</main>
<div id="modalAgregarALista" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Elija la lista</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <select id="idLista">
                    <option value="">Seleccione la lista</option>
                </select>
                <input type="hidden" id="idVideoAgregar" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="agregarVideoLista()">Guardar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>

    function buscarVideos() {
        let terminos = $('#terminos').val();
        if(terminos.length < 3) {
            alert('Debe ingresar un termino de busqueda de al menos 3 caracteres');
            return;
        }

        $.ajax({
            url: '<?= auto_link('principal/getVideos') ?>',
            dataType: 'json',
            data: {
                terminos: terminos
            },
            method: 'GET',
            error: function () {
                alert('Ocurrio un error desconocido al buscar videos');
            },
            success: function (data) {
                if(data.ok) {
                    $('#buscarMas').attr('disabled', false);
                    $('#buscarMas').attr('data-token', data.next);
                    $('#buscarMas').attr('data-terminos', terminos);;
                    $('#resultados').html(getHtmlVideos(data.results, ''));
                }
            }
        })
    }

    function buscarMas() {
        let terminos = $('#buscarMas').attr('data-terminos');
        let token = $('#buscarMas').attr('data-token');
        if(!token) return;

        $.ajax({
            url: '<?= auto_link('principal/getVideos') ?>',
            dataType: 'json',
            data: {
                terminos: terminos,
                token: token
            },
            method: 'GET',
            error: function () {
                alert('Ocurrio un error desconocido al buscar videos');
            },
            success: function (data) {
                if(data.ok) {
                    $('#buscarMas').attr('data-token', data.next);
                    let resultados = $();
                    $('#resultados').append(getHtmlVideos(data.results, ''));
                }
            }
        });
    }

    function getHtmlVideos(videos, idLista) {
        let str = '';
        if(typeof idLista === 'undefined') {
            idLista = '';
        }
        videos.forEach(function(e) {
            str+= '<div class="card card-video m-2">' +
                '           <div class="embed-responsive embed-responsive-16by9 card-img-top">\n' +
                '               <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'+e+'?rel=0" allowfullscreen></iframe>\n' +
                '           </div>\n' +
                '           <div class="card-body">\n' +
                (idLista ? '<button type="button" class="btn btn-danger" onclick="eliminarDeLista(\''+e+'\','+idLista+', this)">Eliminar</button>' : '<button type="button" class="btn btn-success" onclick="openAgregarALista(\''+e+'\')">Agregar a lista </button>')+

                '           </div>\n' +
                '       </div>'
        });

        return str;
    }

    function crearLista() {
        let titulo = $('#titulo').val();
        if(titulo == '') {
            alert('El titulo de la lista no puede estar vacío');
            return;
        }

        $.ajax({
            url: '<?= auto_link('principal/crearLista') ?>',
            dataType: 'json',
            data: {
                titulo: titulo,
            },
            method: 'GET',
            error: function () {
                alert('Ocurrio un error desconocido al crear la lista');
            },
            success: function (data) {
                if(data.ok) {
                    crearElementoLista(data.id, titulo, []);

                } else {
                    alert(data.error);
                }
            }
        });
    }

    function crearElementoLista(id, titulo, videos) {
        let str = '<div class="card">' +
            '                    <div class="card-header" id="heading'+id+'">' +
            '                        <h2 class="mb-0">' +
            '                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#lista'+id+'" aria-expanded="true" aria-controls="lista'+id+'">' +
            '                                ' + titulo +
            '                            </button>' +
            '                        </h2>' +
            '                    </div>' +
            '' +
            '                    <div id="lista'+id+'" data-id-lista="'+id+'" class="collapse" aria-labelledby="heading'+id+'" data-parent="#resultados">' +
            '                        <div class="card-body">' +
            '                            <div class="d-flex flex-wrap justify-content-center listado">' +
                                                getHtmlVideos(videos, id) +
            '                            </div>' +
            '                        </div>' +
            '                    </div>' +
            '     </div>';

        $('#listas').append(str);
        $('#idLista').append('<option value="'+id+'">'+titulo+'</option>');
    }

    function openAgregarALista(id) {
        $('#idVideoAgregar').val(id);
        $('#modalAgregarALista').modal();
        $('#idLista').val('');
    }

    function agregarVideoLista() {
        let idVideo = $('#idVideoAgregar').val();
        let idLista = $('#idLista').val();
        if(idLista == '') {
            alert('Seleccione una lista');
        }

        $.ajax({
            url: '<?= auto_link('principal/agregarVideoLista') ?>',
            data: {
                idVideo: idVideo,
                idLista: idLista,
            },
            dataType: 'json',
            error: function() {
                alert('Ocurrio un error desconocido al agregar el video');
            },
            success: function(data) {
                if(data.ok) {
                    let str = getHtmlVideos([idVideo], idLista);
                    $('#lista' + idLista).find('.listado').append(str);
                    $('#modalAgregarALista').modal('hide');
                } else {
                    alert('Ocurrio un error al agregar el video');
                }
            }
        });
    }

    function eliminarDeLista(idVideo, idLista, el) {
        if(!confirm('Esta seguro de eliminar el video?')) return;
        $.ajax({
            url: '<?= auto_link('principal/eliminarVideoLista') ?>',
            dataType: 'json',
            data: {
                idVideo: idVideo,
                idLista: idLista,
            },
            error: function() {
                alert('Ocurrio un error desconocido al agregar el video');
            },
            success: function(data) {
                if(data.ok) {
                    $(el).parent().parent().remove();
                } else {
                    alert('Ocurrio un error al agregar el video');
                }
            }
        });

    }

    function enter(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            buscarVideos();
        }
    }
    $(document).ready(function() {
        let listas = JSON.parse('<?= json_encode($listas) ?>');
        if(listas.length > 0) {

            listas.forEach(function(l) {
                crearElementoLista(l.id, l.nombre, l.videos);
            })
        }
    })
</script>
</body>
</html>