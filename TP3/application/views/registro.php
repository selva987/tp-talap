<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>VideoTrends - Registro</title>

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="../js/bootstrap.min.js" ></script>
    <script type="text/javascript" src="../js/script.js"></script>

    <link rel="shortcut icon" href="../favicon.ico">
</head>
<body class="container">
<header>
    <nav class="navbar navbar-expand navbar-light bg-light navbar-top">
        <a class="navbar-brand" href="index.html">
            <img src="../img/logo.png" class="d-inline-block align-top">
            <h1 class="titulo">VideoTrend</h1>
        </a>
        <span class="subtitulo">Mira tus videos de YouTube como quieras</span>
    </nav>
    <nav class="navbar navbar-expand navbar-light bg-light justify-content-center">
        <ul class="navbar-nav nav-ul">
            <li class="nav-item">
                <a href="../usuarios/registrar" class="nav-link">Crear una Cuenta</a>
            </li>
            <li class="nav-item nav-link">|</li>
            <li class="nav-item">
                <a href="#" class="nav-link">Olvidé mi contraseña</a>
            </li>
            <li class="nav-item nav-link">|</li>
            <li class="nav-item">
                <a href="#" class="nav-link">Acerca de Nosotros</a>
            </li>
        </ul>
    </nav>
</header>
<main class="card m-2">
    <div class="card-body container-fluid row justify-content-center px-4">
    <h1><?= ($user && !$error ? 'Editar datos de usuario' : 'Registro de usuarios') ?></h1>
    <div class="row">
        <?php if(isset($error)) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $error ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php } ?>
    <form method="post" action="../usuarios/<?= ($user && !$error ? 'modificar_datos' : 'nuevo_usuario') ?>" class="col-8">
        <section class="seccion-registro">
            <h4>Datos de Inicio de Sesión</h4>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="mail">E-mail*</label>
                <div class="col-sm-8">
                    <input class="form-control" type="email" onblur="validarMail();" name="mail" id="mail" value="<?= $user['mail'] ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="password">Contraseña*</label>
                <div class="col-sm-8">
                    <input class="form-control" type="password" name="password" id="password" <?= ($user && !$error ? '' : 'required') ?>>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="repetir_password">Repetir Contraseña*</label>
                <div class="col-sm-8">
                    <input class="form-control" type="password" name="repetir_password" id="repetir_password" <?= ($user && !$error ? '' : 'required') ?>>
                </div>
            </div>
        </section>
        <section class="seccion-registro">
            <h4>Datos personales</h4>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="nombre">Nombre</label>
                <div class="col-sm-8">
                    <input class="form-control" type="text" name="nombre" id="nombre" maxlength="60" value="<?= $user['nombre'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="apellido">Apellido</label>
                <div class="col-sm-8">
                    <input class="form-control" type="text" name="apellido" id="apellido" maxlength="60" value="<?= $user['apellido'] ?>" >
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Género</label>
                <div class="form-check form-check-inline px-3">
                    <input <?= ($user && $user['genero']=='M' ? 'checked' : '') ?> class="form-check-input" type="radio" name="genero" id="generoM" value="M">
                    <label class="form-check-label" for="generoM">Masculino</label>
                </div>
                <div class="form-check form-check-inline mx-5">
                    <input <?= ($user && $user['genero']=='F' ? 'checked' : '') ?> class="form-check-input" type="radio" name="genero" id="generoF" value="F">
                    <label class="form-check-label" for="generoF">Femenino</label>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="telefono">Número de teléfono</label>
                <div class="col-sm-8">
                    <input class="form-control" type="tel" name="telefono" id="telefono" value="<?= $user['telefono'] ?>">
                </div>
            </div>
                <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="fecha_nacimiento">Fecha de nacimiento</label>
                <div class="col-sm-8">
                        <input class="form-control" type="date" name="fecha_nacimiento" value="<?= $user['fecha_nacimiento'] ?>" id="fecha_nacimiento">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="pagina_web">Página web</label>
                <div class="col-sm-8">
                    <input class="form-control" type="url" name="pagina_web" id="pagina_web" value="<?= $user['pagina_web'] ?>">
                </div>
            </div>
        </section>
        <section class="seccion-registro">
            <h4>Datos de localización</h4>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="pais">País</label>
                <div class="col-sm-8">
                    <select class="form-control" name="pais" id="pais">
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="provincia">Provincia/Estado</label>
                <div class="col-sm-8">
                    <select class="form-control" name="provincia" id="provincia">
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="ciudad">Ciudad</label>
                <div class="col-sm-8">
                    <select class="form-control" name="ciudad" id="ciudad">
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="altura">Altura (número)</label>
                <div class="col-sm-8">
                    <input class="form-control" type="number" name="altura" id="altura"  value="<?= $user['altura'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Coordenadas</label>
                <div class="col-sm-2">
                    <input class="form-control" type="text" name="latitud" id="latitud" value="<?= $user['latitud'] ?>">

                </div>
                <label class="col-sm-2 col-form-label" for="latitud">Lat.</label>
                <div class="col-sm-2">
                    <input class="form-control" type="text" name="longitud" id="longitud" value="<?= $user['longitud'] ?>">

                </div>
                <label class="col-sm-2 col-form-label" for="latitud">Long.</label>
            </div>
        </section>
        <div class="text-center">
            <button id="registrar" class="btn btn-outline-dark w-75 " type="submit"><?= ($user && !$error ? 'Guardar datos' : 'Crear mi cuenta') ?></button>
        </div>
    </form>
    <aside class="col-4">
        <div class="sticky-top my-5 text-center">
            <img src="../img/registro-aside.png" class="img-fluid w-75" alt="imagen del lado">
            <?php if(!$user || $error) { ?>
            <p class="footer_img text-justify mt-2">Al hacer clic en "Crear mi cuenta", aceptas las Condiciones y confirmas que leíste
                nuestra Política de datos, incluido el uso de cookies.</p>
            <?php } ?>
        </div>
    </aside>
    </div>
    </div>
</main>

<footer>
    <nav class="navbar navbar-expand navbar-dark bg-dark justify-content-center">
        <ul class="navbar-nav">
            <li class="nav-item"><a target="_blank" class="nav-link" href="https://youtube.com">YouTube</a></li>
            <li class="nav-item nav-link">-</li>
            <li class="nav-item"><a target="_blank" class="nav-link" href="https://ugd.edu.ar">U.G.D.</a></li>
            <li class="nav-item nav-link">-</li>
            <li class="nav-item"><a target="_blank" class="nav-link" href="https://campusvirtual.ugd.edu.ar">Campus Virtual</a></li>
        </ul>
    </nav>
</footer>
</body>
</html>