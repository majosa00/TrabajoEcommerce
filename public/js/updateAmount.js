"use strict";
function updateQuantity(productId, newQuantity) {
    // Realizar la solicitud AJAX
    $.ajax({
        type: 'PUT',
        url: '/cart/updateAmount/' + productId,
        data: { quantity: newQuantity },
        success: function (response) {
            // Manejar la respuesta del servidor si es necesario
            console.log(response.message);
        },
        error: function (error) {
            // Manejar el error si es necesario
            console.error('Error al actualizar la cantidad: ', error);
        }
    });
}

function more(productId) {
    let amountElement = document.getElementById('amount' + productId);
    let currentAmount = parseInt(amountElement.textContent);
    currentAmount += 1;
    amountElement.textContent = currentAmount;

    // Llamar a la función para actualizar la cantidad en la base de datos
    updateQuantity(productId, currentAmount);
}

function less(productId) {
    let amountElement = document.getElementById('amount' + productId);
    let currentAmount = parseInt(amountElement.textContent);

    if (currentAmount > 1) {
        currentAmount -= 1;
        amountElement.textContent = currentAmount;

        // Llamar a la función para actualizar la cantidad en la base de datos
        updateQuantity(productId, currentAmount);
    }
}
