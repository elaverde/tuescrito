function helperResponseMessage(response, message=null) {
    //validamos deato para vver si hay una excepcion
    try {
        let t = response.status;
    }
    catch (e) {
        Swal.fire({
            text: 'Error al procesar la información',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
        console.log(e);
        console.log(response);
        return;
    };
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
function helperPagination(options){
    let page = options.page || 1;
    let pageSize = options.pageSize || 10;
    let totalPages = options.totalPages || 1;
    let url = options.url;
    
    function fetchData() {
        return axios.get(url, {
        params: {
            page,
            pageSize
        }
        })
        .then(response => {
            return response.data;
        })
        .catch(error => {
            console.error(error);
        });
    }
    function goToPage(newPage) {
        page = newPage;
        fetchData();
    }
    function previousPage() {
        if (page === 1) {
        return;
        }
        page--;
        fetchData();
    }

    function nextPage() {
        if (page === totalPages) {
        return;
        }
        page++;
        fetchData();
    }
    return {
        fetchData,
        goToPage,
        previousPage,
        nextPage
    };
}