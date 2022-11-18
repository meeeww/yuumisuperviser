function cards() {
    document.getElementById("card1").style.display = "none";
    document.getElementById("cajita").style.display = "inline";
}

function crearMapa() {
    document.getElementById("cajita").style.display = "none";
    document.getElementById("cargando").style.display = "flex";
    document.getElementById("mapBlue").style.display = "inline";
    document.getElementById("mapRed").style.display = "inline";
}

function settings(tipo) {
    document.getElementById("account").style.display = "none";
    document.getElementById("password").style.display = "none";
    document.getElementById("security").style.display = "none";
    document.getElementById("application").style.display = "none";
    document.getElementById("notification").style.display = "none";
    document.getElementById(tipo).style.display = "block";
}