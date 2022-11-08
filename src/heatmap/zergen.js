function cards() {
    document.getElementById("card1").style.display = "none";
    document.getElementById("card2").style.display = "none";
    document.getElementById("cajita").style.display = "inline";
}

function crearMapa() {
    document.getElementById("cajita").style.display = "none";
    document.getElementById("cargando").style.display = "flex";
    document.getElementById("mapBlue").style.display = "inline";
    document.getElementById("mapRed").style.display = "inline";
}