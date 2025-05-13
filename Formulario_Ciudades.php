<?php
include ('Conexion.php');

// Función para obtener ciudades
function getCiudades($conn) {
    $sql = "SELECT id_ciudad, nombre FROM Ciudades";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Función para crear una nueva ciudad
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crear_ciudad'])) {
    $nombre = $_POST['nombre'];

    $sql = "INSERT INTO Ciudades (nombre) VALUES ('$nombre')";
    if ($conn->query($sql) === TRUE) {
        echo "<script type='text/javascript'>alert('Ciudad creada exitosamente');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Función para editar una ciudad existente
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['actualizar_ciudad'])) {
    $id_ciudad = $_POST['id_ciudad'];
    $nombre = $_POST['nombre'];

    $sql = "UPDATE Ciudades SET nombre='$nombre' WHERE id_ciudad=$id_ciudad";
    if ($conn->query($sql) === TRUE) {
        echo "<script type='text/javascript'>alert('Ciudad actualizada exitosamente');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Función para eliminar una ciudad
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar_ciudad'])) {
    $id_ciudad = $_POST['id_ciudad'];

    $sql = "DELETE FROM Ciudades WHERE id_ciudad=$id_ciudad";
    if ($conn->query($sql) === TRUE) {
        echo "<script type='text/javascript'>alert('Ciudad eliminada exitosamente');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Obtener ciudades
$ciudades = getCiudades($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Ciudades</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>
    <div style="text-align: right; margin-bottom: 20px;">
        <button onclick="window.location.href='index.php'">Volver a Inicio</button>
    </div>

    <h1>Formulario de Ciudades</h1>
    <form id="Form_Ciudad" method="post" action="Formulario_Ciudades.php">
        <input type="hidden" name="id_ciudad" id="id_ciudad" value="">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required><br>
        <button type="submit" name="crear_ciudad">Crear Ciudad</button>
        <button type="submit" name="actualizar_ciudad" style="display:none;" id="actualizar_ciudad">Actualizar Ciudad</button>
    </form>

    <div id="ciudades-lista">
        <?php foreach ($ciudades as $ciudad): ?>
            <div class="ciudad-item">
                <table>
                    <tr>
                        <th><p><strong>Nombre:</strong></p></th>
                        <td><?php echo $ciudad['nombre']; ?></td>
                    </tr>
                </table>
                <button type="button" onclick="editarCiudad(<?php echo $ciudad['id_ciudad']; ?>, '<?php echo $ciudad['nombre']; ?>')">Editar Ciudad</button>
                <form method="post" action="Formulario_Ciudades.php" style="display:inline; border:0">
                    <input type="hidden" name="id_ciudad" value="<?php echo $ciudad['id_ciudad']; ?>">
                    <button type="submit" name="eliminar_ciudad">Eliminar Ciudad</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <script>
        function editarCiudad(id_ciudad, nombre) {
            document.getElementById('id_ciudad').value = id_ciudad;
            document.getElementById('nombre').value = nombre;

            // Mostrar el botón de actualizar y ocultar el de crear
            document.querySelector('button[name="crear_ciudad"]').style.display = 'none';
            document.getElementById('actualizar_ciudad').style.display = 'inline';
        }

        document.getElementById('Form_Ciudad').addEventListener('submit', function() {
            setTimeout(function() {
                location.reload(); // Recarga la página para actualizar la lista de ciudades
            }, 100);
        });
    </script>
</body>
</html>