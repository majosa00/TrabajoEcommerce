"use strict";

function actualizarCantidad(cantidad) {
    // Obtén el ID del producto o la información necesaria
    let productoId = 1; // Reemplaza esto con la lógica adecuada para obtener el ID del producto

    // Realiza una solicitud AJAX a tu controlador
    axios.post('/actualizar-cantidad', {
        producto_id: productoId,
        cantidad: cantidad
    })
    .then(response => {
        // Actualiza la cantidad en la interfaz
        document.getElementById('cantidad').innerText = response.data.nuevaCantidad;
    })
    .catch(error => {
        console.error('Error al actualizar la cantidad', error);
    });
}
