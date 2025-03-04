<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Registro de Destinos y Fechas de Viaje</title>
    <style>
        .register-container {
            text-align: center;
            margin-top: 20px;
        }
        #notifications-container {
            margin-top: 25px;
            text-align: center;
            color: rgb(254, 0, 0);
            font-weight: bold;
        }
        .destino {
            margin-bottom: 25px;
            border: 1px solid #ccc;
            padding: 10px;
        }
    </style>
</head>
<body>

<div class="register-container">
    <h1>Registro de Destinos y Fechas de Viaje</h1>
    <form action="procesar_registro.php" method="POST">
        <div id="destinos-container">
            <div class="destino">
                <label for="nombreHotel">Nombre del Hotel:</label>
                <input type="text" name="nombreHotel[]" required><br>

                <label for="ciudad">Ciudad:</label>
                <input type="text" name="ciudad[]" required><br>

                <label for="pais">País:</label>
                <input type="text" name="pais[]" required><br>

                <label for="fechaViaje">Fecha de Viaje:</label>
                <input type="date" name="fechaViaje[]" required><br>

                <label for="duracionViaje">Duración del Viaje (días):</label>
                <input type="number" name="duracionViaje[]" required><br>

                <label for="destino">Destino:</label>
                <input type="text" name="destino[]" list="destinations" required>
                <datalist id="destinations">
                    <!-- Las opciones se agregarán dinámicamente aquí -->
                </datalist><br>

                <button type="button" onclick="eliminarDestino(this)">Eliminar Destino</button>
            </div>
        </div>
        <button type="button" onclick="agregarDestino()">Agregar Destino</button><br><br>
        <button type="submit">Registrar Paquetes</button>
    </form>
</div>

<div id="notifications-container">
    <!-- Las notificaciones en tiempo real se mostrarán aquí -->
</div>

<script>
    class PaqueteTuristico {
        constructor(destino, fecha, oferta, disponible) {
            this.destino = destino;
            this.fecha = fecha;
            this.oferta = oferta;
            this.disponible = disponible;
        }
        obtenerDescripcion() {
            return `Destino: ${this.destino}, Fecha: ${this.fecha}, Oferta: ${this.oferta}, Disponible: ${this.disponible ? 'Sí' : 'No'}`;
        }
        actualizarDisponibilidad(nuevaDisponibilidad) {
            this.disponible = nuevaDisponibilidad;
        }
    }

    const paquetesTuristicos = [
        new PaqueteTuristico('París', '2024-07-01', '10% de descuento', true),
        new PaqueteTuristico('Roma', '2024-08-15', '15% de descuento', false),
        new PaqueteTuristico('Tokio', '2024-09-10', '20% de descuento', true)
    ];

    // Agregar destinos al datalist
    const datalist = document.getElementById('destinations');
    paquetesTuristicos.forEach(paquete => {
        const option = document.createElement('option');
        option.value = paquete.destino;
        datalist.appendChild(option);
    });

    function agregarDestino() {
        const container = document.getElementById('destinos-container');
        const newDestino = document.createElement('div');
        newDestino.classList.add('destino');
        newDestino.innerHTML = `
            <label for="nombreHotel">Nombre del Hotel:</label>
            <input type="text" name="nombreHotel[]" required><br>

            <label for="ciudad">Ciudad:</label>
            <input type="text" name="ciudad[]" required><br>

            <label for="pais">País:</label>
            <input type="text" name="pais[]" required><br>

            <label for="fechaViaje">Fecha de Viaje:</label>
            <input type="date" name="fechaViaje[]" required><br>

            <label for="duracionViaje">Duración del Viaje (días):</label>
            <input type="number" name="duracionViaje[]" required><br>

            <label for="destino">Destino:</label>
            <input type="text" name="destino[]" list="destinations" required>
            <datalist id="destinations">
                <!-- Las opciones se agregarán dinámicamente aquí -->
            </datalist><br>

            <button type="button" onclick="eliminarDestino(this)">Eliminar Destino</button>
        `;
        container.appendChild(newDestino);
    }

    function eliminarDestino(button) {
        const destino = button.parentElement;
        destino.remove();
    }

    // Función para mostrar notificaciones
    function mostrarNotificacion(mensaje) {
        const notificationsContainer = document.getElementById('notifications-container');
        const notificacionElement = document.createElement('div');
        notificacionElement.textContent = mensaje;
        notificationsContainer.appendChild(notificacionElement);
        setTimeout(() => {
            notificationsContainer.removeChild(notificacionElement);
        }, 5000);
    }

    // Intervalo para mostrar notificaciones de ofertas especiales
    setInterval(() => {
        const ofertaEspecial = paquetesTuristicos[Math.floor(Math.random() * paquetesTuristicos.length)];
        mostrarNotificacion(`Oferta Especial: ${ofertaEspecial.oferta} en ${ofertaEspecial.destino} para el ${ofertaEspecial.fecha}`);
    }, 10000);

    // Intervalo para simular actualización de disponibilidad
    setInterval(() => {
        const paqueteActualizado = paquetesTuristicos[Math.floor(Math.random() * paquetesTuristicos.length)];
        paqueteActualizado.actualizarDisponibilidad(!paqueteActualizado.disponible);
        mostrarNotificacion(`Actualización: La disponibilidad del paquete a ${paqueteActualizado.destino} ha sido actualizada a ${paqueteActualizado.disponible ? 'Disponible' : 'No Disponible'}`);
    }, 15000);
</script>

</body>
</html>
