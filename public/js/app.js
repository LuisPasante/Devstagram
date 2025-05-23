 import Dropzone from "dropzone";
Dropzone.autoDiscover = false;

document.addEventListener("DOMContentLoaded", function () {
    const dropzone = new Dropzone(".dropzone", {
        url: "/ruta-del-servidor", // Asegúrate de poner la URL aquí
        dictDefaultMessage: "Sube aquí tu imagen",
        acceptedFiles: ".png,.jpg,.jpeg,.gif",
        addRemoveLinks: true,
        dictRemoveFile: "Borrar archivo",
        maxFiles: 1,
        uploadMultiple: false,
    });

    dropzone.on('sending', function(file, xhr, formData) {
        console.log('Entro', file);
    });

    dropzone.on('success', function(file, response) {
        console.log(response);
    });

    dropzone.on('error', function(file, message) {
        console.log(message);
    });
    dropzone.on('removedFile', function(file, response) {
        console.log('Archivo Eliminado');
    });
});
