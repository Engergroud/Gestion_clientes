<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #ff9a9e 10%, #fad0c4 100%);
        }
        .container {
            text-align: center;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .button {
            display: inline-block;
            margin: 10px;
            padding: 15px 30px;
            font-size: 18px;
            color: white;
            background: linear-gradient(135deg, #6a11cb 10%, #2575fc 100%);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.3s ease;
        }
        .button:hover {
            background: linear-gradient(135deg, #2575fc 10%, #6a11cb 100%);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Página Principal</h1>
        <a href="Formulario_Ciudades.php" class="button">Formulario Ciudad</a>
        <a href="Formulario_Clientes.php" class="button">Formulario Clientes</a>
    </div>
</body>
</html>