"use strict"

document.addEventListener('DOMContentLoaded', function () {
    let select = document.getElementById('address');
    let form = document.getElementById('newAddressForm');

    select.addEventListener('change', function () {
        let option = this.options[this.selectedIndex];
        let toggleTarget = option.getAttribute('data-toggle');
        if (toggleTarget) {
            let targetElement = document.querySelector(toggleTarget);
            if (targetElement) {
                let display = targetElement.style.display === 'none' ? 'block' : 'none';
                targetElement.style.display = display;
            }
        }
    });
});