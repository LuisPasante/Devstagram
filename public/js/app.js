import Dropzone from "dropzone";
Dropzone.autoDiscover = false;

document.addEventListener("DOMContentLoaded", function () {
    const dropzone = new Dropzone(".dropzone", {
        //url: "/ruta-del-servidor", // Asegúrate de poner la URL aquí
        dictDefaultMessage: "Sube aquí tu imagen",
        acceptedFiles: ".png,.jpg,.jpeg,.gif",
        addRemoveLinks: true,
        dictRemoveFile: "Borrar archivo",
        maxFiles: 1,
        uploadMultiple: false,
        init: function () {
            const imagenInput = document.querySelector('[name="imagen"]');
            const nombreImagen = imagenInput?.value?.trim();

            if (nombreImagen) {
                const imagenPublicada = {
                    size: 1234,
                    name: nombreImagen
                };

                this.options.addedfile.call(this, imagenPublicada);
                this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);
                imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
            }
        }

    });

    // dropzone.on('sending', function(file, xhr, formData) {
    //     console.log('Entro', file);
    // });

    dropzone.on('success', function(file, response) {
       // console.log(response);
       document.querySelector('[name="imagen"]').value = response.imagen;
    });

    // dropzone.on('error', function(file, message) {
    //     console.log(message);
    // });
    dropzone.on('removedFile', function(file, response) {
         document.querySelector('[name="imagen"]').value = "";
    });
});
