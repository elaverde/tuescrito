function helperResponseMessage(response, message=null) {
    switch (response.status) {
        case 201:
            Swal.fire({
                text: message ? message : 'Buen trabajo, información almacenada correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
            break;
        case 200:
            Swal.fire({
                text: message ? message : 'Buen trabajo, información actualizada correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
            break;
        case 204:
            Swal.fire({
                text: message ? message : 'Buen trabajo, información eliminada correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
            break;
        case 400:
            Swal.fire({
                text: message ? message : 'Error al almacenar la información',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
            break;
        default:
            Swal.fire({
                text: message ? message :'Ha ocurrido un error inesperado',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
            break;
    }
}