<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/formapago.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos</title>
</head>
<body>

    <div class="container mt-5">
        <!-- Opciones de pago -->
        <div class="payment-options d-flex justify-content-between mb-5">
            <button class="btn btn-personalizado" onclick="location.href='https://www.paypal.com/mx/home';">
                <img src="../../img/pago1.png" class="logo" alt="PayPal">
            </button>
            <button class="btn btn-personalizado" onclick="location.href='https://www.apple.com/mx/apple-pay/';">
                <img src="../../img/pago2.png" class="logo" alt="Apple Pay">
            </button>
            <button class="btn btn-personalizado" onclick="location.href='https://pay.google.com/intl/es_mx/about/';">
                <img src="../../img/pago3.png" class="logo" alt="Google Pay">
            </button>
        </div>

        <!-- Línea divisoria -->
        <div class="separator text-center mb-4">
            <hr class="line">
            <p class="pagoC">Puedes pagar usando una tarjeta de crédito</p>
            <hr class="line">
        </div>

        <!-- Formulario de pago con tarjeta -->
        <div class="credit-card-info">
            <div class="input_container mb-3">
                <label for="name" class="input_label">Nombre completo del titular de la tarjeta</label>
                <input id="name" class="form-control" type="text" placeholder="Ingresa tu nombre completo">
            </div>
            <div class="input_container mb-3">
                <label for="card-number" class="input_label">Número de Tarjeta</label>
                <input id="card-number" class="form-control" type="text" placeholder="0000 0000 0000 0000">
            </div>
            <div class="input_container mb-4">
                <label for="expiry-cvv" class="input_label">Fecha de Vencimiento / CVV</label>
                <div class="split d-flex gap-3">
                    <input id="expiry-date" class="form-control" type="text" placeholder="MM/AA">
                    <input id="cvv" class="form-control" type="text" placeholder="CVV">
                </div>
            </div>

            <!-- Botones -->
            <div class="d-flex justify-content-between">
                <button class="btn btn-primary" onclick="location.href='https://www.paypal.com/mx/home';">Confirmar</button>
                <button class="btn btn-secondary" onclick="location.href='?c=cotizacion';">Regresar</button>
            </div>
        </div>
    </div>

</body>
</html>
