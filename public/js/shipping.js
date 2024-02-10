"use strict"

document.addEventListener('DOMContentLoaded', function () {
    var select = document.getElementById('address');
    var form = document.getElementById('newAddressForm');

    select.addEventListener('change', function () {
        var option = this.options[this.selectedIndex];
        var toggleTarget = option.getAttribute('data-toggle');
        if (toggleTarget) {
            var targetElement = document.querySelector(toggleTarget);
            if (targetElement) {
                var display = targetElement.style.display === 'none' ? 'block' : 'none';
                targetElement.style.display = display;
            }
        }
    });
});