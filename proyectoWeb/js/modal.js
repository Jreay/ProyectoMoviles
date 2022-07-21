let cerrar = document.querySelectorAll(".close")[0];
let abrir = document.querySelectorAll(".sign-in")[0];
let ventana = document.querySelectorAll(".ventana")[0];
let container = document.querySelectorAll(".modal-container")[0];

abrir.addEventListener("click", function(e) {
    e.preventDefault();
    container.style.opacity = "1";
    container.style.visibility = "visible";
    ventana.classList.toggle("ventana-close");

})

cerrar.addEventListener("click", function() {
    ventana.classList.toggle("ventana-close");
    setTimeout(function() {
        container.style.opacity = "0";
        container.style.visibility = "hidden";
    }, 850)

})

window.addEventListener("click", function(e) {
    if (e.target == container) {
        ventana.classList.toggle("ventana-close");
        setTimeout(function() {
            container.style.opacity = "0";
            container.style.visibility = "hidden";
        }, 850)
    }
})

function ConfirmSession() {
    var respuesta = confirm("¿Está seguro que desea cerrar sesión?");
    if (respuesta == true) {
        //header("location: index.php")
        return true;
    } else {
        return false;
    }
}

function ConfirmDelete() {
    var respuesta = confirm("¿Esta seguro que desea eliminar esta actividad?");
    if (respuesta == true) {

        return true;
    } else {
        return false;
    }
}