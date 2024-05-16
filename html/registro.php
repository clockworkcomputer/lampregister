<?php
    // Incluir el archivo de conexión a la base de datos
    include 'db.php';

    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $dni = $_POST["dni"];
        $pass = $_POST["pass"];

        // Cifrar la contraseña
        $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

        // Preparar la consulta SQL para insertar datos en la tabla cliente
        $query = "INSERT INTO cliente (dni, pass) VALUES ('$dni', '$pass_hash')";

        // Ejecutar la consulta
        if ($con->query($query) === TRUE) {
            echo "Registrado correctamente";
        } else {
            echo "Error al registrar: " . $con->error;
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Cliente</title>
</head>
<body>
    <h1>Registro de Cliente</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="dni">DNI:</label>
        <input type="text" name="dni" id="dni" autocomplete="off" required><br><br>
        <label for="pass">Contraseña:</label>
        <input type="password" name="pass" id="pass" required><br><br>
        <input type="submit" value="Registrar">
    </form>
</body>
</html>
