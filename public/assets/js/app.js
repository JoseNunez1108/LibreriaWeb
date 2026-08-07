document.addEventListener('DOMContentLoaded', () => {
    const formulario = document.querySelector('#formularioContacto');

    if (!formulario) {
        return;
    }

    formulario.addEventListener('submit', (event) => {
        const campos = formulario.querySelectorAll(
            'input[required], textarea[required]'
        );

        let formularioValido = true;

        campos.forEach((campo) => {
            campo.classList.remove('is-invalid');

            if (campo.value.trim() === '') {
                campo.classList.add('is-invalid');
                formularioValido = false;
            }
        });

        const correo = formulario.querySelector('#correo');

        if (
            correo &&
            correo.value.trim() !== '' &&
            !correo.checkValidity()
        ) {
            correo.classList.add('is-invalid');
            formularioValido = false;
        }

        if (!formularioValido) {
            event.preventDefault();
        }
    });
});
