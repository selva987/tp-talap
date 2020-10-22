<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>VideoTrends - Login</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <link rel="shortcut icon" href="favicon.ico">
</head>
<body class="container">
<header>
    <nav class="navbar navbar-expand navbar-light bg-light navbar-top">
        <a class="navbar-brand" href="index.html">
            <img src="img/logo.png" class="d-inline-block align-top">
            <h1 class="titulo">VideoTrend</h1>

        </a>
        <span class="subtitulo">Mira tus videos de YouTube como quieras</span>
    </nav>
    <nav class="navbar navbar-expand navbar-light bg-light justify-content-center">
        <ul class="navbar-nav nav-ul">
            <li class="nav-item">
                <a href="registro.html" class="nav-link">Crear una Cuenta</a>
            </li>
            <li class="nav-item nav-link">|</li>
            <li class="nav-item">
                <a href="#" class="nav-link">Olvidé mi contraseña</a>
            </li>
            <li class="nav-item nav-link">|</li>
            <li class="nav-item">
                <a href="#" class="nav-link" data-toggle="modal" data-target="#acercaDe">Acerca de Nosotros</a>
            </li>
        </ul>
    </nav>
</header>

<main id="login" class="card m-2">
    <div class="card-body container-fluid row justify-content-center">
        <aside class="col-xs-12 col-md-6 text-center">
            <img src="img/login-aside.jpg" alt="imagen del lado" class="redondo">
        </aside>
        <section class="col-xs-12 col-md-6 text-center login-form">
            <form method="post">
                <div class="form-group">
                    <input type="email" required id="mail" name="mail" class="form-control text-center">
                    <label for="mail">E-mail</label>
                </div>
                <div class="form-group">
                    <input type="password" required id="password" name="password" class="form-control text-center">
                    <label for="password">Contraseña</label>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-outline-dark w-100">Iniciar Sesión</button>
                </div>
                <hr>
                <div class="form-group">
                    <a href="registro.html" class="btn btn-outline-primary w-100">Crear una cuenta</a>
                </div>
            </form>
        </section>
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

<div class="modal fade" id="acercaDe" data-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">TP1 de taller de aplicaciones web</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Alumno: Selva Ricardo Federico - 65363
            </div>
        </div>
    </div>
</div>
</body>
</html>