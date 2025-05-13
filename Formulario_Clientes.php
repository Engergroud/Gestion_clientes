<?php
include ('Conexion.php');

// Función para obtener ciudades
function getCiudades($conn) {
    $sql = "SELECT id_ciudad, nombre FROM Ciudades";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Función para obtener todos los clientes
function getClientes($conn) {
    $sql = "SELECT id_cliente, nombre, rnc, telefono, direccion, id_ciudad FROM Clientes";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getCiudadNombre($conn, $id_ciudad) {
    $sql = "SELECT nombre FROM Ciudades WHERE id_ciudad = $id_ciudad";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['nombre'];
}

// Función para validar que el RNC y el teléfono sean únicos
function validarUnicidad($conn, $rnc, $telefono, $id_cliente = null) {
    $sql = "SELECT COUNT(*) as count FROM Clientes WHERE (rnc = '$rnc' OR telefono = '$telefono')";
    if ($id_cliente) {
        $sql .= " AND id_cliente != $id_cliente";
    }
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['count'] == 0;
}

// Función para crear un nuevo cliente
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['crear_cliente'])) {
    $nombre = $_POST['nombre'];
    $rnc = $_POST['rnc'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $id_ciudad = $_POST['id_ciudad'];

    if (validarUnicidad($conn, $rnc, $telefono)) {
        $sql = "INSERT INTO Clientes (nombre, rnc, telefono, direccion, id_ciudad) VALUES ('$nombre', '$rnc', '$telefono', '$direccion', $id_ciudad)";
        if ($conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>alert('Cliente creado exitosamente');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<script type='text/javascript'>alert('El RNC o el teléfono ya están en uso.');</script>";
    }
}

// Función para editar un cliente existente
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['actualizar_cliente'])) {
    $id_cliente = $_POST['id_cliente'];
    $nombre = $_POST['nombre'];
    $rnc = $_POST['rnc'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $id_ciudad = $_POST['id_ciudad'];

    if (validarUnicidad($conn, $rnc, $telefono, $id_cliente)) {
        $sql = "UPDATE Clientes SET nombre='$nombre', rnc='$rnc', telefono='$telefono', direccion='$direccion', id_ciudad=$id_ciudad WHERE id_cliente=$id_cliente";
        if ($conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>alert('Cliente actualizado exitosamente');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<script type='text/javascript'>alert('El RNC o el teléfono ya están en uso.');</script>";
    }
}

// Función para eliminar un cliente
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar_cliente'])) {
    $id_cliente = $_POST['id_cliente'];

    $sql = "DELETE FROM Clientes WHERE id_cliente=$id_cliente";
    if ($conn->query($sql) === TRUE) {
        echo "<script type='text/javascript'>alert('Cliente eliminado exitosamente');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Obtener ciudades
$ciudades = getCiudades($conn);

// Obtener clientes
$clientes = getClientes($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Clientes</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>
<div style="text-align: right; margin-bottom: 20px;">
        <button onclick="window.location.href='index.php'">Volver a Inicio</button>
    </div>
    <h1>Formulario de Clientes</h1>
    <form id="Form_Cli" method="post" action="Formulario_Clientes.php">
        <input type="hidden" name="id_cliente" id="id_cliente" value="">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required><br>
        <label for="rnc">RNC:</label>
        <input type="text" name="rnc" id="rnc" required><br>
        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono" required><br>
        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" id="direccion"><br>
        <label for="id_ciudad">Ciudad:</label>
        <select name="id_ciudad" id="id_ciudad" required>
            <?php foreach ($ciudades as $ciudad): ?>
                <option value="<?php echo $ciudad['id_ciudad']; ?>"><?php echo $ciudad['nombre']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <button type="submit" name="crear_cliente">Crear Cliente</button>
        <button type="submit" name="actualizar_cliente" style="display:none;" id="actualizar_cliente">Actualizar Cliente</button>
    </form>

    <div id="clientes-lista">
        <?php foreach ($clientes as $cliente): ?>
            <div class="cliente-item">
                <table>
                    <tr>
                        <th><p><strong>Nombre:</strong></p></th>
                        <td><?php echo $cliente['nombre']; ?></td>
                    </tr>
                    <tr>
                        <th><p><strong>RNC:</strong></p></th>
                        <td><?php echo $cliente['rnc']; ?></td>
                    </tr>
                    <tr>
                        <th><p><strong>Teléfono:</strong></p></th>
                        <td><?php echo $cliente['telefono']; ?></td>
                    </tr>
                    <tr>
                        <th><p><strong>Dirección:</strong></p></th>
                        <td><?php echo $cliente['direccion']; ?></td>
                    </tr>
                    <tr>
                        <th><p><strong>Ciudad:</strong></p></th>
                        <td><?php echo getCiudadNombre($conn, $cliente['id_ciudad']); ?></td>
                    </tr>
                </table>
                <button type="button" onclick="editarCliente(<?php echo $cliente['id_cliente']; ?>, '<?php echo $cliente['nombre']; ?>', '<?php echo $cliente['rnc']; ?>', '<?php echo $cliente['telefono']; ?>', '<?php echo $cliente['direccion']; ?>', <?php echo $cliente['id_ciudad']; ?>)">Editar Cliente</button>
                <form method="post" action="Formulario_Clientes.php" style="display:inline; border:0">
                    <input type="hidden" name="id_cliente" value="<?php echo $cliente['id_cliente']; ?>">
                    <button type="submit" name="eliminar_cliente">Eliminar Cliente</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <script>
        function editarCliente(id_cliente, nombre, rnc, telefono, direccion, id_ciudad) {
            document.getElementById('id_cliente').value = id_cliente;
            document.getElementById('nombre').value = nombre;
            document.getElementById('rnc').value = rnc;
            document.getElementById('telefono').value = telefono;
            document.getElementById('direccion').value = direccion;
            document.getElementById('id_ciudad').value = id_ciudad;

            // Mostrar el botón de actualizar y ocultar el de crear
            document.querySelector('button[name="crear_cliente"]').style.display = 'none';
            document.getElementById('actualizar_cliente').style.display = 'inline';
        }

        document.getElementById('Form_Cli').addEventListener('submit', function() {
            setTimeout(function() {
                location.reload(); // Recarga la página para actualizar la lista de clientes
            }, 100);
        });
    </script>
</body>
</html>