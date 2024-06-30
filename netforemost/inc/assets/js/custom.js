document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
        offset: 200, // Desplazamiento (en px) desde el borde superior del elemento antes de que se active la animación
        duration: 1000, // Duración de la animación (en ms)
        easing: 'ease-in-out', // Tipo de easing para la animación
        delay: 200, // Retraso de inicio de la animación (en ms)
        once: true // Si se debe ejecutar la animación solo una vez
    });
});
