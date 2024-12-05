function mostrarCotizacion() {
    const cotizacionForm = document.getElementById('formPaquete');  // Primer formulario (cotización)
    const resultadoForm = document.getElementById('formResultado');  // Segundo formulario (resultado)

    const formulario = document.getElementById('cotizacionForm');
    
    const nombrePaquete = formulario.nombre_paquete.value;
    const nombreEvento = formulario.nombre_evento.options[formulario.nombre_evento.selectedIndex]?.text || "Evento no seleccionado";
    const servicios = formulario.querySelectorAll('input[name="servicios[]"]:checked');
    
    let totalCotizacion = 0;
    let detalleServicios = '';

    // Itera sobre los servicios seleccionados
    servicios.forEach((servicio) => {
        const precioServicio = parseFloat(servicio.value);  // Obtiene el precio en MXN
        const descuento = precioServicio * 0.10;  // Calcula el 10% de descuento
        const precioFinal = precioServicio - descuento;  // Aplica el descuento

        totalCotizacion += precioFinal;  // Acumula el total
        detalleServicios += `${servicio.parentElement.textContent.trim()} - ${precioFinal.toFixed(2)} MXN<br>`;  // Detalle del servicio con el precio con descuento
    });

    // Muestra los resultados de la cotización
    const detalleCotizacionHTML = document.getElementById('detalleCotizacion');
    detalleCotizacionHTML.innerHTML = `
        <strong>Nombre del Paquete:</strong> ${nombrePaquete}<br>
        <strong>Evento seleccionado:</strong> ${nombreEvento}<br>
        <strong>Servicios seleccionados:</strong><br> ${detalleServicios}
        <strong>Total de la Cotización (con descuento):</strong> ${totalCotizacion.toFixed(2)} MXN
    `;

    // Oculta el formulario de cotización y muestra el formulario de resultados
    cotizacionForm.classList.remove('active');
    resultadoForm.classList.add('active');
}

function mostrarFormularioCotizacion() {
    const cotizacionForm = document.getElementById('formPaquete');  // Primer formulario (cotización)
    const resultadoForm = document.getElementById('formResultado');  // Segundo formulario (resultado)

    // Muestra el formulario de cotización y oculta el formulario de resultados
    cotizacionForm.classList.add('active');
    resultadoForm.classList.remove('active');
}
