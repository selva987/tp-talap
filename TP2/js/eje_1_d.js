class DatosLogin {
    constructor(mail, pass) {
        this.mail = mail;
        this.pass = pass;
    }

    mostrarDatos() {
        alert('Email: ' + this.mail + ' Password: ' +this.pass);
    }

}

function login() {
    var mail = document.getElementById('mail');
    var pass = document.getElementById('password');

    var datos = new DatosLogin(mail.value, pass.value);

    datos.mostrarDatos();
}