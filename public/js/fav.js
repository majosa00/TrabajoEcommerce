"use strict";

function toggleWishlist(productId) {
    const heartIcon = document.getElementById('heartIcon' + productId);
    const wishlistBtn = document.getElementById('wishlistBtn' + productId);

    if (wishlistBtn.classList.contains('red')) {
        // Realiza la acción para desmarcar de la wishlist (puedes llamar a tu función del controlador aquí)
        heartIcon.classList.remove('fas');
        heartIcon.classList.add('far');
        wishlistBtn.classList.remove('red');
        // Elimina el producto de la wishlist almacenado localmente
        localStorage.removeItem('wishlistProduct' + productId);
    } else {
        // Realiza la acción para marcar en la wishlist (puedes llamar a tu función del controlador aquí)
        heartIcon.classList.remove('far');
        heartIcon.classList.add('fas');
        wishlistBtn.classList.add('red');
        // Agrega el producto a la wishlist almacenado localmente
        localStorage.setItem('wishlistProduct' + productId, 'true');
    }
}
