
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form.needs-validation');

    form.addEventListener('submit', function(event) {
        let isValid = true;
        
        // Validación de campos numéricos
        const numericFields = form.querySelectorAll('input[type="number"]');
        numericFields.forEach(input => {
            if (input.value <= 0) {
                isValid = false;
                showInvalidFeedback(input, 'Value must be greater than 0');
            } else {
                hideInvalidFeedback(input);
            }
        });

        // Validación de campos de texto
        const textFields = form.querySelectorAll('input[type="text"], textarea');
        textFields.forEach(input => {
            // Excluye el campo 'description' de esta validación
            if (input.id !== 'description') {
                if (!/^[a-zA-Z\s]*$/.test(input.value)) {
                    isValid = false;
                    showInvalidFeedback(input, 'Please enter only letters and spaces');
                } else {
                    hideInvalidFeedback(input);
                }
            }
        });

        // Si el formulario no es válido, previene el envío
        if (!isValid) {
            event.preventDefault();
            // Añade aquí cualquier otra acción necesaria cuando el formulario no es válido
        }
    });

    function showInvalidFeedback(input, message) {
        input.classList.add('is-invalid'); // Asume el uso de Bootstrap para la clase de invalid-feedback
        const feedbackElement = input.nextElementSibling;
        if (feedbackElement) {
            feedbackElement.textContent = message;
            feedbackElement.style.display = 'block';
        }
    }

    function hideInvalidFeedback(input) {
        input.classList.remove('is-invalid');
        const feedbackElement = input.nextElementSibling;
        if (feedbackElement) {
            feedbackElement.style.display = 'none';
        }
    }
});

